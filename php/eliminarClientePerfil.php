<?php
include("conexion.php");
$conn=conectar();

$rutCliente=$_POST["rut_persona"];

$sql="SELECT eliminarPerfilCliente('".$rutCliente."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: perfil.php");
}else{
    
}

?>