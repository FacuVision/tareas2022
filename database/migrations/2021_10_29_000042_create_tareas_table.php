<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('estado',[0,1,2,3]);

            /**
             * 0 = desaprobado
             * 1 = aprobado
             * 2 = publicado (por el docente)
             * 3 = entregado (por el alumno)
             *
             */

            $table->unsignedBigInteger('carpeta_id');

            $table->foreign('carpeta_id')
            ->references('id')
            ->on('carpetas')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
