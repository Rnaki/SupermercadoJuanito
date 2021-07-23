<?php

include("conexion.php");
$gbd = conectar();
  $idProducto = $_POST['idProducto'];
 
    try{
        $sql = "SELECT id_producto, producto.id_categoria, nombre_producto, marca, precio, nombre_categoria FROM producto 
                JOIN categoria
                ON producto.id_categoria = categoria.id_categoria
        WHERE id_producto = '".$idProducto."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
            $idProducto=$row["id_producto"];
            $idCategoria=$row["id_categoria"];
            $nombreProducto=$row["nombre_producto"];
            $marca=$row["marca"];
            $precio=$row["precio"];
            $nombreCategoria=$row["nombre_categoria"];
        }

        $info = [$idProducto, $idCategoria, $nombreProducto, $marca, $precio, $nombreCategoria];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>