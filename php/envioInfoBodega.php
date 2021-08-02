<?php
include("conexion.php");
$conn=conectar();

$envioIdProducto=$_POST["envioIdProducto"];
$envioStock=$_POST["envioStock"];
$envioIdBodega=$_POST["envioIdBodega"];

/*$sql="UPDATE cliente SET rut='$rut', nombre='$nombre', apellidoP='$apellidoP',
                         apellidoM='$apellidoM', region='$region',
                         comuna='$comuna',
                         calle='$calle',
                         ncalle='$ncalle',
                          fechaNacimiento='$fechaNacimiento',
                         Sexo='$Sexo', Contraseña='$Contraseña', Correo='$Correo',
                         Teléfono='$Telefono'
 WHERE rut='$rut'";
 */

$sql0 = "SELECT stock FROM contiene WHERE id_producto = '$envioIdProducto' and id_bodega = '".$envioIdBodega."';";
//'". ."' letras y ' ' num
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $stockTotal = $row["stock"];
    var_dump($stockTotal);
}

$stockMenos = $stockTotal - $envioStock;

if(isset($stockMenos) < 0){
    Header("Location: infoBodega.php?error=2");
}

$sql1 = "SELECT id_sucursal FROM sucursal WHERE id_bodega = '".$envioIdBodega."';";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $idSucursal = $row1["id_sucursal"];
    var_dump($idSucursal);
}

$sql2 = "SELECT stock_sucursal FROM incluye WHERE id_producto = '$envioIdProducto' and id_sucursal = '".$idSucursal."';";
$conn->exec($sql2);
$data2 = $conn->query($sql2)->fetchAll();
foreach ($data2 as $row2){
    $stockIncluye = $row2["stock_sucursal"];
    var_dump($stockIncluye);
}

$stockFinal = $stockIncluye + $envioStock;

$sql = "SELECT envioInfoBodega('$envioIdProducto', '$stockFinal','$stockMenos','".$envioIdBodega."','".$idSucursal."')";
echo $conn->exec($sql);


if($conn){
    Header("Location: infoBodega.php");
}

?>