<?php

session_start();
echo $_SESSION["sucursal"];

include("conexion.php");
$gbd = conectar();

if (isset($_POST["rutBuscar"])) {
	$rutBuscar = $_POST["rutBuscar"];
	$sql = "SELECT * from cliente where rut_persona like '$rutBuscar%' and estado_persona = false";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT * FROM cliente where estado_persona = false";
	} else {
		$sql = "SELECT * from cliente where apellidop_persona like CONCAT('$apellidoPBuscar','%') and estado_persona = false";
		
		//var_dump($apellidoPBuscar);
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT * from cliente where (fecha_nacimiento_persona Between '$desde' and '$hasta' and estado_persona = false)";
} else if (!isset($_POST["rutBuscar"]) && !isset($_POST["apellidoPBuscar"]) || $_POST["apellidoPBuscar"] == "" || $_POST["desde"] == "" || $_POST["hasta"] == "") {
	$sql = "SELECT * FROM cliente where estado_persona = false";
}

if(isset($_GET["error"])){
	$tipoError = $_GET["error"];
	if($tipoError ==2){
		echo "<script>
				alert('Rut ya existente');
			</script>";
	} 
}

//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$cuenta_col = $gsent->columnCount();
$data = $gbd->query($sql)->fetchAll();

$sql1 = "SELECT sucursal.nombre_sucursal from sucursal where id_sucursal = '".$_SESSION["sucursal"]."'";
$gsent = $gbd->prepare($sql1);
$resultado1 = $gbd->query($sql1)->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Recuperar clientes</title>
	<!--Sacado de por otra via-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
	<!--Sacado de la carpeta-->
    <script src="../popper/popper.min.js"></script>
	<link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

	
	<style>
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

		body {
			color: #566787;
			background: #f5f5f5;
			font-family: 'Varela Round', sans-serif;
			font-size: 13px;
		}

		.table-responsive {
			margin: 30px 0;
		}

		.table-wrapper {
			background: #fff;
			padding: 20px 25px;
			border-radius: 3px;
			min-width: 1000px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
		}

		.table-title {
			padding-bottom: 15px;
			background: #435d7d;
			color: #fff;
			padding: 16px 30px;
			min-width: 100%;
			margin: -20px -25px 10px;
			border-radius: 3px 3px 0 0;
		}

		.table-title h2 {
			margin: 5px 0 0;
			font-size: 24px;
		}

		.table-title .btn-group {
			float: right;
		}

		.table-title .btn {
			color: #fff;
			float: right;
			font-size: 13px;
			border: none;
			min-width: 50px;
			border-radius: 2px;
			border: none;
			outline: none !important;
			margin-left: 10px;
		}

		.table-title .btn i {
			float: left;
			font-size: 21px;
			margin-right: 5px;
		}

		.table-title .btn span {
			float: left;
			margin-top: 2px;
		}

		table.table tr th,
		table.table tr td {
			border-color: #e9e9e9;
			padding: 12px 15px;
			vertical-align: middle;
		}

		table.table tr th:first-child {
			width: 60px;
		}

		table.table tr th:last-child {
			width: 100px;
		}

		table.table-striped tbody tr:nth-of-type(odd) {
			background-color: #fcfcfc;
		}

		table.table-striped.table-hover tbody tr:hover {
			background: #f5f5f5;
		}

		table.table th i {
			font-size: 13px;
			margin: 0 5px;
			cursor: pointer;
		}

		table.table td:last-child i {
			opacity: 0.9;
			font-size: 22px;
			margin: 0 5px;
		}

		table.table td a {
			font-weight: bold;
			color: #566787;
			display: inline-block;
			text-decoration: none;
			outline: none !important;
		}

		table.table td a:hover {
			color: #2196F3;
		}

		table.table td a.edit {
			color: #FFC107;
		}

		table.table td a.delete {
			color: #F44336;
		}

		table.table td i {
			font-size: 19px;
		}

		table.table .avatar {
			border-radius: 50%;
			vertical-align: middle;
			margin-right: 10px;
		}

		.pagination {
			float: right;
			margin: 0 0 5px;
		}

		.pagination li a {
			border: none;
			font-size: 13px;
			min-width: 30px;
			min-height: 30px;
			color: #999;
			margin: 0 2px;
			line-height: 30px;
			border-radius: 2px !important;
			text-align: center;
			padding: 0 6px;
		}

		.pagination li a:hover {
			color: #666;
		}

		.pagination li.active a,
		.pagination li.active a.page-link {
			background: #03A9F4;
		}

		.pagination li.active a:hover {
			background: #0397d6;
		}

		.pagination li.disabled i {
			color: #ccc;
		}

		.pagination li i {
			font-size: 16px;
			padding-top: 6px
		}

		.hint-text {
			float: left;
			margin-top: 10px;
			font-size: 13px;
		}

		/*----Cambio----*/
		div .primero {
			margin-bottom: 12px;
		}

		div .col-sm-6 .btn {
			padding: 8px 12px;
			border-radius: 4px;
			font-size: 15px;
		}

		div .segundo {
			padding-bottom: 14px;
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
			margin-right: 1%;
			padding-right: 4%;
		}

		div .col-sm-1 .b {
			background-color: #198754;
			padding: 10% 20%;
			font-size: 15px;
			border-radius: 4px;
		}

		div .row .buscar label {
			font-size: 19px;
			padding-bottom: 0%;
			padding-top: 4px;
		}

		div .accordion-body h5{
			font-size: 19px;
		}
		/*Boton recuperar*/
		a.btn.btn-success.b2{
			background: #167bde;
			margin-left: 15px;
		}
		svg.bi.bi-plus-circle-fill{
			color: #B0D7FD;
		}
	</style>
