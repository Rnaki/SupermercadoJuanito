<?php
session_start();

if (isset($_SESSION["rut_persona"])) {
    $_SESSION["sucursal"];
    $_SESSION["rut_persona"];

include("conexion.php");
$gbd = conectar();

    $sql0 = "SELECT * FROM trabajador where rut_persona = '" . $_SESSION["rut_persona"] . "'";
	$gsent0 = $gbd->prepare($sql0);
	$gsent0->execute();
	$perfil = $gsent0->fetchAll(PDO::FETCH_ASSOC);

//$sql = "SELECT my_function();";
$sql = "SELECT * FROM sucursal WHERE id_sucursal = '".$_SESSION["sucursal"]."';";
//$data = $conn->query($sql)->fetchAll();
$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM categoria;";
$gsent2 = $gbd->prepare($sql2);
$gsent2->execute();
$resultado2 = $gsent2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		JOIN categoria ON producto.id_categoria = categoria.id_categoria
        JOIN incluye ON producto.id_producto = incluye.id_producto
		where estado_producto = true and id_sucursal = '".$_SESSION["sucursal"]."' ";

//BUSCADOR
if (isset($_POST["idBuscar"]) && ($_POST["idBuscar"] != '')) {
    $idBuscar = $_POST["idBuscar"];
    $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
            JOIN categoria ON producto.id_categoria = categoria.id_categoria
            JOIN incluye ON producto.id_producto = incluye.id_producto
            where estado_producto = true and producto.id_producto = '$idBuscar' and id_sucursal = '".$_SESSION["sucursal"]."' ";
} else if (isset($_POST["nombreBuscar"])) {
    $nombreBuscar = $_POST["nombreBuscar"];
    if ($_POST["nombreBuscar"] == "") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		        JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN incluye ON producto.id_producto = incluye.id_producto
		        where estado_producto = true and id_sucursal = '".$_SESSION["sucursal"]."' ";
    } else {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		        JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN incluye ON producto.id_producto = incluye.id_producto
		        where estado_producto = true and upper(producto.nombre_producto) like upper('%$nombreBuscar%') and id_sucursal = '".$_SESSION["sucursal"]."' ";
    }
} else if (isset($_POST["nombreCategoria"]) && isset($_POST["marca"]) && $_POST["nombreCategoria"] !== " " && $_POST["marca"] !== " ") {
    $idCategoria = $_POST["nombreCategoria"];
    $marca = $_POST["marca"];
    if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] == "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		        JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN incluye ON producto.id_producto = incluye.id_producto
		        where estado_producto = true and categoria.id_categoria = '$idCategoria' and id_sucursal = '".$_SESSION["sucursal"]."' ";
    } else if ($_POST["nombreCategoria"] == "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		        JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN incluye ON producto.id_producto = incluye.id_producto
		        where estado_producto = true and marca = '$marca' and id_sucursal = '".$_SESSION["sucursal"]."' ";
    } else if ($_POST["nombreCategoria"] != "Seleccione..." && $_POST["marca"] != "Seleccione...") {
        $sql3 = "SELECT *, categoria.nombre_categoria as tnombre_categoria, incluye.stock_sucursal as tstock FROM producto 
		        JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN incluye ON producto.id_producto = incluye.id_producto
		        where estado_producto = true and categoria.id_categoria = '$idCategoria' and marca = '$marca' and id_sucursal = '".$_SESSION["sucursal"]."' ";
    }
}
$gsent3 = $gbd->prepare($sql3);
$gsent3->execute();
$resultado7 = $gsent3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT sum(stock_sucursal) FROM incluye where id_sucursal = '".$_SESSION["sucursal"]."';";
$gsent4 = $gbd->prepare($sql4);
$gsent4->execute();
$resultado4 = $gsent4->fetchAll(PDO::FETCH_ASSOC);

$sql6 = "SELECT distinct marca FROM producto
        join contiene on contiene.id_producto = producto.id_producto 
        where estado_producto = true order by marca;";
$gsent6 = $gbd->prepare($sql6);
$gsent6->execute();
$resultado6 = $gsent6->fetchAll(PDO::FETCH_ASSOC);

//paginador
$xpaginas = 5;
$totalquery = $gsent3->rowCount();
if($totalquery == 0){
	$totalquery = 1;
	$paginas = $totalquery/$xpaginas;
	$paginasElevado = ceil($paginas);
	$totalquery = 0;
	if(!$_GET){
		header('Location: infoSucursal.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: infoSucursal.php?pagina=1');
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
		header('Location: infoSucursal.php?pagina=1');
	}
	if($_GET['pagina'] > $paginasElevado || $_GET['pagina'] <= 0){
		header('Location: infoSucursal.php?pagina=1');
	}

	$iniciar = ($_GET['pagina']-1)*$xpaginas;

	$sqlGuardar = $sql3.' LIMIT :nArticulos OFFSET :iniciar;';
	$gsent3 = $gbd->prepare($sqlGuardar);
	$gsent3->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
	$gsent3->bindParam(':nArticulos', $xpaginas, PDO::PARAM_INT);
	$gsent3->execute();
	$resultado7 = $gsent3->fetchAll(PDO::FETCH_ASSOC);
}


