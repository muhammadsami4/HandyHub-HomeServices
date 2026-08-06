<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    protected $table = 'seeker_profiles';

    protected $fillable = [

        'user_id',

        /*
        |--------------------------------------------------------------------------
        | BASIC INFO
        |--------------------------------------------------------------------------
        */
        'phone',
        'gender',
        'date_of_birth',
        'bio',

        /*
        |--------------------------------------------------------------------------
        | ADDRESS
        |--------------------------------------------------------------------------
        */
        'province',
        'city',
        'home_address',

        /*
        |--------------------------------------------------------------------------
        | DOCUMENTS (KYC ONLY)
        |--------------------------------------------------------------------------
        */
        'cnic_front',
        'cnic_back',
        'income_proof',

        /*
        |--------------------------------------------------------------------------
        | PROFILE IMAGE
        |--------------------------------------------------------------------------
        */
        'profile_image',

        /*
        |--------------------------------------------------------------------------
        | VERIFICATION STATUS
        |--------------------------------------------------------------------------
        */
        'is_verified',
        'verified_at',
        'profile_completed',
    ];



    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'date_of_birth' => 'date',
        'is_verified' => 'boolean',
        'profile_completed' => 'boolean',
        'verified_at' => 'datetime',
    ];



    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    /**
     * Check profile completeness (KYC READY)
     */
    public function isComplete(): bool
    {
        return !empty($this->phone)
            && !empty($this->gender)
            && !empty($this->province)
            && !empty($this->city)
            && !empty($this->home_address)
            && !empty($this->cnic_front)
            && !empty($this->cnic_back);
    }



    /**
     * Access user name directly
     */
    public function getNameAttribute()
    {
        return $this->user?->name;
    }



    /**
     * Access user email directly
     */
    public function getEmailAttribute()
    {
        return $this->user?->email;
    }
}