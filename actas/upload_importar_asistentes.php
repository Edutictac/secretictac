<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();
$id_asistentes=$_REQUEST['id_asistentes'];
$tipo_acta_import=$_REQUEST['tipo_acta_import'];
$tipo_asistente_may=$_REQUEST['tipo_asistente_may'];

$tempFile = $_FILES["archivo"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"];
$tipo = $_FILES["archivo"]["type"];
$nombre_archivo = $_FILES["archivo"]["name"];
$targetPath='../archivos/';
$targetFile =  $targetPath.$nombre_archivo;

  if (!file_exists($targetPath))
    {
    mkdir(str_replace('//','/',$targetPath), 0777, true);
    }
    
    if ($tempFile != '') {

 // comprobar extension con php
$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
$tipo_archivo=finfo_file($finfo, $tempFile) ;
finfo_close($finfo);
      if ($tipo_archivo!='text/plain') {
       die('<b>'.$_FILES["archivo"]["name"].'</b> no es archivo v&aacute;lido!<br/>'.$_FILES["archivo"]["name"].' es un archivo <b>'.$tipo_archivo.'</b><br>'.
        '<a href="javascript:history.go(-1);">'.
        '&lt;&lt VOLVER</a>');
        exit();
      }
    }
 
if ($nombre_archivo != "") {
if (copy($_FILES["archivo"]['tmp_name'],$targetFile)) {
}
else {
$status = "Error al subir el archivo";
echo "$status";
}
}   
    
mysql_query("DELETE FROM actas_asistentes WHERE cod_centro ='$upload_centro' and id_tipo_acta='$tipo_acta_import'");

$data = file($targetFile);
  for($i=0; $i<sizeof($data); $i++) {
      $line = trim($data[$i]);
      $arr = explode(";", $line);
      $remm = str_replace("'","", $arr);
      $id_asistente_codigo=$id_asistentes.$i;
      $sql = "insert into actas_asistentes (nombre_asistente,id_tipo_acta,id_asistente,tipo_asistente,cod_centro) values
       ('".utf8_decode(implode("','", $remm))."','$tipo_acta_import','$id_asistente_codigo','$tipo_asistente_may','$upload_centro')";
      mysql_query($sql);

}
unlink($targetFile);
header("Location: $ruta_absoluta/importar_asistentes/$tipo_acta_import");
exit();
?>