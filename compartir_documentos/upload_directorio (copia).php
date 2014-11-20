<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();
$nick_usuario=$_SESSION['usuario_secretictac'];



$nom_prof=mysql_query("SELECT * FROM usuarios where COD_CENTRO='$upload_centro' and usuario='$nick_usuario'");
                    $row2=mysql_fetch_array($nom_prof);
                    $nom_profesor=($row2["nombre_usuario"]);




$codigo_fecha = date("dmyHis");
$codigo_documento_asignado=md5($nick_usuario).$codigo_fecha;
$tipo_documento= $_REQUEST["tipo_documento"];

$archivo_dropbox=$_REQUEST['selected-file'];

$padre_recogido= $_REQUEST["padre_recogido"];
$hijo= $_REQUEST["hijo"];

$titulo= $_REQUEST["titulo"];
$titulo=str_replace($search,$replace,$titulo);
$titulo=limpiar_tags($titulo);

$fecha_d= $_REQUEST["fecha_d"];
$fecha_d=str_replace($search,$replace,$fecha_d);
$fecha_d=limpiar_tags($fecha_d);
$fit=f_datefI($fecha_d);

foreach($_FILES['archivo']['tmp_name'] as $key => $value){

$tempFile = $_FILES["archivo"]["tmp_name"][$key];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"][$key];
$tipo = $_FILES["archivo"]["type"][$key];
$nombre_archivo = $_FILES["archivo"]["name"][$key];
$nombre_archivo=sanear_string($nombre_archivo);
$nombre_archivo_arbol=$nombre_archivo;
$targetPath='../archivos/compartidos/'.$upload_centro.'/';

$targetFile =  $targetPath.$nombre_archivo;
$link_documento=$nombre_archivo;

  if (!file_exists($targetPath))
    {
    mkdir(str_replace('//','/',$targetPath), 0777, true);
    }






    if ($tempFile != '') {
    	
 // comprobar extension con php
$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
$tipo_archivo=finfo_file($finfo, $tempFile) ;
finfo_close($finfo);
      if (!in_array($tipo_archivo,$archivos_permitidas_php)) {
       die('<b>'.$_FILES["archivo"]["name"].'</b> no es archivo v&aacute;lido!<br/>'.$_FILES["archivo"]["name"].' es un archivo <b>'.$tipo_archivo.'</b><br>'.
        '<a href="javascript:history.go(-1);">'.
        '&lt;&lt VOLVER</a>');
        exit();
      }
    }

move_uploaded_file($tempFile,$targetFile);
}




?>







