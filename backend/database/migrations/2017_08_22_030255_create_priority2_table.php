<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
Use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriority2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority2', function (Blueprint $table) {
            $table->unique('idpp');
            
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
        Schema::dropIfExists('priority2');
    }
}
