<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pehle drop karo agar exist karti ho (safe migration)
        Schema::dropIfExists('chat_messages');

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->enum('sender_type', ['seeker', 'provider']);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['booking_id', 'created_at']);
            $table->index(['receiver_id', 'read_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};