<?php

session_start();
$_SESSION["rut_persona"];

include("conexion.php");
$gbd = conectar();

//$sql = "SELECT my_function();";
$sql = "SELECT * FROM proveedor where estado_proveedor = true ";

//BUSCADOR
if (isset($_POST["rutBuscar"]) && ($_POST["rutBuscar"] != '')) {
    $rutBuscar = $_POST["rutBuscar"];
    $sql = "SELECT * FROM proveedor where estado_proveedor = true and rut_proveedor like '$rutBuscar%' ";
} else if (isset($_POST["nombreBuscar"])) {
    $nombreBuscar = $_POST["nombreBuscar"];
    if ($_POST["nombreBuscar"] == "") {
        $sql = "SELECT * FROM proveedor where estado_proveedor = true ";
    } else {
        $sql = "SELECT * FROM proveedor where estado_proveedor = true and upper(nombre_proveedor) like upper('%$nombreBuscar%') ";
    }
} else if (isset($_POST["tipo"]) && isset($_POST["marca"]) && $_POST["tipo"] !== " " && $_POST["marca"] !== " ") {
    $tipo = $_POST["tipo"];
    $marca = $_POST["marca"];
    if ($_POST["tipo"] != "Seleccione..." && $_POST["marca"] == "Seleccione...") {
        $sql = "SELECT * FROM proveedor where estado_proveedor = true and tipo_proveedor = '$tipo' ";
    } else if ($_POST["tipo"] == "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql = "SELECT * FROM proveedor where estado_proveedor = true and marca_proveedor = '$marca' ";
    } else if ($_POST["tipo"] != "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql = "SELECT * FROM proveedor where estado_proveedor = true and tipo_proveedor = '$tipo' and marca_proveedor = '$marca' ";
    }
}

//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$gsent->execute();

$sql2 = "SELECT distinct marca_proveedor FROM proveedor WHERE estado_proveedor = true order by marca_proveedor;";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT distinct tipo_proveedor FROM proveedor WHERE estado_proveedor = true order by tipo_proveedor;";
$gsent3 = $gbd->prepare($sql3);
$gsent3->execute();
$resultado3 = $gsent3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT rut_persona FROM trabajador where rut_persona = '".$_SESSION["rut_persona"]."';";
$gsent4 = $gbd->prepare($sql4);
$gsent4->execute();
$resultado4 = $gsent4->fetchAll(PDO::FETCH_ASSOC);

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

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
	header('Location: proveedor.php?pagina=1');
}
if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
	header('Location: proveedor.php?pagina=1');
}

$iniciar = ($_GET['pagina']-1)*$xpaginas;

