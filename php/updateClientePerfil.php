<?php
include("conexion.php");
$conn=conectar();

$updateRutCliente=$_POST["updateRutCliente"];
$updateNombreCliente=$_POST["updateNombreCliente"];
$updateApellidoPCliente=$_POST["updateApellidoPCliente"];
$updateApellidoMCliente=$_POST["updateApellidoMCliente"];
$updateRegionCliente=$_POST["updateRegionCliente"];
$updateComunaCliente=$_POST["updateComunaCliente"];
$updateCalleCliente=$_POST["updateCalleCliente"];
$updateNcalleCliente=$_POST["updateNcalleCliente"];
$updateFechaNacimientoCliente=$_POST["updateFechaNacimientoCliente"];
$updateSexoCliente=$_POST["updateSexoCliente"];
$updateContrase├▒aCliente=$_POST["updateContrase├▒aCliente"];
$updateCorreoCliente=$_POST["updateCorreoCliente"];
$updateTelefonoCliente=$_POST["updateTelefonoCliente"];
$updateDireccionDespacho=$_POST["updateDireccionDespacho"];
$updateNombreUsuario=$_POST["updateNombreUsuario"];

$sql="SELECT updatepersonarrhh('".$updateRutCliente."',
                               '".$updateNombreCliente."',
                               '".$updateApellidoPCliente."',
                               '".$updateApellidoMCliente."',
                               '".$updateRegionCliente."',
                               '".$updateComunaCliente."',
                               '".$updateCalleCliente."',
                               '".$updateNcalleCliente."',
                               '".$updateFechaNacimientoCliente."',
                               '".$updateSexoCliente."',
                               '".$updateContrase├▒aCliente."',
                               '".$updateCorreoCliente."',
                               '".$updateTelefonoCliente."')";
echo $conn->exec($sql);

$sql="SELECT updateclienteperfil('".$updateRutCliente."',
                               '".$updateNombreCliente."',
                               '".$updateApellidoPCliente."',
                               '".$updateApellidoMCliente."',
                               '".$updateRegionCliente."',
                               '".$updateComunaCliente."',
                               '".$updateCalleCliente."',
                               '".$updateNcalleCliente."',
                               '".$updateFechaNacimientoCliente."',
                               '".$updateSexoCliente."',
                               '".$updateContrase├▒aCliente."',
                               '".$updateCorreoCliente."',
                               '".$updateTelefonoCliente."',
                               '".$updateDireccionDespacho."',
                               '".$updateNombreUsuario."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: perfil.php");
}

?>