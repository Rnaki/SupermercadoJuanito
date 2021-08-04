<?php

include("conexion.php");
$gbd = conectar();
    $rut_persona = $_POST['rut_persona'];
    try{
        $sql = "SELECT rut_persona, 
                       nombre_persona,
                       apellidop_persona, 
                       apellidom_persona, 
                       fecha_nacimiento_persona, 
                       sexo, 
                       correo, 
                       fono, 
                       region, 
                       comuna, 
                       calle, 
                       numero_calle, 
                       contrasena,
                       direccion_despacho,
                       nombre_usuario_cliente 
                       FROM cliente WHERE rut_persona = '".$rut_persona."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $rut_persona = $row["rut_persona"];
           $nombre_persona =  $row["nombre_persona"];
           $apellidop_persona = $row["apellidop_persona"];
           $apellidom_persona = $row["apellidom_persona"];
           $fecha_nacimiento_persona = $row["fecha_nacimiento_persona"];
           $sexo = $row["sexo"];
           $correo = $row["correo"];
           $fono = $row["fono"];
           $region = $row["region"];
           $comuna = $row["comuna"];
           $calle = $row["calle"];
           $numero_calle = $row["numero_calle"];
           $contrasena = $row["contrasena"];
           $direccion_despacho = $row["direccion_despacho"];
           $nombre_usuario_cliente = $row["nombre_usuario_cliente"];
        }

        $info = [$rut_persona, $nombre_persona, $apellidop_persona, $apellidom_persona, $fecha_nacimiento_persona, $sexo, $correo, $fono, $region, $comuna, $calle, $numero_calle, $contrasena, $direccion_despacho, $nombre_usuario_cliente];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>