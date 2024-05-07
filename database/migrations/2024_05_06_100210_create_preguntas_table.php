<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePreguntasTable extends Migration
{
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('producto_id');
            $table->text('respuesta')->nullable();
            $table->timestamp('fecha_pregunta')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fecha_respuesta')->nullable();
            $table->string('estado');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('preguntas');
    }

    
}
