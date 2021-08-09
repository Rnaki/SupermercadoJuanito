<?php 

session_start();
if(isset($_SESSION["rut_persona"])){


$_SESSION["rut_persona"];
 include("conexion.php");
$gbd=conectar();

    $sql0 = "SELECT * FROM trabajador where rut_persona = '" . $_SESSION["rut_persona"] . "'";
	$gsent0 = $gbd->prepare($sql0);
	$gsent0->execute();
	$perfil = $gsent0->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM trabajador";
$gsent = $gbd->prepare($sql2);
$data2 = $gbd->query($sql2)->fetchAll();

$rutPersona = $_SESSION["rut_persona"];
$sql2 = "SELECT * FROM trabajador where rut_persona = '".$rutPersona."' ";
$gsent = $gbd->prepare($sql2);
$data2 = $gbd->query($sql2)->fetchAll();
  



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Trabajador</title>

    <!--Sacado de la carpeta-->
    <script src="../popper/popper.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>

    <style>
        .table-responsive {
            border-bottom: 2px solid black;
            border-radius: 3px 3px 0 0;
        }

        .table-responsive .pedido {
            background-color: #3b9a00;
            color: whitesmoke;
            font-weight: 500;
            margin-left: 85%;
            margin-top: 10px;
            padding: 8px 8px;
        }

        div .bi-pencil-square {
            margin-bottom: 4px;
        }

        div .col-sm-6 h4 {
            font-family: 'Varela Round', sans-serif;
            margin-top: 1%;
        }

        div .col-sm-6 .b1 {
            margin-left: 68%;
        }

        /*CSS de InfoBodega*/
        .table-title .col .b {
            font-size: 28px;
        }

        header .letrah2 {
            color: #566787;
            font-family: "Varela Round", sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-title {
            padding-bottom: 15px;
            background-color: #212529;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            background-color: #f8f9fa;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
        }

        .container-xl .table-striped {
            font-size: 15px;
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        .container-xl tbody .bi {
            margin-left: 7px;
        }

        .container-xl .col-sm-6 .form-control {
            width: 36%;
            display: inline;
        }

        div .table-striped td {
            padding-top: 10px;
            font-size: 16px;
        }

        /*Cambios al modal*/
        .modal-content {
            max-width: 85%;
        }

        .modal .edi h5 {
            font-size: 21px;
        }

        .modal .modal-body .form-group label {
            font-family: 'Varela Round', sans-serif;
            font-size: 15px;
        }

        div .edi {
            background-color: gold;
            color: white;
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

        /*Color boton delete perfil*/
        a.delete{
            color: #ff3333;
            margin-left: 20px;
        }

        /*Header*/
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
    <header class="site-header sticky-top py-1">
		<nav class="container d-flex flex-column flex-md-row justify-content-between">

			<a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver a Menu Trabajador</a>
			<h2 class="letrah2">PERFIL TRABAJADOR</h2>
			<div class="dropdown">
				<button class="btn" id="bd-version" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                <div class="row juan">
							<div class="col-md-3 text-center">
								<?php
								foreach ($perfil as $row0) {
									echo '<img src="../imagenes/' . $row0["foto"] . '" width="40px" height="50px" class="rounded-circle">';
								}
								?>
							</div>
							<div class="col-md-8 text-start">
								<div class="card-body">
									<?php
									foreach ($perfil as $row0) {
										echo '<h5 class="card-title">' . $row0["nombre_persona"] . ' ' . $row0["apellidop_persona"] . '</h5>';
										echo '<p class="card-text">' . $row0["cargo"] . '</p>';
									}
									?>
								</div>
							</div>
						</div>
				</button>
				<div class="dropdown-menu" aria-labelledby="bd-version">
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
                        <div class="col-sm-12">
                            <h4 class="text-center">PERFIL DE USUARIO </h4>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover tab">
                <?php
                  foreach ($data2 as $row) {
                      ?>
           
                    <tr>
                        <th></th>
                        <th>
                            <h5>Rut: </h5>
                        </th>
                        <td><?php echo $row['rut_persona'] ?></td>
                        <th></th>
                        <th>
                            <h5>Nombre: </h5>
                        </th>
                        <td><?php echo $row['nombre_persona'] ?></td>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Apellido Paterno: </h5>
                        </th>
                        <td><?php echo $row['apellidop_persona'] ?></td>
                        <th></th>
                        <th>
                            <h5>Apellido Materno: </h5>
                        </th>
                        <td><?php echo $row['apellidom_persona'] ?></td>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Región: </h5>
                        </th>
                        <td><?php echo $row['region'] ?></td>
                        <th></th>
                        <th>
                            <h5>Comuna: </h5>
                        </th>
                        <td><?php echo $row['comuna'] ?></td>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Calle: </h5>
                        </th>
                        <td><?php echo $row['calle'] ?></td>
                        <th></th>
                        <th>
                            <h5>Nº Calle: </h5>
                        </th>
                        <td><?php echo $row['numero_calle'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Fecha de nacimiento: </h5>
                        </th>
                        <td><?php echo $row['fecha_nacimiento_persona'] ?></td>
                        <th></th>
                        <th>
                            <h5>Sexo: </h5>
                        </th>
                        <td><?php echo $row['sexo'] ?></td>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Contraseña: </h5>
                        </th>
                        <td></td>
                        <th></th>
                        <th>
                            <h5>Correo: </h5>
                        </th>
                        <td><?php echo $row['correo'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Telefono: </h5>
                        </th>
                        <td><?php echo $row['fono'] ?></td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                </table>
                <?php	
                    
                ?>
            </div>
        </div>
    </div>

    <?php
        }
    ?>

    <!-- Modal editar cliente-->
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updateClientePerfil.php" method="POST">
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
                                <input type="text" class="form-control c" id="updateNcalleCliente" name="updateNcalleCliente" required value="" maxlength="8">
                            </div>
                            <div class="form-group">
                                <label>Fecha Nacimiento: </label>
                                <input type="date" class="form-control c" id="updateFechaNacimientoCliente" name="updateFechaNacimientoCliente" required value="">
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
                            <div class="form-group">
                                <label>Direccion de Despacho: </label>
                                <input type="text" class="form-control c" id="updateDireccionDespacho" name="updateDireccionDespacho" required value="" maxlength="64">
                            </div>
                            <div class="form-group">
                                <label>Nombre de Usuario: </label>
                                <input type="text" class="form-control c" id="updateNombreUsuario" name="updateNombreUsuario" required value="" maxlength="64">
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

     <!-- Modal de Eliminar-->
     <div class="modal fade" id="eliminarexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header eli">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Estas seguro que quieres eliminar tu cuenta?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="eliminarCliente" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>

<?php 
}else{
  echo "NO ENTRES INTRUSO";
  
  Header("refresh:5; url=../index.php");
}
?>