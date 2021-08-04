<?php

include("conexion.php");
$gbd = conectar();
  $idProducto = $_POST['idProducto'];
 
    try{
        $sql = "SELECT id_producto, producto.id_categoria, producto.rut_proveedor,nombre_producto, marca, descripcion, precio, imagen, descuento, nombre_categoria, proveedor.nombre_proveedor FROM producto 
                JOIN categoria ON producto.id_categoria = categoria.id_categoria
                JOIN proveedor ON producto.rut_proveedor = producto.rut_proveedor
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
            //$imagen=$row["imagen"];
            $descripcion=$row["descripcion"];
            $descuento=$row["descuento"];
            $nombreCategoria=$row["nombre_categoria"];
            $rutProveedor=$row["rut_proveedor"];
        }

        $info = [$idProducto, $idCategoria, $nombreProducto, $marca, $precio, $descuento, $descripcion, $nombreCategoria, $rutProveedor];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>