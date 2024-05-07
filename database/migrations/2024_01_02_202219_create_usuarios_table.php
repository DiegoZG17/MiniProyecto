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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('correo')->unique();
            $table->string('apellido_paterno')->nullable()->default(null);
            $table->string('apellido_materno')->nullable()->default(null);
            $table->string('nombre')->nullable()->default(null);
            $table->enum('genero',['Masculino' , 'Femenino']);
            $table->string('clave')->nullable()->default('123');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
