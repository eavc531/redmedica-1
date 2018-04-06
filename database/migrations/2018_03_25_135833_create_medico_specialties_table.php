<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('institution');
            $table->string('specialty');
            $table->string('state');
            $table->dateTime('from');
            $table->dateTime('until');
            $table->string('aditional')->nullable();
            $table->string('specialty_category');
            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('medicos');
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
        Schema::dropIfExists('medico_specialties');
    }
}
