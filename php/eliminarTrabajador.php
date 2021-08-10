<?php
include("conexion.php");
$conn=conectar();

$rut_persona=$_POST["rut_persona"];
$id_sucursal=$_POST["id_sucursal"];

//FALTA INGRESAR LA FUNCION EN LA BD
$sql="SELECT eliminarTrabajador('".$rut_persona."')";
echo $conn->exec($sql);

$sql1 = "DELETE FROM controla where rut_persona = '".$rut_persona."'";
echo $conn->exec($sql1);

$sql12 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut_persona."', 6)";
    echo $conn->exec($sql12);

$sqlTrab1 = "SELECT sucursal.nombre_sucursal, count(trabaja.rut_persona)as cantidad from sucursal 
    left join trabaja on trabaja.id_sucursal = sucursal.id_sucursal 
    join trabajador on trabajador.rut_persona = trabaja.rut_persona where sucursal.id_sucursal = '".$id_sucursal."' and trabajador.estado_persona = true group by nombre_sucursal order by count(trabaja.rut_persona);";
$conn->exec($sqlTrab1);
$resulta1 = $conn->query($sqlTrab1)->fetchAll();
foreach ($resulta1 as $row){
    $cantidad1 = $row["cantidad"];
}
if($cantidad1 == ''){
    $cantidad1 = 0;
}

$sql28 = "UPDATE sucursal SET cantidad_trabajadores = '$cantidad1' where id_sucursal = '".$id_sucursal."';";
echo $conn->exec($sql28);


if($conn){
    Header("Location: interfaz RRHH.php");
}else{
    
}

?>