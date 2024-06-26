<?php
session_start();
// Validar si existe la sesión y controlar que no ingrese
if (!isset($_SESSION['usuario_info']) || empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit; // Termina la ejecución del script después de la redirección
}


require '../../vendor/autoload.php';
//verfico si el metodo viene por get y tambien si el valor es numerico
if(isset($_GET['id'])&& is_numeric($_GET['id'])){
        $id = $_GET['id'];
$platos = new manin\Crud;
//muestro el plato por id segun el CRUD establecido
$resultado = $platos->verPorId($id);

if(!$resultado)
     header('Location: listarPlatos.php');
}else{
  header('Location: listarPlatos.php');
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
              <li>
            <a href="listarPlatos.php" class="btn">Platos</a>
          </li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php   print $_SESSION['usuario_info'] ['nombreUsuario'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../cerrarSesion.php">Cerrar Sesión</a></li>
          </ul>
        </li>
        </ul>




      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main" >
<div class="row">
    <div class="col-md-12">
      <fieldset > <legend>Datos de los Platos</legend>
  <form method="POST" action="../acciones.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php print $resultado['ID_PLA']?>">
   <div class="row">
        <div class="col-md-6">
      <div class="form-group">
    <label >Titulo</label>
    <input value="<?php print $resultado['TITU_PLA']?>" type="text" class="form-control" name="titulo"required>
  </div>
        </div>
   </div>
     <div class="row">
        <div class="col-md-12">
      <div class="form-group">
    <label >Descripcion</label>
      <textarea class="form-control" name="descripcion" id="" cols="3" required><?php print $resultado['DESC_PLA']?></textarea>
  </div>
        </div>
   </div>
     <div class="row">
        <div class="col-md-4">
      <div class="form-group">
    <label >Categorias</label>
        <select  class="form-control"name="categoria_id" id="" required>
          <option value="">--Seleccione--</option>
            <?php
                  require '../../vendor/autoload.php';
                  $categoria = new manin\Categorias;
                  $info_categoria = $categoria->ver(); 
                  $cantidad = count($info_categoria);
                  for($x = 0; $x < $cantidad; $x++) {
                      $item = $info_categoria[$x];
                  ?>
                      <option value="<?php print $item['ID_CAT']?>"
                          <?php print $resultado['CAT_ID_PER'] == $item['ID_CAT'] ? 'selected' : ''; ?>>
                          <?php print $item['NOM_CAT']?>
                      </option>
                  <?php
                  }
                  ?>

        </select>
  </div>
        </div>
   </div>
   <div class="row">
    <div class="col-md-12">
  <form>
   <div class="row">
        <div class="col-md-4">
      <div class="form-group">
        <!---Guardo la foto en otro input para traer el dato al querer actualizar-->
    <label >Foto</label>
    <input type="file" class="form-control" name="foto" >
    <input type="hidden"name="foto_temp" value="<?php print $resultado['FOT_PLA']?>">
  </div>
        </div>
   </div>
   <div class="row">
    <div class="col-md-12">
  <form>
   <div class="row">
        <div class="col-md-4">
      <div class="form-group">
    <label >Precio</label>
    <input value="<?php print $resultado['PRE_PLA']?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
  </div>
        </div>
   </div>
  
  <input type="submit" class="btn btn-info" name ="accion" value="Actualizar">
   <a href="../indexAdmin.php" class="btn btn-default"></span>Cancelar</a>
</form>

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