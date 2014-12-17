<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();

$id_firma= $_REQUEST["id_firma"];

$firma_convocatoria= $_REQUEST["id_firma"];

$tipo_acta=$_POST['tipo_acta'];
$tipo_asistente=$_POST['tipo_asistente'];

$orden=$_POST['orden'];
$orden=str_replace($search,$replace,$orden);
$orden=limpiar_tags($orden);

$qry="insert into actas_firmas(id_tipo_acta,cod_centro,id_firma,id_tipo_asistente,orden,firma_convocatoria) values
 ('$tipo_acta','$upload_centro','$id_firma','$tipo_asistente','$orden','$firma_convocatoria')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/actas_firmas");
exit();
?>