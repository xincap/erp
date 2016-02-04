<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_town', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('county_id');
            $table->string('name',30);
            $table->index('county_id');
            $table->foreign('county_id')->references('id')->on('address_county')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_town');
    }
}
