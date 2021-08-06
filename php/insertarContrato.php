<?php
include("conexion.php");
$conn=conectar();

$rutPersona=$_POST["rutPersona"];
$cargo=$_POST["cargo"];
$sueldo=$_POST["sueldo"];
$fechaInicio=$_POST["fechaInicio"];
$fechaTermino=$_POST["fechaTermino"];


if(isset($columnas) == 1){
    Header("Location: Contratos.php?error=2");
}else{



//en $sql se guarda el insert
$sql="SELECT insertarContrato('$rutPersona','".$cargo."','$sueldo','$fechaInicio','$fechaTermino')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: Contratos.php");
}else{
    Header("Location: Contratos.php");
}

}

?>