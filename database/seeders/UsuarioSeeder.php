<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nuevo = new Usuario();
        $nuevo->correo = 'cliente1@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Comprador1";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('cliente1@gmail.com');
        $nuevo->role = 'Cliente';
        $nuevo->save();
        //
        $nuevo = new Usuario();
        $nuevo->correo = 'cliente2@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Comprador2";
        $nuevo->genero = 'Femenino';
        $nuevo->clave = Hash::make('cliente2@gmail.com');
        $nuevo->role = 'Cliente';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'cliente3@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Comprador3";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('cliente3@gmail.com');
        $nuevo->role = 'Cliente';
        $nuevo->save();
        
        $nuevo = new Usuario();
        $nuevo->correo = 'cliente4@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Comprador4";
        $nuevo->genero = 'Femenino';
        $nuevo->clave = Hash::make('cliente5@gmail.com');
        $nuevo->role = 'Cliente';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'cliente5@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Comprador5";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('cliente5@gmail.com');
        $nuevo->role = 'Cliente';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'vendedor1@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Vendedor1";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('vendedor1@gmail.com');
        $nuevo->role = 'Vendedor';
        $nuevo->save();
        //
        $nuevo = new Usuario();
        $nuevo->correo = 'vendedor2@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Vendedor2";
        $nuevo->genero = 'Femenino';
        $nuevo->clave = Hash::make('vendedor2@gmail.com');
        $nuevo->role = 'Vendedor';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'vendedor3@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Vendedor3";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('vendedor3@gmail.com');
        $nuevo->role = 'Vendedor';
        $nuevo->save();
        
        $nuevo = new Usuario();
        $nuevo->correo = 'vendedor4@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Vendedor4";
        $nuevo->genero = 'Femenino';
        $nuevo->clave = Hash::make('vendedor5@gmail.com');
        $nuevo->role = 'Vendedor';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'vendedor5@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Vendedor5";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('vendedor5@gmail.com');
        $nuevo->role = 'Vendedor';
        $nuevo->save();
        //
        $nuevo = new Usuario();
        $nuevo->correo = 'encargado1@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Encargado1";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('encargado1@gmail.com');
        $nuevo->role = 'Encargado';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'encargado2@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Encargado2";
        $nuevo->genero = 'Femenino';
        $nuevo->clave = Hash::make('encargado2@gmail.com');
        $nuevo->role = 'Encargado';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'encargado3@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Encargado3";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('encargado3@gmail.com');
        $nuevo->role = 'Encargado';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'supervisor1@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Supervisor1";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('supervisor1@gmail.com');
        $nuevo->role = 'Supervisor';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'supervisor2@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Supervisor2";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('supervisor2@gmail.com');
        $nuevo->role = 'Supervisor';
        $nuevo->save();

        $nuevo = new Usuario();
        $nuevo->correo = 'contador@gmail.com';
	    $nuevo->apellido_paterno = "N";
        $nuevo->apellido_materno = "N";
        $nuevo->nombre = "Contador1";
        $nuevo->genero = 'Contador';
        $nuevo->clave = Hash::make('contador@gmail.com');
        $nuevo->role = 'Encargado';
        $nuevo->save();
    }
}
