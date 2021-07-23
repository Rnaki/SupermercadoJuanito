<?php
include("conexion.php");
$conn=conectar();

$updateRutProveedor=$_POST["updateRutProveedor"];
$updateNombreProveedor=$_POST["updateNombreProveedor"];
$updateTipoProveedor=$_POST["updateTipoProveedor"];
$updateMarcaProveedor=$_POST["updateMarcaProveedor"];
$updateFonoProveedor=$_POST["updateFonoProveedor"];

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
$sql = "SELECT updateProveedor('".$updateRutProveedor."', '".$updateNombreProveedor."', '".$updateTipoProveedor."', '".$updateMarcaProveedor."', '".$updateFonoProveedor."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: proveedor.php");
}

?>