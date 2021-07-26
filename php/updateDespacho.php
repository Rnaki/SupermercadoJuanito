<?php
include("conexion.php");
$conn=conectar();

 $idUpdateDespacho=$_POST["idUpdateDespacho"];
 $updatePatente=$_POST["updatePatente"];
 $updateInformacion=$_POST["updateInformacion"];
 $updateFechaLimite=$_POST["updateFechaLimite"];
 $updateFechaEntrega=$_POST["updateFechaEntrega"];
 $updateProcesoDespacho=$_POST["updateProcesoDespacho"];

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
$sql = "SELECT updatedespacho('".$idUpdateDespacho."','".$updatePatente."', '".$updateInformacion."', '".$updateFechaLimite."', '".$updateFechaEntrega."', '".$updateProcesoDespacho."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: despacho.php");
}

?>