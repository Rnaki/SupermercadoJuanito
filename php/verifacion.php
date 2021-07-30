<?php
include("conexion.php");
$conn=conectar();

$rut = $_POST["rut"];
$contraseña =  $_POST["contraseña"];
$sql= "SELECT rut_persona from persona where rut_persona = '$rut' and contrasena = '$contraseña'";
$gsent = $conn->prepare($sql);
$data = $conn->query($sql)->fetchAll();
$cuenta_col = 0;
foreach ($data as $row){
    $row['rut_persona'];
    $cuenta_col ++;
}

$sql2 = "SELECT acceso.id_acceso, funcion from acceso
        join controla on
        acceso.id_acceso = controla.id_acceso
        where controla.rut_persona = '".$row['rut_persona']."'";

$gsent = $conn->prepare($sql2);
$data2 = $conn->query($sql2)->fetchAll();

$contador = 0;
foreach ($data2 as $row2){
   $id_acceso[$contador] = $row2['id_acceso'];
   $funcion[$contador] = $row2['funcion'];
    $contador ++;
}

// CASO 1: Solo cliente//

if ($contador == 1){
    Header("Location: lobby.php");
    session_start();
    $_SESSION["rut_persona"] = $rut;
}else if ($contador > 1){ // CASO 2: Trabajador con Z+1 cargos//
    session_start();
    $_SESSION["rut_persona"] = $rut;
    $_SESSION["cant_permisos"] =$contador;
    for ($z=0; $z<$contador; $z++){
       $_SESSION["permiso".$z] = $funcion[$z];
    }
    Header("Location: menu_trabajador.php");
}


if($cuenta_col == 0){
    Header("Location: ../index.php?error=1"); 
} 



/*
if($cuenta_col == 1){
    Header("Location: lobby.php");
    session_start();
    $_SESSION["rut_persona"] = $rut;
}else if($cuenta_col == 0){
    Header("Location: ../index.php?error=1"); 
} 
*/

?>