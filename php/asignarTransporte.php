<?php

session_start();
if (isset($_SESSION["rut_persona"])) {

$_SESSION["sucursal"];
$_SESSION["rut_persona"];

include("conexion.php");
$gbd = conectar();

$sql0 = "SELECT * FROM trabajador where rut_persona = '".$_SESSION["rut_persona"]."'";
$gsent0 = $gbd->prepare($sql0);
$gsent0->execute();
$perfil = $gsent0->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["rutBuscar"])) {
	$rutBuscar = $_POST["rutBuscar"];
	$sql = "SELECT * from trabajador
	join trabaja on trabaja.rut_persona = trabajador.rut_persona 
	where trabajador.rut_persona like '$rutBuscar%'
	and (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true) and area_trabajo like '%Despacho%'";
} else if (isset($_POST["apellidoPBuscar"])) {
	$apellidoPBuscar = $_POST["apellidoPBuscar"];
	if ($_POST["apellidoPBuscar"] == "") {
		$sql = "SELECT * FROM trabajador
		join trabaja on trabaja.rut_persona = trabajador.rut_persona
		where (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true) and area_trabajo like '%Despacho%'";
	} else {
		$sql = "SELECT * from trabajador 
		join trabaja on trabaja.rut_persona = trabajador.rut_persona 
		where apellidop_persona like '$apellidoPBuscar%' 
		and (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true) and area_trabajo like '%Despacho%'";
	}
} else if (isset($_POST["patenteBuscar"]) && $_POST["patenteBuscar"] !== "") { //NO FUNCIONA EL BUSCAR PATENTE
	$patenteB = $_POST["patenteBuscar"];
	$sql = "SELECT * from trabajador
			join trabaja on trabaja.rut_persona = trabajador.rut_persona 
			where (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona=true) and (UPPER(patente) like UPPER('".$patenteB."%') and area_trabajo like '%Despacho%')";
} else if (!isset($_POST["rutBuscar"]) && !isset($_POST["apellidoPBuscar"]) || $_POST["apellidoPBuscar"] == "" || $_POST["patenteBuscar"] == "" ) {
	$sql = "SELECT * FROM trabajador
			join trabaja on trabaja.rut_persona = trabajador.rut_persona
			where (trabaja.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true) and area_trabajo like '%Despacho%' ";
}


//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$gsent->execute();
$data = $gsent->fetchAll(PDO::FETCH_ASSOC);


$sql1 = "SELECT sucursal.nombre_sucursal from sucursal where id_sucursal = '".$_SESSION["sucursal"]."'";
$gsent1 = $gbd->prepare($sql1);
$resultado1 = $gbd->query($sql1)->fetchAll();


$sql2 = "SELECT * FROM transporte WHERE id_sucursal = '".$_SESSION["sucursal"]."'";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

//paginador
$xpaginas = 5;
$totalquery = $gsent->rowCount();
if($totalquery == 0){
	$totalquery = 1;
	$paginas = $totalquery/$xpaginas;
	$paginasElevado = ceil($paginas);
	$totalquery = 0;
	if(!$_GET){
		header('Location: asignarTransporte.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: asignarTransporte.php?pagina=1');
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
		header('Location: asignarTransporte.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: asignarTransporte.php?pagina=1');
	}

	$iniciar = ($_GET['pagina']-1)*$xpaginas;

	$sqlGuardar = $sql.' LIMIT :nArticulos OFFSET :iniciar;';
	$gsent = $gbd->prepare($sqlGuardar);
	$gsent->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
	$gsent->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
	$gsent->execute();
	$data = $gsent->fetchAll(PDO::FETCH_ASSOC);
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Asignar transporte</title>
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
		height: 60px;
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
		a.btn.btn-success.b2{
			background: #167bde;
		}
	</style>
</head>

<body>

	<header class="site-header sticky-top py-1">
		<nav class="container d-flex flex-column flex-md-row justify-content-between">

			<a class="py-2 d-none d-md-inline-block" href="transporte.php">Volver a Transporte</a>
			<h2 class="letrah2" style="text-align: center;">ASIGNAR TRANSPORTE A EMPLEADO <p style="text-transform: uppercase;height: 0px;"><?php foreach ($resultado1 as $row1){echo $row1["nombre_sucursal"];} ?></p></h2>
			
			<div class="dropdown">
				<button class="btn" id="bd-version" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
				<div class="row juan">
						<div class="col-md-3 text-center">
								<?php
                                foreach ($perfil as $row0) {
                                    echo '<img src="../imagenes/'.$row0["foto"].'" width="40px" height="50px" class="rounded-circle">';
                                }
                                ?>
						</div>
						<div class="col-md-8 text-start">
							<div class="card-body">
								<?php
                                foreach ($perfil as $row0) {
                                    echo '<h5 class="card-title">'.$row0["nombre_persona"].' '.$row0["apellidop_persona"].'</h5>';
									echo '<p class="card-text">'.$row0["cargo"].'</p>';
                                }
                                ?>
							</div>
						</div>
					</div>
				</button>
				<div class="dropdown-menu" aria-labelledby="bd-version">
					<li><a class="dropdown-item" aria-current="true" href="perfilTrabajador.php">Ver perfil</a></li>
					<div class="dropdown-divider"></div>
					<li><a class="dropdown-item" aria-current="true" href="cerrar_session.php">Cerrar sesión</a></li>
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row primero">
						<div class="col-sm-6">
							<h2>ASIGNAR TRANSPORTE: </h2>	
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
												<form action="asignarTransporte.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="RUT" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="asignarTransporte.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="apellidoPBuscar" placeholder="Apellido Paterno" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<h5>Patente: </h5>
											</div>
										</div>
										<div class="row">
                                        <div class="col-sm-6">
												<form action="asignarTransporte.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="patenteBuscar" placeholder="Patente" aria-label="Search">
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
							<th>Patente</th>
							<th>Correo</th>
							<th>Telefono</th>
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
								<td><?php echo $row['patente'] ?></td>
								<td><?php echo $row['correo'] ?></td>
								<td><?php echo $row['fono'] ?></td>

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
				<div class="hint-text">Mostrando <b><?php echo $encontrado?></b> de <b><?php echo $totalquery?></b> entradas</div>
					<ul class="pagination">
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="asignarTransporte.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="asignarTransporte.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="asignarTransporte.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updatePatente.php" method="POST">
                <input type="hidden" id="editRut" name="rut" value="">
                <div class="modal-body">
                    <div class="form-group form">
                        <div class="form-group">
                            <label>Rut: </label>
                            <input type="text" class="form-control c" id="editRut2" name="Rut" required value="" disabled>
                        </div>
                        <div class="form-group">
                        <label>Patente: </label>
                            <br>
                            <select class="form-select" name="patente" id="patente" required>
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($resultado2 as $row2) {
                                    echo "<option id=" . $row2["patente"] . " value=" . $row2['patente'] . ">" . $row2["patente"] . "</option>";
                                }
                                ?>
                            </select>
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
<?php
} else {
    echo "NO ENTRES INTRUSO";

    Header("refresh:5; url=../index.php");
}
?>