<?php
require '../vendor/autoload.php';

$platos = new manin\Crud;
//solo funciona si viene por el metodo post
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
           //validacion para cuando el registro es correcto se redirija al listado de productos indexAdmin.php
        if($respuesta){
                     header('Location: platos/listarPlatos.php');
        }else{
                print("Errror al registrar un plato");
        }
     
        
        
    }
    //verifico que venga por el metodo post y compruebo campos vacios
    if($_POST['accion']==="Actualizar"){
        if(empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['categoria_id'])){
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
            'PRE_PLA' => $_POST['precio'],
            'CAT_ID_PER' => $_POST['categoria_id'],
            'FECHA' => date('Y-m-d'),
            'ID_PLA'=>$_POST['id']// 
        );
        //condicional para que una foto no se obligatoria para actualizar
        //si existe una foto no es obligatorio subir una se queda la misma
        if(!empty($_POST['foto_temp']))
            $_params['FOT_PLA']=$_POST['foto_temp'];
        //sino existe una foto en temp deberia subir una.  
        if(!empty($_FILES['FOT_PLA']['name']))
            $_params['FOT_PLA']=subirFoto();

        // llamo al metodo para actualizar el plato 
        $respuesta = $platos->actualizar($_params);
        //validacion para cuando la actualizacion es correcta se redirija al listado de productos indexAdmin.php
        if($respuesta){
             header('Location: platos/listarPlatos.php');

        }else{
          print("Errror al actualizar un plato");
        }
        
     

    }

  }
//para eliminar algun valor que venga por el metodo get
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     //llamo el metodo para eliminar
      $id=$_GET['id'];
        $respuesta = $platos->eliminar($id);
           //validacion para cuando la eliminacion  es correcta se redirija al listado de productos indexAdmin.php
        if($respuesta){
                     header('Location: platos/listarPlatos.php');
        }else{
                print("Errror al eliminar un plato");
        }
  }


//funcion para subir la foto
function subirFoto(){
  //identifico donde guardar mis fotos temporales
    $carpeta = __DIR__ . '/../assets/temporales/'; //acceso a la carpeta creada en assets
    //ruta donde de la foto
    $archivo = $carpeta . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);

    return $_FILES['foto']['name'];
}

?>
