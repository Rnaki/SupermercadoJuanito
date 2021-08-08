<?php

session_start();
include("conexion.php");
$conn=conectar();

$id_venta = $_SESSION["id_venta"];
$metodo_envio=$_POST["metodo_envio"];
$precio_boleta=$_POST["precio_boleta"];
$precio_despacho=$_POST["precio_despacho"];


///////
$sql0 ="SELECT updateventaprecio('".$metodo_envio."',
                                 '".$precio_boleta."',
                                 '".$precio_despacho."',
                                 '".$id_venta."')";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();

if($conn){
    echo 1;
}

?>