<?php
include("conexion.php");
$conn=conectar();

$id_bodega=$_POST["id_bodega"];
$almacenamiento=$_POST["almacenamiento"];
$region_bodega=$_POST["region_bodega"];
$comuna_bodega=$_POST["comuna_bodega"];
$calle_bodega=$_POST["calle_bodega"];
$numero_calle_bodega=$_POST["numero_calle_bodega"];

///////
$sql0 ="SELECT id_bodega FROM bodega WHERE id_bodega = '$id_bodega' ";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: bodegaGerente.php?error=2");
}else{

}

//en $sql se guarda el insert
$sql=" SELECT insertarBodega('".$id_bodega."', '".$almacenamiento."', '".$region_bodega."', '".$comuna_bodega."', '".$calle_bodega."', '".$numero_calle_bodega."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: bodegaGerente.php");
}else{
    Header("Location: bodegaGerente.php");
}

?>