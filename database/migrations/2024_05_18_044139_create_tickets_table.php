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
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(2400);
            $table->string('title',20);
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->integer('total');
            $table->integer('remaining');
            $table->text('description')->nullable();
            $table->string('status', 10)->default('Active');
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
        Schema::dropIfExists('tickets');
    }
};
