<?php
include("conexion.php");
$conn=conectar();

$rutCliente=$_POST["rutCliente"];

$sql="SELECT eliminarcliente('".$rutCliente."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: perfil.php");
}else{
    
}

?>