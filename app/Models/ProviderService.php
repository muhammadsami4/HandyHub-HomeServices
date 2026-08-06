<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderService extends Model
{
    protected $fillable = [
        'provider_id',
        'service_id',
        'title',
        'description',
        'experience',
    ];

    // Service category (Electrician, Plumber etc.)
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Provider user
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    // Provider's profile
    public function providerProfile()
    {
        return $this->hasOneThrough(
            ProviderProfile::class,
            User::class,
            'id',
            'user_id',
            'provider_id',
            'id'
        );
    }
}
