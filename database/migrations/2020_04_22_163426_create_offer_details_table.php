<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('offer_id', 'agency_fk_718190')->references('id')->on('Offers')->onDelete('cascade');
            $table->unsignedBigInteger('offer_id');  
            $table->dateTime('Departial_time'); 
            $table->dateTime('arrival_time'); 
            $table->string('to');
            $table->string('from');
            $table->string('no_trip');
            $table->enum('transportation_mode',['bus','train']);

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_details');
    }
}
