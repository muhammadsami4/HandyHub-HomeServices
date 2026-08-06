<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         /*
        |--------------------------------------------------------------------------
        | ADMIN USER
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEEKER USER
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Service Seeker',
            'email' => 'seeker@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'seeker',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROVIDER USER
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Service Provider',
            'email' => 'provider@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'provider',
        ]);
    }
}
