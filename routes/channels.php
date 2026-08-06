<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
| Private channel: chat.{requestId}
| Sirf seeker (jo request banayi) aur provider is channel ko join kar sakte hain.
*/

Broadcast::channel('chat.{requestId}', function ($user, $requestId) {
    $req = DB::table('service_requests')->where('id', $requestId)->first();

    if (! $req) {
        return false;
    }

    // Seeker — jisne request banayi
    if ($user->id === (int) $req->user_id) {
        return true;
    }

    // Provider — jo accepted request ke provider hain
    if ($user->role === 'provider') {
        return true;
    }

    return false;
});
