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
            $table->increments('id');
            $table->uuid('country_id')->primary();
            $table->integer('continent_id')->unsigned();
            $table->string('country');
            $table->string('dial_code');
            $table->string('country_code');
            $table->timestamps();

            $table->foreign('continent_id')->references('id')->on('continents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
        });
        Schema::dropIfExists('countries');
    }
}
