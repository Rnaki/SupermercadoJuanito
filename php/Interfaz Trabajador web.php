<?php

include("conexion.php");
$gbd = conectar();

if(isset($_GET["error"])) {
    $error = $_GET["error"];
    echo '<script>alert("Imagen muy grande")</script>';
}

if (isset($_GET["error1"])) {
    $error = $_GET["error1"];
    echo '<script>alert("Tipo de imagen no permitida")</script>';
}

/*
if (isset($_POST["rutBuscar"])) {
	$rutBuscar = $_POST["rutBuscar"];
	$sql = "SELECT * from cliente where rut like '$rutBuscar%'";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT * FROM cliente";
	} else {
		$sql = "SELECT * from cliente where apellidoP = '$apellidoPBuscar'";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT * from cliente where fechaNacimiento Between '$desde' and '$hasta'";
} else if (!isset($_POST["rutBuscar"]) && !isset($_POST["apellidoPBuscar"]) || $_POST["apellidoPBuscar"] == "" || $_POST["desde"] == "" || $_POST["hasta"] == "") {
	$sql = "SELECT * FROM cliente";
}

if(isset($_GET["error"])){
	$tipoError = $_GET["error"];
	if($tipoError ==2){
		echo "<script>
				alert('Rut ya existente');
			</script>";
	} 
}
*/
//$sql = "SELECT my_function();";

$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
		JOIN categoria ON producto.id_categoria = categoria.id_categoria
		where estado_producto = true ";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
	$idBuscar = $_POST["idBuscar"];
	$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
			JOIN categoria ON producto.id_categoria = categoria.id_categoria
			where estado_producto = true and id_producto = '$idBuscar' ";
} else if (isset($_POST["nombreBuscar"])) {
	$nombreBuscar = $_POST["nombreBuscar"];
	if ($_POST["nombreBuscar"] == "") {
		$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = true ";
	} else {
		$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = true and upper(producto.nombre_producto) like upper('%$nombreBuscar%') ";
	}
} else if (isset($_POST["nombreCategoria"]) && isset($_POST["marca"]) && $_POST["nombreCategoria"] !== " " && $_POST["marca"] !== " ") {
	$idCategoria = $_POST["nombreCategoria"];
	$marca = $_POST["marca"];
	if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] == "Seleccione...") {
		$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = true and categoria.id_categoria = '$idCategoria' ";
	} else if ($_POST["nombreCategoria"] == "Seleccione..." && $_POST["marca"] != "Seleccione...") {
		$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = true and marca = '$marca' ";
	} else if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] != "Seleccione...") {
		$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = true and categoria.id_categoria = '$idCategoria' and marca = '$marca' ";
	}
}


$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado5 = $gsent->fetchAll(PDO::FETCH_ASSOC);


/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");

$sql2 = "SELECT * FROM categoria";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT * FROM proveedor where estado_proveedor = true;";
$gsent3 = $gbd->prepare($sql3);
$gsent3->execute();
$resultado3 = $gsent3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT distinct marca FROM producto where estado_producto = true order by marca";
$gsent4 = $gbd->prepare($sql4);
$gsent4->execute();
$resultado4 = $gsent4->fetchAll(PDO::FETCH_ASSOC);

//paginador
$xpaginas = 5;
$totalquery = $gsent->rowCount();
if($totalquery == 0){
	$totalquery = 1;
	$paginas = $totalquery/$xpaginas;
	$paginasElevado = ceil($paginas);
	$totalquery = 0;
	if(!$_GET){
		header('Location: Interfaz Trabajador web.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: Interfaz Trabajador web.php?pagina=1');
	}
	$encontrado = 0;
}else{
	$paginas = $gsent->rowCount()/$xpaginas;
	$paginasElevado = ceil($paginas);
	if($totalquery < $xpaginas){
		$encontrado = $totalquery;
	}else if($paginasElevado == $_GET['pagina']){
		$paginas= (int)$paginas;
		if($paginas*$xpaginas == $totalquery){
			$encontrado = $xpaginas;
		}else{
			$encontrado = $totalquery-($paginas*$xpaginas);
		}
	}else if ($totalquery >= $xpaginas){
		$encontrado = $xpaginas;
	}

	if(!$_GET){
		header('Location: Interfaz Trabajador web.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: Interfaz Trabajador web.php?pagina=1');
	}

	$iniciar = ($_GET['pagina']-1)*$xpaginas;

	$sqlGuardar = $sql.' LIMIT :nArticulos OFFSET :iniciar;';
	$gsent = $gbd->prepare($sqlGuardar);
	$gsent->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
	$gsent->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
	$gsent->execute();
	$resultado5 = $gsent->fetchAll(PDO::FETCH_ASSOC);
}

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

	<style>
		body {
			background: #f5f5f5;
		}

		div .col-sm-6 h4 {
			font-family: 'Varela Round', sans-serif;
		}

		div .primero .col {
			text-align: right;
		}
		/*
		.container-xl .primero .col-sm-1{
			padding-left: 0px 0px;
		}
		*/
		/*Cambio*/
		div .primero {
			margin-bottom: 12px;
		}

		div .primero .btn .bi {
			margin-bottom: 3%;
		}

		div .segundo {
			padding-bottom: 23px;
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
			font-size: 15px;
			padding: 12% 18%;
		}

		div .row .buscar label {
			font-size: 19px;
			font-weight: 500;
		}

		div .accordion-body h5 {
			font-size: 19px;
		}

		/*Header*/
		header {
			background: #f5f5f5;
		}

		header .juan {
			width: 240px;
			height: 50px;
			color: #566787;
		}

		header .row .col-md-3,
		header .row .col-md-8 {
			padding: 0px 0px;
		}

		header .row .card-body {
			padding: 3px 0px;
		}

		header .row .card-body .card-title {
			margin-bottom: 0px;
		}

		header .dropdown .dropdown-menu {
			width: 100%;
			background: #ececec;
		}

		header .dropdown .dropdown-menu li {
			color: #2196F3;
		}
	</style>
	
