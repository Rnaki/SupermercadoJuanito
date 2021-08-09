<?php
include("conexion.php");
$conn=conectar();

$id_sucursal=$_POST["id_sucursal"];
$id_bodega=$_POST["id_bodega"];
$region_sucursal=$_POST["region_sucursal"];
$comuna_sucursal=$_POST["comuna_sucursal"];
$calle_sucursal=$_POST["calle_sucursal"];
$numero_calle_sucursal=$_POST["numero_calle_sucursal"];
$fono_sucursal=$_POST["fono_sucursal"];
$nombre_sucursal=$_POST["nombre_sucursal"];

///////
$sql0 ="SELECT id_sucursal FROM sucursal WHERE id_sucursal = '$id_sucursal' ";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: sucursalGerente.php?pagina=1&error=2");
}else{



//en $sql se guarda el insert
$sql=" SELECT insertarSucursal('".$id_sucursal."', '".$id_bodega."', '".$region_sucursal."', '".$comuna_sucursal."', '".$calle_sucursal."', '".$numero_calle_sucursal."', '".$fono_sucursal."', '".$nombre_sucursal."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: sucursalGerente.php");
}else{
    Header("Location: sucursalGerente.php");
}

}
?>