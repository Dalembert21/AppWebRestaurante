<?php
namespace  manin;

class Usuario{

  private $configuracion;
  private $cn = null;

    //constructor que me permite conectar a la BD 
    public function __construct() {
        // Referencia al archivo config.ini, por el parse_ini_file directorio raiz
        $this->configuracion = parse_ini_file(__DIR__.'/../config.ini');

        try {
          //ruta de conexion y de paso habilito que permita el uso de ñ con el utf8
            $this->cn = new \PDO($this->configuracion['conectar'], $this->configuracion['usuario'], $this->configuracion['clave'], array(\PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        } catch (\PDOException $error) {
          //sino se conecta me especifica el error 
            echo "No se pudo conectar: " . $error->getMessage();

        }
    }
//
    public function login($nombre,$clave){
  $sql =  "SELECT  NOM_USU FROM `usuarios` WHERE NOM_USU=:nombre AND CLAVE_USU=:clave";
  $resultado = $this->cn->prepare($sql);
  $_array = array(
    ":nombre"=> $nombre,
    ":clave" => $clave
  );
  //traigo informacion sola de una pelicula con fetch
  if($resultado->execute($_array)){
    return $resultado->fetch();
  } else {
    print("UPS!! Sucedió algún error al traer el plato que seleccionaste");
    return false;
  }
}

}