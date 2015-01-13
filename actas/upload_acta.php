<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
$upload_anyo_academico=$_SESSION['anyo_academico_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();

$div_seleccionado=$_REQUEST["div_seleccionado"];
$id_tipo_acta= $_REQUEST["tipo_acta_sel"];
$id_acta= $_REQUEST["id_acta"];

$anyo=$_POST['anyo'];
$anyo=str_replace($search,$replace,$anyo);
$anyo=limpiar_tags($anyo);

$fecha_acta=$_POST['fecha_acta'];
$fecha_acta=str_replace($search,$replace,$fecha_acta);
$fecha_acta=limpiar_tags($fecha_acta);
$fecha_acta=f_datefI($fecha_acta);

$texto=$_POST['texto'];
$texto=str_replace($search,$replace,$texto);
$texto = html_entity_decode($texto);


$acuerdos=$_POST['acuerdos'];
$acuerdos=str_replace($search,$replace,$acuerdos);


//insertamos si el acta es del año academico
if($anyo==$upload_anyo_academico)
{
//borro todos los asistentes iniciales y despues se graban de nuevo
mysql_query("DELETE FROM acta_asistentes_reunion WHERE id_actas='$id_acta' and cod_centro='$upload_centro'");

if (isset($_REQUEST['asiste']))
                  {
                  foreach ($_REQUEST['asiste'] as $profesorado1)
                  {                 	              	
                    $nom_prof=mysql_query("SELECT * FROM actas_asistentes where cod_centro='$upload_centro' and id_asistente='$profesorado1' and id_tipo_acta='$id_tipo_acta'");
                    $row2=mysql_fetch_array($nom_prof);
                      	$nom_profesor=($row2["nombre_asistente"]);
                     	$tipo_asistente=($row2["tipo_asistente"]);
                    
                    $cargo_asis=mysql_query("SELECT * FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$tipo_asistente'");
                    $row3=mysql_fetch_array($cargo_asis);	
                     	$nombre_cas=($row3["nombre_cas"]);
                       $nombre_val=($row3["nombre_val"]);
                       $orden=($row3["orden"]);
                       $id_tipo_asistente=($row3["id_tipo"]);
                  
                  $sql4 ="insert into acta_asistentes_reunion(id_actas,id_asistente,nombre,nombre_cargo_cas,nombre_cargo_val,id_tipo_asistente,orden_asistente,cod_centro)
                   values ('$id_acta','$profesorado1','$nom_profesor','$nombre_cas','$nombre_val','$id_tipo_asistente','$orden','$upload_centro')";
                  mysql_query($sql4);
                  }
                  }

}
$sql = "SELECT id_acta FROM actas where id_acta='$id_acta' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);

if ($numero==0)
{$qry="insert into actas(id_acta,cod_centro,texto,acuerdos,fecha,id_tipo_acta,anyo) values 
('$id_acta','$upload_centro','$texto','$acuerdos','$fecha_acta','$id_tipo_acta','$anyo')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else
{
mysql_query("update actas SET texto='$texto',acuerdos='$acuerdos',fecha='$fecha_acta',anyo='$anyo' where id_acta='$id_acta' and cod_centro='$upload_centro' ");
}

$boton = $_REQUEST["nombre_boton"];

switch ($boton) {
case 'GUARDAR':
header("Location: $ruta_absoluta/redactar_actas/$id_tipo_acta/$id_acta/$div_seleccionado");
exit();
break;
case 'VISTA_PREVIA':
header("Location: $ruta_absoluta/vista_previa/$id_tipo_acta/$id_acta/$div_seleccionado");
exit();
break;
case 'NUEVO':
header("Location: $ruta_absoluta/redactar_actas");
exit();
break;
case 'LISTADO':
header("Location: $ruta_absoluta/editar_actas/$anyo/$id_tipo_acta");
exit();
break;
}
mysql_close();
//CERRAMOS LA CONEXION

?>
