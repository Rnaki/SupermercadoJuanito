<?php

session_start();

include("conexion.php");
$conn=conectar();

$rut=$_POST["rut"];
$nombre=$_POST["nombre"];
$apellidoP=$_POST["apellidoP"];
$apellidoM=$_POST["apellidoM"];
$region=$_POST["region"];
$comuna=$_POST["comuna"];
$calle=$_POST["calle"];
$nCalle=$_POST["nCalle"];
$fechaNacimiento=$_POST["fechaNacimiento"];
$Sexo=$_POST["sexo"];
$Contraseña=$_POST["Contraseña"];
$Correo=$_POST["Correo"];
$Telefono=$_POST["Telefono"];

$nombreImagen=$_FILES['foto']['name'];
$tipoImagen=$_FILES['foto']['type'];
$tamanoImagen=$_FILES['foto']['size'];
$time = strtotime(date('Y-m-d H:1:s'));
$nombreImagen= $time."."."jpg";

$Cargo=$_POST["Cargo"];
$trabaja_en = "";
if(isset($_POST["RRHH"])){
    echo $RRHH=$_POST["RRHH"];
    $trabaja_en = $trabaja_en."Recursos Humanos ";
}
if(isset($_POST["Tweb"])){
    echo $Tweb=$_POST["Tweb"];
    $trabaja_en = $trabaja_en."Trabajador Web ";
}
if(isset($_POST["Bodega"])){
    echo $Bodega=$_POST["Bodega"];
    $trabaja_en = $trabaja_en."Bodega ";
}
if(isset($_POST["Proveedor"])){
    echo $Proveedor=$_POST["Proveedor"];
    $trabaja_en = $trabaja_en."Proveedor ";
}
if(isset($_POST["Despacho"])){
    echo $Despacho=$_POST["Despacho"];
    $trabaja_en = $trabaja_en."Despacho ";
}

$rut_contrata = $_SESSION["rut_persona"];
$columnas = 0;
$sql0 ="SELECT rut_persona FROM Trabajador WHERE rut_persona = '$rut'";
$conn->exec($sql0);
$data = $conn->query($sql0)->fetchAll();
foreach ($data as $row){
    $columnas ++;
}
$columnas2 = 0;
$sql00 ="SELECT rut_persona FROM persona WHERE rut_persona = '$rut'";
$conn->exec($sql00);
$data2= $conn->query($sql00)->fetchAll();
foreach ($data2 as $row){
    $columnas2 ++;
}


