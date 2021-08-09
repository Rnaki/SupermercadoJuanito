<?php
include("conexion.php");
$conn=conectar();

//ZONA HORARIA
date_default_timezone_set('America/Santiago');
//FECHA ACTUAL
$fecha_actual = date("Y-m-d");

$id_venta=$_POST["id_venta"];
$rut_persona=$_POST["rut_persona"];
$fecha_expiracion="<?php date('Y-m-d',strtotime($fecha_actual.'+ 1 month'));?>";
$cantidad_monetaria='10000';

$sql0 ="SELECT id_venta FROM cupon WHERE id_venta = '$id_venta'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: lobby.php?error=2");
}else{

}


$sql="INSERT INTO cupon (id_venta, rut_persona, fecha_expiracion, cantidad_monetaria) VALUES ($id_venta,'$rut_persona',$fecha_expiracion,$cantidad_monetaria)";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: lobby.php");
}else{
    Header("Location: lobby.php");
}

?>