<?php
include("conexion.php");
$conn=conectar();

$tipoCategoria=$_POST["tipoCategoria"];
$rutProveedor=$_POST["nombreProveedor"];
$nombreProducto=$_POST["nombreProducto"];
$precio=$_POST["precio"];
$descripcion=$_POST["descripcion"];

$nombreImagen=$_FILES['imagen']['name'];
$tipoImagen=$_FILES['imagen']['type'];
$tamanoImagen=$_FILES['imagen']['size'];

$descuento=$_POST["descuento"];
$marca=$_POST["marca"];

$time = strtotime(date('Y-m-d H:1:s'));
$nombreImagen= $time."."."jpg";

//$idCategoria="67";
$sql0 = "SELECT id_categoria FROM categoria WHERE tipo_categoria = '".$tipoCategoria."'; ";

$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $idCategoria = $row["id_categoria"];
    var_dump($idCategoria);
}

/*
$sql1 = "SELECT rut_proveedor FROM proveedor WHERE nombre_proveedor = '".$nombreProveedor."'; ";

$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $rutProveedor = $row1["rut_proveedor"];
    var_dump($rutProveedor);
}*/

if($tamanoImagen <= 1000000){
    if($tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/jpeg"){

        $carpetaDestino = dirname(getcwd()).'/imagenes/';
        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpetaDestino.$nombreImagen);
        //en $sql se guarda el insert
        $sql="SELECT insertarProducto('$idCategoria','".$rutProveedor."','".$nombreProducto."','$precio', '".$descripcion."','".$nombreImagen."','$descuento','".$marca."')";
        //del $con quiero sacar el $sql para que sea un $query
        echo $conn->exec($sql);
        if($conn){
            Header("Location: Interfaz Trabajador web.php");
        }else{
            Header("Location: Interfaz Trabajador web.php");
        }
    }else{
        Header("Location: Interfaz Trabajador web.php?error1=2");
     }
 }else{
    Header("Location: Interfaz Trabajador web.php?error=2");
 }

?>