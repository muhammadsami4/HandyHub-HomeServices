<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SeekerProfile;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserVerificationController extends Controller
{
    public function index()
    {
        $users = User::with(['seekerProfile', 'providerProfile'])->latest()->get();
        return view('pages.admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['seekerProfile', 'providerProfile'])->findOrFail($id);
        return view('pages.admin.users.show', compact('user'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'seeker') {
            //  Profile na ho to bana do
            $profile = SeekerProfile::firstOrCreate(
                ['user_id' => $user->id],
                ['is_verified' => false]
            );
        } else {
            //  Provider ya admin
            $profile = ProviderProfile::firstOrCreate(
                ['user_id' => $user->id],
                ['is_verified' => false]
            );
        }

        //  Ab profile hamesha milegi
        $profile->is_verified = 1;
        $profile->verified_at = Carbon::now();
        $profile->save();

        return back()->with('success', $user->name . ' successfully verified!');
    }

    public function unverify($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'seeker') {
            $profile = SeekerProfile::where('user_id', $user->id)->first();
        } else {
            $profile = ProviderProfile::where('user_id', $user->id)->first();
        }

        if ($profile) {
            $profile->is_verified = 0;
            $profile->verified_at = null;
            $profile->save();
        }

        return back()->with('success', $user->name . ' unverified successfully.');
    }
}