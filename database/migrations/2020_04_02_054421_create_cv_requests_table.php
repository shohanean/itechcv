<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('skill_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('education_id')->nullable();
            $table->string('job_experience')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('training')->nullable();
            $table->Integer('expected_salary')->nullable();
            $table->string('expected_cv')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('cv_requests');
    }
}
