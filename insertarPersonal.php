<?php
include("conexion.php");
$conn=conectar();

$rut=$_POST["rut"];
$nombre=$_POST["nombre"];
$apellidoP=$_POST["apellidoP"];
$apellidoM=$_POST["apellidoM"];
$region=$_POST["region"];
$comuna=$_POST["comuna"];
$calle=$_POST["calle"];
$nCalle=$_POST["nCalle"];
$fechaNacimiento=$_POST["fechaNacimiento"];
$Sexo=$_POST["sexo"];
$Contraseña=$_POST["Contraseña"];
$Correo=$_POST["Correo"];
$Telefono=$_POST["Telefono"];

$sql0 ="Select rut from personal where rut = '$rut'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if($columnas == 1){
    Header("Location: Interfaz RRHH.php?error=2");
}else{

}

//en $sql se guarda el insert
$sql="INSERT INTO personal VALUES ('$rut','$nombre','$apellidoP','$apellidoM','$region', '$comuna', '$calle', '$nCalle','$fechaNacimiento','$Sexo','$Contraseña','$Correo','$Telefono')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: Interfaz RRHH.php");
}else{
    Header("Location: Interfaz RRHH.php");
}

?>