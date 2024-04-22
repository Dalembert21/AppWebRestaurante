<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Manin Restaurante</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/css/miEstilo.css">
</head>



<body class="login">
  
  <section class="centroLoginS">
    <form class="" action="login.php" method="post">
      <h1 class="tituloLogin">Restaurante Manin</h1>
      <div class="cuadrosSesion">
        <input type="email" class="correo" id="correoElectronico">
        <label for="">Usuario</label>
      </div>
      <div class="cuadrosSesion">
        <input type="password" class="clave" id="contrasenia">
        <label for="">Contraseña</label>
      </div>
      <button type="button" class="iniciarSesion" onclick="iniciarSesion()">Iniciar</button>
    </form>
  </section>

  <!-- Bootstrap core JavaScript -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <script>
    function iniciarSesion() {
      var correo = document.getElementById("correoElectronico").value;
      var clave = document.getElementById("contrasenia").value;

      // Verificar credenciales estáticas
      if (correo === "admin" && clave === "123") {
        window.location.href = "indexAdmin.php";
      } else {
        alert("Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.");
      }
    }
  </script>
</body>

</html>
