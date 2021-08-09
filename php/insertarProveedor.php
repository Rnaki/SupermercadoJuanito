<?php
include("conexion.php");
$conn=conectar();

$rutProovedor=$_POST["rutProovedor"];
$rutPersona=$_POST["rutPersona"];
$nombreProveedor=$_POST["nombreProveedor"];
$tipoProveedor=$_POST["tipoProveedor"];
$marcaProveedor=$_POST["marcaProveedor"];
$fonoProveedor=$_POST["fonoProveedor"];


$sql0 ="Select Rut_proveedor from proveedor where rut_proveedor = '$rutProovedor'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: proveedor.php?pagina=1&error=2");
}else{

//en $sql se guarda el insert
$sql="SELECT insertarProveedor('$rutProovedor','$rutPersona', '$fonoProveedor','$marcaProveedor','$tipoProveedor','$nombreProveedor')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: proveedor.php");
}else{
    Header("Location: proveedor.php");
}

}
?>