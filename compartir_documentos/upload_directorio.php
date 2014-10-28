<?php
session_start();
$upload_centro=$_SESSION['cod_centro'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();
$nick_usuario=$_SESSION['usuario'];



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

$tempFile = $_FILES["archivo"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"];
$tipo = $_FILES["archivo"]["type"];
$nombre_archivo = $_FILES["archivo"]["name"];
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




$boton = $_REQUEST["nombre_boton"];

//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}

switch ($boton) {

case 'GUARDAR':

if($archivo_dropbox!='')
{
$sql ="insert into  documentos_compartidos (id_documentos,numero_padre,numero_hijo,tipo,nombre,COD_CENTRO,fecha,creado,privada,usuario,link,tipo_archivo) values
('$codigo_documento_asignado','$padre_recogido','$hijo','archivo','$titulo','$upload_centro','$fit','$nom_profesor','$tipo_documento','$nick_usuario','$archivo_dropbox','dropbox')";
mysql_query($sql);
desconectar();
header("Location: $ruta_absoluta/registro_archivos/$hijo");
exit();
break;
}

else
{

if($_FILES['archivo']['size']==0){
$sql ="insert into  documentos_compartidos (id_documentos,numero_padre,numero_hijo,tipo,nombre,COD_CENTRO,fecha,creado,privada,usuario) values
('$codigo_documento_asignado','$padre_recogido','$hijo','carpeta','$titulo','$upload_centro','$fit','$nom_profesor','NO','$nick_usuario')";
mysql_query($sql);
desconectar();
header("Location: $ruta_absoluta/registro_archivos/$hijo");
exit();
break;
}

else
{
move_uploaded_file($tempFile,$targetFile);
$sql ="insert into  documentos_compartidos (id_documentos,numero_padre,numero_hijo,tipo,nombre,link,COD_CENTRO,fecha,creado,privada,usuario,tipo_archivo) values
('$codigo_documento_asignado','$padre_recogido','$hijo','archivo','$nombre_archivo_arbol','$link_documento','$upload_centro','$fit','$nom_profesor','$tipo_documento','$nick_usuario','$tipo_archivo')";
mysql_query($sql);
desconectar();
header("Location: $ruta_absoluta/registro_archivos/$padre_recogido");
exit();
break;


}
}


case 'MODIFICAR':
header("Location: $ruta_absoluta/modificar_documentos");
}



?>







