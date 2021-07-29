<?php
    session_start();
    echo $_SESSION["rut_persona"];
    session_destroy();


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
            <a class="py-2 d-none d-md-inline-block text-white " href="../index.php">Cerrar sesión</a>

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
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Calle: </h5>
                        </th>
                        <td>Salmon</td>
                        <th></th>
                        <th>
                            <h5>Nº Calle: </h5>
                        </th>
                        <td>32</td>
                    </tr>
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
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Contraseña: </h5>
                        </th>
                        <td>seba</td>
                        <th></th>
                        <th>
                            <h5>Correo: </h5>
                        </th>
                        <td>luis@gmail.com</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <h5>Telefono: </h5>
                        </th>
                        <td>32454365</td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
                <a class="btn btn-warning pedido" data-bs-toggle="modal" data-bs-target="#edicionexampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg> Editar perfil</a>
            </div>
        </div>
    </div>



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
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group form">
                            <div class="form-group">
                                <label>Rut: </label>
                                <input type="text" class="form-control c" name="nombre" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nombre: </label>
                                <input type="text" class="form-control c" name="nombre" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno: </label>
                                <input type="text" class="form-control c" name="apellidoP" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno: </label>
                                <input type="text" class="form-control c" name="apellidoM" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Region: </label>
                                <input type="text" class="form-control c" name="region" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Comuna: </label>
                                <input type="text" class="form-control c" name="comuna" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Calle: </label>
                                <input type="text" class="form-control c" name="calle" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Nª Calle: </label>
                                <input type="text" class="form-control c" name="ncalle" maxlength="32">
                            </div>
                            <div class="form-group">
                                <label>Fecha Nacimiento: </label>
                                <input type="text" class="form-control c" name="fechaNacimiento">
                            </div>
                            <label>Sexo: </label>
                            <br>
                            <select class="form-select" name="sexo">
                                <option value="Hombre" id="Hombre">Hombre</option>
                                <option value="Mujer" id="Mujer">Mujer</option>
                                <option value="Otros" id="Otros">Otros</option>
                            </select>
                            <br>
                            <div class="form-group">
                                <label>Contraseña: </label>
                                <input type="text" class="form-control c" name="Contraseña" maxlength="12">
                            </div>
                            <div class="form-group">
                                <label>Correo: </label>
                                <input type="text" class="form-control c" name="Correo" maxlength="64">
                            </div>
                            <div class="form-group">
                                <label>Teléfono: </label>
                                <input type="text" class="form-control c" name="Telefono" maxlength="16">
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