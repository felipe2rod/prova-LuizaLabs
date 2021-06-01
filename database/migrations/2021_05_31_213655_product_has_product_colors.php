<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductHasProductColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_product_colors', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->tinyInteger('product_id');
            $table->tinyInteger('product_color_id');
        });

        Schema::table('product_has_product_colors', function (Blueprint $table) {

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('product_color_id')->references('id')->on('product_colors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_product_colors');
    }
}
