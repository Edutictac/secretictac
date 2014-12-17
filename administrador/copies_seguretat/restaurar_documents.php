<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../../idioma.php");
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");

conectar();


$tempFile = $_FILES["archivo"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"];
$tipo = $_FILES["archivo"]["type"];
$nombre_archivo = $_FILES["archivo"]["name"];
$targetPath="../../archivos/";
$targetFile =  $targetPath.$nombre_archivo;
move_uploaded_file($tempFile,$targetFile);

$backup_file ='../../archivos/'. $nombre_archivo;


//clse para extraer zip
class Zip_manager{

function listar($var){
$entries = array();
$zip = zip_open($var);
if (!is_resource($zip)){
die ("No se puede leer el archivo.");
}
else{
while ($entry = zip_read($zip)){
$entries[] = zip_entry_name($entry);
}
}
zip_close($zip);
return $entries;
}

function extraer($var, $destino){
$zip = new ZipArchive;
if ($zip->open($var) === TRUE) {
$zip->extractTo($destino);
$zip->close();
return true;
} else {
return false;
}
}
}

//descomprension del archivo zip
$zip_manager = new Zip_manager();
$archivo_zip = $backup_file; // aqui el nombre del archivo a extraer
$explode_carpeta = explode(".zip", $archivo_zip);  // Es lo que hace es quitarle el .zip
$carpeta_final = '../../';//esto lo he quitado para que se forme un unico directorio .$explode_carpeta[0];  // un simple explode...
$listado = $zip_manager->listar($archivo_zip);
//print_r($listado);
$resultado = $zip_manager->extraer($archivo_zip, $carpeta_final); // aqui pirmero el nombre del archivo y despues la carpeta del destino final.
if (!$resultado){
echo "Error: no se ha podido extraer el archivo";
}
else{
echo "<br>";
}


echo "<script>alert('$copiestexte19');</script>";
unlink($backup_file);
echo "<script>location.href='$ruta_absoluta/copies_seguretat';</script>";	


desconectar();
?>