<?php

include("conexion.php");
$gbd = conectar();

//$sql = "SELECT my_function();";
$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
        JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal
        where proceso_despacho = 'En proceso' or proceso_despacho= 'En camino' ";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
	$idBuscar = $_POST["idBuscar"];
	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
                JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal where id_despacho = '$idBuscar' ";
} else if (isset($_POST["estadoBuscar"])) {
	$estadoBuscar = $_POST["estadoBuscar"];
	if ($_POST["estadoBuscar"] == "Seleccione...") {       
        $sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
        JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal
        where proceso_despacho = 'En proceso' or proceso_despacho= 'En camino' ";
	} else {
        echo 2;
        echo	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
                        JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal  where proceso_despacho = '$estadoBuscar'";
	}
} else if (isset($_POST["desde"]) && isset($_POST["hasta"]) && $_POST["desde"] !== "" && $_POST["hasta"] !== "") {
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];
	$sql = "SELECT *, sucursal.nombre_sucursal as tnombre_sucursal FROM despacho 
            JOIN sucursal ON despacho.id_sucursal = sucursal.id_sucursal where fecha_limite Between '$desde' and '$hasta' and (proceso_despacho = 'En proceso' or proceso_despacho = 'En camino')";
} 




$gsent = $gbd->prepare($sql);
$gsent->execute();

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

//var_dump($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despachos</title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilosDaniel.css">
    <!-- JS BOOTSTRAP -->
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
    <script src="../popper/popper.min.js"></script>
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
    </style>

</head>

<body>
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="menu_trabajador.php">Volver</a>
            <h2 class="letrah2">INFORMACIÓN DE DESPACHO</h2>
            <a class="py-2 d-none d-md-inline-block" href="../index.php">Cerrar sesión</a>
        </nav>
    </header>
    <div style="height:50px"></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row primero">
                        <div class="col-sm-6">
                            <h4>DESPACHOS: </h4>
                        </div>
                        <div class="col-sm-6 col">
                            <a class="btn btn-success b1"  href="despachosEntregados.php" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg> Despachos Entregados</a>
                                <a class="btn btn-danger" href="transporte.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
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
                                                <h5>ID Despacho: </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Estado: </h5>
                                            </div>
                                        </div>
                                        <div class="row segundo">
                                            <div class="col-sm-6">
                                                <form action="despacho.php" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Despacho" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="despacho.php" method="POST" class="d-flex">
                                                    <select class="form-select" name="estadoBuscar">
                                                        <option selected>Seleccione...</option>
                                                        <option value="En proceso" >En proceso</option>
                                                        <option value="En camino" >En camino</option>
                                                    </select>
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Fecha de Entrega: </h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 buscar">
                                                <label> Desde: </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <form action="despacho.php" method="POST" class="d-flex">
                                                    <input class="form-control me-2" type="date" name="desde" placeholder="Fecha" aria-label="Search">
                                            </div>
                                            <div class="col-sm-1 buscar">
                                                <label> Hasta: </label>
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
                            <th></th>
                            <th>ID Despacho</th>
                            <th>Nombre Sucursal</th>
                            <th>Patente</th>
                            <th>Información de envío</th>
                            <th>Fecha Limite</th>
                            <th>Fecha Entrega</th>
                            <th>Proceso despacho</th>
                            <th>Acciones</th>
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado as $row){
                            echo '<tr>';
                            echo '<td>'.$row["id_despacho"].'<a href="crearDespacho.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path
                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg></a></td>';
                            echo  '<td>'.$row["id_despacho"].'</td>';
                            echo  '<td>'.$row["tnombre_sucursal"].'</td>';
                            echo  '<td>'.$row["patente"].'</td>';
                            echo  '<td>'.$row["informacion_envio"].'</td>';
                            echo  '<td>'.$row["fecha_limite"].'</td>';
                            echo  '<td>'.$row["fecha_entrega"].'</td>';
                            echo  '<td>'.$row["proceso_despacho"].'</td>';


                            echo "<td>
                            <a href='' onclick='mostrarUpdateDespacho(\"".$row['id_despacho']."\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='eliminarDespacho(\"".$row['id_despacho']."\")' class='delete' data-bs-toggle='modal' ><svg
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

    <!-- Modal de InfoDespacho-->
    <div class="modal fade" id="infoDespachoEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog infodespacho">
            <div class="modal-content">
                <div class="modal-header info">
                    <h5 class="modal-title" id="exampleModalLabel">Información del Cliente</h5>
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
                                <label><strong>Región: </strong> Tarapaca</label>
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
                                <td>Néctar Andina del Valle durazno</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Despacho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Despacho: </label>
                        <input type="text" class="form-control" required>
                        <div class="form-group">
                            <label>ID Sucursal: </label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Patente: </label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Información de envio: </label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha limite: </label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha entrega: </label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Proceso de despacho: </label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success cread">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edicion-->
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Despacho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateDespacho.php">
                        <div class="form-group">
                            <label>ID Despacho: </label>
                            <input type="text" id="updateIdDespacho" class="form-control" disabled>
                            <input class="updateIdDespacho" name="updateIdDespacho" type="hidden">
                            <div class="form-group">
                                <label>ID Sucursal: </label>
                                <input name="updateIdSucursal" type="text" id="updateIdSucursal" class="form-control" disabled>
                                <input name="idUpdateDespacho" type="hidden" id="idUpdateDespacho" value="">
                            </div>
                            <div class="form-group">
                                <label>Patente: </label>
                                <input name="updatePatente" type="text" id="updatePatente" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Información de envio: </label>
                                <input name="updateInformacion" type="text" id="updateInformacion" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Fecha limite: </label>
                                <input name="updateFechaLimite" type="text" id="updateFechaLimite" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Fecha entrega: </label>
                                <input name="updateFechaEntrega" type="text" id="updateFechaEntrega" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Proceso despacho: </label>
                                <br>
                                    <select id="UpdateEstadoDespacho" class="form-select" name="updateProcesoDespacho" id="" aria-label="Default select example">
                                        <option selected>Seleccione...</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="En camino">En camino</option>
                                        <option value="Entregado">Entregado</option>
                                    </select>
                                <br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Despacho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Estas seguro que quieres archivar el despacho?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="eliminarDespacho" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>