/* Obtener todas las filas restantes del conjunto de resultados */
//print("Obtener todas las filas restantes del conjunto de resultados:\n");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de Sucursal</title>
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
            <a class="py-2 d-none d-md-inline-block" href="infoBodega.php">Bodega</a>
            
            <?php
            foreach ($resultado as $row) {
                echo '<h2 class="letrah2" style="text-transform: uppercase;">'.$row["nombre_sucursal"].'</h2>';
            }
            ?>

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
                    <li><a class="dropdown-item" aria-current="true" href="#">Ver perfil</a></li>
                    <div class="dropdown-divider"></div>
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
                        <div class="col-sm-6">
                            <h4>DETALLES: </h4>
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
                                                <form action="infoSucursal.php?pagina=1" method="POST" class="d-flex">
                                                    <input class="form-control me-3" type="search" name="idBuscar" placeholder="ID Producto" aria-label="Search">
                                                    <button class="btn btn-success b" type="submit">Buscar</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="infoSucursal.php?pagina=1" method="POST" class="d-flex">
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
                                                <form action="infoSucursal.php?pagina=1" method="POST" class="d-flex">
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
                                    <h5><b>Id Sucursal: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["id_sucursal"] . '</td>';
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
                                    echo '<td>' . $row["region_sucursal"] . '</td>';
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
                                    echo '<td>' . $row["comuna_sucursal"] . '</td>';
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
                                    echo '<td style="text-align: center;">' . $row["calle_sucursal"] . '</td>';
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
                                    echo '<td>' . $row["numero_calle_sucursal"] . '</td>';
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
                                <th style="padding-right: 20px;"></th>
                                <th>
                                    <h5><b>Fono: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["fono_sucursal"] . '</td>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <th style="padding-right: 30px;"></th>
                                <th>
                                    <h5><b>Cantidad de Trabajadores: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<td>' . $row["cantidad_trabajadores"] . '</td>';
                                }
                                ?>
                                <th style="padding-left: 30px;"></th>
                            </div>
                            <div class="col-sm-3">
                                <th>
                                    <h5><b>Stock Total: </b></h5>
                                </th>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                foreach ($resultado4 as $row4) {
                                    echo '<td>' . $row4["sum"] . '</td>';
                                }
                                ?>
                                <th style="padding-left: 30px;"></th>
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
                        foreach ($resultado7 as $row7) {
                            echo '<tr>';
                            echo '<td>' . $row7["id_producto"] . '</td>';
                            echo  '<td>' . $row7["nombre_producto"] . '</td>';
                            echo  '<td>' . $row7["tnombre_categoria"] . '</td>';
                            echo  '<td>' . $row7["marca"] . '</td>';
                            echo  '<td>' . $row7["tstock"] . '</td>';
                            echo "<td>
                                <a href='' onclick='mostrarEnvioSucursal(\"" . $row7['id_producto'] . "\",\"" . $row7['id_sucursal'] . "\")' class='envio' data-bs-toggle='modal' data-bs-target='#envioEmployeeModal' data-backdrop='static' data-keyboard='false' ><svg 
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
                <div class="hint-text">Mostrando <b><?php echo $encontrado ?></b> de <b><?php echo $totalquery ?></b> entradas</div>
					<ul class="pagination">
						<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : ''?>"><a href="infoSucursal.php?pagina=<?php echo $_GET['pagina']-1?>" class="page-link">Anterior</a></li>
						<?php for($i=0; $i < $paginasElevado; $i++): ?>
						<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' : ''?>">
							<a href="infoSucursal.php?pagina=<?php echo $i+1?>" class="page-link"><?php echo $i+1?></a>
						</li>
						<?php endfor?>
						<li class="page-item <?php echo $_GET['pagina'] >= $paginasElevado ? 'disabled' : ''?>"><a href="infoSucursal.php?pagina=<?php echo $_GET['pagina']+1?>" class="page-link">Siguiente</a></li>
					</ul>
				</div>
            </div>
        </div>
    </div>

    <!-- Modal de Envio a Bodega-->
    <div class="modal fade" id="envioEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cread">
                    <h5 class="modal-title" id="exampleModalLabel">Devolver Producto a Bodega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="envioSucursal.php">
                        <div class="form-group">
                            <label>ID Producto: </label>
                            <input type="text" class="form-control envioIdProducto" name="envioIdProducto" disabled>
                            <input class="envioIdProducto" name="envioIdProducto" type="hidden">
                            <div class="form-group">
                                <label>Nombre Producto: </label>
                                <input type="text" class="form-control" id="envioNombreProducto" disabled>
                            </div>
                            <div class="form-group">
                                <label>Stock a devolver a Bodega: </label>
                                <input type="number" class="form-control" name="envioStock" id="stock" required>
                                <input class="form-control" name="envioStockSucursal" id="envioStockSucursal" type="hidden">
                                <?php
                                foreach ($resultado as $row) {
                                    echo '<input type="hidden" name="envioIdSucursal" class="form-control" value="'.$row["id_sucursal"].'">';
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" onclick="return verificarStockSu();" class="btn btn-success cread">Enviar</button>
                    </form>
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