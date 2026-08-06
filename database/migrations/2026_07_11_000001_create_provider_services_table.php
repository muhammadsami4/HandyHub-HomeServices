<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('experience')->nullable(); // e.g. "3 years"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_services');
    }
};
