<?php
include("conexion.php");
$conn=conectar();

$rutPersona=$_POST["rutPersona"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT recuperarCliente('".$rutPersona."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: clienteRecuperar.php");
}else{
    
}

?>