<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();



$boton = $_REQUEST["nombre_boton"];
//CUANDO SE APRIETE EL INTRO SE GUARDARA
if ($boton=='')
{
$boton = 'GUARDAR';
}

switch ($boton) {
  case 'CERRAR':

header("Location: $ruta_absoluta/tipo_actas");
exit();
break;

case 'GUARDAR':
$id_tipo= $_REQUEST["id_tipo"];

$nombre_cas=$_POST['nombre_cas'];
$nombre_cas=str_replace($search,$replace,$nombre_cas);
$nombre_cas=limpiar_tags($nombre_cas);

$nombre_val=$_POST['nombre_val'];
$nombre_val=str_replace($search,$replace,$nombre_val);
$nombre_val=limpiar_tags($nombre_val);



$sql = "SELECT id_tipo FROM actas_tipo_acta where id_tipo='$id_tipo' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

if ($numero==0)
{$qry="insert into actas_tipo_acta(id_tipo,cod_centro,nombre_cas,nombre_val) values ('$id_tipo','$upload_centro','$nombre_cas','$nombre_val')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update actas_tipo_acta SET nombre_cas='$nombre_cas',nombre_val='$nombre_val' where id_tipo='$id_tipo' and cod_centro='$upload_centro' ");
}

mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/tipo_actas");
exit();
break;
}

?>

