<?php

include("conexion.php");
$gbd = conectar();
    $rut_trabajador = $_POST['rut_trabajador'];
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
                       cargo
                       FROM trabajador WHERE rut_persona = '".$rut_trabajador."' ";
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
           $correo =  $row["correo"];
           $fono = $row["fono"];
           $region = $row["region"];
           $comuna = $row["comuna"];
           $calle = $row["calle"];
           $numero_calle =  $row["numero_calle"];
           $contrasena = $row["contrasena"];
           $cargo = $row["cargo"];

        }

        
 
        $sql = "SELECT acceso.id_acceso, funcion 
                FROM controla
                join acceso
                on controla.id_acceso = acceso.id_acceso 
                WHERE rut_persona = '".$rut_trabajador."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

        $contador = 0;
        foreach ($resultado as $row) {
       $id_acceso[$contador] = $row["id_acceso"];
       $funcion[$contador] = $row["funcion"];
           $contador ++;
        }
        $cantidad_tuplas = $contador - 1;
        
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

    $info = [$rut_persona, 
                 $nombre_persona, 
                 $apellidop_persona, 
                 $apellidom_persona,
                 $fecha_nacimiento_persona, 
                 $sexo, 
                 $correo, 
                 $fono, 
                 $region, 
                 $comuna, 
                 $calle, 
                 $numero_calle, 
                 $contrasena,  
                 $cargo,
                 $id_acceso,
                 $funcion,
                 $cantidad_tuplas];
        
        echo json_encode($info);
?>