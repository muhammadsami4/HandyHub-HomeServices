<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SeekerProfile;
use App\Models\ProviderProfile;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // ── PROVIDER ──
        if ($user->role === 'provider') {
            $myAccepted      = ServiceRequest::where('provider_id', $user->id)->where('status', 'accepted')->count();
            $myRejected      = ServiceRequest::where('provider_id', $user->id)->where('status', 'rejected')->count();
            $pendingRequests = ServiceRequest::where('status', 'pending')->count();
            $myProfile       = ProviderProfile::where('user_id', $user->id)->first();

            return view('dashboard', compact(
                'myAccepted', 'myRejected', 'pendingRequests', 'myProfile'
            ));
        }

        // ── SEEKER ──
        if ($user->role === 'seeker') {
            $myTotal    = ServiceRequest::where('user_id', $user->id)->count();
            $myAccepted = ServiceRequest::where('user_id', $user->id)->where('status', 'accepted')->count();
            $myPending  = ServiceRequest::where('user_id', $user->id)->where('status', 'pending')->count();
            $myRejected = ServiceRequest::where('user_id', $user->id)->where('status', 'rejected')->count();

            return view('dashboard', compact(
                'myTotal', 'myAccepted', 'myPending', 'myRejected'
            ));
        }

        // ── ADMIN ──
        $totalUsers         = User::count();
        $adminUsers         = User::where('role', 'admin')->count();
        $seekerUsers        = User::where('role', 'seeker')->count();
        $providerUsers      = User::where('role', 'provider')->count();
        $seekerVerified     = SeekerProfile::where('is_verified', 1)->count();
        $seekerUnverified   = SeekerProfile::where('is_verified', 0)->count();
        $providerVerified   = ProviderProfile::where('is_verified', 1)->count();
        $providerUnverified = ProviderProfile::where('is_verified', 0)->count();

        return view('dashboard', compact(
            'totalUsers', 'adminUsers', 'seekerUsers', 'providerUsers',
            'seekerVerified', 'seekerUnverified',
            'providerVerified', 'providerUnverified'
        ));
    }
}