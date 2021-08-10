<?php
include("conexion.php");
$gbd = conectar();

$año = $_GET["añoseleccionado"];

/*
$sql = "SELECT  DATE_TRUNC('month', fecha_venta) as mes, COUNT(id_venta) as cantidad
        FROM venta
        GROUP BY DATE_TRUNC('month', fecha_venta)";
*/

$sql = "SELECT to_char(fecha_venta,'Month') as nombremes, EXTRACT(MONTH FROM  fecha_venta) as mes, extract(year from fecha_venta) as yyyy, COUNT(id_venta) as cantidad
        from venta
        where extract(year from fecha_venta) = $año
        group by 1,2, extract(year from fecha_venta) , extract(month from fecha_venta) order by extract(year from fecha_venta) , extract(month from fecha_venta);
";

$gsent = $gbd->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
$z=0;
foreach ($resultado as $row){
    $nombremes[$z] = $row["nombremes"];
    $cantidad[$z] = $row["cantidad"];
    $z ++;
}


    $info = [$nombremes,$cantidad];

    echo json_encode($info);

?>