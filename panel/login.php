<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    require '../vendor/autoload.php';
    $usuario = new manin\Usuario;
    $resultado = $usuario->login($nombreUsuario, $clave);

    // Condición para cuando el inicio de sesión es exitoso
    if ($resultado) {
        session_start();

        $_SESSION['usuario_info'] = array(
          'nombreUsuario' => $resultado['usuario'],
          'estado' => 1
        );
        header('Location: indexAdmin.php');
        exit; // Termina la ejecución del script después de la redirección
    } else {
        // Script JavaScript para mostrar el mensaje de alerta
        echo "<script>alert('Datos incorrectos'); window.location.href = 'index.php';</script>";
        exit; // Termina la ejecución del script después de mostrar el alerta
    }
}
?>
