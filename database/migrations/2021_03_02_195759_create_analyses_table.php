<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('analysis_count');
            $table->mediumInteger('patients_id');
            $table->mediumInteger('allergen_id');
            $table->mediumInteger('MSP_score');
            $table->mediumInteger('IT_score');
            $table->tinyInteger('validated');
            $table->dateTime('date_added');
            $table->integer('treatment');
            $table->integer('dilution_level');
            $table->integer('two_whl');
            $table->integer('refill');
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
        Schema::dropIfExists('analyses');
    }
}
