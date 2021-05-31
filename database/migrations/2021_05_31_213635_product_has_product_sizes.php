<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductHasProductSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_product_sizes', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->tinyIncrements('id');
            $table->tinyInteger('product_size_id');
        });

        Schema::table('product_has_product_sizes', function (Blueprint $table) {

            $table->foreign('product_size_id')->references('id')->on('product_sizes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_product_sizes');
    }
}
