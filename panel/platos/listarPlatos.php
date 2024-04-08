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
          <li>
            <a href="../pedidos/pedidos.php" class="btn">Pedidos</a>
          </li>
              <li class="active">
            <a href="platos.php" class="btn">Platos</a>
          </li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Cerrar Sesión</a></li>
          </ul>
        </li>
        </ul>




      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <div class ="row">
      <div class="col-md-12">
        <div class="pull-right">
          <a href="registrar.php" class="btn btn-success btn-sm"> <span class="glyphicon glyphicon-plus"></span>Nuevo</a>
        </div>
      </div>
    </div>

    <div class ="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Listado de Platos</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> N.º</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th class="text-center">Foto</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
            
              <?php
                require '../../vendor/autoload.php';
                  $platos = new manin\Crud;

                  $info_platos = $platos->ver();
                  $cantidad = count($info_platos);
                     $contador=0;
                  if($cantidad>0){
                    for($i=0;$i<$cantidad;$i++){
                      $contador++;
                      $item=$info_platos[$i];

                    ?>  
                    <tr>
                 <td><?php print($contador)?></td>
                <td><?php print $item['TITU_PLA']?></td>
                 <td><?php print $item['NOM_CAT']?></td>
                  <td><?php print $item['PRE_PLA']?></td>
                   <td class=""text-center>
                    <?php
                      $foto='../../assets/temporales/'.$item['FOT_PLA'];
                      if(file_exists($foto)){
                                         ?>
                                         <img src="<?php print($foto);?>" alt="" width="50">
            
                     <?php }else{
                          print("no tiene imagen");
                     } ?>
               
                   </td>
                   <td class="text-center">
                          <a href="" class="btn btn-danger btn-sm"> <span class="glyphicon glyphicon-trash">Borrar</span></a>
                         <a href="actualizar.php?id=<?php echo $item['ID_PLA']; ?>" class="btn btn-warning btn-sm">
  <span class="glyphicon glyphicon-edit"></span> Editar
</a>

                   </td>
              </tr>
                <?php
                        } 
                  }else{
                  ?>
                    <tr>
                    <td colspan="6"> NO HAY REGISTROS DISPONIBLES
                    </td></tr>
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