<?php
include("conexion.php");
$conn=conectar();

$updateIdProducto=$_POST["updateIdProducto"];
$updateStock=$_POST["updateStock"];


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
$sql = "SELECT updateInfoBodega('".$updateIdProducto."', '$updateStock')";
echo $conn->exec($sql);

if($conn){
    Header("Location: infoBodega.php");
}

?>