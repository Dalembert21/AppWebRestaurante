<?php
require '../vendor/autoload.php';

$platos = new manin\Platos;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['accion'] === 'Registrar') {
        // Verifico si los campos están vacíos o no 
        if (empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['categoria_id'])) {
            exit('Todos los campos son requeridos. Por favor, completa todos los campos.');
        }

        // Verifico si el ID de categoría es numérico
        if (!is_numeric($_POST['categoria_id'])) {
            exit('La categoría seleccionada no es válida.');
        }

        // preparo los parametros para el registro
        $_params = array(
            'TITULO_PLA' => $_POST['titulo'],
            'DESC_PLA' => $_POST['descripcion'],
            'FOT_PLA' => subirFoto(), // funcion que cree abajo para subir fotos
            'PRE_PLA' => $_POST['precio'],
            'CAT_ID_PER' => $_POST['categoria_id'],
            'FECHA' => date('Y-m-d') // 
        );

        // llamo al metodo para registrar el plato
        $respuesta = $platos->registrar($_params);

        var_dump($respuesta); 
    }

  }

//funcion para subir la foto
function subirFoto(){
    $carpeta = __DIR__ . '/../assets/temporales/'; //acceso a la carpeta creada en assets
    $archivo = $carpeta . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);

    return $_FILES['foto']['name'];
}

?>
