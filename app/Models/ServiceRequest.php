<?php

namespace App\Models;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'description',
        'price_range',
        'location',
        'latitude',
        'longitude',
        'status',
        'provider_id',
        'work_picture',  
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}