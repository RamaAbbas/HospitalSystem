<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('Id');
            $table->string('wing');
            $table->string('brd');
            //$table->timestamps();
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->bigInteger('patient_Id')->unsigned();
            $table->bigInteger('operation_Id')->unsigned();
            $table->bigInteger('doctor_Id')->unsigned();
            $table->bigInteger('doc_exam_Id')->unsigned();
            $table->foreign('patient_Id')->references('Id')->on('patients');
            $table->foreign('operation_Id')->references('Id')->on('operations');
            $table->foreign('doctor_Id')->references('Id')->on('doctors');
            $table->foreign('doc_exam_Id')->references('Id')->on('doc_exams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
