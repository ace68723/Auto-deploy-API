<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Servers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('servers', function(Blueprint $table)
        {
            $table->increments('id')->nullable($value = false);
            $table->string('name')->nullable($value = false);
            $table->string('ip')->nullable($value = false);
            $table->string('user')->nullable($value = false);
            $table->string('password')->nullable($value = false);
            $table->string('path')->nullable($value = false);
            $table->string('deploy_path')->nullable($value = false);
            $table->string('branch')->nullable($value = false);
            $table->string('deleted')->nullable($value = false);
        });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('servers');
     }
}
