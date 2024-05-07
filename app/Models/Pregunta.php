<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido', 'usuario_id', 'producto_id', 'respuesta', 'fecha_pregunta', 'fecha_respuesta', 'estado'
    ];
    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id');
}

public function producto()
{
    return $this->belongsTo(Producto::class, 'producto_id');
}


    // Definir relaciones, métodos de consulta, etc.
}
