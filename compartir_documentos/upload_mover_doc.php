<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");

conectar();
$doc_id= $_REQUEST["doc_id"];
$nuevo_padre= $_REQUEST["nuevo_padre"];

conectar();
$boton = $_REQUEST["nombre_boton"];

//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}


switch ($boton) {

case 'GUARDAR':
mysql_query("update documentos_compartidos SET numero_padre='$nuevo_padre' WHERE id_documentos='$doc_id'");
mysql_query($sql);
desconectar();
header("Location: $ruta_absoluta/modificar_documentos");
exit();
break;

case 'CERRAR':
header("Location: $ruta_absoluta/modificar_documentos");
exit();
break;
}

?>
