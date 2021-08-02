<?php
include("conexion.php");
$conn=conectar();

$patente=$_POST["patente"];

$sql="SELECT eliminarTransporte('".$patente."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: transporte.php");
}else{
    
}

?>