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
        Schema::create('recycles', function (Blueprint $table) {
            $table->id();
            $table->string('filetype', 60); // File type extension (e.g., csv, xls, xlsx)
            $table->text('path'); // File storage path
            $table->string('document'); // File name
            $table->softDeletes(); // Soft delete column
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recycles');
    }
};

