<?php

include("conexion.php");
$gbd = conectar();
    $idBodega = $_POST['id_bodega'];
    try{
        $sql = "SELECT id_bodega, region_bodega, comuna_bodega, calle_bodega, numero_calle_bodega FROM bodega WHERE id_bodega = '".$idBodega."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $row) {
           $id_bodega = $row["id_bodega"];
           $region_bodega = $row["region_bodega"];
           $comuna_bodega = $row["comuna_bodega"];
           $calle_bodega = $row["calle_bodega"];
           $numero_calle_bodega = $row["numero_calle_bodega"];
        }

        $info = [$id_bodega, $region_bodega, $comuna_bodega, $calle_bodega, $numero_calle_bodega];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>