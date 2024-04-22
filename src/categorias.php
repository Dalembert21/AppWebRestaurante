<?php
namespace manin;

class Categorias{
   private $configuracion;
  private $cn = null;

    public function __construct() {
        // Referencia al archivo config.ini
        $this->configuracion = parse_ini_file(__DIR__.'/../config.ini');

        try {
            $this->cn = new \PDO($this->configuracion['conectar'], $this->configuracion['usuario'], $this->configuracion['clave'], array(\PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        } catch (\PDOException $error) {
            echo "No se pudo conectar: " . $error->getMessage();

        }
    }
    
    //funcion para mostrar todas las categorias
    public function ver(){
    $sql =  " SELECT * FROM `categorias`";
   $resultado = $this->cn->prepare($sql);
        if($resultado->execute()){
          return $resultado->fetchAll();
        }else{
          print("UPS!! sucedio algun error para traer datos");
          return false;
        }
}

}

?>