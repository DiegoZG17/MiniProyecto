<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstaladorController extends Controller
{
    
    public function instalar(){

        echo "Borrando base de datos...<br>";
        Artisan::call('db:wipe');
        echo "Base de datos borrada...";
echo "<hr>";
        echo "Instalando... <br>";
        Artisan::call('migrate', 
        [
           '--seed' => true,
           '--force' => true
        ]);
        echo "Instalado...";


    }

}