</head>

<body>

    <header class="site-header sticky-top py-1">
		<nav class="container d-flex flex-column flex-md-row justify-content-between">

			<a class="py-2 d-none d-md-inline-block" href="cliente.php">Volver a Gestión de Clientes</a>
			
			<h2>CLIENTES</h2>
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

		</nav>
		<h2 class="text-center"><?php foreach ($resultado1 as $row1){echo $row1["nombre_sucursal"];} ?></h2>

	</header>

	<div class="container-fluid">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h2>RECUPERAR CLIENTES: </h2>
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
												<h5>RUT: </h5>
											</div>
											<div class="col-sm-6">
												<h5>Apellido Paterno: </h5>
											</div>
										</div>
										<div class="row segundo">
											<div class="col-sm-6">
												<form action="clienteRecuperar.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="RUT" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="clienteRecuperar.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="apellidoPBuscar" placeholder="Apellido Paterno" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<h5>Fecha Nacimiento: </h5>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-2 buscar">
												<label> Desde: </label>
											</div>

											<div class="col-sm-4">
												<form action="clienteRecuperar.php" method="POST" class="d-flex">
													<input class="form-control me-2" type="date" name="desde" placeholder="Fecha" aria-label="Search">

											</div>
											<div class="col-sm-1 buscar">
												<label> Hasta: </label>
											</div>
											<div class="col-sm-4">
												<input class="form-control me-2" type="date" name="hasta" placeholder="Fecha" aria-label="Search">
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
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th></th>
							<th>RUT</th>
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Región</th>
							<th>Comuna</th>
							<th>Calle</th>
							<th>Nº Calle</th>
							<th>Fecha Nacimiento</th>
							<th>Sexo</th>
							<th>Contraseña</th>
							<th>Correo</th>
							<th>Telefono</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($data as $row){
						?>
							<tr>
								<td></td>
								<td><?php echo $row['rut_persona'] ?></td>
								<td><?php echo $row['nombre_persona'] ?></td>
								<td><?php echo $row['apellidop_persona'] ?></td>
								<td><?php echo $row['apellidom_persona'] ?></td>
								<td><?php echo $row['region'] ?></td>
								<td><?php echo $row['comuna'] ?></td>
								<td><?php echo $row['calle'] ?></td>
								<td><?php echo $row['numero_calle'] ?></td>
								<td><?php echo $row['fecha_nacimiento_persona'] ?></td>
								<td><?php echo $row['sexo'] ?></td>
								<td><?php echo $row['contrasena'] ?></td>
								<td><?php echo $row['correo'] ?></td>
								<td><?php echo $row['fono'] ?></td>
								<td>
						<?php   echo "<a href='' onclick='recuperarCliente(\"".$row['rut_persona']."\")' class='btn btn-success b2' data-bs-toggle='modal' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus-circle-fill' viewBox='0 0 16 16'>
								<path d='M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z' />
                                </svg></a>"; ?>
								</td>
							</tr>
							
						<?php
						}
						?>
					</tbody>

				</table>
				<div class="clearfix">
					<div class="hint-text">Mostrar <b>5</b> de <b>25</b> entradas</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Anterior</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Siguiente</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>

