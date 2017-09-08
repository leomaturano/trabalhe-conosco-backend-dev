<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
Use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicpayusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picpayusers', function (Blueprint $table) {
            $table->unique('idpp');
            $table->string('nome');
            $table->string('username');
            $table->integer('priority');
            // $table->increments('id');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picpayusers');
    }
}
