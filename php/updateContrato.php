<?php
include("conexion.php");
$conn=conectar();

 $updateIdContrato=$_POST["updateIdContrato"];
 $updateCargo=$_POST["updateCargo"];
 $updateSueldo=$_POST["updateSueldo"];
 $updateFechaInicio=$_POST["updateFechaInicio"];
 $updateFechaTermino=$_POST["updateFechaTermino"];
 $updateEstado=$_POST["updateEstado"];

 if($updateEstado == 'Vigente'){
     echo "yes";
    echo $updateEstado2 = 'true';
}else{
    echo "nop";
    echo $updateEstado2 = 'false';
}

$sql1 = "SELECT rut_persona FROM contrato WHERE id_contrato = '".$updateIdContrato."';";
$conn->exec($sql1);
$data1 = $conn->query($sql1)->fetchAll();
foreach ($data1 as $row1){
    $rutPersona = $row1["rut_persona"];
}


$sql = "SELECT updateContrato('".$updateIdContrato."','".$updateCargo."', '".$updateSueldo."', '".$updateFechaInicio."', '".$updateFechaTermino."', '$updateEstado2','".$rutPersona."')";
echo $conn->exec($sql);

if($conn){
    Header("Location: Contratos.php");
}

?>