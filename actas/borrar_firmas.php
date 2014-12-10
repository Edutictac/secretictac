<?php
session_start();
include ("../ruta_absoluta.php");
$upload_centro=$_SESSION['cod_centro_secretictac'];
$id_firma=($_GET["id_firma"]);

include ("../conexion.php");
conectar();


mysql_query("DELETE FROM actas_firmas WHERE id_firma='$id_firma' and cod_centro='$upload_centro'");

desconectar();
header("Location: $ruta_absoluta/actas_firmas");
?>

