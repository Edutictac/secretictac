<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();

$id_permiso= $_REQUEST["id_permiso"];

$tipo_acta=$_POST['tipo_acta'];
$permiso=$_POST['permiso'];

$nombre_permiso=mysql_query("SELECT tipo FROM  1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$permiso' ");
$row = mysql_fetch_array($nombre_permiso);
$nombre_permiso1=($row ["tipo"]);

$qry="insert into actas_permisos(id_tipo_acta,cod_centro,id_tipo_permisos,nombre_permiso,id_permiso) values
 ('$tipo_acta','$upload_centro','$permiso','$nombre_permiso1','$id_permiso')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/permisos_ver_acta");
exit();
?>