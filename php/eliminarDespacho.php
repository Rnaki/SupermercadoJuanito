<?php
include("conexion.php");
$conn=conectar();

$idDespacho=$_POST["idDespacho"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarDespacho('".$idDespacho."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: despacho.php");
}else{
    
}

?>