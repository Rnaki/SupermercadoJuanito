<?php

session_start();
if (isset($_SESSION["rut_persona"])) {

$_SESSION["sucursal"];
$_SESSION["rut_persona"];

if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo '<script>alert("La id sucursal ya existe")</script>';
}

include("conexion.php");
$gbd = conectar();

//$sql = "SELECT my_function();";
$sql0 = "SELECT * FROM trabajador where rut_persona = '".$_SESSION["rut_persona"]."'";
$gsent0 = $gbd->prepare($sql0);
$gsent0->execute();
$perfil = $gsent0->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM sucursal ";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
	$idBuscar = $_POST["idBuscar"];
	$sql = "SELECT * FROM sucursal WHERE id_sucursal = '$idBuscar' ";
} else if (isset($_POST["regionBuscar"])) {
	$regionBuscar = $_POST["regionBuscar"];
	if ($_POST["regionBuscar"] == '') {       
        $sql = "SELECT * FROM sucursal ";
	} else {
	$sql = "SELECT * FROM sucursal WHERE upper(region_sucursal) like upper('".$regionBuscar."%') ";
	}
} else if (isset($_POST["comunaBuscar"])) {
	$comunaBuscar = $_POST["comunaBuscar"];
	if ($_POST["comunaBuscar"] == '') {       
        $sql = "SELECT * FROM sucursal ";
	} else {
        $sql = "SELECT * FROM sucursal WHERE upper(comuna_sucursal) like upper('".$comunaBuscar."%') ";
    }
} 


$gsent = $gbd->prepare($sql);
$gsent->execute();

$sql2 = "SELECT bodega.id_bodega, sucursal.id_sucursal from bodega
        left join sucursal on sucursal.id_bodega = bodega.id_bodega where id_sucursal is NULL;";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);


/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

