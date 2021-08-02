<?php
session_start();
$_SESSION["sucursal"];

include("conexion.php");
$gbd = conectar();

if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo '<script>alert("El producto ya existe en bodega")</script>';
}

$sql1 = "SELECT id_bodega FROM sucursal WHERE id_sucursal = '".$_SESSION["sucursal"]."';";
//$data = $conn->query($sql)->fetchAll();
$gsent1 = $gbd->prepare($sql1);
$gsent1->execute();
$resultado1 = $gsent1->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado1 as $row1){
    $idBodega = $row1["id_bodega"];
    //var_dump($idBodega); es imprimir
}

//$sql = "SELECT my_function();";
$sql = "SELECT * FROM bodega WHERE id_bodega = '".$idBodega."';";
//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM producto WHERE estado_producto = true;";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
		JOIN categoria ON producto.id_categoria = categoria.id_categoria
        JOIN contiene ON producto.id_producto = contiene.id_producto
		where estado_producto = true and contiene.id_bodega = '".$idBodega."';";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
    $idBuscar = $_POST["idBuscar"];
    $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
            JOIN categoria ON producto.id_categoria = categoria.id_categoria
            JOIN contiene ON producto.id_producto = contiene.id_producto
            where estado_producto = true and producto.id_producto = '$idBuscar' and contiene.id_bodega = '".$idBodega."';";
} else if (isset($_POST["nombreBuscar"])) {
    $nombreBuscar = $_POST["nombreBuscar"];
    if ($_POST["nombreBuscar"] == "") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN contiene ON producto.id_producto = contiene.id_producto
                where estado_producto = true and contiene.id_bodega = '".$idBodega."';";
    } else {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN contiene ON producto.id_producto = contiene.id_producto
                where estado_producto = true and upper(producto.nombre_producto) like upper('%$nombreBuscar%') and contiene.id_bodega = '".$idBodega."';";
    }
} else if (isset($_POST["nombreCategoria"]) && isset($_POST["marca"]) && $_POST["nombreCategoria"] !== " " && $_POST["marca"] !== " ") {
    $idCategoria = $_POST["nombreCategoria"];
    $marca = $_POST["marca"];
    if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] == "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN contiene ON producto.id_producto = contiene.id_producto
                where estado_producto = true and categoria.id_categoria = '$idCategoria' and contiene.id_bodega = '".$idBodega."';";
    } else if ($_POST["nombreCategoria"] == "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN contiene ON producto.id_producto = contiene.id_producto
                where estado_producto = true and marca = '$marca' and contiene.id_bodega = '".$idBodega."';";
    } else if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, contiene.stock as tstock FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN contiene ON producto.id_producto = contiene.id_producto
                where estado_producto = true and categoria.id_categoria = '$idCategoria' and marca = '$marca' and contiene.id_bodega = '".$idBodega."';";
    }
}

$gsent3 = $gbd->prepare($sql3);
$gsent3->execute();
$resultado3 = $gsent3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT sum(stock) FROM contiene where id_bodega = '".$idBodega."';";
//$data = $conn->query($sql)->fetchAll();
$gsent4 = $gbd->prepare($sql4);
$gsent4->execute();
$resultado4 = $gsent4->fetchAll(PDO::FETCH_ASSOC);

$sql5 = "SELECT * FROM categoria;";
$gsent5 = $gbd->prepare($sql5);
$gsent5->execute();
$resultado5 = $gsent5->fetchAll(PDO::FETCH_ASSOC);

$sql6 = "SELECT distinct marca FROM producto where estado_producto = true order by marca";
$gsent6 = $gbd->prepare($sql6);
$gsent6->execute();
$resultado6 = $gsent6->fetchAll(PDO::FETCH_ASSOC);

