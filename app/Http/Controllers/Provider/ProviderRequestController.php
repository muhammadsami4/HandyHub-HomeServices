<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with(['service', 'user'])
            ->where(function ($query) {
                // Sirf pending requests (koi bhi le sakta hai)
                // + is provider ki apni accepted/rejected
                $query->where('status', 'pending')
                      ->orWhere('provider_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('pages.provider.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = ServiceRequest::with(['service', 'user'])
            ->where('id', $id)
            ->where(function ($query) {
                $query->where('status', 'pending')
                      ->orWhere('provider_id', Auth::id());
            })
            ->firstOrFail();

        return view('pages.provider.requests.show', compact('request'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = $request->status;

        if ($request->status === 'accepted') {
            $serviceRequest->provider_id = Auth::id();
        }

        if ($request->status === 'rejected') {
            $serviceRequest->provider_id = null;
        }

        $serviceRequest->save();

        return back()->with('success', 'Request status updated successfully');
    }
}