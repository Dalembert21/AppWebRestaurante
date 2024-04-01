<?php
namespace  manin;

class Platos{

  private $configuracion;
  private $cn = null;

  public function __construct(){
    //referencia al archivo config. ini
    $this->configuracion = parse_ini_file(__DIR__.'/../config.ini');
    print_r($this->configuracion);

    $this->cn = new \PDO($this->configuracion['conectar'],$this->configuracion['usuario'],$this->configuracion['clave']);
  }


}

