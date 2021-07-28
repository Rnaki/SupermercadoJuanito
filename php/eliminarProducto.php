<?php
include("conexion.php");
$conn=conectar();

$idProducto=$_POST["idProducto"];
//'". ."' letras y ' ' num
$sql="SELECT eliminarProducto('".$idProducto."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: Interfaz Trabajador web.php");
}else{
    
}

?>