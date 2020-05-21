<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('agency_price');
            $table->string('user_price');
            $table->integer('no_rooms');
            $table->boolean('status');
            $table->foreign('agency_id', 'agency_fk_718231')->references('id')->on('agencies')->onDelete('restrict');
            $table->unsignedBigInteger('agency_id');
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
        Schema::dropIfExists('offers');
    }
}