/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de Bodega</title>
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
            font-family: "Varela Round", sans-serif;
        }

        div .primero .col {
            text-align: right;
        }

        div .col-sm-6 h4 {
            margin-top: 1%;
        }

        .table-responsive .table h5 {
            font-size: 18.5px;
        }

        .table-responsive .tab td {
            font-size: 15.6px;
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

        div .row .buscar label,
        div .accordion-body h5 {
            font-size: 19px;
            font-weight: 500;
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

<body class="body-infoB">
    <header class="site-header sticky-top py-1">
        <nav class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="Menu_trabajador.php">Volver</a>
            <a class="py-2 d-none d-md-inline-block" href="infoSucursal.php">Sucursal</a>
            <h2 class="letrah2">INFORMACIÓN DE BODEGA</h2>

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
    <div style="height:30px"></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row primero">
                        <div class="col-sm-6">
                            <h4>DETALLES: </h4>
                        </div>
                        <div class="col-sm-6 col">
                            <a class="btn btn-success b1" data-bs-toggle="modal" data-bs-target="#creacionEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg> Añadir Producto</a>
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
                                                <form action="infoBodega.php" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Producto" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="infoBodega.php" method="POST" class="d-flex">
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
                                                <form action="infoBodega.php" method="POST" class="d-flex">
                                                    <select class="form-select" name="nombreCategoria" id="nombreCategoria" required>
                                                        <option selected>Seleccione...</option>
                                                        <?php
                                                        foreach ($resultado5 as $row5) {
                                                            echo "<option id=" . $row5["id_categoria"] . " value=" . $row5['id_categoria'] . ">" . $row5["nombre_categoria"] . "</option>";
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
                                                    foreach ($resultado6 as $row6) {
                                                        echo "<option id=" . $row6["id_producto"] . " value=" . $row6['marca'] . ">" . $row6["marca"] . "</option>";
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
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <div class="row">
                            <div class="col-sm-3">
                                <th>
                                    <h5><b>Id Bodega: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["id_bodega"] . '</td>';
                                }
                                ?>
                            </div>
                            <th></th>
                            <th></th>
                            <div class="col-sm-3">
                                <th>
                                    <h5><b>Región: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["region_bodega"] . '</td>';
                                }
                                ?>
                            </div>
                        </div>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <th></th>
                        <div class="row">
                            <div class="col-sm-3">
                                <th>
                                    <h5><b>Comuna: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["comuna_bodega"] . '</td>';
                                }
                                ?>
                            </div>
                            <div class="col-sm-3">
                                <th style="text-align: center;">
                                    <h5><b>Calle: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td style="text-align: center;">' . $row["calle_bodega"] . '</td>';
                                }
                                ?>
                            </div>
                            <div class="col-sm-3">
                                <th>
                                    <h5><b>N° Calle: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["numero_calle_bodega"] . '</td>';
                                }
                                ?>
                            </div>
                        </div>
                    </tr>
                </table>
                <table class="table table-striped table-hover tab">
                    <tr>
                        <div class="row">
                            <div class="col-sm-3">
                                <th style="padding-right: 120px;"></th>
                                <th>
                                    <h5><b>Total de Stock: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                foreach ($resultado4 as $row4) {
                                    echo '<td>' . $row4["sum"] . '</td>';
                                }
                                ?>
                                <th style="padding-left: 120px;"></th>
                            </div>
                        </div>
                    </tr>
                </table>
                <table class="table table-striped table-hover" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                            <!--Que productos tiene cada, la cantidad, almacenamiento-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado3 as $row3) {
                            echo '<tr>';
                            echo '<td>' . $row3["id_producto"] . '</td>';
                            echo  '<td>' . $row3["nombre_producto"] . '</td>';
                            echo  '<td>' . $row3["tnombre_categoria"] . '</td>';
                            echo  '<td>' . $row3["marca"] . '</td>';
                            echo  '<td>' . $row3["tstock"] . '</td>';
                            echo "<td>
                            <a href='' onclick='mostrarUpdateInfoBodega(\"" . $row3['id_producto'] . "\",\"" . $row3['id_bodega'] . "\")' class='envio' data-bs-toggle='modal' data-bs-target='#envioEmployeeModal' data-backdrop='static' data-keyboard='false' ><svg 
                                    xmlns='http://www.w3.org/2000/svg' width='17' height='17' fill='currentColor' 
                                    class='bi bi-check-circle-fill' viewBox='0 0 16 16'>
                                    <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
                                </svg></a>
                                <a href='' onclick='mostrarUpdateInfoBodega(\"" . $row3['id_producto'] . "\",\"" . $row3['id_bodega'] . "\")' class='edit' data-bs-toggle='modal' data-bs-target='#edicionexampleModal' data-backdrop='static' data-keyboard='false' ><svg
                                    xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                    <path
                                        d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
                                </svg></a>";
                            echo "<a href='' onclick='eliminarInfoBodega(\"" . $row3['id_producto'] . "\")' class='delete' data-bs-toggle='modal' ><svg
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
    <div class="modal fade" id="creacionEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="insertarInfoBodega.php">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>Nombre Producto: </label>
                            <br>
                            <select class="form-select" name="id_producto" id="id_producto" required>
                                <option selected>Seleccione...</option>
                                <?php
                                foreach ($resultado2 as $row2) {
                                    echo "<option id=" . $row2["id_producto"] . " value=" . $row2['id_producto'] . ">" . $row2["nombre_producto"] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="form-group">
                                <label>Stock: </label>
                                <input type="text" class="form-control" name="stock" id="ingresarStock" required>
                                <?php
                                foreach ($resultado1 as $row1) {
                                    echo '<input type="hidden" name="idBodega" class="form-control" value="'.$row1["id_bodega"].'">';
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success cread">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Envio-->
    <div class="modal fade" id="envioEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Enviar Producto a Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="envioInfoBodega.php">
                        <div class="form-group">
                            <label>ID Producto: </label>
                            <input type="text" class="form-control updateIdProducto" name="envioIdProducto" disabled>
                            <input class="updateIdProducto" name="envioIdProducto" type="hidden">
                            <div class="form-group">
                                <label>Nombre Producto: </label>
                                <input type="text" class="form-control" id="NombreProducto" disabled>
                            </div>
                            <!-- Stock visto
                            <div class="form-group">
                                <label>Stock: </label>
                                
                                <input class="form-control" name="actualStock" id="actualStock" type="hidden">
                            </div> -->
                            <div class="form-group">
                                <label>Stock a enviar a Sucursal: </label>
                                <input type="text" class="form-control" name="envioStock" id="stock" required>
                                <input class="form-control" name="actualStock" id="actualStock" type="hidden">
                                <?php
                                foreach ($resultado1 as $row1) {
                                    echo '<input type="hidden" name="envioIdBodega" class="form-control" value="'.$row1["id_bodega"].'">';
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" onclick="return verificarStockBo();" class="btn btn-success cread">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edicion-->
    <div class="modal fade" id="edicionexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edi">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updateInfoBodega.php">
                        <div class="form-group">
                            <label>ID Producto: </label>
                            <input type="text" class="form-control updateIdProducto" name="updateIdProducto" disabled>
                            <input class="updateIdProducto" name="updateIdProducto" type="hidden">
                            <div class="form-group">
                                <label>Nombre Producto: </label>
                                <input type="text" class="form-control" id="updateNombreProducto" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tipo: </label>
                                <input type="text" class="form-control" id="updateNombreCategoria" disabled>
                            </div>
                            <div class="form-group">
                                <label>Marca: </label>
                                <input type="text" class="form-control" id="updateMarca" disabled>
                            </div>
                            <div class="form-group">
                                <label>Stock: </label>
                                <input type="text" class="form-control" name="updateStock" id="updateStock" required>
                                <input type="hidden" id="actualStock1" required>
                                <?php
                                foreach ($resultado1 as $row1) {
                                    echo '<input type="hidden" name="updateIdBodega" class="form-control" value="'.$row1["id_bodega"].'">';
                                }
                                ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Estas seguro que quieres eliminar este producto?</label>
                        <div style="height:16px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="eliminarInfoBodega">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>