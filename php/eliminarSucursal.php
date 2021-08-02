<?php
include("conexion.php");
$conn=conectar();

$id_sucursal=$_POST["id_sucursal"];


$sql="SELECT eliminarSucursal('".$id_sucursal."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: sucursalGerente.php");
}else{
    
}

?>