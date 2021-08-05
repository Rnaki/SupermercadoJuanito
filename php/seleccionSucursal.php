<?php 
    include("conexion.php");
    $gbd = conectar();
    session_start();
    $rut = $_SESSION["rut_persona"];
    $sql10 = "INSERT INTO VENTA (rut_persona) values ('".$rut."')";
    $gbd->exec($sql10);
    $_SESSION["id_venta"] = $gbd->lastInsertId();
    echo $_SESSION["id_venta"];

    try{

        $sql1 = "SELECT id_sucursal, nombre_sucursal from sucursal ;";
        $gsent1 = $gbd->prepare($sql1);
        $gsent1->execute();
        $resultado = $gsent1->fetchAll(PDO::FETCH_ASSOC);


        

        

    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>

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
    <script src="../js/funciones.js"></script>
    <!-- JS BOOTSTRAP -->
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
<link href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet">

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
      .ancho {
          width:100% !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">

    <h1 class="h3 mb-3 fw-normal">¡Bienvenido a SuperMercado Juanito!</h1>
    <img class="mb-4" src="../imagenes/logo manzana.jfif" alt="" width="300" height="300">
    <h1 class="h3 mb-3 fw-normal">SELECCIONE SUCURSAL</h1>
<div class="row inline-block">
<?php
  
    foreach ($resultado as $row) {
    
    echo "<form action='lobby.php' method='POST'>   
          <input type='hidden' value='".$row["id_sucursal"]."' name='sucursal'>
          <br>
          <button type='submit' class='btn btn-primary btn-lg btn-block ancho'>".$row["nombre_sucursal"]."</button>
          </form>";
        }
  

?>
</div>




    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>

</main>


    
  </body>
</html>
