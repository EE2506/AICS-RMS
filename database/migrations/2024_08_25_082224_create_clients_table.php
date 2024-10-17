<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('field_office' , 10)->nullable();
            $table->string('entered_by', 60)->nullable();
            $table->string('client_no', 20)->unique();
            $table->date('date_accomplished')->nullable();
            $table->string('region', 60);
            $table->string('province', 60);
            $table->string('city_municipality', 60)->nullable();
            $table->string('barangay', 60)->nullable();
            $table->string('district', 30)->nullable()->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('first_name',30)->nullable();
            $table->string('middle_name', 20)->nullable();
            $table->string('extra_name', 4)->nullable();
            $table->string('sex',6)->nullable();
            $table->string('civil_status',13)->nullable();
            $table->string('dob',10)->nullable();
            $table->integer('age')->nullable();
            $table->string('mode_of_admission',10)->nullable();
            $table->string('type_of_assistance1',30)->nullable();
            $table->decimal('amount1', 15, 2)->nullable();
            $table->string('source_of_fund1',30)->nullable();
            $table->string('type_of_assistance2',30)->nullable();
            $table->decimal('amount2', 15, 2)->nullable();
            $table->string('source_of_fund2',30)->nullable();
            $table->string('type_of_assistance3')->nullable();
            $table->decimal('amount3', 15, 2)->nullable();
            $table->string('source_of_fund3',30)->nullable();
            $table->string('type_of_assistance4',30)->nullable();
            $table->decimal('amount4', 15, 2)->nullable();
            $table->string('source_of_fund4',30)->nullable();
            $table->string('client_category',30)->nullable();
            $table->string('subcategory',60)->nullable();
            $table->string('through',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
