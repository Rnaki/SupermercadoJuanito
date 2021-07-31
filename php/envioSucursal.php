<?php
include("conexion.php");
$conn=conectar();

$envioIdProducto=$_POST["envioIdProducto"];
$envioStock=$_POST["envioStock"];


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

$sql0 = "SELECT stock FROM contiene WHERE id_producto = '".$envioIdProducto."'; ";
//'". ."' letras y ' ' num
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $stockTotal = $row["stock"];
    var_dump($stockTotal);
}

$stockSuma = $stockTotal + $envioStock;

$sql1 = "SELECT stock_sucursal FROM incluye WHERE id_producto = '$envioIdProducto'; ";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $stockIncluye = $row1["stock_sucursal"];
    var_dump($stockIncluye);
}

$stockFinal = $stockIncluye - $envioStock;

$sql = "SELECT envioSucursal('".$envioIdProducto."', '$stockFinal','$stockSuma')";
echo $conn->exec($sql);


if($conn){
    Header("Location: infoSucursal.php");
}

?>