if($tamanoImagen <= 1000000){
    if($tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/jpeg"){

        $carpetaDestino = dirname(getcwd()).'/imagenes/';
        move_uploaded_file($_FILES['foto']['tmp_name'],$carpetaDestino.$nombreImagen);

        if(isset($columnas) == 1 && $columnas == 1){
            Header("Location: Interfaz RRHH.php?pagina=1&error=2");
        }elseif(isset($columnas2) == 1 && $columnas2 == 0){
            $sql1="SELECT insertarpersona('".$rut."',
            '".$nombre."',
            '".$apellidoP."',
            '".$apellidoM."',
            '".$fechaNacimiento."',
            '".$Sexo."',
            '".$Correo."',
            '".$Telefono."',
            '".$region."',
            '".$comuna."',
            '".$calle."',
            '".$nCalle."',
            '".$Contraseña."')";
            //del $con quiero sacar el $sql para que sea un $query
            echo $conn->exec($sql1);

            $sql6="SELECT insertarcliente('".$rut."',
                                        '".$nombre."',
                                        '".$apellidoP."',
                                        '".$apellidoM."',
                                        '".$fechaNacimiento."',
                                        '".$Sexo."',
                                        '".$Correo."',
                                        '".$Telefono."',
                                        '".$region."',
                                        '".$comuna."',
                                        '".$calle."',
                                        '".$nCalle."',
                                        '".$Contraseña."')";
            //del $con quiero sacar el $sql para que sea un $query
            echo $conn->exec($sql6);

            //en $sql se guarda el insert
            $sql2="SELECT insertarTrabajador('".$rut."',
                '".$nombre."',
                '".$apellidoP."',
                '".$apellidoM."',
                '".$fechaNacimiento."',
                '".$Sexo."',
                '".$Correo."',
                '".$Telefono."',
                '".$region."', 
                '".$comuna."', 
                '".$calle."', 
                '".$nCalle."',
                '".$Contraseña."',
                '".$rut_contrata."',
                '".$Cargo."',
                '".$trabaja_en."',
                '".$nombreImagen."')";
            //del $con quiero sacar el $sql para que sea un $query
            echo $conn->exec($sql2);

            $sql3 = "INSERT INTO trabaja (rut_persona, id_sucursal) values ('".$rut."', '".$_SESSION["sucursal"]."')";
            echo $conn->exec($sql3);

            $sqlTrab = "SELECT sucursal.nombre_sucursal, count(trabaja.rut_persona)as cantidad from sucursal 
                        left join trabaja on trabaja.id_sucursal = sucursal.id_sucursal 
                        join trabajador on trabajador.rut_persona = trabaja.rut_persona where sucursal.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true group by nombre_sucursal order by count(trabaja.rut_persona);";
            $conn->exec($sqlTrab);
            $resulta = $conn->query($sqlTrab)->fetchAll();
            foreach ($resulta as $row){
                echo $cantidad = $row["cantidad"];
                echo "cantidad";
            }

            $sql27 = "UPDATE sucursal SET cantidad_trabajadores = '$cantidad' where id_sucursal = '".$_SESSION["sucursal"]."';";
            echo $conn->exec($sql27);

            if(isset($_POST["RRHH"])){
                $sql7 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 1)";
                echo $conn->exec($sql7);
            }
            if(isset($_POST["Tweb"])){
                $sql8 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 2)";
                echo $conn->exec($sql8);
            }
            if(isset($_POST["Bodega"])){
                $sql9 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 3)";
                echo $conn->exec($sql9);
            }
            if(isset($_POST["Proveedor"])){
                $sql10 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 4)";
                echo $conn->exec($sql10);
            }
            if(isset($_POST["Despacho"])){
                $sql11 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 5)";
                echo $conn->exec($sql11);
            }

            $sql12 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 6)";
                echo $conn->exec($sql12);

        }elseif(isset($columnas2) == 1 && $columnas2 == 1){
            //en $sql se guarda el insert
            $sql4="SELECT insertarTrabajador('".$rut."',
            '".$nombre."',
            '".$apellidoP."',
            '".$apellidoM."',
            '".$fechaNacimiento."',
            '".$Sexo."',
            '".$Correo."',
            '".$Telefono."',
            '".$region."', 
            '".$comuna."', 
            '".$calle."', 
            '".$nCalle."',
            '".$Contraseña."',
            '".$rut_contrata."',
            '".$Cargo."',
            '".$trabaja_en."',
            '".$nombreImagen."')";
            //del $con quiero sacar el $sql para que sea un $query
            echo $conn->exec($sql4);

            $sql5 = "INSERT INTO trabaja (rut_persona, id_sucursal) values ('".$rut."', '".$_SESSION["sucursal"]."')";
            echo $conn->exec($sql5);

            $sqlTrab1 = "SELECT sucursal.nombre_sucursal, count(trabaja.rut_persona)as cantidad from sucursal 
                        left join trabaja on trabaja.id_sucursal = sucursal.id_sucursal 
                        join trabajador on trabajador.rut_persona = trabaja.rut_persona where sucursal.id_sucursal = '".$_SESSION["sucursal"]."' and trabajador.estado_persona = true group by nombre_sucursal order by count(trabaja.rut_persona);";
            $conn->exec($sqlTrab1);
            $resulta1 = $conn->query($sqlTrab1)->fetchAll();
            foreach ($resulta1 as $row){
                $cantidad1 = $row["cantidad"];
            }

            $sql28 = "UPDATE sucursal SET cantidad_trabajadores = '$cantidad1' where id_sucursal = '".$_SESSION["sucursal"]."';";
            echo $conn->exec($sql28);

            if(isset($_POST["RRHH"])){
                $sql7 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 1)";
                echo $conn->exec($sql7);
            }
            if(isset($_POST["Tweb"])){
                $sql8 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 2)";
                echo $conn->exec($sql8);
            }
            if(isset($_POST["Bodega"])){
                $sql9 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 3)";
                echo $conn->exec($sql9);
            }
            if(isset($_POST["Proveedor"])){
                $sql10 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 4)";
                echo $conn->exec($sql10);
            }
            if(isset($_POST["Despacho"])){
                $sql11 = "INSERT INTO controla (rut_persona, id_acceso) values ('".$rut."', 5)";
                echo $conn->exec($sql11);
            }

        }
        if($conn){
            Header("Location: Interfaz RRHH.php");
        }else{
            Header("Location: Interfaz RRHH.php");
        }
     }else{
        Header("Location: Interfaz RRHH.php?pagina=1&error2=2");
     }
}else{
    Header("Location: Interfaz RRHH.php?pagina=1&error3=2");
}



?>