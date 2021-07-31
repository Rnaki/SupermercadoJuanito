<?php
include("conexion.php");
$conn=conectar();

$id_despacho= 'null';
$rut_persona=$_POST["rut"];
$fecha_venta= 'null';
$metodo_pago= 'null';
$metodo_envio= 'null';
$precio_boleta= 'null';
$precio_despacho= 'null';


///////
$sql0 ="SELECT rut_persona from venta where rut_persona = '$rut_persona'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}

if(isset($columnas) == 1){
    Header("Location: lobby.php?error=2");
}else{

}

//en $sql se guarda el insert
$sql="SELECT insertarVenta($id_despacho,'$rut_persona',$fecha_venta,$metodo_pago,$metodo_envio,$precio_boleta,$precio_despacho)";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: lobby.php");
}else{
    Header("Location: lobby.php");
}

?>