//paginador
$xpaginas = 5;
$totalquery = $gsent->rowCount();
if($totalquery == 0){
	$totalquery = 1;
	$paginas = $totalquery/$xpaginas;
	$paginasElevado = ceil($paginas);
	$totalquery = 0;
	if(!$_GET){
		header('Location: sucursalGerente.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: sucursalGerente.php?pagina=1');
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
		header('Location: sucursalGerente.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: sucursalGerente.php?pagina=1');
	}

	$iniciar = ($_GET['pagina']-1)*$xpaginas;

	$sqlGuardar = $sql.' LIMIT :nArticulos OFFSET :iniciar;';
	$gsent = $gbd->prepare($sqlGuardar);
	$gsent->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
	$gsent->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
	$gsent->execute();
	$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilosDaniel.css">
    <!-- JS BOOTSTRAP -->
    <script src="../popper/popper.min.js"></script>
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
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
    </style>
</head>

<body>
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver</a>
            <h2 class="letrah2">INFORMACI??N DE SUCURSALES</h2>

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
					<li><a class="dropdown-item" aria-current="true" href="cerrar_session.php">Cerrar sesi??n</a></li>
				</div>
			</div>
        </nav>
    </header>
    <div style="height:50px"></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row primero">
                        <div class="col-sm-6">
                            <h4>SUCURSALES: </h4>
                        </div>
                        <div class="col-sm-6 col">
                            <a class="btn btn-success b1" data-bs-toggle="modal"
                                data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg> A??adir Sucursal</a>
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
                                                <h5>ID Sucursal: </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Regi??n: </h5>
                                            </div>
                                        </div>
                                        <div class="row segundo">
                                            <div class="col-sm-6">
                                                <form action="sucursalGerente.php?pagina=1" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Sucursal" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="sucursalGerente.php?pagina=1" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="regionBuscar" placeholder="Regi??n" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>Comuna: </h5>
                                            </div>
                                        </div>
                                        <div class="row segundo">
                                            <div class="col-sm-6">
                                                <form action="sucursalGerente.php?pagina=1" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="comunaBuscar" placeholder="Comuna" aria-label="Search">
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
                            <th>ID Sucursal</th>
                            <th>ID Bodega</th>
                            <th>Regi??n </th>
                            <th>Comuna </th>
                            <th>Calle</th>
                            <th>N?? calle</th>
                            <th>Tel??fono</th>
                            <th>Nombre sucursal</th>
                            <th>Trabajadores</th>
                            <th>Acciones</th>
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado as $row){
                            echo '<tr>';
                            
                            echo  '<td>'.$row["id_sucursal"].'</td>';
                            echo  '<td>'.$row["id_bodega"].'</td>';
                            echo  '<td>'.$row["region_sucursal"].'</td>';
                            echo  '<td>'.$row["comuna_sucursal"].'</td>';
                            echo  '<td>'.$row["calle_sucursal"].'</td>';
                            echo  '<td>'.$row["numero_calle_sucursal"].'</td>';
                            echo  '<td>'.$row["fono_sucursal"].'</td>';
                            echo  '<td>'.$row["nombre_sucursal"].'</td>';
                            echo  '<td>'.$row["cantidad_trabajadores"].'</td>';

                            echo "<td>
                            <a href='' onclick='mostrarUpdateSucursal(\"".$row['id_sucursal']."\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='eliminarSucursal(\"".$row['id_sucursal']."\")' class='delete' data-bs-toggle='modal' ><svg
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
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="sucursalGerente.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="sucursalGerente.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="sucursalGerente.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
					</ul>
				</div>
            </div>
        </div>
    </div>

    <!-- Modal de InfoDespacho-->
    <div class="modal fade" id="infoDespachoEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog infodespacho">
            <div class="modal-content">
                <div class="modal-header info">
                    <h5 class="modal-title" id="exampleModalLabel">Informaci??n del Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-7">
                                <label><strong>Nombre: </strong> Maria Colque</label>
                            </div>
                            <div class="col-sm-5">
                                <label><strong>Metodo de pago: </strong> Efectivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Rut: </strong> 20503968-6</label>
                    </div>
                    <div class="form-group">
                        <label><strong>Domicilio: </strong> Salvador 13</label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-7">
                                <label><strong>Regi??n: </strong> Tarapaca</label>
                            </div>
                            <div class="col-sm-5">
                                <label><strong>Comuna: </strong> Iquique</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-7">
                                <label><strong>Telefono: </strong> (+56) 9 12312312</label>
                            </div>
                            <div class="col-sm-5">
                                <label><strong>Correo: </strong> maria12@gmail.com</label>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Cantidad</th>
                                <th class="text-center">Detalles</th>
                                <th>P. Unitario</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>10</td>
                                <td>Smartphone Xiaomi Redmi 9A 32GB Azul Claro</td>
                                <td>$79.990</td>
                                <td>$799.900</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>18</td>
                                <td>N??ctar Andina del Valle durazno</td>
                                <td>$1.499</td>
                                <td>$26.982</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>21</td>
                                <td>Huevo Gallina Libre 6un</td>
                                <td>$1.690</td>
                                <td>$35.490</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>13</td>
                                <td>Soprole, Yoghurt Batifrut con trozos de Frutilla Pote 165 g</td>
                                <td>$510</td>
                                <td>$6.630</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Creacion-->
    <div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">A??adir Sucursal (Antes se debe crear una bodega)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="insertarSucursal.php">
                        <div class="form-group">
                            <label>ID Sucursal: </label>
                            <input type="text" class="form-control" id="id_sucursal" name="id_sucursal" required>
                            <div class="form-group">
                                <label>ID Bodega: </label>
                                <select class="form-select" name="id_bodega" id="id_bodega" required>
                                    <option value="">Seleccione...</option>
									<?php
									foreach ($resultado2 as $row2) {
										echo "<option id=" . $row2["id_bodega"] . " value=" . $row2['id_bodega'] . ">" . $row2["id_bodega"] . "</option>";
									}
									?>
								</select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label>Regi??n: </label>
                                <input type="text" class="form-control" id="region_sucursal" name="region_sucursal" required>
                            </div>
                            <div class="form-group">
                                <label>Comuna: </label>
                                <input type="text" class="form-control" id="comuna_sucursal" name="comuna_sucursal" required>
                            </div>
                            <div class="form-group">
                                <label>Calle: </label>
                                <input type="text" class="form-control" id="calle_sucursal" name="calle_sucursal" required>
                            </div>
                            <div class="form-group">
                                <label>N?? calle: </label>
                                <input type="text" class="form-control" id="numero_calle_sucursal" name="numero_calle_sucursal" required>
                            </div>
                            <div class="form-group">
                                <label>Tel??fono: </label>
                                <input type="text" class="form-control" id="fono_sucursal" name="fono_sucursal" required>
                            </div>
                            <div class="form-group">
                                <label>Nombre Sucursal: </label>
                                <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success cread">A??adir</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>

    <!-- Modal de Edicion-->
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Info Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateSucursal.php">
                        <div class="form-group">
                            <label>ID Sucursal: </label>
                            <input type="text" id="updateIdSucursal" class="form-control" disabled>
                            <input id="updateIdSucursal2" name="updateIdSucursal2" type="hidden">
                            <div class="form-group">
                                <label>ID Bodega: </label>
                                <input name="updateIdBodega" type="text" id="updateIdBodega" class="form-control" disabled>
                                <input name="updateIdBodega2" type="hidden" id="updateIdBodega2" >
                            </div>
                            <div class="form-group">
                                <label>Regi??n: </label>
                                <input name="updateRegionSucursal" type="text" id="updateRegionSucursal" class="form-control" disabled>
                                <input name="updateRegionSucursal2" type="hidden" id="updateRegionSucursal2" class="form-control" >

                            </div>
                            <div class="form-group">
                                <label>Comuna: </label>
                                <input name="updateComunaSucursal" type="text" id="updateComunaSucursal" class="form-control" disabled>
                                <input name="updateComunaSucursal2" type="hidden" id="updateComunaSucursal2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Calle: </label>
                                <input name="updateCalleSucursal" type="text" id="updateCalleSucursal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>N?? calle: </label>
                                <input name="updateNumeroCalleSucursal" type="text" id="updateNumeroCalleSucursal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tel??fono: </label>
                                <input name="updateFonoSucursal" type="text" id="updateFonoSucursal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nombre sucursal: </label>
                                <input name="updateNombreSucursal" type="text" id="updateNombreSucursal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>N?? trabajadores: </label>
                                <input type="text" id="updateCantidadTrabajadores" class="form-control" disabled>
                                <input name="updateCantidadTrabajadores" type="hidden" id="updateCantidadTrabajadores" class="form-control">
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>??Estas seguro que quieres eliminar la sucursal? ESTA ACCI??N NO SE PUEDE DESHACER</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="eliminarSucursal" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
} else {
    echo "NO ENTRES INTRUSO";

    Header("refresh:5; url=../index.php");
}
?>