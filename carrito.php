<?php


          //activo las sesiones en php
          session_start();
        require 'funciones.php';
        if(isset($_GET['id'])  && is_numeric($_GET['id']) ){
               $id = $_GET['id'];
               require 'vendor/autoload.php';
               $platos = new manin\Crud;
                $resultado = $platos-> verPorId($id);
            
                if(!$resultado)
                   header('Location: index.php'); //controlo  mediante el id que si no existe me redirija al index.html de los platos
                  agregarPlato($resultado , $id);
                  ///validacion si el usuario no ha interactuado con el carrito
              if(array_key_exists($id,$_SESSION['carrito'])) {
    // Obtener la cantidad actual del plato en el carrito
    $cantidad_actual = $_SESSION['carrito'][$id]['cantidad'];
    // Actualizar el plato con una cantidad aumentada
    actualizarPlato($id, $cantidad_actual + 1);
} else {
    // Si no existe el plato en el carrito, agregarlo
    agregarPlato($resultado, $id);
}


                  print '<pre>';
                  print_r($_SESSION['carrito']);
                  die;

                  
                  
        }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Manin Restaurante</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/estilos.css">
   <link rel="stylesheet" href="assets/css/miEstilo.css">
</head>

<body>

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
          aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Manin Restaurante</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="" class="btn">Carrito <span class="badge">0</span></a>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
<div class="container" id="main">
    
</div> <!-- /container -->




  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>