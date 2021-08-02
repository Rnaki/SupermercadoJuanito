<?php
include("conexion.php");
$conn=conectar();

 $updateIdBodega=$_POST["updateIdBodega"];
 $updateAlmacenamiento=$_POST["updateAlmacenamiento"];
 $updateRegionBodega=$_POST["updateRegionBodega"];
 $updateComunaBodega=$_POST["updateComunaBodega"];
 $updateCalleBodega=$_POST["updateCalleBodega"];
 $updateNumeroCalleBodega=$_POST["updateNumeroCalleBodega"];


$sql = "SELECT updatebodega('".$updateIdBodega."','".$updateAlmacenamiento."', '".$updateRegionBodega."', '".$updateComunaBodega."', '".$updateCalleBodega."', '".$updateNumeroCalleBodega."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: bodegaGerente.php");
}

?>