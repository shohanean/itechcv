<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('iso3')->nullable();
            $table->string('iso2')->nullable();
            $table->string('phonecode')->nullable();
            $table->string('capital')->nullable();
            $table->tinyInteger('currency')->nullable();
            $table->timestamps();
            $table->tinyInteger('flag')->default(1);
            $table->string('wikiDataId')->nullable();
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
        Schema::dropIfExists('countries');
    }
}