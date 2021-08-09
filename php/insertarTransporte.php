<?php
include("conexion.php");
$conn=conectar();

$patente=$_POST["patente"];
$tipoTransporte=$_POST["tipoTransporte"];
$idSucursal=$_POST["idSucursal"];

/*
//$idCategoria="67";
$sql0 = "SELECT id_producto FROM producto WHERE nombre_producto = '".$nombreProducto."'; ";
//'". ."' letras y ' ' num
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $idProducto = $row["id_producto"];
    var_dump($idProducto);
}*/

$sql="SELECT patente from transporte where patente = '$patente';";
$conn->exec($sql);
$data = $conn->query($sql)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: transporte.php?pagina=1&error=2");
}else{



//en $sql se guarda el insert
$sql="SELECT insertarTransporte('$patente','".$tipoTransporte."','$idSucursal')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: transporte.php");
}else{
    Header("Location: transporte.php");
}
}
?>