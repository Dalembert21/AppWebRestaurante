<?php
  session_start();
  require 'funciones.php';
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
              <a href="carrito.php" class="btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrito <span class="badge"><?php echo cantidadPlatos(); ?></span></a>

          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <!--Formulario para registrar una compra-->
<div class="container" id="main">
    <div class="main-form">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Complete los datos para su compra</legend>
                    <form method="post" action="completarPedido.php">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" class="form-control" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" class="form-control" name="celular" required>
                        </div>
                        <div class="form-group">
                            <label>Comentario</label>
                            <textarea name="comentario" rows="4" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Enviar</button>
                        <a href="index.php">Seguir comprando ?</a>
                    </form>
                </fieldset>
            </div>
        </div> 
    </div>
</div> <!-- /container -->





  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>