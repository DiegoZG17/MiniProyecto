<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','fecha_publicacion','descripcion','cantidad','categoria_id' ];
 
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function propietario(){
        return $this->belongsTo(Usuario::class);
    }
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'producto_id');
    }
    public function carritos()
{
    return $this->hasMany(Carrito::class);
}


    
    
        

    // en App\Models\Producto.php
public function vendedor()
{
    // Asegúrate de que esta relación exista y esté correctamente definida.
    return $this->belongsTo(Usuario::class, 'usuario_id');
}

public function compras()
{
    return $this->hasMany(Compra::class);
}



   

}
