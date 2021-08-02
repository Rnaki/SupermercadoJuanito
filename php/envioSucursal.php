<?php
include("conexion.php");
$conn=conectar();

$envioIdProducto=$_POST["envioIdProducto"];
$envioStock=$_POST["envioStock"];
$envioIdSucursal=$_POST["envioIdSucursal"];

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

$sql = "SELECT id_bodega FROM sucursal WHERE id_sucursal = '".$envioIdSucursal."';";
//'". ."' letras y ' ' num
$conn->exec($sql);
$data = $conn->query($sql)->fetchAll();
foreach ($data as $row){
    $idBodega = $row["id_bodega"];
    var_dump($idBodega);
}


$sql0 = "SELECT stock FROM contiene WHERE id_producto = '$envioIdProducto' and id_bodega = '".$idBodega."';";
//'". ."' letras y ' ' num
$conn->exec($sql0);
$data0 = $conn->query($sql0)->fetchAll();
foreach ($data0 as $row0){
    $stockTotal = $row0["stock"];
    var_dump($stockTotal);
}

$stockSuma = $stockTotal + $envioStock;

$sql1 = "SELECT stock_sucursal FROM incluye WHERE id_producto = '$envioIdProducto' and id_sucursal = '".$envioIdSucursal."';";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $stockIncluye = $row1["stock_sucursal"];
    var_dump($stockIncluye);
}

$stockFinal = $stockIncluye - $envioStock;

$sql = "SELECT envioSucursal('".$envioIdProducto."', '$stockFinal','$stockSuma','".$envioIdSucursal."','".$idBodega."')";
echo $conn->exec($sql);


if($conn){
    Header("Location: infoSucursal.php");
}

?>