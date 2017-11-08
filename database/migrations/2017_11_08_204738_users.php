<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id')->nullable($value = false);
            $table->string('username')->nullable($value = false);
            $table->string('password')->nullable($value = false);
        });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('users');
     }
}
