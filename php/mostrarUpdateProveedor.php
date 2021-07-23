<?php

include("conexion.php");
$gbd = conectar();
    $rutProveedor = $_POST['rutProveedor'];
    try{
        $sql = "SELECT rut_proveedor, nombre_proveedor, tipo_proveedor, marca_proveedor, fono_proveedor FROM proveedor WHERE rut_proveedor = '".$rutProveedor."' ";
        $gsent = $gbd->prepare($sql);
        $gsent->execute();
        $resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
           $rut = $row["rut_proveedor"];
           $nombre_proveedor =  $row["nombre_proveedor"];
           $tipo_proveedor = $row["tipo_proveedor"];
           $marca_proveedor = $row["marca_proveedor"];
           $fono_proveedor = $row["fono_proveedor"];
        }

        $info = [$rut, $nombre_proveedor, $tipo_proveedor, $marca_proveedor, $fono_proveedor];
        
        echo json_encode($info);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>