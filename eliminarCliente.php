<?php
include("conexion.php");
$conn=conectar();

$rut=$_GET["rut"];

$sql="DELETE FROM cliente WHERE rut='$rut'";
echo $conn->exec($sql);
if($conn){
    Header("Location: cliente.php");
}else{
    
}

?>