<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id('Id');
            $table->string('dateTime');
            //$table->timestamps();
        });
        Schema::table('operations', function (Blueprint $table) {
            $table->bigInteger('op_room_Id')->unsigned();
            $table->bigInteger('anesthesiologist_Id')->unsigned();
            $table->foreign('op_room_Id')->references('Id')->on('op_rooms');
            $table->foreign('anesthesiologist_Id')->references('Id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
