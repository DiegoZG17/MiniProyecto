<?php

namespace Database\Factories;

use Faker\Provider\Base;

class Identificacion extends Base{

 protected static $apellidos = [
    'ADRIANO', 'AGUILAR', 'BALBOA', 'BALLINAS', 'BARRIOS', 'CASTILLEJOS', 'CIGARROA', 'CRUZ', 'DIAZ', 'ESCOBAR', 'ESQUINCA', 'FIGUEROA', 'GARCÍA', 'GUTIERREZ', 'HERNANDEZ', 'HILERIO', 'LOPEZ', 'LÓPEZ', 'MARTINEZ', 'MENDOZA', 'MINOR', 'MOGUEL', 'NATAREN', 'NUCAMENDI', 'OLIVARES', 'ORANTES', 'ORDAZ', 'PÉREZ', 'PRADO', 'RAMOS', 'RODRIGUEZ', 'SAMAYOA', 'VÁZQUEZ', 'VELAZQUEZ', 'ZAPATA', 'ZEBADUA',    
 ];

 protected static $hombres = [
    'ADRIAN', 'ALBERTO', 'ALEXIS', 'ÁNGEL', 'BRAYAN', 'BRIAN', 'CARLOS', 'CESAR', 'DANIEL', 'DIEGO', 'EDUARDO', 'EMMANUEL', 'GUSTAVO', 'IVÁN', 'JESUS', 'JOSÉ', 'LUIS', 'MIGUEL', 'OSCAR', 'RAUL', 'RUSELL', 'YAHIR',
  ];

  protected static $mujeres = [
    'ADRIANA', 'ANGELICA', 'CLAUDIA', 'CRISTEL', 'DANIELA', 'DORIS', 'FERNANDA', 'FRIDA', 'GABRIELA', 'GUADALUPE', 'ISABEL', 'KARLA', 'LOURDES', 'LORENA', 'MARIA', 'JANCY', 'JIMENA', 'PAOLA', 'SOFIA', 'YURIDIA', 
  ];

  protected static $generos = [
    'MASCULINO' , 'FEMENINO'
  ];

 public function apellido()
 {
     return static::randomElement(static::$apellidos);
 }

 public function genero()
 {
     return static::randomElement(static::$generos);
 }
 public function nombreMasculino()
 {
        return static::randomElement(static::$hombres);
 }
 public function nombreFemenino()
 {
        return static::randomElement(static::$mujeres);
 }

}