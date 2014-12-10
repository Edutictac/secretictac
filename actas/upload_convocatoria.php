<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
$upload_anyo_academico=$_SESSION['anyo_academico_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();

$id_convocatoria=$_REQUEST["id_convocatoria"];
$id_tipo_acta= $_REQUEST["tipo_acta_sel"];


$anyo=$_POST['anyo'];
$anyo=str_replace($search,$replace,$anyo);
$anyo=limpiar_tags($anyo);

$fecha_acta=$_POST['fecha_acta'];
$fecha_acta=str_replace($search,$replace,$fecha_acta);
$fecha_acta=limpiar_tags($fecha_acta);
$fecha_acta=f_datefI($fecha_acta);


$fecha_convocatoria=$_POST['fecha_convocatoria'];
$fecha_convocatoria=str_replace($search,$replace,$fecha_convocatoria);
$fecha_convocatoria=limpiar_tags($fecha_convocatoria);
$fecha_convocatoria=f_datefI($fecha_convocatoria);


$texto_cas=$_POST['texto_cas'];
$texto_cas=str_replace($search,$replace,$texto_cas);

$texto_val=$_POST['texto_val'];
$texto_val=str_replace($search,$replace,$texto_val);

$sql = "SELECT id_convocatoria FROM actas_convocatorias where id_convocatoria='$id_convocatoria' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

if ($numero==0)
{$qry="insert into actas_convocatorias(id_convocatoria,cod_centro,texto_cas,texto_val,fecha,id_tipo_acta,anyo,fecha_convocatoria) values 
('$id_convocatoria','$upload_centro','$texto_cas','$texto_val','$fecha_acta','$id_tipo_acta','$anyo','$fecha_convocatoria')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update actas_convocatorias SET texto_cas='$texto_cas',texto_val='$texto_val',fecha='$fecha_acta',anyo='$anyo',fecha_convocatoria='$fecha_convocatoria' where id_convocatoria='$id_convocatoria' and cod_centro='$upload_centro' ");
}

$boton = $_REQUEST["nombre_boton"];
switch ($boton) {
case 'GUARDAR':
header("Location: $ruta_absoluta/convocatorias_actas/$id_tipo_acta/$id_convocatoria");
exit();
break;
case 'VISTA_PREVIA':
header("Location: $ruta_absoluta/vista_previa_convocatoria/$id_tipo_acta/$id_convocatoria");
exit();
break;
case 'NUEVO':
header("Location: $ruta_absoluta/convocatorias_actas");
exit();
break;

}
mysql_close();
//CERRAMOS LA CONEXION

?>
