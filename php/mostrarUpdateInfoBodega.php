<?php

include("conexion.php");
$gbd = conectar();
  $idProducto = $_POST['idProducto'];
 
    try{
        $sql = "SELECT contiene.id_producto, producto.nombre_producto, categoria.id_categoria, marca, categoria.nombre_categoria, stock FROM contiene 
                JOIN producto ON producto.id_producto = contiene.id_producto
                JOIN categoria ON categoria.id_categoria = producto.id_categoria
        WHERE contiene.id_producto = '".$idProducto."';";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $row) {
            $idProducto=$row["id_producto"];
            $nombreProducto=$row["nombre_producto"];
            $idCategoria=$row["id_categoria"];
            $marca=$row["marca"];
            $nombreCategoria=$row["nombre_categoria"];
            $stock=$row["stock"];
        }

        $info = [$idProducto, $nombreProducto, $idCategoria, $marca, $nombreCategoria, $stock, $nombreProducto, $stock];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>