<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seeker_profiles', function (Blueprint $table) {
           $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER RELATION
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');



            /*
            |--------------------------------------------------------------------------
            | BASIC INFO
            |--------------------------------------------------------------------------
            */
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('bio')->nullable();



            /*
            |--------------------------------------------------------------------------
            | ADDRESS
            |--------------------------------------------------------------------------
            */
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('home_address')->nullable();



            /*
            |--------------------------------------------------------------------------
            | DOCUMENTS (KYC)
            |--------------------------------------------------------------------------
            */
            $table->string('cnic_front')->nullable();
            $table->string('cnic_back')->nullable();
            $table->string('income_proof')->nullable();



            /*
            |--------------------------------------------------------------------------
            | PROFILE IMAGE
            |--------------------------------------------------------------------------
            */
            $table->string('profile_image')->nullable();



            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->boolean('profile_completed')->default(false);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeker_profiles');
    }
};
