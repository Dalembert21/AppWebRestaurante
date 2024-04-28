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
    <div class="row">
      <div class="col-md-12">
          <fieldset disabled="disabled">
                  <?php
                      require '../../vendor/autoload.php';
                      $id = $_GET['id'];
                      $pedido = new manin\Pedido;
                      $info_pedido= $pedido->mostrarPorIdPedido($id);
                      $info_detalle_pedido= $pedido->mostrarDetallePorIdPedido($id);

                    ?>
            <legend>Informacion de la Compra</legend>
            <div class="form-group">
                      <label for="">Nombre</label>
                      <input type="text" class="form-control" value="<?php   print $info_pedido['NOM_CLIE'];  ?>" readonly> 
            </div>
            <div class="form-group">
                      <label for="">Apellido</label>
                      <input type="text" class="form-control" value="<?php   print $info_pedido['APE_CLIE'];  ?>" readonly> 
            </div>
            <div class="form-group">
                      <label for="">Correo</label>
                      <input type="text" class="form-control" value="<?php   print $info_pedido['CORREO_CLIE'];  ?>" readonly> 
            </div>
            <div class="form-group">
                      <label for="">Fecha de Compra</label>
                      <input type="text" class="form-control" value="<?php   print $info_pedido['FECHA_PEDI'];  ?>" readonly> 
            </div>
           
            <hr>Productos comprados <hr>
             <table class="table table-bordered" id="opciones">
            <thead class="opciones">
              <tr>
                <th>N.º</th>
                <th>Titulo</th>
                <th>Foto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
               
              </tr>
            </thead>
            <!---CUERPO DE LA TABLA----->
            <tbody>
              <?php
             
             
              //compruebo cuantos registros hay en la bd
              $cantidad = count( $info_detalle_pedido);
              $contador = 0;
              //si cantidad es mayor a cero me devuelve toda la informacion de los pedidos
              if ($cantidad > 0) {
                //recorro el arreglo para mostrar mis items
                for ($x =0; $x<$cantidad;$x++) {
                  $contador++;
                  $item = $info_detalle_pedido[$x];
                  $total = $item['PRECIO_DETA']* $item['CANTI_DETA'];
              ?>
                  <tr>
                      <td><?php print($contador)?></td>
                      <td><?php echo $item['TITU_PLA']?></td>
                      <td>
                         <?php
                      //accedo a la carpeta para leer fotos
                      $foto='../../assets/temporales/'.$item['FOT_PLA'];
                      //si existe la foto la mostrara 
                      if(file_exists($foto)){
                                         ?>
                                         <img src="<?php print($foto);?>" alt="" width="35">
            
                     <?php }else{
                          print("no tiene imagen");
                     } ?>
                      </td> 
                      <td>$<?php echo $item['PRECIO_DETA'] ?> </td>
                      <td><?php echo $item['CANTI_DETA'] ?></td>
                      <td><?php print($total)?></td>
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
          <div class="col-md-3">
                 <div class="form-group">
                      <label for="">Total de Compra</label>
                      <input type="text" class="form-control" value="<?php   print $info_pedido['TOTA_PEDI'];  ?>" readonly> 
            </div>
          </div>
          
          
          
          </fieldset>
          <div class="pull-left">
            <a href="pedidos.php" class="btn btn-default hidden-print">Cancelar</a>
          </div>
             <div class="pull-right">
            <a href="javascript:;" id="btnImprimir"class="btn btn-danger hidden-print">Imprimir</a>
          </div>
          
      </div>
    </div>
 
  </div> <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
        // Función para imprimir cuando se hace clic en el botón
        function imprimir() {
            window.print();
        }

        // Asignar la función al evento clic del botón
        document.getElementById('btnImprimir').addEventListener('click', imprimir);
    </script>

</body>

</html>
