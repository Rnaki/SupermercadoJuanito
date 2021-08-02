<?php
include("conexion.php");
$conn=conectar();

$updatePatente=$_POST["updatePatente"];
$updateTipoTransporte=$_POST["updateTipoTransporte"];

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
$sql = "SELECT updateTransporte('".$updatePatente."', '".$updateTipoTransporte."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: transporte.php");
}

?>