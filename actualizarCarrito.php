<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'funciones.php';
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    // Validar que la cantidad sea numérica y mayor que cero
    if (is_numeric($cantidad) && $cantidad > 0) {
        // Verificar si el plato está en el carrito
        if (array_key_exists($id, $_SESSION['carrito'])) {
            // Actualizar la cantidad del plato
            $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
        }
    }
}
// Redirigir de vuelta a la página del carrito
header('Location: carrito.php');
?>
