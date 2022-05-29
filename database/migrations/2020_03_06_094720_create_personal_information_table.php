<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable()->comment('1=male 2=female 3=others');
            $table->string('phone')->nullable();
            $table->string('present_address')->nullable();
            $table->string('district_id')->nullable();
            $table->string('upazila_id')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('pdistrict_id')->nullable();
            $table->string('pupazila_id')->nullable();
            $table->tinyInteger('is_student')->nullable();
            $table->string('job_category')->nullable();
            $table->string('interested_location')->nullable();
            $table->string('nid')->nullable();
            $table->string('dob')->nullable();
            $table->tinyInteger('marital_status')->nullable()->comment('1=single 2=married');
            $table->text('user_profile')->nullable();
            $table->text('designation')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->integer('job_status')->default(1)->nullable();
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
        Schema::dropIfExists('personal_information');
    }
}
