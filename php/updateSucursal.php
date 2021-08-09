<?php
include("conexion.php");
$conn=conectar();

 $updateIdSucursal=$_POST["updateIdSucursal2"];
 $updateIdBodega=$_POST["updateIdBodega2"];
 $updateRegionSucursal=$_POST["updateRegionSucursal2"];
 $updateComunaSucursal=$_POST["updateComunaSucursal2"];
 $updateCalleSucursal=$_POST["updateCalleSucursal"];
 $updateNumeroCalleSucursal=$_POST["updateNumeroCalleSucursal"];
 $updateFonoSucursal=$_POST["updateFonoSucursal"];
 $updateNombreSucursal=$_POST["updateNombreSucursal"];


$sql = "SELECT updateSucursal('".$updateIdSucursal."', '".$updateIdBodega."', '".$updateRegionSucursal."', '".$updateComunaSucursal."', '".$updateCalleSucursal."', '".$updateNumeroCalleSucursal."', '".$updateFonoSucursal."', '".$updateNombreSucursal."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: sucursalGerente.php");
}

?>