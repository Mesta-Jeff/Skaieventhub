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
        Schema::create('user_otp_tokens', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1700);
            $table->string('token', 20);
            $table->string('token_type', 50);
            $table->string('status', 10)->default('Active');
            $table->string('is_used', 3)->default('No');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_otp_tokens');
    }
};
