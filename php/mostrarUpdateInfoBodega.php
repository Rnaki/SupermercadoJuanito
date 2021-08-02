<?php

include("conexion.php");
$gbd = conectar();
$idProducto = $_POST['idProducto'];
$idBodega = $_POST['idBodega'];

try {
    $sql = "SELECT contiene.id_producto, producto.nombre_producto, categoria.id_categoria, marca, categoria.nombre_categoria, stock, incluye.stock_sucursal FROM contiene 
                JOIN producto ON producto.id_producto = contiene.id_producto
                JOIN categoria ON categoria.id_categoria = producto.id_categoria
                JOIN incluye ON incluye.id_producto  = contiene.id_producto
        WHERE contiene.id_producto = '$idProducto' and id_bodega = '$idBodega';";
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $row) {
        $idProducto = $row["id_producto"];
        $nombreProducto = $row["nombre_producto"];
        $idCategoria = $row["id_categoria"];
        $marca = $row["marca"];
        $nombreCategoria = $row["nombre_categoria"];
        $stock = $row["stock"];
        $stockSucursal = $row["stock_sucursal"];
    }

    $info = [$idProducto, $nombreProducto, $idCategoria, $marca, $nombreCategoria, $stock, $nombreProducto, $stock, $stock, $stockSucursal];
    echo json_encode($info);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>