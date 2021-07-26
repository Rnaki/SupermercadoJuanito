<?php
include("conexion.php");
$gbd = conectar();

//$data = $conn->query($sql)->fetchAll();
$sql = "SELECT * FROM producto where id_categoria = 63";
$gsent = $gbd->prepare($sql);
$cuenta_col = $gsent->columnCount();
$data = $gbd->query($sql)->fetchAll();

?>

<!doctype html>
<html lang="en">


<head>
  <!-- Etiquetas <meta> obligatorias para Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Enlazando el CSS de Bootstrap -->
  <link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
  <script src="js/funciones.js"></script>
  <!-- JS BOOTSTRAP -->
  <script src="jquery/jquery.min.v3.6.0.js"></script>
  <script src="bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

  <title> Ventas Juanito </title>
</head>

<body>
  <header class="site-header sticky-top py-1">
    <nav class="bg-dark container d-flex flex-column flex-md-row justify-content-between">

      <a class="py-2 d-none d-md-inline-block text-white " href="lobby.php">Inicio</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="carrito.php">Carrito</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="perfil.php">Perfil</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="index.php">Cerrar sesión</a>

    </nav>
  </header>
  <main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">Categoria</h1>
        <p class="lead fw-normal"> Carne </p>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Categorias</h1>
          <div class="list-group">
          <a href="/comida.php" class="list-group-item">Carne</a>
            <a href="#" class="list-group-item">Pescado</a>
            <a href="#" class="list-group-item">Frutas</a>
            <a href="#" class="list-group-item">Verduras</a>
            <a href="#" class="list-group-item">Congelados</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
          <?php
                  foreach ($data as $row) {
                      ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                   
                    <a href="/<?php echo $row['nombre_producto'] ?>.html"><td><?php echo $row['nombre_producto'] ?></td></a>
                  
                  </h4>
                  <h5><td>$<?php echo $row['precio'] ?></h5>
                  <p class="card-text"><td><?php echo $row['descripcion'] ?></p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>
            <?php        
                }
                ?>

            

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Supermercado Juanito &copy;</p>
      </div>
      <!-- /.container -->
    </footer>
  </main>
  <!-- Opcional: enlazando el JavaScript de Bootstrap -->

</body>

</html>