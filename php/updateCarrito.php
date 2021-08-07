<?php
session_start();
$id_venta = $_SESSION["id_venta"];
include("conexion.php");
$gbd = conectar();
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    try{
        $sql0 = "UPDATE Pertenece set cantidad = '".$cantidad."' where id_producto = '".$idProducto."' and id_venta = '".$id_venta."';";
        $gsent0 = $gbd->prepare($sql0);
        $gsent0->execute();
        $sql1 = "SELECT ((producto.precio- producto.precio*producto.descuento/100)*pertenece.cantidad) as subtotal from pertenece 
                join producto 
                on producto.id_producto = pertenece.id_producto
                where pertenece.id_producto = '".$idProducto."' and id_venta = '".$id_venta."';";
        $gsent1 = $gbd->prepare($sql1);
        $gsent1->execute();
        $resultado = $gsent1->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
        $subtotal = $row["subtotal"];
        }

        
        $sql2 = "SELECT  SUM(precio * cantidad) as total FROM pertenece 
        join producto
        on pertenece.id_producto = producto.id_producto
        where pertenece.id_venta = '".$id_venta."'";
        $gsent3 = $gbd->prepare($sql2);
        $gsent3->execute();
        $resultado2 = $gsent3->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado2 as $row2) {
        $total0 = $row2["total"];
        }

        $info = [$subtotal, $total0];

        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>