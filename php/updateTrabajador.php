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
$ncalle=$_POST["ncalle"];
$fechaNacimiento=$_POST["fechaNacimiento"];
$Sexo=$_POST["sexo"];
$Contraseña=$_POST["Contraseña"];
$Correo=$_POST["Correo"];
$Telefono=$_POST["Telefono"];
//$Cargo=$_POST["Cargo"];

$trabaja_en = "";
if(isset($_POST["RRHH"])){
    echo $RRHH=$_POST["RRHH"];
    $trabaja_en = $trabaja_en."Recursos Humanos ";
}
if(isset($_POST["Tweb"])){
    echo $Tweb=$_POST["Tweb"];
    $trabaja_en = $trabaja_en."Trabajador Web ";
}
if(isset($_POST["Bodega"])){
    echo $Bodega=$_POST["Bodega"];
    $trabaja_en = $trabaja_en."Bodega ";
}
if(isset($_POST["Proveedor"])){
    echo $Proveedor=$_POST["Proveedor"];
    $trabaja_en = $trabaja_en."Proveedor ";
}
if(isset($_POST["Despacho"])){
    echo $Despacho=$_POST["Despacho"];
    $trabaja_en = $trabaja_en."Despacho ";
}

$sql1="UPDATE cliente SET nombre_persona='".$nombre."',
                          apellidop_persona='".$apellidoP."',
                          apellidom_persona='".$apellidoM."',
                          fecha_nacimiento_persona='".$fechaNacimiento."',
                          sexo='".$Sexo."',
                          correo='".$Correo."',
                          fono='".$Telefono."',
                          region='".$region."',
                          comuna='".$comuna."',
                          calle='".$calle."',
                          numero_calle='".$ncalle."',
                          contrasena='".$Contraseña."'
                          WHERE rut_persona='".$rut."'";
echo $conn->exec($sql1);
/*$sql0="SELECT updateclienterrhh('".$rut."',
                              '".$nombre."',
                              '".$apellidoP."',
                              '".$apellidoM."',
                              '".$region."',
                              '".$comuna."',
                              '".$calle."',
                              '".$ncalle."',
                              '".$fechaNacimiento."',
                              '".$Sexo."',
                              '".$Contraseña."'                              
                              '".$Correo."',
                              '".$Telefono."')";*/
/*echo $conn->exec($sql0);*/

$sql0="SELECT updateTrabajador('".$rut."',
                              '".$nombre."',
                              '".$apellidoP."',
                              '".$apellidoM."',
                              '".$fechaNacimiento."',
                              '".$Sexo."',
                              '".$Correo."',
                              '".$Telefono."',
                              '".$region."',
                              '".$comuna."',
                              '".$calle."',
                              '".$ncalle."',
                              '".$Contraseña."',
                              
                              '".$trabaja_en."')";
echo $conn->exec($sql0);

/*$sql2="SELECT updateclienterrhh('".$rut."',
                              '".$nombre."',
                              '".$apellidoP."',
                              '".$apellidoM."',
                              '".$region."',
                              '".$comuna."',
                              '".$calle."',
                              '".$ncalle."',
                              '".$fechaNacimiento."',
                              '".$Sexo."',
                              '".$Contraseña."'                              
                              '".$Correo."',
                              '".$Telefono."')";
echo $conn->exec($sql2);*/

$sql3="UPDATE persona SET nombre_persona='".$nombre."',
                          apellidop_persona='".$apellidoP."',
                          apellidom_persona='".$apellidoM."',
                          fecha_nacimiento_persona='".$fechaNacimiento."',
                          sexo='".$Sexo."',
                          correo='".$Correo."',
                          fono='".$Telefono."',
                          region='".$region."',
                          comuna='".$comuna."',
                          calle='".$calle."',
                          numero_calle='".$ncalle."',
                          contrasena='".$Contraseña."'
                          WHERE rut_persona='".$rut."'";
echo $conn->exec($sql3);

$sql1 = "DELETE FROM controla where rut_persona = '".$rut."'";
echo $conn->exec($sql1);

if(isset($_POST["RRHH"])){
    $sql7 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 1)";
    echo $conn->exec($sql7);
}
if(isset($_POST["Tweb"])){
    $sql8 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 2)";
    echo $conn->exec($sql8);
}
if(isset($_POST["Bodega"])){
    $sql9 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 3)";
    echo $conn->exec($sql9);
}
if(isset($_POST["Proveedor"])){
    $sql10 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 4)";
    echo $conn->exec($sql10);
}
if(isset($_POST["Despacho"])){
    $sql11 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 5)";
    echo $conn->exec($sql11);
}

$sql12 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 6)";
    echo $conn->exec($sql12);

if($conn){
    Header("Location: Interfaz RRHH.php");
}

?>