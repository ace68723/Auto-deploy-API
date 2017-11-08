<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('relations', function(Blueprint $table)
        {
            $table->increments('id')->nullable($value = false);
            $table->string('server_id')->nullable($value = false);
            $table->string('project_id')->nullable($value = false);
        });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('relations');
     }
}
