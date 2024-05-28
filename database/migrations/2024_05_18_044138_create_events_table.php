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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(23000);
            $table->string('title', 100);
            $table->string('sub_title', 100)->nullable();
            $table->text('content');
            $table->foreignId('creator_id')->constrained('authors')->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->integer('stars')->default(0);
            $table->integer('comments')->default(0);
            $table->text('description')->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('event_type_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('initials', 15)->nullable();
            $table->string('venue', 100);
            $table->string('banner', 100)->nullable();
            $table->string('large_image', 100)->nullable();
            $table->string('medium_image', 100)->nullable();
            $table->string('small_image', 100)->nullable();
            $table->string('promo_video', 100)->nullable();
            $table->string('status', 10)->default('Active');
            $table->boolean('verified')->default(false);
            $table->boolean('approved')->default(false);
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
