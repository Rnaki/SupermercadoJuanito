<?php
    session_start();
    isset($_SESSION["rut_persona"]);
    session_destroy();
    Header("Location: ../index.php");
?>