<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function bookingChat($id)
    {
        $user       = Auth::user();
        $serviceReq = DB::table('service_requests')->where('id', $id)->first();

        abort_if(! $serviceReq, 404, 'Request nahi mili.');

        $isSeeker   = $user->id === (int) $serviceReq->user_id;
        $isProvider = $user->role === 'provider';

        abort_unless($isSeeker || $isProvider, 403, 'Access denied.');

        if ($isProvider) {
            $otherUser = User::findOrFail($serviceReq->user_id);
        } else {
            $providerId = $serviceReq->provider_id ?? null;
            abort_if(! $providerId, 404, 'Koi provider assign nahi hua abhi tak.');
            $otherUser = User::findOrFail($providerId);
        }

        $messages = ChatMessage::where('booking_id', $id)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        ChatMessage::where('booking_id', $id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.booking', [
            'serviceReq' => $serviceReq,
            'messages'   => $messages,
            'otherUser'  => $otherUser,
        ]);
    }

    public function sendMessage(Request $request, $id): JsonResponse
    {
        try {
            $user       = Auth::user();
            $serviceReq = DB::table('service_requests')->where('id', $id)->first();

            if (! $serviceReq) {
                return response()->json(['error' => 'Service request nahi mili.'], 404);
            }

            $isSeeker   = $user->id === (int) $serviceReq->user_id;
            $isProvider = $user->role === 'provider';

            if (! $isSeeker && ! $isProvider) {
                return response()->json(['error' => 'Access denied.'], 403);
            }

            $request->validate(['message' => 'required|string|max:2000']);

            if ($isProvider) {
                $receiverId = (int) $serviceReq->user_id;
                $senderType = 'provider';
            } else {
                $receiverId = (int) ($serviceReq->provider_id ?? 0);
                $senderType = 'seeker';
            }

            if (! $receiverId) {
                return response()->json(['error' => 'Receiver nahi mila.'], 422);
            }

            $msg = ChatMessage::create([
                'booking_id'  => $id,
                'sender_id'   => $user->id,
                'receiver_id' => $receiverId,
                'message'     => $request->message,
                'sender_type' => $senderType,
            ]);

            $msg->load('sender');
            broadcast(new ChatMessageSent($msg));

            return response()->json([
                'success' => true,
                'message' => [
                    'id'          => $msg->id,
                    'message'     => $msg->message,
                    'sender_id'   => $msg->sender_id,
                    'sender_name' => $user->name,
                    'sender_type' => $senderType,
                    'time'        => $msg->created_at->format('h:i A'),
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Chat sendMessage error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function pollMessages(Request $request, $id): JsonResponse
    {
        $user       = Auth::user();
        $serviceReq = DB::table('service_requests')->where('id', $id)->first();

        abort_if(! $serviceReq, 404);

        $isSeeker   = $user->id === (int) $serviceReq->user_id;
        $isProvider = $user->role === 'provider';
        abort_unless($isSeeker || $isProvider, 403);

        $since    = (int) $request->input('since', 0);
        $messages = ChatMessage::where('booking_id', $id)
            ->where('id', '>', $since)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn ($m) => [
                'id'          => $m->id,
                'message'     => $m->message,
                'sender_id'   => $m->sender_id,
                'sender_name' => $m->sender->name,
                'sender_type' => $m->sender_type,
                'time'        => $m->created_at->format('h:i A'),
            ]);

        ChatMessage::where('booking_id', $id)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['messages' => $messages]);
    }
}