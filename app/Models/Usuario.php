<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Usuario  extends Authenticatable
{
    use HasFactory;

    protected $fillable= [ 'apellido_paterno', 'apellido_materno', 'nombre', 'genero', 'correo', 'clave', 'token'];

    public function preguntas() {
        return $this->hasMany(Pregunta::class, 'usuario_id');
    }
    public function carritos()
{
    return $this->hasMany(Carrito::class);
}
}