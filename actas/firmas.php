<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script>

function valida_codigo(){
       if (document.Form1.tipo_asistente.value==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.tipo_asistente.focus()
       return 0;
       }
       if (document.Form1.tipo_acta.value==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.tipo_acta.focus()
       return 0;
       }

       document.Form1.submit();
 }

function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}


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
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.$codigo_fecha;

$activo='actas';
$activado_crear_actas="activado";
include ("../menu.php");
conectar();

$acceso_permitido = mysql_query("SELECT crear_actas FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["crear_actas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}
?>



<div id="titulo_1" align="justify">
<?php echo "$actatexto49";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto6";?>
</div>
<?php
$activo_firmas='active';
include("menu_crear.php");

?>

<div id="campo_input" style="float:left;width:700px;" align='justify'>
<?php echo "$actatexto45";?>
</div>

<!--tabla de usuarios-->
<div  style='float:left;min-height:500px;'><!--para la altura de la tabla minima-->
<table class="borde_tabla" >
<tr>
<th width="200px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto8";?></div></th>
<th width="100px" ><div id="cabecera_tabla" align='center'><?php echo "$actatexto46";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$tipo_actas_se=mysql_query("SELECT * FROM  actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas ");
if ($_SESSION["idioma_secretictac"]=='val')
$tipo_actas_se=mysql_query("SELECT * FROM  actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val ");
while ($row = mysql_fetch_array($tipo_actas_se))
{
$id_tipo=($row ["id_tipo"]);
	if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_tipo1=mysql_query("SELECT nombre_cas FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo' ");
				$row1 = mysql_fetch_array($nombre_tipo1);
				  $nombre_tipo_acta=$row1["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_tipo1=mysql_query("SELECT nombre_val FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo' ");
				$row1 = mysql_fetch_array($nombre_tipo1);
				  $nombre_tipo_acta=$row1["nombre_val"];
				}
				

$consulta_firmas =mysql_query("SELECT * FROM  actas_firmas where cod_centro='$upload_centro' and id_tipo_acta='$id_tipo' order by orden");
while ($row2 = mysql_fetch_array($consulta_firmas))
{
$id_firma=($row2 ["id_firma"]);
$id_tipo_asistente=($row2 ["id_tipo_asistente"]);
$link_borrar="$ruta_absoluta/borrar_firmantes/$id_firma";

if ($_SESSION["idioma_secretictac"]=='cas'){
$tipo_asis =mysql_query("SELECT nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$id_tipo_asistente'");
$row3 = mysql_fetch_array($tipo_asis);
$nombre_tipo_asistente=($row3 ["nombre_cas"]);
}
if ($_SESSION["idioma_secretictac"]=='val'){
$tipo_asis =mysql_query("SELECT nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$id_tipo_asistente'");
$row3 = mysql_fetch_array($tipo_asis);
$nombre_tipo_asistente=($row3["nombre_val"]);
}


if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_7" align="left"><?php echo "$nombre_tipo_acta";?>
</div>
</td>

<td>
<div id="titulo_7" align="left"><?php echo "$nombre_tipo_asistente";?>
</div>
</td>


<td >
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$actatexto35  $nombre_tipo_asistente $actatexto47 $nombre_tipo_acta?";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
</td>
</tr>


<?php
$i=$i+1;
}

}
?>
</table>
</div>


<div  style='float: left;padding: 0px 10px 0px 10px;width:330px' >

<div id="cabecera_formulario">
<?php echo "<b>$texto_cabecera_formulario</b>";?>
</div>

<form  name="Form1" class="formulario_borde2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_tipo_firma">

<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_firma' value='<?php echo "$codigo_tipo";?>'  >


<div id="titulo_campo_texto">
<b><?php echo "$actatexto44";?></b>
</div>
<div id="campo_input">
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_asistente' style='width:200px'>";
	echo "<option value='0'>$actatexto31</option>";
	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

<div id="titulo_campo_texto" align='justify'>
<b><?php echo "$actatexto30";?></b>
</div>
<div id="campo_input" >
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_acta'  style='width:200px'>";
	echo "<option value='0'>$actatexto31</option>";
	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

<div id="campo_input">
<input  type="checkbox" name="firma_convocatoria"  checked value="1">
<b><?php echo "$actatexto94";?></b>
</div>

<div id="campo_input"  align="left">
<?php echo "<b>$actatexto15</b>";?>&nbsp;
<input type='text' maxlength='2' autocomplete="off" style='width:40px;' name='orden'  value=''/>
</div>

<div id="campo_input"  align="right">
<input name="boton" type="button"   onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>"  />
</div>
</form>

</div>



<?php
desconectar();
?>
<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>