</head>

<body>

	<header class="site-header sticky-top py-1">
		<nav class="container d-flex flex-column flex-md-row justify-content-between">

			<a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver</a>
			<h2 class="letrah2">ÁREA TRABAJADOR WEB</h2>

			<div class="dropdown">
				<button class="btn" id="bd-version" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
					<div class="row juan">
						<div class="col-md-3 text-center">
							<img src="../imagenes/foto.jpg" width="40px" height="50px" class="rounded-circle">
						</div>
						<div class="col-md-8 text-start">
							<div class="card-body">
								<h5 class="card-title">Juan Perez</h5>
								<p class="card-text">Gerente General</p>
							</div>
						</div>
					</div>
				</button>
				<div class="dropdown-menu" aria-labelledby="bd-version">
					<li><a class="dropdown-item" aria-current="true" href="#">Ver perfil</a></li>
					<div class="dropdown-divider"></div>
					<li><a class="dropdown-item" aria-current="true" href="cerrar_session.php">Cerrar sesión</a></li>
				</div>
			</div>

	</header>

	<div style="height:30px"></div>

	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h4>GESTION DE PRODUCTOS:</h4>
						</div>
						<div class="col-sm-6 col">
							<a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
									<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
								</svg> Añadir Producto</a>
								<a class="btn btn-primary"  href="interfazProductosEliminados.php" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
								<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                </svg> Recuperar Productos</a>
								
						</div>
					</div>
					<div class="row">
						<div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h3 class="accordion-header" id="headingOne">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<h6>Buscar por... </h6>
									</button>
								</h3>
								<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<div class="row">
											<div class="col-sm-6">
												<h5>ID Producto: </h5>
											</div>
											<div class="col-sm-6">
												<h5>Nombre: </h5>
											</div>
										</div>
										<div class="row segundo">
											<div class="col-sm-6">
												<form action="Interfaz Trabajador web.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Producto" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="Interfaz Trabajador web.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="nombreBuscar" placeholder="Nombre" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-2 buscar">
												<label> Tipo: </label>
											</div>
											<div class="col-sm-4">
												<form action="Interfaz Trabajador web.php?pagina=1" method="POST" class="d-flex">
													<select class="form-select" name="nombreCategoria" id="nombreCategoria" required>
														<option selected>Seleccione...</option>
														<?php
														foreach ($resultado2 as $row2) {
															echo "<option id=" . $row2["id_categoria"] . " value=" . $row2['id_categoria'] . ">" . $row2["nombre_categoria"] . "</option>";
														}
														?>
													</select>
											</div>
											<div class="col-sm-1 buscar">
												<label> Marca: </label>
											</div>
											<div class="col-sm-4">
												<select class="form-select" name="marca" id="marca" required>
													<option selected>Seleccione...</option>
													<?php
													foreach ($resultado4 as $row5) {
														echo "<option id=" . $row5["id_producto"] . " value=" . $row5['marca'] . ">" . $row5["marca"] . "</option>";
													}
													?>
												</select>
											</div>
											<div class="col-sm-1">
												<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<table class="table table-striped table-hover" style="text-align: center;">
					<thead>
						<tr>
							<th>ID Producto</th>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Marca</th>
							<th>Precio</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($resultado5 as $row) {
							echo '<tr>';
							echo '<td>' . $row["id_producto"] . '</td>';
							echo  '<td>' . $row["nombre_producto"] . '</td>';
							echo  '<td>' . $row["tnombre_categoria"] . '</td>';
							echo  '<td>' . $row["marca"] . '</td>';
							echo  '<td>$' . $row["precio"] . '</td>';
							echo "<td>
                            <a href='' onclick='mostrarUpdateProducto(\"" . $row['id_producto'] . "\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal' data-backdrop='static' data-keyboard='false' ><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
							echo "<a href='' onclick='eliminarProducto(\"" . $row['id_producto'] . "\")' class='delete' data-bs-toggle='modal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor'
                                    class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                </svg></a>

                            </td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
				<div class="clearfix">
				<div class="hint-text">Mostrando <b><?php echo $encontrado?></b> de <b><?php echo $totalquery?></b> entradas</div>
					<ul class="pagination">
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="Interfaz Trabajador web.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="Interfaz Trabajador web.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="Interfaz Trabajador web.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal de Creacion-->
	<div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header cread">
					<h5 class="modal-title">Añadir Producto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" action="insertarProducto.php" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group ">
							<div class="form-group">
								<label>Categoria: </label>
								<select class="form-select" name="tipoCategoria" id="tipoCategoria" required>
									<option value="">Seleccione...</option>
									<?php
									foreach ($resultado2 as $row2) {
										echo "<option id=" . $row2["id_categoria"] . " value=" . $row2['nombre_categoria'] . ">" . $row2["nombre_categoria"] . "</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Nombre Proveedor: </label>
								<select class="form-select" name="nombreProveedor" id="nombreProveedor" required>
									<option value="">Seleccione...</option>
									<?php
									foreach ($resultado3 as $row3) {
										echo "<option id=" . $row3["rut_proveedor"] . " value=" . $row3['rut_proveedor'] . ">" . $row3["nombre_proveedor"] . "</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Nombre Producto: </label>
								<input type="text" class="form-control" name="nombreProducto" required>
							</div>
							<div class="form-group">
								<label>Marca: </label>
								<input type="text" class="form-control" name="marca" required>
							</div>
							<div class="form-group">
								<label>Precio: </label>
								<input type="number" class="form-control" name="precio" required>
							</div>
							<div class="form-group">
								<label>Descuento: </label>
								<input type="number" class="form-control" name="descuento" required>
							</div>
							<div class="form-group">
								<label>Descripción: </label>
								<textarea class="form-control" name="descripcion" required></textarea>
							</div>
							<div class="form-group">
								<label>Imagen: </label>
								<input type="file" class="form-control" name="imagen" accept="image/*" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success cread">Crear</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--Modal de Edicion-->
	<div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header edi">
					<h5 class="modal-title">Editar Producto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="updateProducto.php" enctype="multipart/form-data">
						<div class="form-group ">
							<label>ID Producto: </label>
							<input type="text" class="form-control updateIdProducto" name="updateIdProducto" disabled>
							<input class="updateIdProducto" name="updateIdProducto" type="hidden">
							<div class="form-group">
								<label>Categoria: </label>
								<br>
								<select class="form-select" name="UpdatetipoCategoria" id="UpdatetipoCategoria" required>
									<?php
									foreach ($resultado2 as $row2) {
										echo "<option id=" . $row2["id_categoria"] . " value=" . $row2['nombre_categoria'] . ">" . $row2["nombre_categoria"] . "</option>";
									}
									?>
								</select>
								<br>
							</div>
							<div class="form-group">
								<label>Nombre Proveedor: </label>
								<br>
								<select class="form-select" name="updateNombreProveedor" id="updateNombreProveedor" required>
									<?php
									foreach ($resultado3 as $row3) {
										echo "<option id=" . $row3["rut_proveedor"] . " value=" . $row3['rut_proveedor'] . ">" . $row3["nombre_proveedor"] . "</option>";
									}
									?>
								</select>
								<br>
							</div>
							<div class="form-group">
								<label>Nombre: </label>
								<input type="text" class="form-control" name="updateNombreProducto" id="updateNombreProducto" required>
							</div>
							<div class="form-group">
								<label>Marca: </label>
								<input type="text" class="form-control" name="updateMarca" id="updateMarca" required>
							</div>
							<div class="form-group">
								<label>Precio: </label>
								<input type="number" class="form-control" name="updatePrecio" id="updatePrecio" required>
							</div>
							<div class="form-group">
								<label>Descuento: </label>
								<input type="number" class="form-control" name="updateDescuento" id="updateDescuento" required>
							</div>
							<div class="form-group">
								<label>Descripcion: </label>
								<textarea class="form-control" name="updateDescripcion" id="updateDescripcion" required></textarea>
							</div>
							<div class="form-group">
								<label>Imagen: </label>
								<input type="file" class="form-control" name="updateImagen" id="updateImagen" accept="image/*">
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-warning">Guardar Cambios</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal de Eliminar-->
	<div class="modal fade" id="eliminarexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header eli">
					<h5 class="modal-title">Eliminar Producto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>¿Estas seguro que quieres eliminar a este producto?</label>
						<div style="height:16px"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button id="eliminarProducto" type="button" class="btn btn-danger">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>