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
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/estilos.css">
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
        <a class="navbar-brand" href="../indexAdmin.php">Manin Restaurante</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li class="active">
            <a href="pedidos.php" class="btn">Pedidos</a>
          </li>
          <li>
            <a href="../pedidos/listarpedidos.php" class="btn">pedidos</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
              aria-expanded="false">Admin <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
        <div>
        </div>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <!---TABLA DE pedidos-->
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Listado de Pedidos</legend>
          <table class="table table-bordered" id="opciones">
            <thead class="opciones">
              <tr>
                <th>N.º</th>
                <th>Cliente</th>
                <th>N.º Pedido</th>
                <th>Total</th>
                <th>Fecha</th>
                <th class="text-center">Opciones</th>
              </tr>
            </thead>
            <!---CUERPO DE LA TABLA----->
            <tbody>
              <?php
              require '../../vendor/autoload.php';
              $pedidos = new manin\Pedido;
              //creo una variable para almacenar todas las peliculas
              $info_pedidos = $pedidos->mostrarPedido();
              //compruebo cuantos registros hay en la bd
              $cantidad = count($info_pedidos);
              $contador = 0;
              //si cantidad es mayor a cero me devuelve toda la informacion de los pedidos
              if ($cantidad > 0) {
                //recorro el arreglo para mostrar mis items
                foreach ($info_pedidos as $item) {
                  $contador++;
              ?>
                  <tr>
                      <td><?php print($contador)?></td>
                      <td><?php echo $item['NOM_CLIE'].' '. $item['APE_CLIE']?></td>
                      <td><?php echo $item['ID_PEDI'] ?></td> <!-- Aquí estaba duplicado, corregido a ID_PEDI -->
                      <td>$<?php echo $item['TOTA_PEDI'] ?> </td>
                      <td><?php echo $item['FECHA_PEDI'] ?></td>
                      <td class="text-center">
                          <a href="ver.php?id=<?php echo $item['ID_PEDI']; ?>" class="btn btn-danger btn-sm">
                              <span class="glyphicon glyphicon-eye-open"> Visualizar</span>
                          </a>
                      </td>
                  </tr>
              <?php
                }
              } else {
              ?>
                <tr>
                  <td colspan="7">NO HAY REGISTROS DISPONIBLES</td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
  </div> <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>

</body>

</html>
