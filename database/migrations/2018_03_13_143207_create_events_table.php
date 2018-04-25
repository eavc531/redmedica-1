<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title')->nullable();
          $table->string('description')->nullable();
          $table->string('start');
          $table->string('end')->nullable();
          $table->string('eventType')->nullable();
          $table->datetime('dateStart')->nullable();
          $table->datetime('dateEnd')->nullable();
          // $table->string('hourStart');
          // $table->string('hourEnd');
          // $table->string('minsStart');
          // $table->string('minsEnd');
          $table->string('color')->nullable();
          $table->string('rendering')->nullable();
          $table->string('dow')->nullable();
          $table->biginteger('price')->nullable();
          $table->integer('medico_id')->unsigned()->nullable();
          $table->foreign('medico_id')->references('id')->on('medicos');
          $table->string('state')->default('Pendiente');
          
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
        Schema::dropIfExists('events');
    }
}
