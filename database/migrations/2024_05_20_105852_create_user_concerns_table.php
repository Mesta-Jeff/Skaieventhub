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
        Schema::create('user_concerns', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1030);
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->string('concern_type', 50);
            $table->text('concern');
            $table->string('priority', 15);
            $table->foreignId('token_id')->constrained('user_otp_tokens')->onDelete('cascade');
            $table->string('status', 15)->default('Pending');
            $table->foreignId('teller_id')->constrained('users')->nullable()->onDelete('cascade');
            $table->text('answer')->default('No response yet');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_concerns');
    }
};
