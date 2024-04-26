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
            <a href="carrito.php" class="btn">
              <span class="glyphicon glyphicon-shopping-cart"></span> Carrito
              <span class="badge"><?php echo cantidadPlatos(); ?></span>
            </a>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <!-- Muestro los platos disponibles a los clientes -->
  <div class="container" id="main">
    <div class="row">
      <?php
        require './vendor/autoload.php';
        $platos = new manin\Crud;
        $info_platos  = $platos->ver();
        $cantidad = count($info_platos);
        if ($cantidad > 0) {
          for ($x = 0; $x < $cantidad; $x++) {
            $item = $info_platos[$x];
      ?>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center" id="tituloPelicula"><?php echo $item['TITU_PLA']; ?></h1>
          </div>
          <div class="panel-body">
            <?php
              $foto = 'assets/temporales/' . $item['FOT_PLA'];
              if (file_exists($foto)) {
            ?>
            <img src="<?php echo $foto; ?>" class="img-responsive card-image">
            <?php } else { ?>
            <img src="assets/imagenes/not-found.jpg" class="img-responsive card-image">
            <?php } ?>
          </div>
          <div class="panel-footer">
            <a href="carrito.php?id=<?php echo $item['ID_PLA']; ?>&precio=<?php echo $item['PRE_PLA']; ?>" class="btn btn-primary btn-block">
              <span class="glyphicon glyphicon-shopping-cart"></span> Comprar <?php echo $item['PRE_PLA']; ?> USD
            </a>
          </div>
        </div>
      </div>
      <?php
          }
        } else {
      ?>
      <h4>No hay registros</h4>
      <?php } ?>
    </div>
  </div> <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
