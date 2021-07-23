<!doctype html>
<html lang="es">

<head>
  <!-- Etiquetas <meta> obligatorias para Bootstrap -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Enlazando el CSS de Bootstrap -->
  <link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
  <script src="js/funciones.js"></script>
  <link rel="stylesheet" href="css/Estilos.css">
  <!-- JS BOOTSTRAP -->
  <script src="jquery/jquery.min.v3.6.0.js"></script>
  <script src="bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

  <title>Carrito</title>
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
          <div class="card" style="width: 18rem;">
            <img src="imagenes/huevos.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </section>
      </div>
      
      <div class="col-md-3 offset-md--1">
        <section class="registro">
          <h3><strong>Resumen del pedido</strong></h3>
          <br>
          <h5>Id del carrito ------</h5>
          <h5>Subtotal ------</h5>
          <br>
          <h4><strong>Total</strong></h4>
          <br>
          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="button">Comprar</button>
          </div>
        </section>
      </div>
    </div>
  </div>


</body>

</html>