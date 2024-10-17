<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dashboard_report_exports', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');  // Path to the saved image
            $table->string('pdf_path')->nullable();  // Path to the exported PDF (optional)
            $table->string('title')->nullable();  // Optional title for the report
            $table->timestamps();  // Created at and updated at timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_report_exports');
    }
};
