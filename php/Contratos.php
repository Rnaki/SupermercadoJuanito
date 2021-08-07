<?php
session_start();
$_SESSION["sucursal"];

include("conexion.php");
$gbd = conectar();

$sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
		join trabaja on trabaja.rut_persona = contrato.rut_persona 
		JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
		where trabajador.estado_persona = true and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "' ";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
	$idBuscar = $_POST["idBuscar"];
	$sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
			join trabaja on trabaja.rut_persona = contrato.rut_persona 
			JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
			where trabajador.estado_persona = true and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "' and id_contrato = '$idBuscar' ";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
				join trabaja on trabaja.rut_persona = contrato.rut_persona 
				JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
				where trabajador.estado_persona = true and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "' ";
	} else {
		$sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
				join trabaja on trabaja.rut_persona = contrato.rut_persona 
				JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
				where trabajador.estado_persona = true and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "' and upper(apellidop_persona) like upper('%$apellidoPBuscar%') ";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
			join trabaja on trabaja.rut_persona = contrato.rut_persona 
			JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
			where trabajador.estado_persona = true and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "' and fecha_inicio_contrato Between '$desde' and '$hasta' ";
} 

$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");

$sql2 = "SELECT * FROM trabajador 
		join trabaja on trabajador.rut_persona = trabaja.rut_persona
		where estado_persona = true and cargo = '' and trabaja.id_sucursal = '" . $_SESSION["sucursal"] . "';";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

//paginador
$xpaginas = 5;
$totalquery = $gsent->rowCount();
$paginas = $gsent->rowCount()/$xpaginas;
$paginasElevado = ceil($paginas);
if($totalquery < $xpaginas){
	$encontrado = $totalquery;
}else if($paginasElevado == $_GET['pagina']){
    $paginas= (int)$paginas;
    $encontrado = $totalquery-($paginas*$xpaginas);
}else if ($totalquery >= $xpaginas){
	$encontrado = $xpaginas;
}

if(!$_GET){
	header('Location: Contratos.php?pagina=1');
}
if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
	header('Location: Contratos.php?pagina=1');
}

$iniciar = ($_GET['pagina']-1)*$xpaginas;

