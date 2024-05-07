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
        $nuevo->apellido_paterno = "GOMEZ";
        $nuevo->apellido_materno = "CRUZ";
        $nuevo->nombre = "PEDRO";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('cliente1@gmail.com');
        $nuevo->save();
        //
        $nuevo = new Usuario();
        $nuevo->correo = 'cliente2@gmail.com';
        $nuevo->apellido_paterno = "GOMEZ";
        $nuevo->apellido_materno = "CRUZ";
        $nuevo->nombre = "RAUL";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('cliente2@gmail.com');
        $nuevo->save();
        //
        $nuevo = new Usuario();
        $nuevo->correo = 'encargado@gmail.com';
        $nuevo->apellido_paterno = "PEREZ";
        $nuevo->apellido_materno = "LOPEZ";
        $nuevo->nombre = "LUIS";
        $nuevo->genero = 'Masculino';
        $nuevo->clave = Hash::make('encargado@gmail.com');
        $nuevo->role = 'Encargado';
        $nuevo->save();
    }
}
