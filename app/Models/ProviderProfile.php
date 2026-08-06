<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    protected $fillable = [

        'user_id',

        'organization_name',
        'organization_type',

        'phone',
        'website',

        'province',
        'city',
        'address',

        'description',
        'registration_number',

        'registration_certificate',
        'tax_certificate',
        'organization_logo',
        'owner_cnic_front',
        'owner_cnic_back',
        'police_clearance',

        'is_verified',
        'verified_at',

        'profile_completed',
    ];

    protected $casts = [

        'is_verified' => 'boolean',
        'profile_completed' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * USER RELATION
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}