$sqlGuardar = $sql.'LIMIT :nArticulos OFFSET :iniciar;';
$gsent3 = $gbd->prepare($sqlGuardar);
$gsent3->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
$gsent3->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
$gsent3->execute();
$resultado3 = $gsent3->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Contratos</title>

	<!--Sacado de la carpeta-->
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
			font-family: "Varela Round", sans-serif;
		}

		div .primero .col {
			text-align: right;
		}

		div .col-sm-6 h4 {
			margin-top: 1%;
		}

		.table-responsive .table h5 {
			font-size: 18.5px;
		}

		.table-responsive .tab td {
			font-size: 15.6px;
		}

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

		div .row .buscar label,
		div .accordion-body h5 {
			font-size: 19px;
			font-weight: 500;
		}

		div .table-striped tbody .envio {
			color: #198754;
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

			<a class="py-2 d-none d-md-inline-block" href="Interfaz RRHH.php">Gestion de personal</a>
			<h2 class="letrah2">ÁREA RECURSOS HUMANOS</h2>
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
	</header>
	<div style="height:30px"></div>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h4>CONTRATOS:</h4>
						</div>
						<div class="col-sm-6 col">
							<a class="btn btn-success b1" data-bs-toggle="modal" data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
									<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
								</svg> Crear Contrato</a>
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
												<form action="Contratos.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Contrato" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="Contratos.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="apellidoPBuscar" placeholder="Apellido Paterno" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<h5>Fecha de Inicio: </h5>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-2 buscar">
												<label> Desde: </label>
											</div>
											<div class="col-sm-4">
												<form action="Contratos.php?pagina=1" method="POST" class="d-flex">
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
				<table class="table table-striped table-hover" style="text-align: center;">
					<thead>
						<tr>
							<th>Id Contrato</th>
							<th>Nombre Completo</th>
							<th>Tipo de Contrato</th>
							<th>Sueldo</th>
							<th>Fecha de Inicio</th>
							<th>Fecha de Termino</th>
							<th>Estado de Contrato</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($resultado3 as $row3) {
							if ($row3["estado_contrato"] == true) {
								$estado = 'Vigente';
							} else {
								$estado = 'No vigente';
							}
							echo '<tr>';
							echo '<td>' . $row3["id_contrato"] . '</td>';
							echo  '<td>' . $row3["nombre_persona"] . ' ' . $row3["apellidop_persona"] . ' ' . $row3["apellidom_persona"] . '</td>';
							echo  '<td>' . $row3["cargo"] . '</td>';
							echo  '<td>$' . $row3["sueldo"] . '</td>';
							echo  '<td>' . $row3["fecha_inicio_contrato"] . '</td>';
							echo  '<td>' . $row3["fecha_termino_contrato"] . '</td>';
							echo  '<td>' . $estado . '</td>';
							echo "<td>
                            <a href='' onclick='mostrarUpdateContrato(\"" . $row3['id_contrato'] . "\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal' data-backdrop='static' data-keyboard='false' ><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
							echo "<a href='' onclick='eliminarContrato(\"" . $row3['id_contrato'] . "\")' class='delete' data-bs-toggle='modal'><svg
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
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="Contratos.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="Contratos.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="Contratos.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Creacion -->
	<div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header cread">
					<h5 class="modal-title" id="exampleModalLabel">Añadir Producto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" action="insertarContrato.php">
					<div class="modal-body">
						<div class="form-group ">
							<label>Nombre Persona: </label>
							<br>
							<select class="form-select" name="rutPersona" id="rutPersona" required>
								<option value="">Seleccione...</option>
								<?php
								foreach ($resultado2 as $row2) {
									echo "<option id=" . $row2["rut_persona"] . " value=" . $row2['rut_persona'] . ">" . $row2["nombre_persona"] . "</option>";
								}
								?>
							</select>
							<div class="form-group">
								<label>Cargo: </label>
								<input type="text" class="form-control" name="cargo" required>
							</div>
							<div class="form-group">
								<label>Sueldo: </label>
								<input type="number" class="form-control" name="sueldo" required>
							</div>
							<div class="form-group">
								<label>Fecha de Inicio</label>
								<input class="form-control" type="date" name="fechaInicio" placeholder="Fecha" aria-label="Search" required>
							</div>
							<div class="form-group">
								<label>Fecha de Termino</label>
								<input class="form-control" type="date" name="fechaTermino" placeholder="Fecha" aria-label="Search" required>
							</div>
							<br>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success cread">Añadir</button>
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

	<!-- Modal Edicion -->
	<div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header edi">
					<h5 class="modal-title" id="exampleModalLabel">Editar Contrato</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="updateContrato.php">
						<div class="form-group">
							<label>ID Contrato: </label>
							<input type="text" class="form-control updateIdContrato" name="updateIdContrato" disabled>
							<input class="updateIdContrato" name="updateIdContrato" type="hidden">
							<div class="form-group">
								<label>Nombre Completo: </label>
								<input type="text" class="form-control updateNombreCompleto" id="updateNombreCompleto" disabled>
								<input class="updateNombreCompleto" name="updateNombreCompleto" type="hidden">
							</div>
							<div class="form-group">
								<label>Tipo de Contrato: </label>
								<input type="text" class="form-control" id="updateCargo" name="updateCargo" required>
							</div>
							<div class="form-group">
								<label>Sueldo: </label>
								<input type="number" class="form-control" id="updateSueldo" name="updateSueldo" required>
							</div>
							<div class="form-group">
								<label>Fecha de Inicio: </label>
								<input type="text" class="form-control" name="updateFechaInicio" id="updateFechaInicio" required>
							</div>
							<div class="form-group">
								<label>Fecha de Termino: </label>
								<input type="text" class="form-control" name="updateFechaTermino" id="updateFechaTermino" required>
							</div>
							<div class="form-group">
								<label>Estado de Contrato: </label>
								<select class="form-select" name="updateEstado" id="updateEstado" required>
									<option value="Vigente">Vigente</option>
									<option value="No vigente">No vigente</option>
								</select>
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
					<h5 class="modal-title">Eliminar Contrato</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>¿Estas seguro que quieres eliminar este contrato?</label>
						<div style="height:16px"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button id="eliminarContrato" type="button" class="btn btn-danger">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>