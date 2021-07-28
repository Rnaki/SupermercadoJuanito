<?php
include("conexion.php");
$conn=conectar();

$tipoCategoria=$_POST["tipoCategoria"];
$nombreProveedor=$_POST["nombreProveedor"];
$nombreProducto=$_POST["nombreProducto"];
$precio=$_POST["precio"];
$descripcion=$_POST["descripcion"];
$imagen=$_POST["imagen"];
$descuento=$_POST["descuento"];
$marca=$_POST["marca"];

//$idCategoria="67";
$sql0 = "SELECT id_categoria FROM categoria WHERE tipo_categoria = '".$tipoCategoria."'; ";

$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $idCategoria = $row["id_categoria"];
    var_dump($idCategoria);
}


$sql1 = "SELECT rut_proveedor FROM proveedor WHERE nombre_proveedor = '".$nombreProveedor."'; ";

$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $rutProveedor = $row1["rut_proveedor"];
    var_dump($rutProveedor);
}

if(isset($columnas) == 1){
    Header("Location: Interfaz Trabajador web.php?error=2");
}else{

}

//en $sql se guarda el insert
$sql="SELECT insertarProducto('$idCategoria','".$rutProveedor."','".$nombreProducto."','$precio', '".$descripcion."','".$imagen."','$descuento','".$marca."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: Interfaz Trabajador web.php");
}else{
    Header("Location: Interfaz Trabajador web.php");
}

?>