<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_exams', function (Blueprint $table) {
            $table->id('Id');
            $table->string('result');
            //$table->timestamps();
        });
        Schema::table('doc_exams', function (Blueprint $table) {
            $table->bigInteger('doctor_Id')->unsigned();
            $table->bigInteger('examination_Id')->unsigned();
            $table->foreign('doctor_Id')->references('Id')->on('doctors');
            $table->foreign('examination_Id')->references('Id')->on('examinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_exams');
    }
}
