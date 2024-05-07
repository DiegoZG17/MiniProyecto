<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado',['propuesto','consignado'])->default('propuesto');
            $table->date('fecha_publicacion');
            $table->string('motivo')->nullable()->default(null);
            $table->text('descripcion');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->bigInteger('propietario_id')->unsigned();
            $table->foreign('propietario_id')->references('id')->on('usuarios');


            



            //$table->foreignId()
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
