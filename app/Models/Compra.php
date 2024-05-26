<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    protected $fillable = ['usuario_id', 'total', 'productos', 'estado', 'pago'];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}