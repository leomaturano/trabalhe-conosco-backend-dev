<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

Use Jenssegers\Mongodb\Schema\Blueprint;

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
            $table->increments('id');
            $table->string('idpp');
            $table->string('nome');
            $table->string('username');                        
            $table->timestamps();
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
