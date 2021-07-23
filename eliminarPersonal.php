<?php
include("conexion.php");
$conn=conectar();

$rut=$_GET["rut"];

$sql="DELETE FROM personal WHERE rut='$rut'";
echo $conn->exec($sql);
if($conn){
    Header("Location: Interfaz RRHH.php");
}else{
    
}

?>