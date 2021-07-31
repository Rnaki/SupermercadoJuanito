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

$sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
		JOIN categoria ON producto.id_categoria = categoria.id_categoria
		where estado_producto = false;";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
    $idBuscar = $_POST["idBuscar"];
    $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
			JOIN categoria ON producto.id_categoria = categoria.id_categoria
			where estado_producto = false and id_producto = '$idBuscar';";
} else if (isset($_POST["nombreBuscar"])) {
    $nombreBuscar = $_POST["nombreBuscar"];
    if ($_POST["nombreBuscar"] == "") {
        $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = false;";
    } else {
        $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = false and upper(producto.nombre_producto) like upper('%$nombreBuscar%');";
    }
} else if (isset($_POST["nombreCategoria"]) && isset($_POST["marca"]) && $_POST["nombreCategoria"] !== " " && $_POST["marca"] !== " ") {
    $idCategoria = $_POST["nombreCategoria"];
    $marca = $_POST["marca"];
    if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] == "Seleccione...") {
        $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = false and categoria.id_categoria = '$idCategoria';";
    } else if ($_POST["nombreCategoria"] == "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = false and marca = '$marca';";
    } else if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql = "SELECT *, categoria.nombre_categoria as tnombre_categoria FROM producto 
				JOIN categoria ON producto.id_categoria = categoria.id_categoria
				where estado_producto = false and categoria.id_categoria = '$idCategoria' and marca = '$marca';";
    }
}

$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");

$sql2 = "SELECT * FROM categoria";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT * FROM proveedor";
$gsent3 = $gbd->prepare($sql3);
$gsent3->execute();
$resultado3 = $gsent3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT distinct marca FROM producto where estado_producto = false order by marca";
$gsent4 = $gbd->prepare($sql4);
$gsent4->execute();
$resultado4 = $gsent4->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Eliminados</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
        }

        div .col-sm-6 h4 {
            font-family: 'Varela Round', sans-serif;
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

        div .row .buscar label {
            font-size: 19px;
            font-weight: 500;
        }

        div .accordion-body h5 {
            font-size: 19px;
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

            <a class="py-2 d-none d-md-inline-block" href="Interfaz Trabajador Web.php">Interfaz Trabajador</a>
            <h2 class="letrah2">PRODUCTOS ELIMINADOS</h2>

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

    </header>

    <div style="height:30px"></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row primero">
                        <div class="col-sm-6">
                            <h4>GESTION DE PRODUCTOS ELIMINADOS:</h4>
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
                                                <h5>ID Producto: </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Nombre: </h5>
                                            </div>
                                        </div>
                                        <div class="row segundo">
                                            <div class="col-sm-6">
                                                <form action="interfazProductosEliminados.php" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Producto" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="interfazProductosEliminados.php" method="POST" class="d-flex">
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
                                                <form action="interfazProductosEliminados.php" method="POST" class="d-flex">
                                                    <select class="form-select" name="nombreCategoria" id="nombreCategoria" required>
                                                        <option selected>Seleccione...</option>
                                                        <?php
                                                        foreach ($resultado2 as $row2) {
                                                            echo "<option id=" . $row2["id_categoria"] . " value=" . $row2['id_categoria'] . ">" . $row2["nombre_categoria"] . "</option>";
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
                                                    foreach ($resultado4 as $row4) {
                                                        echo "<option id=" . $row4["id_producto"] . " value=" . $row4['marca'] . ">" . $row4["marca"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
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
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $row) {
                            echo '<tr>';
                            echo '<td>' . $row["id_producto"] . '</td>';
                            echo  '<td>' . $row["nombre_producto"] . '</td>';
                            echo  '<td>' . $row["tnombre_categoria"] . '</td>';
                            echo  '<td>' . $row["marca"] . '</td>';
                            echo  '<td>$' . $row["precio"] . '</td>';
                            echo "<td>
                                <a href='' onclick='devolverProducto(\"" . $row['id_producto'] . "\")' class='envio' data-bs-toggle='modal'><svg
                                    xmlns='http://www.w3.org/2000/svg' width='19' height='19' fill='currentColor' 
                                    class='bi bi-reply-fill' viewBox='0 0 16 16'>
                                    <path d='M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z'/>
                                    </svg></a>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Mostrar <b>5</b> de <b>25</b> entradas</div>
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

    <!-- Modal de devoler producto-->
    <div class="modal fade" id="devolverProducEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title">Devolver Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<div class="form-group">
						<label>¿Estas seguro que quieres devolver este producto?</label>
                        <div style="height:16px"></div>
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="devolProducto" class="btn btn-success cread">Devolver</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>