<style>
    .modal-content {
        max-width: 85%;
    }

    div .aña {
        background-color: forestgreen;
        color: honeydew;
        margin-bottom: 15px;
        padding: 20px 30px;
    }

    div .c {
        margin-bottom: 12px;
    }

    div form div {
        padding: 20px 30px;
    }

    div form label {
        color: #212529;
        margin-bottom: 0px;
        font-size: 14px;
    }

    div .modal-footer {
        background: #ecf0f1;
    }

    div form .btn-default {
        background-color: gray;
    }

    div .modal-footer .b1 {
        padding: 2px 12px;
    }

    div form .btn-success {
        background-color: forestgreen;
        font-size: 30px;
    }

    div form h6 {
        font-size: 16px;
        margin-top: 8px;
    }
</style>

<div class="modal fade" id="añadirexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header aña">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insertarCliente.php" method="POST">
                <div>
                    <label>Rut: </label>
                    <input type="text" class="form-control mb-3 c" required="required" id="rutAgregar" name="rut" placeholder="Rut" maxlength="10">
                    <label>Nombre: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="nombre" placeholder="Nombre" maxlength="32">
                    <label>Apellido Paterno: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="apellidoP" placeholder="Apellido Paterno" maxlength="32">
                    <label>Apellido Materno: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="apellidoM" placeholder="Apellido Materno" maxlength="32">
                    <label>Región: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="region" placeholder="Region" maxlength="32">
                    <label>Comuna: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="comuna" placeholder="Comuna" maxlength="32">
                    <label>Calle: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="calle" placeholder="Calle" maxlength="32">
                    <label>Nº Calle: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="nCalle" placeholder="N° Calle" maxlength="32">
                    <label>Fecha Nacimiento: </label>
                    <input type="date" class="form-control mb-3 c" required="required" name="fechaNacimiento" placeholder="Fecha Nacimiento">
                    <label>Sexo: </label>
                    <br>
                    <select class="form-select" name="sexo" id="sexo">
                        <option selected>Seleccione...</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <br>
                    <label>Contraseña: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="Contraseña" placeholder="Contraseña" maxlength="12">
                    <label>Correo: </label>
                    <input type="email" class="form-control mb-3 c" required="required" name="Correo" placeholder="Correo" maxlength="64">
                    <label>Teléfono: </label>
                    <input type="text" class="form-control mb-3 c" required="required" name="Telefono" placeholder="Telefono" maxlength="16">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary b1" data-bs-dismiss="modal">
                        <h6>Cancelar</h6>
                    </button>
                    <button type="submit" onclick="return validarRut();" class="btn btn-success b1">
                        <h6>Añadir</h6>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-content {
        max-width: 85%;
    }

    div .edi {
        background-color: gold;
        color: honeydew;
        margin-bottom: 15px;
        padding: 20px 30px;
    }

    div .modal-content .form label {
        color: #212529;
        margin-bottom: 0px;
        font-size: 14px;
    }

    div .c {
        margin-bottom: 12px;
    }

    div .modal-body {
        padding: 20px 30px;
    }

    .modal .modal-footer .btn-warning {
        color: rgb(255, 255, 255);
    }

    div .modal-footer {
        background: #ecf0f1;
    }
