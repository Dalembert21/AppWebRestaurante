<?php
namespace  manin;

class Crud{

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
//registrar los platos
public function registrar($_params) {
    // Verificar si los índices existen en el array $_params donde tomo todos los valores para registrar
    if (!isset($_params['TITULO_PLA'], $_params['DESC_PLA'], $_params['FOT_PLA'], $_params['PRE_PLA'], $_params['CAT_ID_PER'], $_params['FECHA'])) {
        // Si algun campo falla presenta el error 
        echo "Faltan algunos datos necesarios para registrar el plato.";
        return false;
    }

    // Preparo la consulta SQL para registrar un Plato
    $sql = "INSERT INTO `platos`(`TITU_PLA`, `DESC_PLA`, `FOT_PLA`, `PRE_PLA`, `CAT_ID_PER`, `FECHA`) VALUES (:TITU_PLA, :DESC_PLA, :FOT_PLA, :PRE_PLA, :CAT_ID_PER, :FECHA)";

    // Preparo los valores a insertar en la consulta
    $resultado = $this->cn->prepare($sql);
    $_array = array(
        ":TITU_PLA" => $_params['TITULO_PLA'],
        ":DESC_PLA" => $_params['DESC_PLA'],
        ":FOT_PLA" => $_params['FOT_PLA'],
        ":PRE_PLA" => $_params['PRE_PLA'],
        ":CAT_ID_PER" => $_params['CAT_ID_PER'],
        ":FECHA" => $_params['FECHA']
    );

    //si es verdadero registra 
    if ($resultado->execute($_array)) {
        return true; // Si la ejecución tiene éxito, retorna verdadero 
    } else {
        echo "Tuve un error para registrar el plato."; // Mostrar mensaje de error si la ejecución falla
        return false;
    }
}

//actualizo los platos 
//registrar y actualizar usaron lo mismo
    public function actualizar($_params){
       $sql = "UPDATE `platos` SET `TITU_PLA`=:TITU_PLA,`DESC_PLA`=:DESC_PLA,`FOT_PLA`=:FOT_PLA,`PRE_PLA`=:PRE_PLA,`CAT_ID_PER`=:CAT_ID_PER,`FECHA`=:FECHA WHERE `ID_PLA`=:ID_PLA";

        $resultado = $this->cn->prepare($sql);
        $_array = array(":TITU_PLA" =>$_params['TITULO_PLA'],
        ":DESC_PLA" => $_params['DESC_PLA'], 
        ":FOT_PLA" => $_params['FOT_PLA'],
         ":PRE_PLA"=> $_params['PRE_PLA'],
          ":CAT_ID_PER"=> $_params['CAT_ID_PER'], 
          ":FECHA" =>$_params['FECHA'],
          ":ID_PLA"=> $_params['ID_PLA']
        
        );
        //si todo esta bien actualiza caso contrario da un error 
        if($resultado->execute($_array)){
          return true;
        }else{
          print("Tuve un error para actualizar el plato");
          return false;
        }
    }

    //elimino un plato por el id
public function eliminar($id){
  //consulta
  $sql =  "DELETE FROM `platos` WHERE `ID_PLA`=:ID_PLA";
  $resultado = $this->cn->prepare($sql);
  $_array = array(
    ":ID_PLA"=> $id
  );
//si  es verdadero elimina caso contrario da un error 
  if($resultado->execute($_array)){
    return true;
  } else {
    print("Tuve un error para eliminar el plato");
    return false;
  }
}

//para poder ver todos los platos es decir el listado general
//estan relacionadas las tablas categoria  y platos
//tienen en comun id platos con cat_id_per de categorias
//la consulta que hago es inner join para relacion entre tablas 
public function ver(){
    $sql =  " SELECT  ID_PLA, TITU_PLA, DESC_PLA, FOT_PLA,NOM_CAT, PRE_PLA,FECHA,EST_PLA FROM platos INNER JOIN categorias ON platos.CAT_ID_PER = categorias.ID_CAT ORDER BY platos.ID_PLA DESC";
   $resultado = $this->cn->prepare($sql);
   //traigo todos los datos con fetchall en array 
        if($resultado->execute()){
          return $resultado->fetchAll();
        }else{
          print("UPS!! sucedio algun error para traer datos");
          return false;
        }
}

//mostrar el id para seleccionar solo un plato para saber sus datos
public function verPorId($id){
  $sql =  "SELECT * FROM `platos` WHERE `ID_PLA` = :ID_PLA ";
  $resultado = $this->cn->prepare($sql);
  $_array = array(
    ":ID_PLA"=> $id
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

?>