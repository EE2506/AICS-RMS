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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 45)->unique();
            $table->string('fname', 20); // Set the length to 12
            $table->string('lname', 20); // Set the length to 12
            $table->string('password',60); // Set the length to 12
            $table->string('remember_token',60)->nullable();
            $table->string('custom_token',1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
