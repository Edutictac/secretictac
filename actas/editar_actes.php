<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script>
function confirmar ( mensaje ) {
return confirm( mensaje );
}
 function envia(){
       document.Form1.submit();
}
</script>


<div id="container">

<div id="tabla_centrar2" align="left">

<?php

$activo='actas';
$activado_editar_actas="activado";
include ("../menu.php");
conectar();

$acceso_permitido = mysql_query("SELECT listado_actas FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["listado_actas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}
?>
<div id="titulo_1" align="justify">
<?php echo "$actatexto57";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto67";?>
</div>

<?php
if (isset($_REQUEST['tipo_acta']))
{
				if(isset($_REQUEST['anyo']))
				$anyo_seleccionado=$_REQUEST['anyo'];
				else 
				$anyo_seleccionado=$upload_anyo_academico;
	
$id_tipo_seleccionado=$_REQUEST['tipo_acta'];

$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo_seleccionado' ");
$row = mysql_fetch_array($tipo_sel);
$id_tipo_seleccion=($row ["id_tipo"]);

if ($_SESSION["idioma_secretictac"]=='cas')
$nombre_acta= ($row ["nombre_cas"]);
if ($_SESSION["idioma_secretictac"]=='val')
$nombre_acta= ($row ["nombre_val"]);
}
else 
{
$id_tipo_seleccion='0';
$nombre_acta= $actatexto31;

}
?>

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/editar_actas"  id="Form1">
<div id="campo_input" style="width:700px;" align='justify'>
<b><?php echo "$actatexto30";?></b>
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_acta' onchange='envia()'>";
	echo "<option value=$id_tipo_seleccion>$nombre_acta</option>";
	
	while($registro=mysql_fetch_row($consulta))
	{
		//miramos las actas sobre las que tiene permiso
		$sql = "SELECT id_tipo_acta FROM actas_permisos where id_tipo_acta='".$registro[0]."' and id_tipo_permisos='$permiso' and cod_centro='$upload_centro'";
   $result = mysql_query($sql);
   $numero = mysql_num_rows($result);
   if ($numero!=0)
   {
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
  	}
	}
	echo "</select>";

?>
</div>
</form>

<div id='campo_input'>
<?php
$busqueda_anyo = mysql_query("SELECT distinct anyo FROM actas where cod_centro='$upload_centro' and id_tipo_acta='$id_tipo_seleccionado' order by anyo desc");
while ($row5 = mysql_fetch_array($busqueda_anyo))
{
$anyo_academico= ($row5 ["anyo"]);
$link_anyo_academico="$ruta_absoluta/editar_actas/$anyo_academico/$id_tipo_seleccionado";
?>

<a href='<?php echo "$link_anyo_academico";?>' target="_self">
<div id="enlaces" style="float:left">
<?php
if($anyo_academico==$anyo_seleccionado)
echo "<span class='activo'><b><u>$anyo_academico</u></b></font>";
else
echo "$anyo_academico";
?>
</div>

</a>
&nbsp;&nbsp;&nbsp;

<?php
}
?>
</div>


<?php
$i='1';
if (isset($_REQUEST['tipo_acta']))
{
?>

<table class= 'borde_tabla' cellpadding="0" cellspacing="0">
<tr>
<th width="80px" ><div id="cabecera_tabla" align='left'><?php echo "$compartirtexto28";?></div></th>
<th width="450px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto68 $nombre_acta";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$registrotexto56";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_imprimir";?></div></th>
</tr>
<?php
$listado_actas=mysql_query("SELECT * FROM actas where cod_centro='$upload_centro' and id_tipo_acta='$id_tipo_seleccionado' and anyo='$anyo_seleccionado' order by fecha desc");
	while($row = mysql_fetch_array($listado_actas))
	{
		$id_acta=($row ["id_acta"]);
		$fecha_ver= f_datef($row ["fecha"]);
		$anyo= ($row ["anyo"]);
   $texto= Recortar((quitar_html($row ["texto"])),250);
   $link_editar="$ruta_absoluta/redactar_actas/$id_tipo_seleccionado/$id_acta/1";
   $link_imprimir="$ruta_absoluta/vista_previa_editar/$id_tipo_seleccionado/$id_acta/$anyo/0";


if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>

<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_5" align="left"><?php echo "$fecha_ver";?>
</div>
</td>

<td  >
<div id="titulo_5" align="justify"><?php echo "$texto";?></div>
</td>

<td >
<div id="enlaces" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$registrotexto56";?>
</a>
</td>

<td >
<div id="enlaces"  align="center">
<a href='<?php echo "$link_imprimir";?>' target="_self">
<?php echo "$boton_imprimir";?>
</a>
</td>
</tr>
<?php
$i=$i+1;
}
?>

</table>
<?php
}
desconectar();
?>
<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>
