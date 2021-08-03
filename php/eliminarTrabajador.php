<?php
include("conexion.php");
$conn=conectar();

$rut_persona=$_POST["rut_persona"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarTrabajador('".$rut_persona."')";
echo $conn->exec($sql);

$sql1 = "DELETE FROM controla where rut_persona = '".$rut_persona."'";
echo $conn->exec($sql1);

$sql12 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut_persona."', 6)";
    echo $conn->exec($sql12);

if($conn){
    Header("Location: interfaz RRHH.php");
}else{
    
}

?>