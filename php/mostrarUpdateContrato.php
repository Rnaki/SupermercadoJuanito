<?php

include("conexion.php");
$gbd = conectar();
    $idContrato = $_POST['idContrato'];
    try{
        $sql = "SELECT *, trabajador.cargo, trabajador.nombre_persona FROM contrato
		join trabaja on trabaja.rut_persona = contrato.rut_persona 
		JOIN trabajador ON trabajador.rut_persona = contrato.rut_persona
		where contrato.id_contrato = '$idContrato';";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
            if($row["estado_contrato"] == true){
                $estado = "Vigente";
            }else{
                $estado = "No vigente";
            }
           $id_contrato = $row["id_contrato"];
           $nombre_persona =  $row["nombre_persona"].' '.$row["apellidop_persona"].' '.$row["apellidom_persona"];
           $cargo = $row["cargo"];
           $sueldo = $row["sueldo"];
           $fecha_inicio = $row["fecha_inicio_contrato"];
           $fecha_termino = $row["fecha_termino_contrato"];
        }

        $info = [$id_contrato, $nombre_persona, $cargo, $sueldo, $fecha_inicio, $fecha_termino, $estado];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>