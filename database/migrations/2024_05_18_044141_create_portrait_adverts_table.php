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
        Schema::create('portrait_adverts', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(3300);
            $table->string('title', 100);
            $table->string('sub_title', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status', 10)->default('Active');
            $table->boolean('verified')->default(false);
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portrait_adverts');
    }
};
