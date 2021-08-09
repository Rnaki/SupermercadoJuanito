<?php
include("conexion.php");
$conn=conectar();

 echo $updateIdBodega=$_POST["updateIdBodega"];
 $updateRegionBodega=$_POST["updateRegionBodega2"];
 $updateComunaBodega=$_POST["updateComunaBodega2"];
 echo $updateCalleBodega=$_POST["updateCalleBodega"];
 $updateNumeroCalleBodega=$_POST["updateNumeroCalleBodega"];


$sql = "SELECT updatebodega('".$updateIdBodega."', '".$updateRegionBodega."', '".$updateComunaBodega."', '".$updateCalleBodega."', '".$updateNumeroCalleBodega."')";
echo $conn->exec($sql);

if($conn){
   Header("Location: bodegaGerente.php");
}

?>