<?php
include("conexion.php");
$conn=conectar();

$updateIdProducto=$_POST["updateIdProducto"];
$UpdatetipoCategoria=$_POST["UpdatetipoCategoria"];
$updateNombreProducto=$_POST["updateNombreProducto"];
$updatePrecio=$_POST["updatePrecio"];

//$imagen=addslashes(file_get_contents($_FILES['updateImagen']['tmp_name']));
$updateNombreImagen=$_FILES['updateImagen']['name'];
$updateTipoImagen=$_FILES['updateImagen']['type'];
$updateTamanoImagen=$_FILES['updateImagen']['size'];

$updateDescripcion=$_POST["updateDescripcion"];
$updateDescuento=$_POST["updateDescuento"];
$updateMarca=$_POST["updateMarca"];


$sql0 = "SELECT id_categoria FROM categoria WHERE tipo_categoria = '".$UpdatetipoCategoria."'; ";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $updateIdCategoria = $row["id_categoria"];
    //var_dump($updateIdCategoria);
}

$sql1 = "SELECT imagen FROM producto WHERE imagen = '".$updateNombreImagen."';";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $imagen = $row1["imagen"];
}
if(isset($imagen) == isset($updateNombreImagen)){
    
    "holaaaa";
}

if($updateTamanoImagen <= 1000000){
    if($updateTipoImagen == "image/jpg" || $updateTipoImagen == "image/png" || $updateTipoImagen == "image/jpeg"){
        //$temp=$_FILES['updateImagen']['tmp_name'//];
        //move_uploaded_file($temp,'imagenes' . $updateNombreImagen);
        
        //echo $carpetaDestino=$_SERVER['DOCUMENT_ROOT'] . '/imagenes/';
        //echo "<br>";
        //move_uploaded_file($_FILES['updateImagen']['tmp_name'], '/imagenes/' . $_FILES['updateImagen']['name']);
        echo $carpetaDestino = dirname(getcwd()).'/imagenes/';
        //move_uploaded_file($_FILES['updateImagen']['tmp_name'],$carpetaDestino.$updateNombreImagen);
        move_uploaded_file($_FILES['updateImagen']['tmp_name'],$carpetaDestino.$updateNombreImagen);

        $sql = "SELECT updateProducto2('".$updateIdProducto."', '$updateIdCategoria', '".$updateNombreProducto."', '$updatePrecio', '".$updateNombreImagen."', '".$updateDescripcion."','$updateDescuento', '".$updateMarca."')";
        echo $conn->exec($sql);
        if($conn){
            Header("Location: Interfaz Trabajador web.php");
        }

    }else{
        Header("Location: Interfaz Trabajador web.php?error1=2");
    }
}else{
    Header("Location: Interfaz Trabajador web.php?error=2");
}

?>