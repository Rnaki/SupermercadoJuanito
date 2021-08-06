<?php
include("conexion.php");
$conn=conectar();

$idContrato=$_POST["idContrato"];

$sql1 = "SELECT rut_persona FROM contrato WHERE id_contrato = '".$idContrato."';";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $rutPersona = $row1["rut_persona"];
}

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarContrato('".$idContrato."','".$rutPersona."')";
echo $conn->exec($sql);
if($conn){
    Header("Location: despacho.php");
}else{
    
}

?>