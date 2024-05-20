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
            $table->bigIncrements('id')->startingValue(3200);
            $table->string('title', 100);
            $table->text('message')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->string('logo', 20)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('type', 50);
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
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
