<?php
include("conexion.php");
$conn=conectar();

echo $rut=$_POST["rut"];
echo $nombre=$_POST["nombre"];
echo $apellidoP=$_POST["apellidoP"];
echo $apellidoM=$_POST["apellidoM"];
echo $region=$_POST["region"];
echo $comuna=$_POST["comuna"];
echo $calle=$_POST["calle"];
echo $nCalle=$_POST["nCalle"];
echo $fechaNacimiento=$_POST["fechaNacimiento"];
echo $sexo=$_POST["sexo"];
echo $contraseña=$_POST["Contraseña"];
echo $correo=$_POST["Correo"];
echo $telefono=$_POST["Telefono"];
echo $nombre_usuario = "Pepito";

$sql0 ="Select rut_persona from persona where rut_persona = '$rut'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: Registro.php?error=2");
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
    Header("Location: ../index.php");
}else{
    Header("Location: ../index.php");
}

?>