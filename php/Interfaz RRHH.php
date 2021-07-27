<?php
include("conexion.php");
$gbd = conectar();

if (isset($_POST["rutBuscar"])) {
	$rutBuscar = $_POST["rutBuscar"];
	$sql = "SELECT * from trabajador where rut_persona like '$rutBuscar%'";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT * FROM trabajador";
	} else {
		$sql = "SELECT * from trabajador where apellidop_persona = '$apellidoPBuscar'";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT * from trabajador where fecha_nacimiento_persona Between '$desde' and '$hasta'";
} else if (!isset($_POST["rutBuscar"]) && !isset($_POST["apellidoPBuscar"]) || $_POST["apellidoPBuscar"] == "" || $_POST["desde"] == "" || $_POST["hasta"] == "") {
	$sql = "SELECT * FROM trabajador";
}


//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$cuenta_col = $gsent->columnCount();
$data = $gbd->query($sql)->fetchAll();

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

	<!--Sacado de la carpeta-->
	<link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
	<script src="../jquery/jquery.min.v3.6.0.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

	<style>
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
	</style>
</head>

<body>

	<header class="site-header sticky-top py-1">
		<nav class="container d-flex flex-column flex-md-row justify-content-between">

			<a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver</a>
			<a class="py-2 d-none d-md-inline-block" href="Contratos.php">Contratos</a>
			<h2>ÁREA RECURSOS HUMANOS</h2>
			<a class="py-2 d-none d-md-inline-block" href="cliente.php">Clientes</a>
			<a class="py-2 d-none d-md-inline-block" href="index.php">Cerrar sesión</a>

		</nav>
	</header>

	<div class="container-fluid">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h2>GESTIÓN DE PERSONAL: </h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#añadirexampleModal"><i class="material-icons">&#xE147;</i> <span>Añadir nuevo empleado</span></a>
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
							<th>Rut trabajador</th>
							<th>Cargo</th>
							<th>Area de trabajo</th>
							<th>Foto</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
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
								<td><?php echo $row['foto'] ?></td>
								<td><?php echo $row['estado_persona'] ?></td>
								<td>
									<a href="#?id=<?php echo $row['rut_persona'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#edicionexampleModal<?php echo $row['rut_persona']; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
									<a href="#?id=<?php echo $row['rut_persona'] ?>" class="delete" data-bs-toggle="modal" data-bs-target="#eliminarexampleModal<?php echo $row['rut_persona'] ?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
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

</html>