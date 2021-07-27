<?php

include("conexion.php");
$gbd = conectar();
    $rut_persona = $_POST['rut_persona'];
    try{
        $sql = "SELECT rut_persona, 
                       nombre_persona,
                       apellidop_persona, 
                       apellidom_persona 
                       FROM cliente WHERE rut_persona = '".$rut_persona."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $rut_persona = $row["rut_persona"];
           $nombre_persona =  $row["nombre_persona"];
           $apellidop_persona = $row["apellidop_persona"];
           $apellidom_persona = $row["apellidom_persona"];
        }

        $info = [$rut_persona, $nombre_persona, $apellidop_persona, $apellidom_persona];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>