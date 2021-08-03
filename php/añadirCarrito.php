<?php
include("conexion.php");
$conn=conectar();
session_start();
$id_venta = $_SESSION["id_venta"];
$id_producto=$_POST["id_producto"];
$cantidad=$_POST["cantidad"];

$columna = 0;
$sql0="SELECT * FROM pertenece where id_venta = '".$id_venta."' and id_producto = $id_producto";
$gsent = $conn->prepare($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){

    $columna ++;
}
if($columna == 1){
    echo 2;
}else{


    //INGRESAR AL CARRITO//
    $sql="INSERT INTO pertenece (id_venta, id_producto, cantidad) values ('".$id_venta."',
                                                                        '".$id_producto."',
                                                                        '".$cantidad."')";
    echo $conn->exec($sql);
}

?>