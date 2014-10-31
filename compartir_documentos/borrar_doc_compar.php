<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");

conectar();
$doc_id= $_REQUEST["id_documentos"];

$query = mysql_query("SELECT * from documentos_compartidos  WHERE id_documentos='$doc_id'");
$row = mysql_fetch_array($query);
$tipo=$row["tipo"];
$ruta_documento=$row["link"];
$ruta_documento=$upload_centro.'/'.$ruta_documento;
 
 
if($tipo=='archivo') {
$archivo='../archivos/compartidos/'.$ruta_documento;

mysql_query("DELETE FROM documentos_compartidos WHERE id_documentos='$doc_id'");

    if (file_exists($archivo))
    {
    unlink($archivo) ;
    }
}
if($tipo=='carpeta') {
mysql_query("DELETE FROM documentos_compartidos WHERE id_documentos='$doc_id'");
}

desconectar();
header("Location: $ruta_absoluta/modificar_documentos");

?>

