<?php
include("conexion.php");
$conn=conectar();

$rut = $_POST["rut"];
$contraseña =  $_POST["contraseña"];
$sql= "SELECT rut from cliente where rut = '$rut' and contraseña = '$contraseña'";
$gsent = $conn->prepare($sql);
$data = $conn->query($sql)->fetchAll();
$cuenta_col = 0;
foreach ($data as $row){
    echo $row['rut'];
    $cuenta_col ++;
}

if($cuenta_col == 1){
    Header("Location: lobby.php");
}else if($cuenta_col == 0){
    Header("Location: index.php?error=1"); 
} 


?>