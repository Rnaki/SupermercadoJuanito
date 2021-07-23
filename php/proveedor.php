<?php

include("conexion.php");
$gbd = conectar();
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
$sql = "SELECT * FROM proveedor where estado_proveedor = true";
//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$gsent->execute();

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

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

        div .col-sm-6 .b1{
            margin-left: 67%;
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
    </style>

</head>
<body>
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="../Menu trabajador.html">Volver</a>
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
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="rutBuscar" placeholder="RUT" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
											<div class="col-sm-6">
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
													<input class="form-control me-3" type="search" name="nombrePBuscar" placeholder="Nombre" aria-label="Search">
													<button class="btn btn-success b" type="submit">Buscar</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-2 buscar">
												<label> Tipo: </label>
											</div>
											<div class="col-sm-4">
												<form action="Interfaz RRHH.php" method="POST" class="d-flex">
													<input class="form-control me-2" type="date" name="desde" placeholder="Fecha" aria-label="Search">

											</div>
											<div class="col-sm-1 buscar">
												<label> Marca: </label>
											</div>
											<div class="col-sm-4">
												<input class="form-control me-2" type="date" name="hasta" placeholder="Fecha" aria-label="Search">
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
                            foreach ($resultado as $row){
                            echo '<tr>';
                            echo '<td>'.$row["rut_proveedor"].'<a href="compraProv.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path
                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg></a></td>';
                            echo  '<td>'.$row["nombre_proveedor"].'</td>';
                            echo  '<td>'.$row["tipo_proveedor"].'</td>';
                            echo  '<td>'.$row["marca_proveedor"].'</td>';
                            echo  '<td>'.$row["fono_proveedor"].'</td>';
                            echo "<td>
                            <a href='' onclick='mostrarUpdateProveedor(\"".$row['rut_proveedor']."\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='EliminarProveedor(\"".$row['rut_proveedor']."\")' class='delete' data-bs-toggle='modal' ><svg
                                    xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor'
                                    class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                </svg></a>

                            </td>";
                            echo "<tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Mostrando <b>5</b> de <b>25</b> entradas</div>
                    <ul class="pagination">
                        <li class="page-item"><a href="#" class="page-link">Anterior</a></li>
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
                            <input name="rutProovedor" type="text" class="form-control" required>
                            <div class="form-group">
                                <label>Nombre: </label>
                                <input name="nombreProveedor" type="text" class="form-control" required>
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
                        <button type="submit" class="btn btn-success cread">Crear</button>
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