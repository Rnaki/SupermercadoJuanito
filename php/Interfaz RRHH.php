<?php

session_start();
$_SESSION["sucursal"];
$_SESSION["rut_persona"];

if(isset($_GET["error"]) && $_GET["error"] == 2){
	echo "<script>alert('El rut ya se encuentra registrado')</script>";
}
include("conexion.php");
$gbd = conectar();

$sql0 = "SELECT * FROM trabajador where rut_persona = '".$_SESSION["rut_persona"]."'";
$gsent0 = $gbd->prepare($sql0);
$gsent0->execute();
$resultado0 = $gsent0->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["rutBuscar"])) {
	$rutBuscar = $_POST["rutBuscar"];
	$sql = "SELECT * from trabajador
	join trabaja on trabaja.rut_persona = trabajador.rut_persona 
	where trabajador.rut_persona like '$rutBuscar%'
	and trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT * FROM trabajador
		join trabaja on trabaja.rut_persona = trabajador.rut_persona
		where trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true";
	} else {
		$sql = "SELECT * from trabajador 
		join trabaja on trabaja.rut_persona = trabajador.rut_persona 
		where apellidop_persona like '$apellidoPBuscar%' 
		and trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT * from trabajador
			join trabaja on trabaja.rut_persona = trabajador.rut_persona 
			where fecha_nacimiento_persona Between '$desde' and '$hasta' and (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' 
			and trabajador.estado_persona = true)";
} else if (!isset($_POST["rutBuscar"]) && !isset($_POST["apellidoPBuscar"]) || $_POST["apellidoPBuscar"] == "" || $_POST["desde"] == "" || $_POST["hasta"] == "") {
	$sql = "SELECT * FROM trabajador
			join trabaja on trabaja.rut_persona = trabajador.rut_persona
			where trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true";
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
	<title>Gestion de personal</title>
	<!--Sacado de por otra via-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../css/estilosDaniel.css">
	<!--Sacado de la carpeta-->
	<script src="../popper/popper.min.js"></script>
	<link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
	<script src="../jquery/jquery.min.v3.6.0.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

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
			<a class="py-2 d-none d-md-inline-block" href="Contratos.php">Contratos</a>
			<h2 class="letrah2">ÁREA RECURSOS HUMANOS</h2>
			
			<a class="py-2 d-none d-md-inline-block" href="cliente.php">Clientes</a>
			<div class="dropdown">
				<button class="btn" id="bd-version" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
					<div class="row juan">
						<div class="col-md-3 text-center">
								<?php
                                foreach ($resultado0 as $row0) {
                                    echo '<img src="../imagenes/'.$row0["foto"].'" width="40px" height="50px" class="rounded-circle">';
                                }
                                ?>
						</div>
						<div class="col-md-8 text-start">
							<div class="card-body">
								<?php
                                foreach ($resultado0 as $row0) {
                                    echo '<h5 class="card-title">'.$row0["nombre_persona"].' '.$row0["apellidop_persona"].'</h5>';
									echo '<p class="card-text">'.$row0["cargo"].'</p>';
                                }
                                ?>
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
		<h2 class="text-center letrah2"><?php foreach ($resultado1 as $row1){echo $row1["nombre_sucursal"];} ?></h2>
	</header>

	<div class="container-fluid">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h3>GESTIÓN DE PERSONAL: </h3>	
						</div>
						<div class="col-sm-6 col">
							<a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#añadirexampleModal"><i class="material-icons">&#xE147;</i> <span>Añadir nuevo empleado</span></a>
							<a class="btn btn-primary"  href="trabajadorRecuperar.php" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
								<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                </svg> Recuperar Empleados</a>
							<?php //include("modalAñadirPersonal.php"); ?>
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
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="RUT" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
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
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
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
							<th>Supervisor</th>
							<th>Cargo</th>
							<th>Area de trabajo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody">
						<?php
						foreach ($data as $row) {
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

								<td><?php echo $row['tra_rut_persona'] ?></td>
								<td><?php echo $row['cargo'] ?></td>
								<td><?php echo $row['area_trabajo'] ?></td>
								<td>
						<?php	echo "<a onclick='mostrarUpdateTrabajador(\"" . $row['rut_persona'] . "\")' href='#edicionexampleModal' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><i class='material-icons' data-toggle='tooltip' title='Editar'>&#xE254;</i></a> "?>
						<?php 	echo "<a onclick='mostrarEliminarTrabajador(\"" . $row['rut_persona'] . "\")' href='#eliminarexampleModal' class='delete' data-bs-toggle='modal' data-bs-target='#eliminarexampleModal'><i class='material-icons' data-toggle='tooltip' title='Eliminar'>&#xE872;</i></a>" ?>
								</td>
							</tr>
							<?php //include("modalEditarPersonal.php"); ?>
							<?php //include("modalEliminarPersonal.php"); ?>
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
<!--
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
-->
<div class="modal fade" id="añadirexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cread">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insertarTrabajador.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
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
					<label>Foto: </label>
                    <input type="file" class="form-control mb-3 c" required="required" name="foto" accept="image/*">
					<!--<label>Cargo: </label>-->
                    <input type="hidden" class="form-control mb-3 c" required="required" name="Cargo" placeholder="Cargo" maxlength="16">
					<label>Acceso: </label>
					<br>
					<input type="checkbox" id="RRHH" name="RRHH" value="1" >
					<label for="RRHH"> Recursos Humanos</label><br>
					<input type="checkbox" id="Tweb" name="Tweb" value="2">
					<label for="Tweb"> Trabajador Web</label><br>
					<input type="checkbox" id="Bodega" name="Bodega" value="3">
					<label for="Bodega"> Bodega</label><br>
					<input type="checkbox" id="Proveedor" name="Proveedor" value="4">
					<label for="Proveedor"> Proveedor</label><br>
					<input type="checkbox" id="Despacho" name="Despacho" value="5">
					<label for="Despacho">Despacho</label><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <h6>Cancelar</h6>
                    </button>
                    <button type="submit" onclick="return validarRut();" class="btn btn-success cread">
                        <h6>Añadir</h6>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--
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
-->
<div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header edi">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updateTrabajador.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="editRut" name="rut" value="">
                <div class="modal-body">
                    <div class="form-group form">
                        <div class="form-group">
                            <label>Rut: </label>
                            <input type="text" class="form-control c" id="editRut2" name="Rut" required value="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nombre: </label>
                            <input type="text" class="form-control c" id="editNombre" name="nombre" required value="">
                        </div>
                        <div class="form-group">
                            <label>Apellido Paterno: </label>
                            <input type="text" class="form-control c" id="editApellidoP" name="apellidoP" required value="">
                        </div>
                        <div class="form-group">
                            <label>Apellido Materno: </label>
                            <input type="text" class="form-control c" id="editApellidoM" name="apellidoM" required value="">
                        </div>
                        <div class="form-group">
                            <label>Region: </label>
                            <input type="text" class="form-control c" id="editRegion" name="region" required value="" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Comuna: </label>
                            <input type="text" class="form-control c" id="editComuna" name="comuna" required value="" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Calle: </label>
                            <input type="text" class="form-control c" id="editCalle" name="calle" required value="" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Nª Calle: </label>
                            <input type="text" class="form-control c" id="editNCalle" name="ncalle" required value="" maxlength="32">
                        </div>
                        <div class="form-group">
                            <label>Fecha Nacimiento: </label>
                            <input type="text" class="form-control c" id="editFechaNacimiento" name="fechaNacimiento" required value="">
                        </div>
                        <label>Sexo: </label>
                        <br>
                        <select class="form-select" id="editSexo" name="sexo" id="sexoupdate">
                            <option value="Hombre" id="Hombre">Hombre</option>
                            <option value="Mujer" id="Mujer">Mujer</option>
                            <option value="Otros" id="Otros">Otros</option>
                        </select>
                        <br>
                        <div class="form-group">
                            <label>Contraseña: </label>
                            <input type="text" class="form-control c" id="editContraseña" name="Contraseña" required value="">
                        </div>
                        <div class="form-group">
                            <label>Correo: </label>
                            <input type="text" class="form-control c" id="editCorreo" name="Correo" required value="">
                        </div>
                        <div class="form-group">
                            <label>Teléfono: </label>
                            <input type="text" class="form-control c" id="editTelefono" name="Telefono" required value="">
                        </div>
						<label>Foto: </label>
                    <input type="file" class="form-control mb-3 c" name="editFoto" accept="image/*">
					<!--
						<label>Cargo: </label>
                    <input type="text" class="form-control mb-3 c" required="required" id="editCargo" name="Cargo" placeholder="Cargo" maxlength="16">
					-->
					<label>Acceso: </label>
					<br>
					<input type="checkbox" id="accesoEdit1" name="RRHH" value="1" >
					<label for="RRHH"> Recursos Humanos</label><br>
					<input type="checkbox" id="accesoEdit2" name="Tweb" value="2">
					<label for="Tweb"> Trabajador Web</label><br>
					<input type="checkbox" id="accesoEdit3" name="Bodega" value="3">
					<label for="Bodega"> Bodega</label><br>
					<input type="checkbox" id="accesoEdit4" name="Proveedor" value="4">
					<label for="Proveedor"> Proveedor</label><br>
					<input type="checkbox" id="accesoEdit5" name="Despacho" value="5">
					<label for="Despacho">Despacho</label><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        //$('#sexoupdate<?php //echo $row['rut'] ?> option[id="<?php //echo $row['sexo'] ?>"]').attr("selected", true);
        //$('#sexoupdate option[id="'+$info['compañia']+'"]').attr("selected", true);
    </script>
</div>
<!--
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
-->
<div class="modal fade" id="eliminarexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header eli">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body cuadro">
                    <div class="form-group fuente">
                        <label>¿Estas seguro que quieres eliminar al Trabajador <b></b>?</label>
						<input type="hidden" id="eliminarRutTrabajador" value="">
						<h5 id="EliminarNombreTrabajador"></h5>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="eliminarTrabajador()"  class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</html>