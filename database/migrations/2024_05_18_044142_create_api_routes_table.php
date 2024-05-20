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
        Schema::create('api_routes', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(3400);
            $table->string('name', 100);
            $table->text('param')->nullable();
            $table->string('method', 10);
            $table->string('endpoint', 255);
            $table->text('description')->nullable();
            $table->string('status', 10)->default('Active');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_routes');
    }
};
