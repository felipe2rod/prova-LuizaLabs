<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id('id');
            $table->date('order_date');
            $table->string('observation',255);
            $table->enum('pay_method',['money','credit_cart','check']);
            $table->integer('client_id');
        });

        Schema::table('orders', function (Blueprint $table) {

            $table->foreign('client_id')->references('id')->on('clients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('orders');
    }
}
