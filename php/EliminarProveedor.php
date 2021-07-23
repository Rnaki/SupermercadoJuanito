<?php
include("conexion.php");
$conn=conectar();

$rutProveedor=$_POST["rutProveedor"];

$sql="SELECT eliminarProveedor('".$rutProveedor."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: proveedor.php");
}else{
    
}

?>