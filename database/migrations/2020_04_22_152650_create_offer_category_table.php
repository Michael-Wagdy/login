<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('offer_id');

            $table->foreign('offer_id', 'offer_id_fk_702184')->references('id')->on('offers')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id', 'category_id_fk_702184')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_offer');
    }
}
