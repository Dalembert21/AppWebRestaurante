<?php
          //activo las sesiones en php para usar mientras navego en las paginas
          session_start();
        require 'funciones.php';
        //obtengo por la URL el tipo id
        if(isset($_GET['id'])  && is_numeric($_GET['id']) ){
               $id = $_GET['id'];
               require 'vendor/autoload.php';
               $platos = new manin\Crud;
                $resultado = $platos-> verPorId($id);
            
                if(!$resultado)
                   header('Location: index.php'); //controlo  mediante el id que si no existe me redirija al index.html de los platos
                  agregarPlato($resultado , $id);
                  //si el carrito existe
                  if(isset($_SESSION['carrito'])){ 
                          //si el plato existe en el carrito 
                          if(array_key_exists($id,$_SESSION['carrito'])){
                          
                          }else{
                            //si el plato no existe en el carrito
                              agregarPlato($resultado,$id);
                          }

                                  } else {
                                    //si el carrito no existe
                                    agregarPlato($resultado,$id);

                    }
                                              

                                     

                                      
                                      
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
           <a href="#" class="btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrito<span class="badge"><?php echo cantidadPlatos(); ?></span></a>


          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
<div class="container" id="main">

  <table class="table table-bordered table-hover" id="opciones">
            <thead class="opciones">
              <tr>
                <th> N.º</th>
                 <th>Plato</th>
                  <th>Foto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th class="">Opciones</th>
              </tr>

            </thead>
            <!---CUERPO DE LA TABLA PARA MOSTRAR TODOS LOS PRODUCTOS DEL CARRITO----->
            <tbody>
                            <?php
                                  if(isset($_SESSION['carrito'])&& !empty($_SESSION['carrito'])){
                                    $total=0;
                                    $c=0;
                                    foreach($_SESSION['carrito'] as $indice =>$value){
                                      $c++;
                                      $total = $value['precio'] * $value['cantidad'];
                                  
                            ?>
                              <form action="actualizarCarrito.php" method="post">
                                              <tr>
                                                  <td><?php print $c ?></td>
                                                <td><?php print $value['titulo'] ?></td>
                                                <td>      <?php
                                                                  $foto = 'assets/temporales/' . $value['foto'];
                                                                  if (file_exists($foto)) {
                                                              ?>
                                                              <img src="<?php print($foto); ?>" width="35">
                                                              <?php } else { ?>
                                                              <img src="assets/imagenes/not-found.jpg" width="35">
                                                              <?php } ?>
                                                </td>
                                                    <td><?php print $value['precio'] ?>
                                                  </td>
                                                  <td>
                                                      <input type="hidden" name="id" value="<?php  print $value['id']  ?>">
                                                    <input type="text" name="cantidad" class="form-control u-size-100" value="<?php  print $value['cantidad']  ?>">
                                                  </td>
                                                    <td>$<?php print ($total) ?>
                                                  </td>
                                                  <td>
                                                        <button type="submit" class="btn-success btn-xs">
                                                          <span class="glyphicon glyphicon-refresh"> </span> Actualizar
                                                        </button>
                                                          <a href="eliminarCarrito.php?id=<?php print $value['id']  ?>" class="btn btn-danger btn-xs">
                                                          <span class="glyphicon glyphicon-trash"> </span> Borrar
                                                        </a>
                                                  </td>
                                    </form>
                                   
                                </tr>

                            <?php
                                    }
                                  }else{
                            ?>
                            <tr>
                              <td colspan="7">No hay productos en el carrito</td>
                            </tr>

                            <?php
                                  }

                            ?>  
            </tbody>
            <tfoot>
                    <tr>
                      <td colspan="5" class="text-right">TOTAL =</td>
                      <td>$<?php  print calcularTotal();?></td>
                      <td></td>
                    </tr>
            </tfoot>
            </table>
    
</div> <!-- /container -->




  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>