<?php
include("conexion.php");
$conn=conectar();

$tipoCategoria=$_POST["tipoCategoria"];
$rutProveedor="2222222222";
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