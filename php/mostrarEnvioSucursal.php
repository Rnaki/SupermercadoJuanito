<?php

include("conexion.php");
$gbd = conectar();
$idProducto = $_POST['idProducto'];
$idSucursal = $_POST['idSucursal'];

try {
    $sql = "SELECT stock_sucursal, incluye.id_producto, producto.nombre_producto FROM incluye 
            join producto on producto.id_producto = incluye.id_producto 
            WHERE incluye.id_producto = '$idProducto' and incluye.id_sucursal = '".$idSucursal."';";
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $row) {
        $idProducto = $row["id_producto"];
        $nombreProducto = $row["nombre_producto"];
        $stockSucursal = $row["stock_sucursal"];
    }

    $info = [$idProducto, $nombreProducto, $stockSucursal];
    echo json_encode($info);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>