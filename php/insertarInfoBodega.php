<?php
include("conexion.php");
$conn=conectar();

$idProducto=$_POST["id_producto"];
$idBodega=$_POST["idBodega"];
$stock=$_POST["stock"];

$sql0 = "SELECT id_sucursal FROM sucursal WHERE id_bodega = '".$idBodega."';";

$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $idSucursal = $row["id_sucursal"];
}

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

$sql="SELECT id_producto from contiene where id_producto = '$idProducto' and id_bodega = '".$idBodega."';";
$conn->exec($sql);
$data = $conn->query($sql)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: infoBodega.php?pagina=1&error=1");
}else{



//en $sql se guarda el insert
$sql="SELECT insertarInfoBodega('$idProducto','".$idBodega."','$stock','".$idSucursal."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: infoBodega.php");
}else{
    Header("Location: infoBodega.php");
}

}

?>