$sqlGuardar = $sql.'LIMIT :nArticulos OFFSET :iniciar;';
$gsent5 = $gbd->prepare($sqlGuardar);
$gsent5->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
$gsent5->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
$gsent5->execute();
$resultado5 = $gsent5->fetchAll(PDO::FETCH_ASSOC);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedor</title>
    <script src="../popper/popper.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilosDaniel.css">
    <!-- JS BOOTSTRAP -->
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
    <script src="../js/funciones.js"></script>
    
    
    <style>
        .table-title .col .form-control{
            width: 33%;
        }

        .table-responsive tbody a {
            color: #566787;
        }

        div .col-sm-6 h4{
            font-family: 'Varela Round', sans-serif;
        }

        div .primero .col {
			text-align: right;
		}

        /*Cambio*/
        div .primero {
			margin-bottom: 12px;
		}

        div .primero .btn .bi{
            margin-bottom: 3%;
        }

		div .segundo {
			padding-bottom: 23px;
		}

        div .accordion-collapse .segundo .form-control{
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
            float:right;
            padding: 10% 17%;
		}

		div .row .buscar label {
			font-size: 19px;
            font-weight:500;
		}

		div .accordion-body h5{
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
            <h2 class="letrah2">INFORMACIÓN DE PROVEEDORES</h2>
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
                    <li><a class="dropdown-item" aria-current="true" href="../index.php">Cerrar sesión</a></li>
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
                            <h4>PROVEEDORES: </h4>
                        </div>
                        <div class="col-sm-6 col">
                            <a class="btn btn-success b1" data-bs-toggle="modal"
                                data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg> Añadir Proveedor</a>
                                <a class="btn btn-danger" href="proveedoresEliminados.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
									<path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
								</svg></a>
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
												<h5>Nombre: </h5>
											</div>
										</div>
										<div class="row segundo">
											<div class="col-sm-6">
												<form action="proveedor.php?pagina=1" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="RUT" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="proveedor.php?pagina=1" method="POST" class="d-flex">
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
												<form action="proveedor.php?pagina=1" method="POST" class="d-flex">
                                                <select class="form-select" name="tipo" id="tipo" required>
                                                        <option selected>Seleccione...</option>
                                                        <?php
                                                        foreach ($resultado3 as $row3) {
                                                            echo "<option id=" . $row3["rut_proveedor"] . " value=" . $row3['tipo_proveedor'] . ">" . $row3["tipo_proveedor"] . "</option>";
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
                                                        foreach ($resultado2 as $row2) {
                                                            echo "<option id=" . $row2["rut_proveedor"] . " value=" . $row2['marca_proveedor'] . ">" . $row2["marca_proveedor"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
											</div>
											<div class="col-sm-1 colb">
												<button class="btn btn-success" type="submit">Buscar</button>
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
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Fono</th>
                            <th>Acciones</th>
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado5 as $row5){
                            echo '<tr>';
                            echo '<td>'.$row5["rut_proveedor"].'<a href="compraProv.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path
                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg></a></td>';
                            echo  '<td>'.$row5["nombre_proveedor"].'</td>';
                            echo  '<td>'.$row5["tipo_proveedor"].'</td>';
                            echo  '<td>'.$row5["marca_proveedor"].'</td>';
                            echo  '<td>'.$row5["fono_proveedor"].'</td>';
                            echo "<td>
                            <a href='' onclick='mostrarUpdateProveedor(\"".$row5['rut_proveedor']."\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='EliminarProveedor(\"".$row5['rut_proveedor']."\")' class='delete' data-bs-toggle='modal' ><svg
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
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="proveedor.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="proveedor.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="proveedor.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
					</ul>
				</div>
            </div>
        </div>
    </div>

    <!-- Modal de Creacion-->
    <div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="insertarProveedor.php">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>RUT: </label>
                            <input name="rutProovedor" id="rutAgregar" type="text" class="form-control" required>
                            <div class="form-group">
                                <label>Nombre: </label>
                                <input name="nombreProveedor" type="text" class="form-control" required>
                                <?php
                                foreach ($resultado4 as $row4) {
                                    echo '<input type="hidden" name="rutPersona" class="form-control" value="'.$row4["rut_persona"].'">';
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Tipo: </label>
                                <input name="tipoProveedor" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Marca: </label>
                                <input name="marcaProveedor" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Fono: </label>
                                <input name="fonoProveedor" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" onclick="return validarRut();" class="btn btn-success cread">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Edicion-->
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateProveedor.php">
                        <div class="form-group">
                            <label>RUT: </label>
                            <input name="updateRutProveedor" type="text" class="form-control updateRutProveedor"  disabled>
                            <input class="updateRutProveedor" name="updateRutProveedor" type="hidden">
                            <div class="form-group">
                                <label>Nombre: </label>
                                <input id="updateNombreProveedor" name="updateNombreProveedor" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tipo: </label>
                                <input id="updateTipoProveedor" name="updateTipoProveedor" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Marca: </label>
                                <input id="updateMarcaProveedor" name="updateMarcaProveedor" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Fono: </label>
                                <input id="updateFonoProveedor" name="updateFonoProveedor" type="text" class="form-control" required>
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
    <div class="modal fade" id="eliminarexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header eli">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Estas seguro que quieres eliminar a este proveedor?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="eliminarProveedor" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>