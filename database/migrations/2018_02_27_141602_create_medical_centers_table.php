<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_medicalCenter')->nullable();
            $table->string('name');
            $table->string('activePlan')->nullable();
            $table->string('emailAdmin',60);
            $table->string('nameAdmin');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('city');
            $table->string('billingData')->nullable();
            $table->string('meansOfRecords')->nullable() ;
            $table->string('confirmation_code')->nullable();
            $table->string('confirmation_statuss')->default('false');
            $table->integer('id_promoter')->nullable();
            $table->string('plan')->nullable();
            $table->DateTime('activationPlan')->nullable();
            $table->string('role')->default('medical_center');
            $table->string('password')->nullable();
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
        Schema::dropIfExists('medical_centers');
    }
}
