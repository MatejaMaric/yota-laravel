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
            $table->id();
            $table->boolean('approved')->default(false);
            //$table->unsignedBigInteger('specialCall');
            $table->string('specialCall', 50);
            $table->dateTime('fromTime');
            $table->dateTime('toTime');
            $table->string('frequencies', 255);
            $table->string('modes', 255);
            $table->string('operatorCall');
            $table->string('operatorName');
            $table->string('operatorEmail');
            $table->string('operatorPhone', 50);
            $table->integer('qso')->default(0);
            $table->timestamps();
            //$table->foreign('specialCall')->references('id')->on('special_calls');
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
