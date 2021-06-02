<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_itens', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id('id');
            $table->integer('quantity');
            $table->integer('order_id');
            $table->integer('product_id');
        });

        Schema::table('order_itens', function (Blueprint $table) {

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_itens');
    }
}
