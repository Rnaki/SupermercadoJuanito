<?php

/*session_start();
$sucursal=$_SESSION["sucursal"];*/

include("conexion.php");
$gbd = conectar();

//$sql = "SELECT my_function();";
//$sql = "SELECT * FROM venta";
/*
//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
	$idBuscar = $_POST["idBuscar"];
	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
                JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal 
                where despacho.id_sucursal = '".$sucursal."' and id_despacho = '$idBuscar' ";
} else if (isset($_POST["estadoBuscar"])) {
	$estadoBuscar = $_POST["estadoBuscar"];
	if ($_POST["estadoBuscar"] == "Seleccione...") {       
        $sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
        JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal
        where despacho.id_sucursal = '".$sucursal."' and (proceso_despacho = 'En proceso' or proceso_despacho= 'En camino') ";
	} else {
    	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
                JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal  
                where despacho.id_sucursal = '".$sucursal."' and proceso_despacho = '$estadoBuscar'";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
            JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal 
            where (despacho.id_sucursal = '".$sucursal."' and fecha_limite Between '$desde' and '$hasta') and (proceso_despacho = 'En proceso' or proceso_despacho = 'En camino')";
} 

*/

//$sql ="SELECT id_sucursal, nombre_sucursal from sucursal";

$sql="SELECT extract(year from fecha_venta) as yyyy
      from venta
      Group by 1";
$gsent = $gbd->prepare($sql);
$gsent->execute();

//Obtener todas las filas restantes del conjunto de resultados 
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

//var_dump($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trabajador web</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilosDaniel.css">

	<!-- BOOTSTRAP -->
	<script src="../popper/popper.min.js"></script>
	<link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
	<script src="../jquery/jquery.min.v3.6.0.js"></script>
	<script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
	<script src="../js/funciones.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ventas</title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilosDaniel.css">
    <!-- JS BOOTSTRAP -->
    
    
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
   
    <script src="../js/funciones.js"></script>
    <style>
        .table-title .col .form-control {
            width: 33%;
        }

        .table-responsive tbody a {
            color: #566787;
        }

        div .col-sm-6 h4 {
            font-family: 'Varela Round', sans-serif;
            margin-top: 1%;
        }

        div .primero .col {
			text-align: right;
		}

        /*Cambio*/
        div .primero {
            margin-bottom: 12px;
        }

        div .primero .btn .bi {
            margin-bottom: 3%;
        }

        div .segundo {
            padding-bottom: 20px;
        }

        div .segundo .col-sm-6 .form-select{
            margin-right: 4%;
        }

        div .row .col-sm-4 h5 {
            font-size: 20px;
        }

        div .accordion-collapse .segundo .form-control {
            width: 100%;
        }

        div .accordion-item .accordion-button {
            background: #435d7d;
            color: ivory;
        }

        div .accordion-item {
            background-color: #344e6e;
            border: 1px solid #2d445f;
        }

        div h3 h6 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        div .col-sm-6 .b {
            background-color: #198754;
            font-size: 15px;
            padding: 1% 3%;
        }

        div .col-sm-1 .btn-success {
            background-color: #198754;
            float: right;
            padding: 10% 17%;
        }

        div .row .buscar label {
            font-size: 19px;
            font-weight: 500;
        }

        div .accordion-body h5 {
            font-size: 19px;
        }

        .modal .infodespacho {
            max-width: 700px;
        }

        div .modal-content .info {
            background: #435d7d;
        }

        .modal .modal-content .modal-body .form-group {
            margin-top: 1px;
        }

        .modal .modal-content .modal-body .form-group strong {
            margin-right: 6px;
        }

        .modal .modal-content .modal-body .frente {
            margin-bottom: 15px;
        }

        .modal .form-group .form-control {
            margin-bottom: 16px;
            padding-bottom: 4px;
        }

        .modal .table {
            margin-top: 30px;
        }

        .modal .table thead tr {
            background-color: rgb(163, 182, 241);
            border-top: 1px solid black;
        }
    </style>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="../bootstrap-5.0.2-examples/assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="dashboard/dashboard.css" rel="stylesheet">

</head>

<body>
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver</a>
            <h2 class="letrah2">INFO REPORTE DE VENTAS</h2>
            <a class="py-2 d-none d-md-inline-block" href="../index.php">Cerrar sesión</a>
        </nav>
    </header>
    <!doctype html>
<html lang="en">

  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" id="tituloGrafico">Grafico</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>

                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        VISTA
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <button class='dropdown-item' onclick="vistaVentas()">VENTAS</button>
                        <button class='dropdown-item' onclick="vistaPesos()">PESOS</button>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Año
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                       <?php 
                             foreach($resultado as $row){
                            echo "<li><button onclick='seleccionAño(".$row['yyyy'].")' class='dropdown-item' href='#'>".$row["yyyy"]."</button></li>";
                            }
                        ?>
                    </ul>
                </div>
                <button onclick="generarDatos()">GENERAR DATOS</button>
            </div>
        </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

        <div id="tablaReporte">
            
        </div>    
    </main>
  </div>
</div>


    <script src="../bootstrap-5.0.2-examples/assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="dashboard/dashboard.js"></script>
      <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
  </body>
</html>

</body>

</html>