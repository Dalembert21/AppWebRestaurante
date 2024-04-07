<?php
namespace  manin;

class Platos{

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

public function registrar($_params) {
    // Verificar si los índices existen en el array $_params
    if (!isset($_params['TITULO_PLA'], $_params['DESC_PLA'], $_params['FOT_PLA'], $_params['PRE_PLA'], $_params['CAT_ID_PER'], $_params['FECHA'])) {
        // Si algun campo falla presenta el error 
        echo "Faltan algunos datos necesarios para registrar el plato.";
        return false;
    }

    // Prepara la consulta SQL
    $sql = "INSERT INTO `platos`(`TITU_PLA`, `DESC_PLA`, `FOT_PLA`, `PRE_PLA`, `CAT_ID_PER`, `FECHA`) VALUES (:TITU_PLA, :DESC_PLA, :FOT_PLA, :PRE_PLA, :CAT_ID_PER, :FECHA)";

    // Prepara los valores a insertar en la consulta
    $resultado = $this->cn->prepare($sql);
    $_array = array(
        ":TITU_PLA" => $_params['TITULO_PLA'],
        ":DESC_PLA" => $_params['DESC_PLA'],
        ":FOT_PLA" => $_params['FOT_PLA'],
        ":PRE_PLA" => $_params['PRE_PLA'],
        ":CAT_ID_PER" => $_params['CAT_ID_PER'],
        ":FECHA" => $_params['FECHA']
    );

    // 
    if ($resultado->execute($_array)) {
        return true; // Si la ejecución tiene éxito, retorna verdadero 
    } else {
        echo "Tuve un error para registrar el plato."; // Mostrar mensaje de error si la ejecución falla
        return false;
    }
}


    public function actualizar($_params){
       $sql = "UPDATE `platos` SET `TITU_PLA`=:TITU_PLA,`DESC_PLA`=:DESC_PLA,`FOT_PLA`=:FOT_PLA,`PRE_PLA`=:PRE_PLA,`CAT_ID_PER`=:CAT_ID_PER,`FECHA`=:FECHA WHERE `ID_PLA `=:ID_PLA";

        $resultado = $this->cn->prepare($sql);
        $_array = array(":TITU_PLA" =>$_params['TITULO_PLA'],
        ":DESC_PLA" => $_params['DESC_PLA'], 
        ":FOT_PLA" => $_params['FOT_PLA'],
         ":PRE_PLA"=> $_params['PRE_PLA'],
          ":CAT_ID_PER"=> $_params['CAT_ID_PER'], 
          ":FECHA" =>$_params['FECHA'],
          ":ID_PLA"=> $_params['ID_PLA']
        
        );

        if($resultado->execute($_array)){
          return true;
        }else{
          print("Tuve un error para actualizar el plato");
          return false;
        }
    }
public function eliminar($id){
  $sql =  "DELETE FROM `platos` WHERE `ID_PLA`=:ID_PLA";
  $resultado = $this->cn->prepare($sql);
  $_array = array(
    ":ID_PLA"=> $id
  );

  if($resultado->execute($_array)){
    return true;
  } else {
    print("Tuve un error para eliminar el plato");
    return false;
  }
}

public function ver(){
    $sql =  " SELECT  ID_PLA, TITU_PLA, DESC_PLA, FOT_PLA,NOM_CAT, PRE_PLA,FECHA,EST_PLA FROM platos INNER JOIN categorias ON platos.CAT_ID_PER = categorias.ID_CAT ORDER BY platos.ID_PLA DESC";
   $resultado = $this->cn->prepare($sql);
        if($resultado->execute()){
          return $resultado->fetchAll();
        }else{
          print("UPS!! sucedio algun error para traer datos");
          return false;
        }
}
public function verPorId($ID_PLA){
  $sql =  "SELECT * FROM `platos` WHERE `ID_PLA` = :ID_PLA ";
  $resultado = $this->cn->prepare($sql);
  $_array = array(
    ":ID_PLA"=> $ID_PLA
  );
  if($resultado->execute($_array)){
    return $resultado->fetch();
  } else {
    print("UPS!! Sucedió algún error al traer datos");
    return false;
  }
}

}

?>