</style>


    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updateCliente.php" method="POST">
					<div class="modal-body">
                        <div class="form-group form">
                            <div class="form-group">
                                <label>Rut: </label>
                                <input type="text" class="form-control c updateRutCliente" name="" value="" disabled>
								<input type="hidden" class="form-control c updateRutCliente" id ="updateRutCliente" name="updateRutCliente" required value="" >
                            </div>
                            <div class="form-group">
                                <label>Nombre: </label>
                                <input type="text" class="form-control c" id="updateNombreCliente" name="updateNombreCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno: </label>
                                <input type="text" class="form-control c" id="updateApellidoPCliente" name="updateApellidoPCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno: </label>
                                <input type="text" class="form-control c" id="updateApellidoMCliente" name="updateApellidoMCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Region: </label>
                                <input type="text" class="form-control c" id="updateRegionCliente" name="updateRegionCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Comuna: </label>
                                <input type="text" class="form-control c" id="updateComunaCliente" name="updateComunaCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Calle: </label>
                                <input type="text" class="form-control c" id="updateCalleCliente" name="updateCalleCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Nª Calle: </label>
                                <input type="text" class="form-control c" id="updateNcalleCliente" name="updateNcalleCliente" required value="" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Fecha Nacimiento: </label>
                                <input type="text" class="form-control c" id="updateFechaNacimientoCliente" name="updateFechaNacimientoCliente" required value="">
                            </div>
                            <label>Sexo: </label>
                            <br>
                            <select class="form-select" id="updateSexoCliente" name="updateSexoCliente" id="sexoupdate">
                                <option value="Hombre" id="Hombre">Hombre</option>
                                <option value="Mujer" id="Mujer">Mujer</option>
                                <option value="Otros" id="Otros">Otros</option>
                            </select>
                            <br>
                            <div class="form-group">
                                <label>Contraseña: </label>
                                <input type="text" class="form-control c" id="updateContraseñaCliente" name="updateContraseñaCliente" required value="" maxlength="12">
                            </div>
                            <div class="form-group">
                                <label>Correo: </label>
                                <input type="text" class="form-control c" id="updateCorreoCliente" name="updateCorreoCliente" required value="" maxlength="64">
                            </div>
                            <div class="form-group">
                                <label>Teléfono: </label>
                                <input type="text" class="form-control c" id="updateTelefonoCliente" name="updateTelefonoCliente" required value="" maxlength="16">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        //$('#sexoupdate<?php //echo $row['rut'] ?> option[id="<?php //echo $row['sexo'] ?>"]').attr("selected", true);
        //$('#sexoupdate option[id="'+$info['compañia']+'"]').attr("selected", true);
    </script>
<style>
    div .modal-dialog .eli{
        padding: 20px 30px;
        background-color: rgb(202, 15, 15);
        color: ivory;
    }

    div .modal-footer .btn-danger{
        background-color: rgb(202, 15, 15);
    }

    div .cuadro{
        padding-bottom: 0px;
    }

    div .fuente label{
        padding-top: 12px;
        color: #212529;
        font-size: 15px;
    }
</style>

	<!-- Modal de Recuperar-->
	<div class="modal fade" id="eliminarexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header eli">
                    <h5 class="modal-title" id="exampleModalLabel">Recuperar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Desea recuperar este cliente?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="recuperarCliente" type="button" class="btn btn-danger">Recuperar</button>
                </div>
            </div>
        </div>
    </div>
</html>