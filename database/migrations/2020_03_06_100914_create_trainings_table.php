<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('user_id');
            $table->string('training_name');
            $table->bigInteger('country_id');
            $table->string('topic_cover');
            $table->string('training_year');
            $table->string('training_institute');
            $table->string('training_duration');
            $table->string('training_location');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
