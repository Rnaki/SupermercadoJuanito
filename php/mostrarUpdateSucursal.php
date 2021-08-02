<?php

include("conexion.php");
$gbd = conectar();
    $idSucursal = $_POST['id_sucursal'];
    try{
        $sql = "SELECT id_sucursal, id_bodega, region_sucursal, comuna_sucursal, calle_sucursal, numero_calle_sucursal, fono_sucursal, nombre_sucursal, cantidad_trabajadores FROM sucursal WHERE id_sucursal = '".$idSucursal."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $id_sucursal = $row["id_sucursal"];
           $id_bodega =  $row["id_bodega"];
           $region_sucursal = $row["region_sucursal"];
           $comuna_sucursal = $row["comuna_sucursal"];
           $calle_sucursal = $row["calle_sucursal"];
           $numero_calle_sucursal = $row["numero_calle_sucursal"];
           $fono_sucursal = $row["fono_sucursal"];
           $nombre_sucursal = $row["nombre_sucursal"];
           $cantidad_trabajadores = $row["cantidad_trabajadores"];
        }

        $info = [$id_sucursal, $id_bodega, $region_sucursal, $comuna_sucursal, $calle_sucursal, $numero_calle_sucursal, $fono_sucursal, $nombre_sucursal, $cantidad_trabajadores];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>