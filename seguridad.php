<?php
session_start();
include ("ruta_absoluta.php");
if ($_SESSION["autentificado_secretictac"] != "secretictac_acceso") {
    header("Location: $ruta_absoluta/index.php");
    exit();
}
?>
