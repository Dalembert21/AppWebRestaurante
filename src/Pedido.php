<?php
namespace manin;

class Pedido {
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

    // Método para registrar el pedido
    public function registrarPedido($_params) {
        // Verificar si los índices existen en el array $_params
        if (!isset($_params['cliente_id'], $_params['total'], $_params['fecha'])) {
            echo "Faltan algunos datos necesarios para registrar el pedido";
            return false;
        }

        $sql = "INSERT INTO `pedidos`(`ID_CLIE_PER`, `TOTA_PEDI`, `FECHA_PEDI`) VALUES (:ID_CLIE_PER, :TOTA_PEDI, :FECHA_PEDI)";
        $resultado = $this->cn->prepare($sql);
        $values = array(
            ":ID_CLIE_PER" => $_params['cliente_id'],
            ":TOTA_PEDI" => $_params['total'],
            ":FECHA_PEDI" => $_params['fecha']
        );

        if ($resultado->execute($values)) {
            return $this->cn->lastInsertId();
        } else {
            echo "Tuve un error para registrar el pedido.";
            return false;
        }
    }

// Método para registrar el detalle del pedido
public function registrarDetallePedido($_params) {
    // Verificar si los índices existen en el array $_params
    if (!isset($_params['ID_PEDI_PER'], $_params['ID_PLAT_PER'], $_params['PRECIO_DETA'], $_params['CANTI_DETA'])) {
        echo "Faltan algunos datos necesarios para registrar el detalle del pedido";
        return false;
    }


    $sql = "INSERT INTO `detallepedido`(`ID_PEDI_PER`, `ID_PLAT_PER`, `PRECIO_DETA`, `CANTI_DETA`) VALUES (:ID_PEDI_PER, :ID_PLAT_PER, :PRECIO_DETA, :CANTI_DETA)";
    $resultado = $this->cn->prepare($sql);
    $values = array(
        ":ID_PEDI_PER" => $_params['ID_PEDI_PER'],
        ":ID_PLAT_PER" => $_params['ID_PLAT_PER'],
        ":PRECIO_DETA" => $_params['PRECIO_DETA'],
        ":CANTI_DETA" => $_params['CANTI_DETA']
    );

    if ($resultado->execute($values)) {
        return $this->cn->lastInsertId();
    } else {
        echo "Tuve un error para registrar el detalle del pedido.";
        return false;
    }
}

public function mostrarPedido() {
    $sql = "SELECT 
                p.ID_PEDI,
                c.NOM_CLIE,
                c.APE_CLIE,
                c.CORREO_CLIE,
                p.TOTA_PEDI,
                p.FECHA_PEDI
            FROM 
                pedidos p
            INNER JOIN
                clientes c ON p.ID_CLIE_PER = c.ID_CLIE
            ORDER BY 
                p.ID_PEDI DESC";

    $resultado = $this->cn->prepare($sql);
    if ($resultado->execute()) {
        return $resultado->fetchAll();
    } else {
        echo "Tuve un error para mostrar el pedido.";
        return false;
    }
}
//visualizar el pedido en ver.php
public function mostrarPorIdPedido($id){
          $sql = "SELECT 
                p.ID_PEDI,
                c.NOM_CLIE,
                c.APE_CLIE,
                c.CORREO_CLIE,
                p.TOTA_PEDI,
                p.FECHA_PEDI
            FROM 
                pedidos p
            INNER JOIN
                clientes c ON p.ID_CLIE_PER = c.ID_CLIE
            WHERE p.ID_PEDI = :id ";

    $resultado = $this->cn->prepare($sql);

    $_array = array(
          ':id' => $id
    );
    

    if ($resultado->execute($_array)) {
        return $resultado->fetch();
    } else {
        echo "Tuve un error para mostrar el pedido.";
        return false;
    }

}

public function mostrarDetallePorIdPedido($id) {
    $sql = "  SELECT dp.ID_DETA,
	       p.TITU_PLA,
         dp.PRECIO_DETA,
         dp.CANTI_DETA,
         p.FOT_PLA
	  FROM detallepedido dp
	  INNER JOIN platos p ON p.ID_PLA = dp.ID_PLAT_PER
          WHERE dp.ID_PEDI_PER =:id";

    $resultado = $this->cn->prepare($sql);
        $_array = array(
          ':id' => $id
    );
   
    
    if ($resultado->execute($_array)) {
        return $resultado->fetchAll();
    } else {
        echo "Tuve un error para mostrar el pedido.";
        return false;
    }
}
//mostar en el indexAdmin.php
public function mostrarUltimos() {
    $sql = "SELECT 
                p.ID_PEDI,
                c.NOM_CLIE,
                c.APE_CLIE,
                c.CORREO_CLIE,
                p.TOTA_PEDI,
                p.FECHA_PEDI
            FROM 
                pedidos p
            INNER JOIN
                clientes c ON p.ID_CLIE_PER = c.ID_CLIE
            ORDER BY 
                p.ID_PEDI DESC LIMIT 10";

    $resultado = $this->cn->prepare($sql);
    if ($resultado->execute()) {
        return $resultado->fetchAll();
    } else {
        echo "Tuve un error para mostrar el pedido.";
        return false;
    }
}




}
?>
