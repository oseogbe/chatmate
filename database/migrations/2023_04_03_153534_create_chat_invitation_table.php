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
        Schema::create('chat_invitation', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('inviter')->constrained('users')->cascadeOnDelete();
            $table->string('invitee');
            $table->enum('invite_type', ['chat', 'chatroom']);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_invitation');
    }
};
