<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();
$id_tipo=$_REQUEST['id_tipo'];
$tabla=$_REQUEST['tabla'];
$tipo_e_s=$_REQUEST['tipo_e_s'];
$eleccion=$_REQUEST['eleccion'];

$nombre_castellano=$_REQUEST['nombre_castellano'];
$nombre_castellano=str_replace($search,$replace,$nombre_castellano);
$nombre_castellano=limpiar_tags($nombre_castellano);


$nombre_valenciano=$_REQUEST['nombre_valenciano'];
$nombre_valenciano=str_replace($search,$replace,$nombre_valenciano);
$nombre_valenciano=limpiar_tags($nombre_valenciano);


$tabla_consulta="registro_".$tabla;
$id_consulta="id_".$tabla;


$sql = "SELECT $id_consulta FROM $tabla_consulta where $id_consulta='$id_tipo' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);


if ($numero==0)
{
$qry="insert into $tabla_consulta ($id_consulta,cod_centro,nombre_cas,nombre_val,entrada_salida) 
values ('$id_tipo','$upload_centro','$nombre_castellano','$nombre_valenciano','$tipo_e_s')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else 
{
mysql_query("update $tabla_consulta SET nombre_cas='$nombre_castellano', nombre_val='$nombre_valenciano' where $id_consulta='$id_tipo' and cod_centro='$upload_centro' ");
}

desconectar();

header("Location: $ruta_absoluta/mantenimiento/$eleccion");
exit();

?>