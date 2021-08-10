<?php 

session_start();
$_SESSION["id_venta"];

if(isset($_POST["sucursal"])){
  $_SESSION["sucursal"] = $_POST["sucursal"];
  

}
if(isset($_SESSION["rut_persona"])){

  $sucursal = $_SESSION["sucursal"];

include("conexion.php");
$gbd=conectar();

$sql = "SELECT * FROM categoria ";
$gsent = $gbd->prepare($sql);
$cuenta_col = $gsent->columnCount();
$data = $gbd->query($sql)->fetchAll();

$sql2 = "SELECT * FROM producto
         join incluye
         on incluye.id_producto = producto.id_producto
         where incluye.id_sucursal = '".$sucursal."' ";
$gsent = $gbd->prepare($sql2);
$data2 = $gbd->query($sql2)->fetchAll();

if(isset($_GET["idCategoria"])){
  $idCategoria = $_GET["idCategoria"];
  $sql2 = "SELECT * FROM producto
          join incluye
          on incluye.id_producto = producto.id_producto 
          where id_categoria = '".$idCategoria."' 
          and incluye.id_sucursal = '".$sucursal."'";
  $gsent = $gbd->prepare($sql2);
  $data2 = $gbd->query($sql2)->fetchAll();

}

$sql3 = "SELECT nombre_sucursal from sucursal

        where id_sucursal = '".$sucursal."'";

$gsent3 = $gbd->prepare($sql3);
$resultado = $gbd->query($sql3)->fetchAll();




?>

<!doctype html>
<html lang="en">




<head>
  <!-- Etiquetas <meta> obligatorias para Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Enlazando el CSS de Bootstrap -->
  <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
  <script src="../js/funciones.js"></script>
  <!-- JS BOOTSTRAP -->
  <script src="../jquery/jquery.min.v3.6.0.js"></script>
  <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
  <style>

    /*Botones*/
    .btn-dark-l{
      color: #fff;
      background-color: #212529;
      border-color: #212529;
      text-align: center;
      width: 87px;
      height: 36px;
      
  
    }

    /*Cantidad*/
    .num{
      line-height: 65px;
      text-align: center;
      width: 87px;
      height: 36px;
      margin-right: 5px !important;
      margin-left: 5px !important;
      margin-top: 0px;
      padding: 0px
      

    }

    /*Agregar al carrito*/
    .btn-dark{
      margin-top: 10px;
      height: 45px;
      width: 273px;
    }

  </style>

  <title> Ventas Juanito </title>
</head>

<body>
  <header class="site-header sticky-top py-1">
    <nav class="bg-dark container d-flex flex-column flex-md-row justify-content-between">
      <a class="py-2 d-none d-md-inline-block text-white " href="seleccionSucursal.php">Sucursales</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="lobby.php">Inicio</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="carrito.php">Carrito</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="perfil.php">Perfil</a>
      <a class="py-2 d-none d-md-inline-block text-white " href="cerrar_session.php">Cerrar sesión</a>

    </nav>
  </header>
  <main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1><?php foreach($resultado as $row){ echo $row["nombre_sucursal"];} ?></h1>
        <h1 class="display-4 fw-normal">¡Bienvenido al Supermecado online de Juanito!</h1>
        <p class="lead fw-normal"> Ofrecemos los mejores productos del mercado y te lo enviamos lo más pronto posible </p>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h1 class="my-4">Categorias</h1>
          <div class="list-group">
            <?php foreach ($data as $row){
              echo "<form method='GET' action='lobby.php'>";
              echo "<input type='hidden' name='idCategoria' value=".$row["id_categoria"].">";
              echo "<div class='d-grid gap-2'>";
              echo "<button class='btn btn-dark' type='submit' id=".$row["id_categoria"].">".$row["nombre_categoria"]."</button>";
              echo "</div>";
              echo "</form>";
            }
            ?>
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
          $n = 0;
                  foreach ($data2 as $row) {

                      ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100 w-500">
                <a href="#"><img class="card-img-top" src="../imagenes/<?php echo $row['imagen'] ?>" width="20px" height="200px" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                   
                    <a ><td><?php echo $row['nombre_producto'] ?></td></a>
                  
                  </h4>
                  <h5>$<?php echo round($row['precio']-(($row['precio']*$row['descuento'])/100)) ?></h5>

                  <h6 style="color:dimgrey;">-<?php echo $row['descuento'] ?>%</h6>
                  <p class="card-text"><td><?php echo $row['descripcion'] ?></p>
                </div>
                <div class="card-footer">
                <?php
                //echo "<form class='form-num' method='POST' action='insertarCarrito.php'>";
                echo "<input type='hidden' name='idProducto' value=".$row["id_producto"].">";
                echo "<div class=' gap-2'>";

                
                echo "<button class='btn btn-dark-l' onclick='decrementar(".$row["id_producto"].")'>-</button>";
                echo "<input class='num' type='text' value='1' id='".$row["id_producto"]."' name='cantidad' disabled>";
                echo "<button class='btn btn-dark-l' onclick='incrementar(".$row["id_producto"].")'>+</button>";

                echo "<button onclick='añadircarrito(".$row["id_producto"].")'class='btn btn-dark' type='submit'>Agregar al carrito</button>";
                echo "</div>";
                //echo "</form>";
                $n++;
              ?>
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

<?php 
  }else{
    echo "NO ENTRES INTRUSO";
    Header("refresh:5; url=../index.php");
  }
?>