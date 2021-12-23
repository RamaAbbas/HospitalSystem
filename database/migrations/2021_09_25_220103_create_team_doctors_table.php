<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_doctors', function (Blueprint $table) {
            $table->id('Id');
            //$table->timestamps();
        });
        Schema::table('team_doctors', function (Blueprint $table) {
            $table->bigInteger('doctor_Id')->unsigned();
            $table->bigInteger('team_Id')->unsigned();
            $table->foreign('doctor_Id')->references('Id')->on('doctors');
            $table->foreign('team_Id')->references('Id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_doctors');
    }
}
