<?php

include("conexion.php");
$gbd = conectar();
    $patente = $_POST['patente'];
    try{
        $sql = "SELECT * from transporte where patente = '$patente';";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $patente = $row["patente"];
           $tipoTransporte =  $row["tipo_transporte"];
           $idSucursal =  $row["id_sucursal"];
        }

        $info = [$patente, $tipoTransporte, $idSucursal];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>