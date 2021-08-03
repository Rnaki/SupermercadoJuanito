<?php   

 session_start();
 $id_venta = $_SESSION["id_venta"];
 if(isset($_SESSION["rut_persona"])){

    include("conexion.php");
    $gbd = conectar();

    $sql = "SELECT pertenece.id_producto, pertenece.cantidad, nombre_producto, precio FROM pertenece 
            join producto
            on pertenece.id_producto = producto.id_producto
            where pertenece.id_venta = '".$id_venta."'";
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    //$cuenta_col = $gsent->columnCount();
    //$data = $gbd->query($sql)->fetchAll();
    $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

    //ZONA HORARIA
    date_default_timezone_set('America/Santiago');
    //FECHA ACTUAL
    $fecha_actual = date("Y-m-d");

    $sql2 = "SELECT  SUM(precio * cantidad) as total FROM pertenece 
    join producto
    on pertenece.id_producto = producto.id_producto
    where pertenece.id_venta = '".$id_venta."'";
    $gsent2 = $gbd->prepare($sql2);
    $gsent2->execute();
    //$cuenta_col = $gsent->columnCount();
    //$data = $gbd->query($sql)->fetchAll();
    $total = $gsent2->fetchAll(PDO::FETCH_ASSOC);

 }


?>

<!doctype html>
<html lang="es">

<head>
  <!-- Etiquetas <meta> obligatorias para Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Enlazando el CSS de Bootstrap -->
  <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
  <script src="../js/funciones.js"></script>
  <link rel="stylesheet" href="../css/Estilos.css">
  <!-- JS BOOTSTRAP -->
  <script src="../jquery/jquery.min.v3.6.0.js"></script>
  <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

  <title>Carrito</title>
</head>

<body>
  <header class="site-header sticky-top py-1">
  <nav class="bg-dark container d-flex flex-column flex-md-row justify-content-between">
    
    <a class="py-2 d-none d-md-inline-block text-white " href="lobby.php">Inicio</a>
    <a class="py-2 d-none d-md-inline-block text-white " href="carrito.php">Carrito</a>
    <a class="py-2 d-none d-md-inline-block text-white " href="perfil.php">Perfil</a>
    <a class="py-2 d-none d-md-inline-block text-white " href="../index.php">Cerrar sesión</a>
    
  </nav>
  </header>
  <div style="height:50px"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-8">

        <section class="cesta">
          <h3><strong>Carrito</strong></h3>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Seleccionar Todo
            </label>
          </div>
        </section>
        <br>
        <section>
          
          

        <table class="table table-striped table-hover">

        <thead>
                        <tr>                         
                            <th>Id producto</th>
                            <th>Nombre</th>  
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Sub Total</th>     
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado as $row){
                            echo '<tr>';
                            echo  '<td>'.$row["id_producto"].'</td>';
                            echo  '<td>'.$row["nombre_producto"].'</td>';
                            echo  '<td>'.$row["cantidad"].'</td>';
                            echo  '<td>'.$row["precio"].'</td>';
                            echo  '<td>'.$row["precio"]*$row["cantidad"].'</td>';
                            echo "<tr>";
                            }
                        ?>  
                    </tbody>
          </table>
          
          <h2> TOTAL: <?php foreach ($total as $row){ echo $row["total"]; } ?></h2>
          
          
          
          <!--<div class="card" style="width: 18rem;">
            <img src="../imagenes/huevos.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div> -->

        </section>
      </div>
      
      <div class="col-md-3 offset-md--1">
        <section class="registro">
          <h3><strong>Resumen del pedido</strong></h3>
          <br>
          <h5>Id de venta ------ <td><?php echo $row['id_venta'] ?></td> </h5>
          
          <h5>Subtotal ------ <td><?php echo $row['124124'] ?></td> </h5>
          
          <br>
          <h4><strong>Total</strong></h4>
          <br>
          <div class="d-grid gap-2">
          <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#creacionDespachoModal" type="button">Comprar</button>
          </div>
        </section>
      </div>
    </div>
  </div>


</body>

<!-- Modal de Creacion Despacho-->
<div class="modal fade" id="creacionDespachoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Dirección de despacho: </label>
                            <input type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Fecha limite: </label>
                            <input type="datetime" name="fecha"  value="<?php echo date("Y-m-d",strtotime($fecha_actual."+ 5 days"));?>" disabled>
                        </div>       
                        <div class="form-group">
                            <label>Proceso de despacho: </label>
                            <input type="text" class="form-control" value="En proceso" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success cread">Crear</button>
                </div>
            </div>
        </div>
    </div>

</html>

</html>