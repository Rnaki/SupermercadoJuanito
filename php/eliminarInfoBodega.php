<?php
include("conexion.php");
$conn=conectar();

$idProducto=$_POST["idProducto"];


$sql0 = "SELECT stock FROM contiene WHERE id_producto = '".$idProducto."'; ";
//'". ."' letras y ' ' num
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $stock = $row["stock"];
    var_dump($stock);
}

//'". ."' letras y ' ' num
$sql="SELECT eliminarInfoBodega('".$idProducto."','$stock')";
echo $conn->exec($sql);
if($conn){
    Header("Location: infoBodega.php");
}else{
    
}

?>