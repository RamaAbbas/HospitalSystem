<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamNursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_nurses', function (Blueprint $table) {
            $table->id('Id');
            //$table->timestamps();
        });
        Schema::table('team_nurses', function (Blueprint $table) {
            $table->bigInteger('nurse_Id')->unsigned();
            $table->bigInteger('team_Id')->unsigned();
            $table->foreign('nurse_Id')->references('Id')->on('nurses');
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
        Schema::dropIfExists('team_nurses');
    }
}
