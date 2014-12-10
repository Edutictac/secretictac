<?php
session_start();
include ("../ruta_absoluta.php");
$upload_centro=$_SESSION['cod_centro_secretictac'];
$id_permiso=($_GET["id_permiso"]);

include ("../conexion.php");
conectar();


mysql_query("DELETE FROM actas_permisos WHERE id_permiso='$id_permiso' and cod_centro='$upload_centro'");

desconectar();
header("Location: $ruta_absoluta/permisos_ver_acta");
?>

