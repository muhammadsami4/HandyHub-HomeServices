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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // user who triggered event (registered user)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            // notification type (new_user, verification, etc.)
            $table->string('type')->index();

            // optional title (for UI headings)
            $table->string('title')->nullable();

            // main message
            $table->text('message');

            // optional role (seeker/provider/admin)
            $table->string('role')->nullable();

            // read/unread status
            $table->boolean('is_read')->default(false);

            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
