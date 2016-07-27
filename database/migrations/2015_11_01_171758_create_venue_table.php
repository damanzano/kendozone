<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue', function (Blueprint $table) {
            $table->increments('id');
            $table->string("venue_name");
            $table->string("coords");
            $table->string("address");
            $table->string("details");
            $table->string("city");
            $table->integer("CP");
            $table->string("state")->nullable();
            $table->integer("country_id");
            $table->string("latitude");
            $table->string("longitude");
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('venue');
    }
}