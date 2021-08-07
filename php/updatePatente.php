<?php
include("conexion.php");
$conn=conectar();

$rut=$_POST["rut"];
$patente=$_POST["patente"];

$sql1="UPDATE trabajador SET patente='".$patente."'
                          WHERE rut_persona='".$rut."'";
echo $conn->exec($sql1);

if($conn){
    Header("Location: asignarTransporte.php");
}

?>