<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contratos</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
	<!--Sacado de la carpeta-->
	<link rel="stylesheet" href="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
	<script src="jquery/jquery.min.v3.6.0.js"></script>
	<script src="js/funciones.js"></script>
	<script src="bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
	
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

		.table .avatar {
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

		/* Modal styles */
		.modal .modal-dialog {
			max-width: 400px;
		}

		.modal .modal-header,
		.modal .modal-body,
		.modal .modal-footer {
			padding: 20px 30px;
		}

		.modal .modal-content {
			border-radius: 3px;
			font-size: 14px;
		}

		.modal .modal-footer {
			background: #ecf0f1;
			border-radius: 0 0 3px 3px;
		}

		.modal .modal-title {
			display: inline-block;
		}

		.modal .form-control {
			border-radius: 2px;
			box-shadow: none;
			border-color: #dddddd;
		}

		.modal textarea.form-control{
			resize: vertical;
		}

		.modal .btn {
			border-radius: 2px;
			min-width: 100px;
		}

		.modal form label {
			font-weight: normal;
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
			padding-right: 5%;
		}

		div .col-sm-1 .b {
			background-color: #198754;
			padding: 13% 20%;
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

			<a class="py-2 d-none d-md-inline-block" href="Interfaz RRHH.php">Gestion de personal</a>
			<h2>ÁREA RECURSOS HUMANOS</h2>
			<a class="py-2 d-none d-md-inline-block" href="../index.php">Cerrar sesión</a>

		</nav>
	</header>

	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h2>CONTRATOS:</h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir contrato</span></a>
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
												<h5>ID Contrato: </h5>
											</div>
											<div class="col-sm-6">
												<h5>Apellido Paterno: </h5>
											</div>
										</div>
										<div class="row segundo">
											<div class="col-sm-6">
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="ID Contrato" aria-label="Search">
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
							<th>Id Contrato</th>
							<th>Nombre Completo</th>
							<th>Tipo de Contrato</th>
							<th>Sueldo</th>
							<th>Estado de Contrato</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>003949</td>
							<td>Fernando Jose Valenzuela Caseres</td>
							<td>Vendedor web</td>
							<td>$380.000</td>
							<td>Vigente</td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								<a href="#contratoEmpleado" class="view" data-toggle="modal"><img class="material-icons" src="imagenes/icono contrato.png" data-toggle="tooltip" title="Ver contrato" width="20" height="20" /></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>009394</td>
							<td>Andrea Antonia Bustamante Torres</td>
							<td>Reparto</td>
							<td>$390.000</td>
							<td>Vigente</td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								<a href="#contratoEmpleado" class="view" data-toggle="modal"><img class="material-icons" src="imagenes/icono contrato.png" data-toggle="tooltip" title="Ver contrato" width="20" height="20" /></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>009334</td>
							<td>Maria Alejandra Herrera Fuentes</td>
							<td>Cajero</td>
							<td>$530.000</td>
							<td>Vigente</td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								<a href="#contratoEmpleado" class="view" data-toggle="modal"><img class="material-icons" src="imagenes/icono contrato.png" data-toggle="tooltip" title="Ver contrato" width="20" height="20" /></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>009594</td>
							<td>Wilson Jose Gonzales Vilches</td>
							<td>Bodega</td>
							<td>$540.000</td>
							<td>Vigente</td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								<a href="#contratoEmpleado" class="view" data-toggle="modal"><img class="material-icons" src="imagenes/icono contrato.png" data-toggle="tooltip" title="Ver contrato" width="20" height="20" /></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>0093294</td>
							<td>Martin Sebastian Blanco Vergara</td>
							<td>Cajero</td>
							<td>$400.000</td>
							<td>Vigente</td>
							<td>

								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								<a href="#contratoEmpleado" class="view" data-toggle="modal"><img class="material-icons" src="imagenes/icono contrato.png" data-toggle="tooltip" title="Ver contrato" width="20" height="20" /></a>
							</td>
						</tr>
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
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Añadir empleado</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Dirección</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Teléfono</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Añadir">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML (Contrato)-->
	<div id="contratoEmpleado" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Detalles del contrato</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div>Nombre:</div>
						<div>Rut:</div>
						<div>Edad:</div>
						<div>Sexo:</div>
						<div>Direccón:</div>
						<div>Cargo:</div>
						<div>Fecha de contrato:</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="">
					</div>
				</form>
			</div>

		</div>

	</div>
	<!-- Edit Modal HTML (Editar Empleado)-->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Editar empleado</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Dirección</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Teléfono</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" value="Guardar">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML (Eliminar Empleado)-->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Eliminar empleado</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>¿Esta seguro que desea eliminar este empleado?</p>
						<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>