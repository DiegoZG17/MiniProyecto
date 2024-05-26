<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = ['vendedor_id', 'contador_id', 'monto', 'fecha_pago'];

    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'vendedor_id');
    }

    public function contador()
    {
        return $this->belongsTo(Usuario::class, 'contador_id');
    }

    
}

