<?php
namespace manin;

class Cliente {
    private $configuracion;
    private $cn = null;

    // Constructor que permite la conexión a la BD 
    public function __construct() {
        // Referencia al archivo config.ini en el directorio raíz
        $this->configuracion = parse_ini_file(__DIR__.'/../config.ini');

        try {
            // Ruta de conexión y habilitación de caracteres UTF-8
            $this->cn = new \PDO($this->configuracion['conectar'], $this->configuracion['usuario'], $this->configuracion['clave'], array(\PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        } catch (\PDOException $error) {
            // Si no se puede conectar, muestra el error
            echo "No se pudo conectar: " . $error->getMessage();
        }
    }

    // Método para registrar 
    public function registrarCliente($_params) {
        // Verificar si los índices existen en el array $_params
        if (!isset($_params['NOM_CLIE'], $_params['APE_CLIE'], $_params['CORREO_CLIE'], $_params['TEL_CLIE'], $_params['COMEN_CLIE'])) {
            // Si algun campo falla presenta el error 
            echo "Faltan algunos datos necesarios para registrar el cliente";
            return false;
        }

        // Preparo la consulta SQL para registrar un cliente
        $sql = "INSERT INTO `clientes`(`NOM_CLIE`, `APE_CLIE`, `CORREO_CLIE`, `TEL_CLIE`, `COMEN_CLIE`) VALUES (:NOM_CLIE, :APE_CLIE, :CORREO_CLIE, :TEL_CLIE, :COMEN_CLIE)";

        // Preparo los valores a insertar en la consulta
        $resultado = $this->cn->prepare($sql);
        $values = array(
            ":NOM_CLIE" => $_params['NOM_CLIE'],
            ":APE_CLIE" => $_params['APE_CLIE'],
            ":CORREO_CLIE" => $_params['CORREO_CLIE'],
            ":TEL_CLIE" => $_params['TEL_CLIE'],
            ":COMEN_CLIE" => $_params['COMEN_CLIE']
        );

        //si es verdadero registra 
        if ($resultado->execute($values)) {
            return $this->cn->lastInsertId(); //tomo el ultimo id del registro de Cliente
        } else {
            echo "Tuve un error para registrar el cliente."; // Mostrar mensaje de error si la ejecución falla
            return false;
        }
    }
}
?>