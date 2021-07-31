<?php
include("conexion.php");
$conn=conectar();

$id_venta= "4";
$id_producto= '3';
$cantidad='1';



///////
$sql0 ="SELECT id_venta from pertenece where id_venta = '$id_venta'";
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
$sql="SELECT insertarCarrito($id_venta,'$id_producto',$cantidad)";
//del $con quiero sacar el $sql para que sea un $query
echo $conn->exec($sql);

if($conn){
    Header("Location: carrito.php");
}else{
    Header("Location: carrito.php");
}

?>