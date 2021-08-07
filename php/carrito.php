<?php   
session_start();


 $id_venta = $_SESSION["id_venta"];
 if(isset($_SESSION["rut_persona"])){

    include("conexion.php");
    $gbd = conectar();

    $sql = "SELECT pertenece.id_producto, pertenece.cantidad, nombre_producto, (precio - precio*descuento/100) as test, imagen FROM pertenece 
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

    $sql3 = "SELECT nombre_persona, apellidop_persona, apellidom_persona, fono, region, comuna, direccion_despacho from cliente where rut_persona = '".$_SESSION["rut_persona"]."';";
    $gsent = $gbd->prepare($sql3);
    $gsent->execute();
    //$cuenta_col = $gsent->columnCount();
    //$data = $gbd->query($sql)->fetchAll();
    $resultado3 = $gsent->fetchAll(PDO::FETCH_ASSOC);

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
    <a class="py-2 d-none d-md-inline-block text-white " href="cerrar_session.php">Cerrar sesión</a>
    
  </nav>
  </header>
  <div style="height:50px"></div>
  <div class="container">
  <div class="row">
    <h3><strong>Información de Envío<strong></h3>
    <?php
      foreach ($resultado3 as $row){
      echo "<div>";
      echo "<h5><strong>Nombre:</strong></h5><h6>".$row["nombre_persona"]." ".$row["apellidop_persona"]." ".$row["apellidom_persona"]."</h6>";
      echo "";
      echo "<h5><strong>Telefono:</strong></h5><h6>".$row["fono"]."</h6>";
      echo "<h5><strong>Dirección de despacho:</strong></h5><h6>".$row["region"]." ".$row["comuna"].", ".$row["direccion_despacho"]."</h6>";
      echo "</div>"; 
      }
    ?>

  </div>
    <div class="row">
      <div class="col-md-8">

        <section class="cesta">
          <h3><strong>Carrito</strong></h3>
      <!--    <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Seleccionar Todo
            </label>
          </div>
-->
        </section>
        <br>
        <section>
          
          

        <table class="table">

        <thead>
                        <tr> 
                          <!--  <th></th>     -->                   
                            <th>Id producto</th>
                            <th>Imagen</th>
                            <th>Nombre</th>  
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Sub Total</th>  
                            <th>Eliminar</th>   
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado as $row){
                            echo '<tr>';
                           // echo '<td><input type="checkbox"</td>';
                            echo  '<td>'.$row["id_producto"].'</td>';
                            echo '<td> <a href="#"><img class="card-img-top" src="../imagenes/'.$row["imagen"].'" width="20px" height="40px" alt=""></a></td>';
                            echo  '<td>'.$row["nombre_producto"].'</td>';
                            echo  "<td><button type='button' class='btn btn-outline-warning' onclick='decrementarcarrito(".$row['id_producto'].")'>-</button><input class='num' type='text' value='".$row["cantidad"]."' id='".$row["id_producto"]."' size='1' disabled><button type='button' class='btn btn-outline-info' onclick='incrementarcarrito(".$row['id_producto'].")'>+</button></td>";
                            echo  "<td><input value='".$row["test"]."' size='3' disabled id=precio".$row['id_producto']."></td>";
                            echo  "<td><input value='".$row["test"]*$row["cantidad"]."' size='3' disabled id=subtotal".$row['id_producto']."></td>";
                            echo  "<td><button onclick='borrarCarrito(".$row['id_producto'].")' type='buton' class='btn btn-danger'> <svg
                            xmlns='http://www.w3.org/2000/svg' width='15' height='15' fill='currentColor'
                            class='bi bi-trash-fill' viewBox='0 0 16 16'>
                            <path
                                d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                            </svg></a></button></td>";
                            echo '<tr>';
                            }
                        ?>  
                    </tbody>
          </table>
          
          <h2> TOTAL: <?php foreach ($total as $row){ echo "<input value='".$row["total"]."' size='4' id='total0'> "; } ?></h2>
          
          
          
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
        <div class="row">
          <div class="col">
            <h5>Id de venta ------ </h5>
          </div>
          <div class="col">
            <h5><?php echo $id_venta ?> </h5>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <h5>Retiro En Local</h5>
            <input id="checkBoxLocal" type="checkbox" checked>
          </div>
          <div class="col">
          <h5>Retiro En Tienda</h5>
          <input id="checkBoxTienda" type="checkbox">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <h5>Subtotal Compra------</h5>
          </div>
          <div class="col">
            <h5 id="subtotalCompra"><?php foreach ($total as $row){ echo $row["total"]; }?></h5>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <h5>Envío </h5>
          </div>
          <div class="col">
            <input id="envio" value="2000" size="4" disabled>
          </div>
        </div>
        
        <div class="row">
          <div class="col">
            <h5>Total Compra </h5>
          </div>
          <div class="col">
          <!--<form method="POST" action="../php/transaccion/index.php" >-->
            <input type="text"   name="totalCompra" id="totalCompra" class="totalCompra" value="" size="5" disabled>
            <input type="hidden" name="totalCompraTransbank" id="totalCompra" class="totalCompra" value="" size="5" >
          </div>
        </div>
          <div class="d-grid gap-2">
          <button onclick="completarVenta()" class="btn btn-primary btn-lg" type="submit">Comprar</button>
          </div>
         </form>
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
                    <button type="button" class="btn btn-primary cread">Comprar</button>
                </div>
            </div>
        </div>
    </div>

</html>

<script>
  totalCompra = parseInt( $('#subtotalCompra').text()) + parseInt(2000);
    $('.totalCompra').val(totalCompra);
$('#checkBoxLocal').on('change', function() {
  var x = document.getElementById("checkBoxLocal").checked;
    if(x == false){
      $('#checkBoxLocal').prop('checked', true);
    }



    $('#checkBoxTienda').not(this).prop('checked', false); 
    $('#envio').val(2000);
    totalCompra = parseInt( $('#subtotalCompra').text()) + parseInt(2000);
    $('.totalCompra').val(totalCompra);
});

$('#checkBoxTienda').on('change', function() {

  var x = document.getElementById("checkBoxTienda").checked;
    if(x == false){
      $('#checkBoxTienda').prop('checked', true);
    }

    $('#checkBoxLocal').not(this).prop('checked', false);  
    $('#envio').val(0);
    totalCompra = parseInt($('#subtotalCompra').text())+parseInt(0);
    $('.totalCompra').val(totalCompra);
    

});



</script>