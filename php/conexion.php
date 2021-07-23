<?php
function conectar(){
    $hostname="magallanes.inf.unap.cl";
    $database = "rnakagawa";
    $username="rnakagawa";
    $password="jpo78qa";

    try{
    $conn = new PDO("pgsql:host=$hostname;dbname=$database", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $conn;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>