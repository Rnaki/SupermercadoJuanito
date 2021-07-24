<?php
include("conexion.php");
$conn=conectar();

$id_despacho=$_POST["id_despacho"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarDespacho('".$id_despacho."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: despacho.php");
}else{
    
}

?>