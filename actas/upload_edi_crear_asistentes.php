<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();

$id_asistentes_ne=$_REQUEST['id_asistentes_ne'];
$tipo_acta_import_ne=$_REQUEST['tipo_acta_import_ne'];
$boton = $_REQUEST["nombre_boton"];
switch ($boton) {
  case 'CERRAR':

header("Location: $ruta_absoluta/importar_asistentes/$tipo_acta_import_ne");
exit();
break;

case 'GUARDAR':
$nombre_asis_ne=$_POST['nombre_asis_ne'];
$nombre_asis_ne=str_replace($search,$replace,$nombre_asis_ne);
$nombre_asis_ne=limpiar_tags($nombre_asis_ne);

$tipo_asistente_ne=$_REQUEST['tipo_asistente_ne'];


$sql = "SELECT id_asistente FROM actas_asistentes where id_asistente='$id_asistentes_ne' and cod_centro='$upload_centro' and id_tipo_acta='$tipo_acta_import_ne'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

if ($numero==0)
{$qry="insert into actas_asistentes(id_tipo_acta,cod_centro,id_asistente,	nombre_asistente,tipo_asistente) 
values ('$tipo_acta_import_ne','$upload_centro','$id_asistentes_ne','$nombre_asis_ne','$tipo_asistente_ne')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update actas_asistentes SET nombre_asistente='$nombre_asis_ne',tipo_asistente='$tipo_asistente_ne' where id_asistente='$id_asistentes_ne' and cod_centro='$upload_centro' ");
}

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/importar_asistentes/$tipo_acta_import_ne");
exit();
break;
}

?>







