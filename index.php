<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Ventas Juanito</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css"/>
    <script src="js/funciones.js"></script>
    <!-- JS BOOTSTRAP -->
    <script src="jquery/jquery.min.v3.6.0.js"></script>
    <script src="bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
<link href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="verifacion.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">¡Bienvenido a SuperMercado Juanito!</h1>
    <img class="mb-4" src="imagenes/logo manzana.jfif" alt="" width="300" height="300">
    <h1 class="h3 mb-3 fw-normal">Ingrese sus datos</h1>
      <?php if(isset($_GET["error"])){
                $tipoError = $_GET["error"];
                if ($tipoError == 1){
                  echo '<p style="color:red;">Rut o Contraseña incorrecto, intente de nuevo</p>';
                }
            }
      ?>
    <div class="form-floating">
      <input type="text" class="form-control" name="rut" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Rut</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="contraseña" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>

    <input class="w-100 btn btn-lg btn-primary" type="submit" value="Entrar"></input>
    <div><a href="Registro.php" class="h6 mb-3 fw-normal">Registrarse</a></div>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>


    
  </body>
</html>
