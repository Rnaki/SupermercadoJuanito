<?php
session_start();
$_SESSION["sucursal"];

include("conexion.php");
$gbd = conectar();

if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo '<script>alert("La patente ya existe en transporte")</script>';
}

//$sql = "SELECT my_function();";
$sql = "SELECT patente ,tipo_transporte, transporte.id_sucursal , sucursal.nombre_sucursal, sucursal.fono_sucursal FROM transporte
        JOIN sucursal ON sucursal.id_sucursal = transporte.id_sucursal
        WHERE transporte.id_sucursal = '".$_SESSION["sucursal"]."';";

//BUSCADOR
if (isset($_POST["patente"]) && ($_POST["patente"] != '')) {
	$patente = $_POST["patente"];
	$sql = "SELECT patente ,tipo_transporte, transporte.id_sucursal , sucursal.nombre_sucursal, sucursal.fono_sucursal FROM transporte
            JOIN sucursal ON sucursal.id_sucursal = transporte.id_sucursal
            WHERE upper(patente) like upper('$patente%') and transporte.id_sucursal = '".$_SESSION["sucursal"]."';";
} else if (isset($_POST["tipoTransporte"])) {
	$tipoTransporte = $_POST["tipoTransporte"];
	if ($_POST["tipoTransporte"] == "") {       
        $sql = "SELECT patente ,tipo_transporte, transporte.id_sucursal , sucursal.nombre_sucursal, sucursal.fono_sucursal FROM transporte
                JOIN sucursal ON sucursal.id_sucursal = transporte.id_sucursal
                WHERE transporte.id_sucursal = '".$_SESSION["sucursal"]."';";
	} else {
        $sql = "SELECT patente ,tipo_transporte, transporte.id_sucursal , sucursal.nombre_sucursal, sucursal.fono_sucursal FROM transporte
                JOIN sucursal ON sucursal.id_sucursal = transporte.id_sucursal
                WHERE upper(tipo_transporte) like upper('$tipoTransporte%') and transporte.id_sucursal = '".$_SESSION["sucursal"]."';";
	}
}

$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

$sql1 = "SELECT * from sucursal WHERE id_sucursal = '".$_SESSION["sucursal"]."';";
$gsent1 = $gbd->prepare($sql1);
$gsent1->execute();
$resultado1 = $gsent1->fetchAll(PDO::FETCH_ASSOC);


//var_dump($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporte</title>
    <link rel="stylesheet" href="../bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilosDaniel.css">
    <!-- JS BOOTSTRAP -->
    <script src="../jquery/jquery.min.v3.6.0.js"></script>
    <script src="../bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
    <script src="../popper/popper.min.js"></script>
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
    </style>

</head>

<body>
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="despacho.php">Despacho</a>
            <?php
                foreach ($resultado1 as $row1) {
                    echo '<h2 class="letrah2" style="text-transform: uppercase;">TRANSPORTE '.$row1["nombre_sucursal"].'</h2>';
                }
            ?>
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
                            <?php
                                foreach ($resultado1 as $row1) {
                                    echo '<h4 style="text-transform: uppercase;">TRANSPORTE '.$row1["nombre_sucursal"].': </h4>';
                                }
                                ?>
                        </div>
                        <div class="col-sm-6 col">
                        <a class="btn btn-success b1" data-bs-toggle="modal"
                                data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg> Añadir Transporte</a>
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
                                                <h5>Patente: </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Tipo de Transporte: </h5>
                                            </div>
                                        </div>
                                        <div class="row segundo">
                                            <div class="col-sm-6">
                                                <form action="transporte.php" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="patente" placeholder="Patente" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="transporte.php" method="POST" class="d-flex">
                                                <input class="form-control me-3" type="search" name="tipoTransporte" placeholder="Tipo de Transporte" aria-label="Search">
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
                            <th></th>
                            <th>Patente</th>
                            <th>Tipo Transporte</th>
                            <th>Acciones</th>
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado as $row){
                            echo '<tr>';
                            echo '<td></td>';
                            echo  '<td>'.$row["patente"].'</td>';
                            echo  '<td>'.$row["tipo_transporte"].'</td>';
                            echo "<td>
                            <a href='' onclick='mostrarUpdateTransporte(\"".$row['patente']."\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='eliminarTransporte(\"".$row['patente']."\")' class='delete' data-bs-toggle='modal' ><svg
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
    <!-- Modal de Creacion-->
    <div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="insertarTransporte.php">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>Patente: </label>
                            <input name="patente" type="text" class="form-control" required>
                            <div class="form-group">
                                <label>Tipo de Transporte: </label>
                                <input name="tipoTransporte" type="text" class="form-control" required>
                                <?php
                                foreach ($resultado1 as $row1) {
                                    echo '<input type="hidden" name="idSucursal" class="form-control" value="'.$row1["id_sucursal"].'">';
                                }
                                ?>
                            </div>
                            <div style="height:20px"></div>
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
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateTransporte.php">
                        <div class="form-group">
                            <label>Patente: </label>
                            <input type="text" id="updatePatente" class="form-control updatePatente" disabled>
                            <input class="updatePatente" name="updatePatente" type="hidden">
                            <div class="form-group">
                                <label>Tipo de Transporte: </label>
                                <input name="updateTipoTransporte" type="text" id="updateTipoTransporte" class="form-control" required>
                            </div>
                            <br>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Estas seguro que eliminar este transporte?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="eliminarTransporte" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>