<?php
include("conexion.php");
$conn=conectar();

$rut_persona=$_POST["rut_persona"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarpersona('".$rut_persona."')";
echo $conn->exec($sql);
$sql2="SELECT eliminarcliente('".$rut_persona."')";
echo $conn->exec($sql2);
if($conn){
    Header("Location: cliente.php");
}else{
    
}

?>