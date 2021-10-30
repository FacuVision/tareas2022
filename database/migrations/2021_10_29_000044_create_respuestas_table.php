<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->integer('puntaje');


            $table->unsignedBigInteger('actividad_id');
            // $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('actividad_id')
            ->references('id')
            ->on('actividads')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // $table->foreign('user_id')
            // ->references('id')
            // ->on('users')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
