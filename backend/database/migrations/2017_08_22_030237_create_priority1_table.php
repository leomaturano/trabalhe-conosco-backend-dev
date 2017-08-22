<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
Use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriority1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority1', function (Blueprint $table) {
            $table->unique('id');
            
            //$table->increments('id');
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
        Schema::dropIfExists('priority1');
    }
}
