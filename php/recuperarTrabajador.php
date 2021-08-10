<?php
include("conexion.php");
$conn=conectar();

$rutPersona=$_POST["rutPersona"];
$idSucursal=$_POST["idSucursal"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT recuperarTrabajador('".$rutPersona."')";
echo $conn->exec($sql);

$sqlTrab1 = "SELECT sucursal.nombre_sucursal, count(trabaja.rut_persona)as cantidad from sucursal 
    left join trabaja on trabaja.id_sucursal = sucursal.id_sucursal 
    join trabajador on trabajador.rut_persona = trabaja.rut_persona where sucursal.id_sucursal = '".$idSucursal."' and trabajador.estado_persona = true group by nombre_sucursal order by count(trabaja.rut_persona);";
$conn->exec($sqlTrab1);
$resulta1 = $conn->query($sqlTrab1)->fetchAll();
foreach ($resulta1 as $row){
    $cantidad1 = $row["cantidad"];
}
if($cantidad1 == ''){
    $cantidad1 = 0;
}

$sql28 = "UPDATE sucursal SET cantidad_trabajadores = '$cantidad1' where id_sucursal = '".$idSucursal."';";
echo $conn->exec($sql28);

if($conn){
    Header("Location: trabajadorRecuperar.php");
}else{
    
}

?>