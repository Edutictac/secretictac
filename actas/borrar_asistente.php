<?php
session_start();
include ("../ruta_absoluta.php");
$upload_centro=$_SESSION['cod_centro_secretictac'];
$id_asistentes=($_GET["id_asistentes"]);
$tipo_acta=($_GET["tipo_acta"]);
include ("../conexion.php");
conectar();


mysql_query("DELETE FROM actas_asistentes WHERE id_tipo_acta='$tipo_acta' and id_asistente='$id_asistentes' and cod_centro='$upload_centro'");

desconectar();
header("Location: $ruta_absoluta/importar_asistentes/$tipo_acta");
?>

