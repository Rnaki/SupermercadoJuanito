<?php
include("conexion.php");
$conn=conectar();

$idProducto=$_POST["idProducto"];

$sql="SELECT eliminarProveedor('".$idProducto."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: Interfaz Trabajador web.php");
}else{
    
}

?>