<?php
include ("../ruta_absoluta.php");

$id_nombre=($_REQUEST["id_nombre"]);
$seleccion=($_REQUEST["seleccion"]);
$tabla=$_REQUEST['tabla'];

$tabla_consulta="registro_".$tabla;
$id_consulta="id_".$tabla;



include ("../conexion.php");
conectar();


mysql_query("DELETE FROM $tabla_consulta WHERE $id_consulta ='$id_nombre'");

desconectar();
header("Location: $ruta_absoluta/mantenimiento/$seleccion");
?>

