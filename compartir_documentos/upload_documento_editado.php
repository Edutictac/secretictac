<?php
session_start();
$upload_centro=$_SESSION['cod_centro'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();
$nick_usuario=$_SESSION['usuario'];

conectar();

$codigo_fecha = date("dmyHis");

$doc_id= $_REQUEST["doc_id"];






$titulo= $_REQUEST["titulo"];
$titulo=str_replace($search,$replace,$titulo);
$titulo=limpiar_tags($titulo);

$fecha_d= $_REQUEST["fecha_d"];
$fecha_d=str_replace($search,$replace,$fecha_d);
$fecha_d=limpiar_tags($fecha_d);
$fit=f_datefI($fecha_d);

$tipo_documento= $_REQUEST["tipo_documento"];
if($tipo_documento=='')
$tipo_documento='NO';
 
$boton = $_REQUEST["nombre_boton"];

//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}


switch ($boton) {

case 'GUARDAR':

mysql_query("update documentos_compartidos SET nombre='$titulo',fecha='$fit',privada='$tipo_documento' WHERE id_documentos='$doc_id'");
mysql_query($sql);
desconectar();
header("Location: $ruta_absoluta/modificar_documentos");
exit();
break;


case 'CERRAR':

header("Location:  $ruta_absoluta/modificar_documentos");
exit();
break;
}




?>
