<?php
include("conexion.php");
$conn=conectar();

$idProducto=$_POST["idProducto"];
//'". ."' letras y ' ' num

$sql="SELECT devolverProducto('".$idProducto."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: interfazProductosEliminados.php");
}else{
    
}

?>