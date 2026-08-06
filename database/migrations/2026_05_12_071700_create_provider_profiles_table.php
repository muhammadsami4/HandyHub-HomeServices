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
        Schema::create('provider_profiles', function (Blueprint $table) {
           $table->id();

    // RELATION
    $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');

    // ORGANIZATION INFO
    $table->string('organization_name')->nullable();
    $table->string('organization_type')->nullable();

    // CONTACT
    $table->string('phone')->nullable();
    $table->string('website')->nullable();

    // ADDRESS
    $table->string('province')->nullable();
    $table->string('city')->nullable();
    $table->text('address')->nullable();

    // BUSINESS DETAILS
    $table->text('description')->nullable();
    $table->string('registration_number')->nullable();

    // VERIFICATION DOCUMENTS
    $table->string('registration_certificate')->nullable();
    $table->string('tax_certificate')->nullable();
    $table->string('organization_logo')->nullable();
    $table->string('owner_cnic_front')->nullable();
    $table->string('owner_cnic_back')->nullable();

    // STATUS
    $table->boolean('is_verified')->default(false);
    $table->timestamp('verified_at')->nullable();

    // PROFILE STATUS
    $table->boolean('profile_completed')->default(false);

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_profiles');
    }
};
