<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];

include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");
conectar();


$id_carpeta= $_REQUEST["id_carpeta"];

$ruta=$_POST['ruta'];
$ruta=str_replace($search,$replace,$ruta);
$ruta=limpiar_tags($ruta);

$numero_copies=$_POST['numero_copies'];
$numero_copies=str_replace($search,$replace,$numero_copies);
$numero_copies=limpiar_tags($numero_copies);

$sql = "SELECT id_carpeta FROM copies_carpeta where id_carpeta='$id_carpeta' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);
if ($numero==0)
{$qry="insert into copies_carpeta(id_carpeta,cod_centro,ruta,numero_copies) values 
('$id_carpeta','$upload_centro','$ruta','$numero_copies')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update copies_carpeta SET ruta='$ruta',numero_copies='$numero_copies' where id_carpeta='$id_carpeta' and cod_centro='$upload_centro' ");
}

header("Location: $ruta_absoluta/copies_seguretat");

mysql_close();
exit();

?>
