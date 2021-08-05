<?php
session_start();
$id_venta = $_SESSION["id_venta"];
include("conexion.php");
$gbd = conectar();
    $idProducto = $_POST['idProducto'];
    try{
        $sql0 = "delete from pertenece where id_producto = '".$idProducto."' and id_venta = '".$id_venta."';";
        $gsent0 = $gbd->prepare($sql0);
        $gsent0->execute();
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

        $info = [$total0];

        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>