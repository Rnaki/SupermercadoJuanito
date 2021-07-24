<?php
include("conexion.php");
$conn=conectar();

$id_sucursal=$_POST["id_sucursal"];
$patente=["patente"];
$informacion_envio=$_POST["informacion_envio"];
$fecha_limite=$_POST["fecha_limite"];
$fecha_entrega=$_POST["fecha_entrega"];
$proceso_despacho=$_POST["proceso_despacho"];

///////
$sql0 ="select id_sucursal from despacho where id_sucursal = '1'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: despacho.php?error=2");
}else{

}

//en $sql se guarda el insert
$sql="insertarDespacho('$id_sucursal','$patente','$informacion_envio','$tipoProveedor','$marcaProveedor','$fonoProveedor')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: despacho.php");
}else{
    Header("Location: despacho.php");
}

?>