<?php
include("conexion.php");
$conn=conectar();

$id_sucursal= "";
$patente= "";
$informacion_envio=$_POST["informacion_envio"];
$fecha_limite=$_POST["fecha_limite"];
$fecha_entrega= "";
$proceso_despacho=$_POST"En proceso";

///////
$sql0 ="SELECT id_despacho from despacho where id_despacho = "'$id'";";
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
$sql="insertarDespacho('$id_sucursal','$patente','$informacion_envio','$fecha_limite','$fecha_entrega','$proceso_despacho')";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: despacho.php");
}else{
    Header("Location: despacho.php");
}

?>