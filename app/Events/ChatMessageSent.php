<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Yeh event har naye chat message par fire hota hai.
 * ShouldBroadcastNow use kiya hai (queue ki zaroorat nahi) —
 * matlab message turant WebSocket (Reverb) ke zariye doosre
 * user tak pohanch jata hai, koi queue:work chalane ki zaroorat nahi.
 */
class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ChatMessage $message)
    {
    }

    /**
     * Sirf isi booking ke private channel par broadcast hoga —
     * koi aur user (jo seeker/provider nahi hai) yeh sun nahi sakta.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->booking_id),
        ];
    }

    /**
     * Frontend par 'message.sent' naam se listen hoga.
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    /**
     * Yeh data JSON ki shakal mein dusre browser tak jayega.
     */
    public function broadcastWith(): array
    {
        return [
            'id'          => $this->message->id,
            'message'     => $this->message->message,
            'sender_id'   => $this->message->sender_id,
            'sender_name' => $this->message->sender->name,
            'sender_type' => $this->message->sender_type,
            'time'        => $this->message->created_at->format('h:i A'),
        ];
    }
}
