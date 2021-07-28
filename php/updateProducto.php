<?php
include("conexion.php");
$conn=conectar();

$updateIdProducto=$_POST["updateIdProducto"];
$UpdatetipoCategoria=$_POST["UpdatetipoCategoria"];
$updateNombreProducto=$_POST["updateNombreProducto"];
$updatePrecio=$_POST["updatePrecio"];
$updateImagen=$_POST["updateImagen"];
$updateDescripcion=$_POST["updateDescripcion"];
$updateDescuento=$_POST["updateDescuento"];
$updateMarca=$_POST["updateMarca"];

$sql0 = "SELECT id_categoria FROM categoria WHERE tipo_categoria = '".$UpdatetipoCategoria."'; ";

$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $updateIdCategoria = $row["id_categoria"];
    var_dump($updateIdCategoria);
}

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
$sql = "SELECT updateProducto('".$updateIdProducto."', '$updateIdCategoria', '".$updateNombreProducto."', '$updatePrecio', '".$updateImagen."', '".$updateDescripcion."','$updateDescuento', '".$updateMarca."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: Interfaz Trabajador web.php");
}

?>