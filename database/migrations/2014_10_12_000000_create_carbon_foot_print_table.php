<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarbonFootPrintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carbon_foot_print', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_type');
            $table->string('activity');
            $table->string('country');
            $table->string('mode');
            $table->string('carbon_foot_print');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carbon_foot_print');
    }
}
