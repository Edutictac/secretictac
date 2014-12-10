<?php
session_start();
include ("../ruta_absoluta.php");
$upload_centro=$_SESSION['cod_centro_secretictac'];
$tipo_acta=($_GET["tipo_acta"]);
$id_acta=($_GET["id_acta"]);
$div_seleccionado=($_GET["div_seleccionado"]);
$id_asistente=($_GET["id_asistente"]);
include ("../conexion.php");
conectar();


mysql_query("DELETE FROM acta_asistentes_reunion WHERE id_actas='$id_acta' and id_asistente='$id_asistente' and cod_centro='$upload_centro'");

desconectar();
header("Location: $ruta_absoluta/redactar_actas/$tipo_acta/$id_acta/3");
?>

