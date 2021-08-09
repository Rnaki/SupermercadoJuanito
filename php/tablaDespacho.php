<?php 
session_start();
if(isset($_SESSION["rut_persona"])){
if(isset($_POST["sucursal"])){
    $_SESSION["sucursal"] = $_POST["sucursal"];
    
  
  }

$sucursal = $_SESSION["sucursal"];

include("conexion.php");
$conn=conectar();
/*$sql2 = "SELECT * FROM tranporte where id_sucursal= $sucursal ";
$gsent = $conn->prepare($sql2);
$cuenta_col = $gsent->columnCount();
$data = $conn->query($sql2)->fetchAll();*/

$fecha_actual = date("Y-m-d");
$fecha_limite=date("Y-m-d",strtotime($fecha_actual."+ 5 days"));



$sql3 = "SELECT direccion_despacho from cliente where rut_persona = '".$_SESSION["rut_persona"]."';";
$gsent = $conn->prepare($sql3);
$cuenta_col = $gsent->columnCount();
$resultado3 = $conn->query($sql3)->fetchAll();
    foreach ($resultado3 as $row){
       $direccion_despacho = $row["direccion_despacho"]; 
        }


$sql="INSERT INTO despacho(id_sucursal, patente, informacion_envio, fecha_limite, fecha_entrega, proceso_despacho) VALUES ('".$sucursal."',NULL,'".$direccion_despacho."','".$fecha_limite."',NULL,'En proceso')";

echo $conn->exec($sql);
$_SESSION["id_despacho"] = $conn->lastInsertId();
echo $_SESSION["id_despacho"];

    }

?>