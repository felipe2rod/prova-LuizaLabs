<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            $table->engine = 'MyISAM';
            $table->tinyIncrements('id');
            $table->string('name',45);
            $table->string('email',45)->unique();
            $table->string('cpf',14)->unique();
            $table->enum('sex',['male','female']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('clients');
    }
}
