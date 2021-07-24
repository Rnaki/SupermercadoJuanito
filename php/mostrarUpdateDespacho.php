<?php

include("conexion.php");
$gbd = conectar();
    $idDespacho = $_POST['idDespacho'];
    try{
        $sql = "SELECT id_despacho, id_sucursal, patente, informacion_envio, fecha_limite, fecha_entrega, proceso_despacho FROM despacho WHERE id_despacho = '".$idDespacho."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $id_despacho = $row["id_despacho"];
           $id_sucursal =  $row["id_sucursal"];
           $patente = $row["patente"];
           $informacion_envio = $row["informacion_envio"];
           $fecha_limite = $row["fecha_limite"];
           $fecha_entrega = $row["fecha_entrega"];
           $proceso_despacho = $row["proceso_despacho"];
        }

        $info = [$id_despacho, $id_sucursal, $patente, $informacion_envio, $fecha_limite, $fecha_entrega, $proceso_despacho];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>