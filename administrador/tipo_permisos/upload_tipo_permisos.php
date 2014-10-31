<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");
conectar();



$boton = $_REQUEST["nombre_boton"];
//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}

switch ($boton) {
  case 'CERRAR':

header("Location: $ruta_absoluta/tipo_permisos");
exit();
break;

case 'GUARDAR':
$id_tipo= $_REQUEST["id_tipo"];

$tipo=$_POST['tipo'];
$tipo=str_replace($search,$replace,$tipo);
$tipo=limpiar_tags($tipo);



$sql = "SELECT id_tipo FROM  1_tipos_permisos where id_tipo='$id_tipo' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

if ($numero==0)
{$qry="insert into 1_tipos_permisos(id_tipo,cod_centro,tipo) values ('$id_tipo','$upload_centro','$tipo')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update 1_tipos_permisos SET tipo='$tipo' where id_tipo='$id_tipo' and cod_centro='$upload_centro' ");
}

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/tipo_permisos");
exit();
break;
}

?>

