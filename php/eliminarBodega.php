<?php
include("conexion.php");
$conn=conectar();

$id_bodega=$_POST["id_bodega"];


$sql="SELECT eliminarBodega('".$id_bodega."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: bodegaGerente.php");
}else{
    
}

?>