<?php
	session_start();

	include("conexion.php");
	$conn=conectar();
	$rut = $_SESSION["rut_persona"];
	$sql= "SELECT * from trabajador where rut_persona = '$rut'";
	$gsent = $conn->prepare($sql);
	$data = $conn->query($sql)->fetchAll();


	$sql2 = "SELECT acceso.id_acceso, funcion, pagina_web from acceso
        join controla on
        acceso.id_acceso = controla.id_acceso
        where controla.rut_persona = '".$rut."'";

	$gsent = $conn->prepare($sql2);
	$data2 = $conn->query($sql2)->fetchAll();
	$contador = 0;
	$esGerente =0;
	foreach ($data2 as $row2){
		$id_acceso[$contador] = $row2['id_acceso'];
		$funcion[$contador] = $row2['funcion'];
		$pagina_web[$contador] = $row2['pagina_web'];
		
		if ($id_acceso[$contador] == 7){
			$esGerente = 1;
		};
		$contador ++;
	}

	$sql3 = "SELECT sucursal.id_sucursal, sucursal.nombre_sucursal from sucursal";

	$gsent = $conn->prepare($sql3);
	$resultado3 = $conn->query($sql3)->fetchAll();


	$sucursal = "Sucursal Sin Seleccionar";
	if (isset($_POST["sucursal"])){
		$sql5 = "SELECT sucursal.nombre_sucursal from sucursal where id_sucursal = '".$_POST["sucursal"]."'";
		$gsent = $conn->prepare($sql5);
		$resultado5 = $conn->query($sql5)->fetchAll();
		foreach ($resultado5 as $row5){
		$sucursal = $row5["nombre_sucursal"];
		$_SESSION["sucursal"] = $_POST["sucursal"];
		}
	};

	if (isset($_SESSION["sucursal"])){
		
	};

	$sql4 = "SELECT sucursal.nombre_sucursal, sucursal.id_sucursal from sucursal 
			join trabaja 
			on sucursal.id_sucursal = trabaja.id_sucursal
			join trabajador 
			on trabajador.rut_persona = trabaja.rut_persona
			where trabajador.rut_persona = '".$rut."'";
	$gsent = $conn->prepare($sql4);
	$resultado4 = $conn->query($sql4)->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Menú trabajador</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
	<script src="../jquery/jquery.min.v3.6.0.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/Estilos.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
    margin: 10px;
}
.table-responsive {
    margin: 40px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

.table-title {        
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 7px 0 0;
	font-size: 28px;
}

table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}

table.table-striped.table-hover tbody a{
    color:rgb(80, 74, 74);
    font-size: 24px;

}

   
</style>
<script>

</script>
</head>
<body>
	
    <header class="bg-dark site-header sticky-top py-1 text-center" >
       
			<div class="row text-center">
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="#">Mision</a>
				</div>
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="#">Vision</a>
				</div>
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="#">Organigrama</a>
				</div>
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="#">Historia</a>
				</div>
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="#">Quienes Somos</a>
				</div>
				<div class="col-sm-2">
					<a class="py-2 d-none d-md-inline-block link-light" href="cerrar_session.php">Cerrar sesión</a>
				</div>
					
				</div>
			</div>
    </header>
	<br>
	<div class="container">
		<div class="row">
		 
		  <div class="col-sm-12">
			<?php 
		  	if ($esGerente ==1){
			echo '<h2 class = "text-center">';echo $sucursal.'</h2>';
			}else if ($esGerente == 0){
				echo '<h2 class = "text-center">';
				foreach ($resultado4 as $row4){
					echo $row4["nombre_sucursal"];
					$_SESSION["sucursal"] = $row4["id_sucursal"];
				}
				
				echo '</h2>';
			}
			?>
		  </div>
		  
		</div>
	  </div>
		


<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
		<?php
		foreach ($data as $row){

		echo '	<div class="table-title">
			<div class="row">
				<div class="col-sm-12">
					<h2 class = "text-center">BIENVENIDO</h2>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 text-center">
					<img src="../imagenes/'.$row["foto"].'" alt="foto" width="110px" height="120px">
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-sm-12">
					<h4 class = "text-center">'.$row["nombre_persona"].' '.$row["apellidop_persona"].' '.$row["apellidom_persona"].'</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<h5>RUT: '.$row["rut_persona"].'</h5>
				</div>
				<div class="col-sm-6">
					<h5 class = "text-right">CARGO: '.$row["cargo"].'</h5>
				</div>
			</div>
		</div>';
		}
		?>
		<?php
		if ($esGerente == 1){

		
		echo '
		<div class="row" style="height: 100px;">
		<h5>SUCURSALES: </h5>'; 
		echo '<form method="POST" action="menu_trabajador.php">';
		echo '<select class="form-select" name="sucursal" id="sucursal" required>';
		foreach ($resultado3 as $row3) {
			echo "<option id=" . $row3["id_sucursal"] . " value='" . $row3['id_sucursal'] . "'>" . $row3["nombre_sucursal"] . "</option>";
		}
		echo '</select>';
		echo '</div>';
		echo '<button class="btn btn-success btn-lg btn-block" type="submit"> Seleccionar Sucursal</button>';
		echo '</form>';
		echo '<br>';
		}
		if ($esGerente == 1 && isset($_POST["sucursal"])){

			

			echo'
			<div class="row" style="height: 100px;">	
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
				  <a class="link-options link-light"  href="Interfaz RRHH.php">RECURSO HUMANOS</a>
				</div>
			</div>
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
				<a class="link-options link-light" href="Interfaz Trabajador web.php">TRABAJADOR WEB</a>
				</div>
			</div>	
		</div>

		<div class="row" style="height: 100px;">
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="infoBodega.php">BODEGA</a>
				</div>
			</div>
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="proveedor.php">PROVEEDORES</a>
				</div>
			</div>
		</div>
		<div class="row" style="height: 100px;">
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="despacho.php">DESPACHO</a>
				</div>
			</div>
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="seleccionSucursal.php">TIENDA</a>
				</div>
			</div>
		</div>
		<div class="row" style="height: 100px;">
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="sucursalGerente.php">SUCURSALES</a>
				</div>
			</div>
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="bodegaGerente.php">MENU BODEGA</a>
				</div>
			</div>
		</div>

		<div class="row" style="height: 100px;">
			<div class="col-sm-6 text-center h-100 border border-light bg-dark">
				<div class="inline alinear-central">
					<a class="link-options link-light" href="reporteVentas.php">REPORTE DE VENTAS</a>
				</div>
			</div>
		</div>';
		}elseif ($esGerente == 0){
			
			for ($i=0; $i<$contador; $i++){
				if ($i == 0 || $i == 2 || $i == 4){
					echo '<div class="row" style="height: 100px;">';
				}	
			echo '<div class="col-sm-6 text-center h-100 border border-light bg-dark">
					<div class="inline alinear-central">
              		<a class="link-options link-light"  href="'.$pagina_web[$i].'">'.$funcion[$i].'</a>
					</div>
				</div>';

				;
			
				if ($i == 1 || $i == 3 || $i == 5){
					echo '</div>';
				}	
			}
		}

		?>

				
		</div>
	</div>        
</div>

</body>
</html>

