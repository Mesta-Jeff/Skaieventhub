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
        Schema::create('payouts', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1050);
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->text('reason')->nullable();
            $table->decimal('amount', 8,2)->nullable();
            $table->string('priority', 15);
            $table->decimal('balance_before', 8,2)->nullable();
            $table->decimal('balance_after', 8,2)->nullable();
            $table->foreignId('token_id')->constrained('user_otp_tokens')->onDelete('cascade');
            $table->string('status', 15)->default('Pending');
            $table->foreignId('teller_id')->constrained('users')->nullable()->onDelete('cascade');
            $table->text('response')->default('No response yet');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
