<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_rooms', function (Blueprint $table) {
            $table->id('Id');
            $table->string('type');
            $table->string('open_at');
            $table->string('close_at');
            //$table->timestamps();
        });
        Schema::table('op_rooms', function (Blueprint $table) {
            $table->bigInteger('surgeon_Id')->unsigned();
            $table->bigInteger('team_Id')->unsigned();
            $table->foreign('surgeon_Id')->references('Id')->on('doctors');
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
        Schema::dropIfExists('op_rooms');
    }
}
