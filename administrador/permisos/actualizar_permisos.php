<?php
session_start();
$upload_centro=$_SESSION['cod_centro'];
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
conectar();



$boton = $_REQUEST["nombre_boton"];
//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}

switch ($boton) {
  case 'CERRAR':

header("Location: $ruta_absoluta/elegir_permiso");
exit();
break;

case 'GUARDAR':
$tipo_usuario= $_REQUEST["tipo_usuario"];

if (isset($_POST['administrador']))
$administrador="1";
else
$administrador="0";

if (isset($_POST['tipo_permisos']))
$tipo_permisos="1";
else
$tipo_permisos="0";

if (isset($_POST['permisos']))
$permisos="1";
else
$permisos="0";

if (isset($_POST['crear_usuarios']))
$crear_usuarios="1";
else
$crear_usuarios="0";

if (isset($_POST['definir_centro']))
$definir_centro="1";
else
$definir_centro="0";


if (isset($_POST['documentos_compar']))
$compartir_documentos="1";
else
$compartir_documentos="0";


if (isset($_POST['subir_docum']))
$subir_documentos="1";
else
$subir_documentos="0";


if (isset($_POST['modif_docum']))
$modificar_documentos="1";
else
$modificar_documentos="0";


if (isset($_POST['registro']))
$registro="1";
else
$registro="0";

if (isset($_POST['entradas']))
$entradas="1";
else
$entradas="0";

if (isset($_POST['salidas']))
$salidas="1";
else
$salidas="0";

if (isset($_POST['listados']))
$listados="1";
else
$listados="0";

if (isset($_POST['configuracion']))
$configuracion="1";
else
$configuracion="0";


if (isset($_POST['imprimir_libros']))
$imprimir_libros="1";
else
$imprimir_libros="0";

$sql = "SELECT id_tipo FROM  1_permisos where id_tipo='$tipo_usuario' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

If ($numero==0)
{$qry="insert into 1_permisos(id_tipo,cod_centro,administrador,tipo_permisos,permisos,crear_usuarios,definir_centro,compartir_documentos,subir_documentos,modificar_documentos,registro,entradas,salidas,listados,configuracion,imprimir_libros)
values ('$tipo_usuario','$upload_centro','$administrador','$tipo_permisos','$permisos','$crear_usuarios','$definir_centro','$compartir_documentos','$subir_documentos','$modificar_documentos','$registro','$entradas','$salidas','$listados','$configuracion','$imprimir_libros')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update 1_permisos SET administrador='$administrador', tipo_permisos='$tipo_permisos',permisos='$permisos',crear_usuarios='$crear_usuarios',definir_centro='$definir_centro',compartir_documentos='$compartir_documentos',subir_documentos='$subir_documentos',
modificar_documentos='$modificar_documentos',registro='$registro',entradas='$entradas',salidas='$salidas',listados='$listados',configuracion='$configuracion',imprimir_libros='$imprimir_libros' where id_tipo='$tipo_usuario' and cod_centro='$upload_centro' ");
}

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/elegir_permiso");
exit();
break;
}

?>

