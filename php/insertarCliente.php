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
$sexo=$_POST["sexo"];
$contraseña=$_POST["Contraseña"];
$correo=$_POST["Correo"];
$telefono=$_POST["Telefono"];

$sql0 ="Select rut_persona from cliente where rut_persona = '$rut'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: cliente.php?pagina=1&error=2");
}else{

}

//en $sql se guarda el insert
$sql="SELECT insertarpersona('".$rut."','".$nombre."','".$apellidoP."','".$apellidoM."','".$fechaNacimiento."','".$sexo."','".$correo."','".$telefono."','".$region."','".$comuna."','".$calle."','".$nCalle."','".$contraseña."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);
$sql2="SELECT insertarcliente('".$rut."','".$nombre."','".$apellidoP."','".$apellidoM."','".$fechaNacimiento."','".$sexo."','".$correo."','".$telefono."','".$region."','".$comuna."','".$calle."','".$nCalle."','".$contraseña."')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql2);

$sql3 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 6)";
echo $conn->exec($sql3);

if($conn){
    Header("Location: cliente.php");
}else{
    Header("Location: cliente.php");
}

?>