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
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(51000);
            $table->string('title', 15);
            $table->string('initials', 10)->nullable();
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('town_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('gender', 10);
            $table->date('dob');
            $table->string('phone', 10)->unique();
            $table->string('tel', 10)->nullable();
            $table->foreignId('identity_type_id')->constrained()->onDelete('cascade');
            $table->string('id_number', 20);
            $table->string('id_scan', 255)->nullable();
            $table->string('email', 100)->unique();
            $table->string('acc_owner', 100);
            $table->string('acc_num', 16)->unique();
            $table->string('account_type', 20)->nullable();
            $table->string('acc_host', 100)->nullable();
            $table->string('acc_branch', 100)->nullable();
            $table->string('profile')->nullable();
            $table->string('status', 10)->default('Active');
            $table->boolean('verified')->default(false);
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
