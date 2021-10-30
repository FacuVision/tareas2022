<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->integer('sesion');
            $table->text('descripcion');

            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->enum('estado',[0,1]);

            $table->unsignedBigInteger('materia_id');
            //$table->unsignedBigInteger('user_id');


            //0 = cerrado
            //1 = abierto

            $table->timestamps();

            // $table->foreign('user_id')
            // ->references('id')
            // ->on('users')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');

            $table->foreign('materia_id')
            ->references('id')
            ->on('materias')
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
        Schema::dropIfExists('carpetas');
    }
}
