<?php
include("conexion.php");
$conn=conectar();

$rutProveedor=$_POST["rutProveedor"];
//'". ."' letras y ' ' num

$sql="SELECT devolverProveedor('".$rutProveedor."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: proveedoresEliminados.php");
}else{
    
}

?>