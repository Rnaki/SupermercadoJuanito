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

//Obtener todas las filas restantes del conjunto de resultados 
//print("Obtener todas las filas restantes del conjunto de resultados:\n");
$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Ventas Año $año</h2>
    <div class='table-responsive'>
        <table class='table table-striped table-sm'>
        <thead>
            <tr>
            <th scope='col'>Mes</th>
            <th scope='col'>Mes</th>
            <th scope='col'>Ventas</th>
            <th scope='col'>Año</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($resultado as $row){
        echo"
        <tr>
        <td>".$row["mes"]."</td>
        <td>".$row["nombremes"]."</td>
        <td>".$row["cantidad"]."</td>
        <td>".$row["yyyy"]."</td>

        </tr>
        ";
    }        
    echo "       
        </tbody>
        </table>
    </div>";

?>