<?php
include("conexion.php");
$conn=conectar();

 $updateIdSucursal=$_POST["updateIdSucursal"];
 $updateIdBodega=$_POST["updateIdBodega"];
 $updateRegionSucursal=$_POST["updateRegionSucursal"];
 $updateComunaSucursal=$_POST["updateComunaSucursal"];
 $updateCalleSucursal=$_POST["updateCalleSucursal"];
 $updateNumeroCalleSucursal=$_POST["updateNumeroCalleSucursal"];
 $updateFonoSucursal=$_POST["updateFonoSucursal"];
 $updateNombreSucursal=$_POST["updateNombreSucursal"];
 $updateCantidadTrabajadores=$_POST["updateCantidadTrabajadores"];


$sql = "SELECT updateSucursal('".$updateIdSucursal."', '".$updateIdBodega."', '".$updateRegionSucursal."', '".$updateComunaSucursal."', '".$updateCalleSucursal."', '".$updateNumeroCalleSucursal."', '".$updateFonoSucursal."', '".$updateNombreSucursal."', '".$updateCantidadTrabajadores."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: sucursalGerente.php");
}

?>