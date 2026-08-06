<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\ProviderProfile;
use App\Models\SeekerProfile;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Role helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSeeker()
    {
        return $this->role === 'seeker';
    }

    public function isProvider()
    {
        return $this->role === 'provider';
    }


    /**
 * SEEKER PROFILE
 */

    public function seekerProfile()
{
    return $this->hasOne(SeekerProfile::class);
}

public function providerProfile()
{
    return $this->hasOne(ProviderProfile::class);
}



    }
