<?php 

session_start();
if(isset($_SESSION["rut_persona"])){



 include("conexion.php");
$gbd=conectar();

$sql2 = "SELECT * FROM cliente";
$gsent = $gbd->prepare($sql2);
$data2 = $gbd->query($sql2)->fetchAll();

$rutPersona = $_SESSION["rut_persona"];
$sql2 = "SELECT * FROM cliente where rut_persona = '".$rutPersona."' ";
$gsent = $gbd->prepare($sql2);
$data2 = $gbd->query($sql2)->fetchAll();
  



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <!--Sacado de la carpeta-->
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
            background-color: #f0da1a;
            color: whitesmoke;
            font-weight: 500;
            margin-left: 88%;
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

        
    </style>
</head>

<body>
    <header class="site-header sticky-top py-1">
        <nav class="bg-dark container d-flex flex-column flex-md-row justify-content-between">

            <a class="py-2 d-none d-md-inline-block text-white " href="lobby.php">Inicio</a>
            <a class="py-2 d-none d-md-inline-block text-white " href="carrito.php">Carrito</a>
            <a class="py-2 d-none d-md-inline-block text-white " href="perfil.php">Perfil</a>
            <a class="py-2 d-none d-md-inline-block text-white " href="cerrar_session.php">Cerrar sesión</a>

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
                        <td class="hidetext"><input type="password" value="<?php echo $row['contrasena']?>" disabled></td>
                        <th></th>
                        <th>
                            <h5>Correo: </h5>
                        </th>
                        <td><?php echo $row['correo'] ?></td>
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
                    <tr>
                        <th></th>
                        <th>
                            <h5>Direccion de Despacho: </h5>
                        </th>
                        <td><?php echo $row['direccion_despacho'] ?></td>
                        <th></th>
                        <th>
                            <h5>Nombre de Usuario: </h5>
                        </th>
                        <td><?php echo $row['nombre_usuario_cliente'] ?></td>
                        <th></th>
                    </tr>
                </table>
                <?php	echo "<a onclick='mostrarUpdateCliente(\"".$row['rut_persona']."\")' href='#edicionexampleModal' class='btn btn-warning pedido' data-bs-toggle='modal' data-backdrop='static' data-keyboard='false' data-bs-target='#edicionexampleModal'>               
                <svg xmlns='http://www.w3.org/2000/svg' width='19' height='19' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                    </svg></i>Editar Perfil</a>";?>
            </div>
        </div>
    </div>

    <?php
                  }
              ?>

    <!--
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
                    <tr>
                        <th></th>
                        <th>
                            <h5>Rut: </h5>
                        </th>
                        <td>20435895-4</td>
                        <th></th>
                        <th>
                            <h5>Nombre: </h5>
                        </th>
                        <td>Luis</td>
                        <th></th>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <th>
                            <h5>Apellido Paterno: </h5>
                        </th>
                        <td>Castro</td>
                        <th></th>
                        <th>
                            <h5>Apellido Materno: </h5>
                        </th>
                        <td>Godoy</td>
                        <th></th>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <th>
                            <h5>Región: </h5>
                        </th>
                        <td>Tarapaca</td>
                        <th></th>
                        <th>
                            <h5>Comuna: </h5>
                        </th>
                        <td>Alto Hospicio</td>
                        <th>
                            <h5>Calle: </h5>
                        </th>
                        <td>Salmon</td>
                        <th></th>
                        <th>
                            <h5>Nº Calle: </h5>
                        </th>
                        <td>32</td>
                        <th></th>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <th>
                            <h5>Fecha de nacimiento: </h5>
                        </th>
                        <td>2021-05-12</td>
                        <th></th>
                        <th>
                            <h5>Sexo: </h5>
                        </th>
                        <td>Hombre</td>
                        <th>
                            <h5>Contraseña: </h5>
                        </th>
                        <td>seba</td>
                        <th></th>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <th>
                            <h5>Correo: </h5>
                        </th>
                        <td>luis@gmail.com</td>
                        <th></th>
                        <th>
                            <h5>Telefono: </h5>
                        </th>
                        <td>32454365</td>
                        <th></th>
                    </tr>
                </table>
                <a class="btn btn-warning pedido" data-bs-toggle="modal" data-bs-target="#edicionexampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg> Editar perfil</a>
            </div>
        </div>
    </div>-->

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
</body>

</html>

<?php 

}else{
  echo "NO ENTRES INTRUSO";
  
  Header("refresh:5; url=../index.php");
}


?>