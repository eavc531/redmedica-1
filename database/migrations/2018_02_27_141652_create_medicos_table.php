<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification')->nullable();
            $table->string('name');
            $table->string('lastName');
            $table->string('gender');
            $table->string('email',60);
            $table->string('password');

            $table->integer('medicalCenter_id')->unsigned()->nullable();
            $table->foreign('medicalCenter_id')->references('id')->on('medical_centers');
            $table->string('phone')->nullable();
            //$table->string('facebook')->nullable();
            $table->string('id_promoter')->nullable();
            $table->string('showNumber')->nullable();
            $table->string('phoneOffice1')->nullable();
            $table->string('phoneOffice2')->nullable();
            $table->string('specialty')->nullable();
            $table->string('sub_specialty')->nullable();
            $table->string('role')->default('medico');
            $table->string('stateConfirm')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states');
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('colony')->nullable();
            $table->string('street')->nullable();
            $table->string('number_ext')->nullable();
            $table->string('number_int')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();

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
        Schema::dropIfExists('medicos');
    }
}
