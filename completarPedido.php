<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'funciones.php';
    require 'vendor/autoload.php';

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new manin\Cliente;
        $_cliente_params = array(
            "NOM_CLIE" => $_POST['nombre'],
            "APE_CLIE" => $_POST['apellido'],
            "CORREO_CLIE" => $_POST['correo'],
            "TEL_CLIE" => $_POST['celular'],
            "COMEN_CLIE" => $_POST['comentario'],
        );
        $cliente_id = $cliente->registrarCliente($_cliente_params);

        $pedido = new manin\Pedido;

        $_pedido_params = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );

        $pedido_id = $pedido->registrarPedido($_pedido_params);

        // Registro del detalle 
foreach ($_SESSION['carrito'] as $indice => $value) {
    $_detalle_params = array(
        "ID_PEDI_PER" => $pedido_id,
        "ID_PLAT_PER" => $value['id'], // Utiliza 'id' como clave para el ID del producto
        "PRECIO_DETA" => $value['precio'], // Utiliza 'precio' como clave para el precio del producto
        "CANTI_DETA" => $value['cantidad'], // Utiliza 'cantidad' como clave para la cantidad del producto
    );
    $pedido->registrarDetallePedido($_detalle_params);
}



        // Limpiar la sesión
        $_SESSION['carrito'] = array();
        header('Location: gracias.php');
        exit(); // Importante para detener la ejecución después de redirigir
    }
}
?>
