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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(29000);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('acc_number', 20);
            $table->string('ref_number', 30);
            $table->string('acc_host', 100);
            $table->string('ipaddress', 20);
            $table->string('status', 10)->default('Pending');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
