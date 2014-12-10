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
       var a="GUARDAR";
       document.Form1.nombre_boton.value=a;
       document.Form1.submit();
 }

function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}


function confirmar ( mensaje ) {
return confirm( mensaje );
}

</script>

<?php
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.md5($usuario).$codigo_fecha;
?>
<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$activo='registro';
$activado_configuracion="activado";
include ("../menu.php");
conectar();
?>




<?php

$acceso_permitido = mysql_query("SELECT configuracion FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["configuracion"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align="justify">
<?php echo "$mantenimientotexto1";?>
</div>

<div id="titulo_2" align="justify">
<?php echo "$mantenimientotexto2";?>
</div>
<div id="campo_input"></div>
<table>
<tr>
<td>
<div id="titulo_campo_texto" style='padding-right:50px'> <b><?php echo $mantenimientotexto3;?></b></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/origen_entradas"> <?php echo $mantenimientotexto6;?></a></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/organismo_entradas"> <?php echo $mantenimientotexto7;?></a></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/destino_entradas"> <?php echo $mantenimientotexto8;?></a></div>

</td>
<td>
<div id="titulo_campo_texto" style='padding-right:50px'> <b><?php echo $mantenimientotexto4;?></b></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/origen_salidas"> <?php echo $mantenimientotexto6;?></a></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/organismo_salidas"> <?php echo $mantenimientotexto7;?></a></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/destino_salidas"> <?php echo $mantenimientotexto8;?></a></div>

</td>

<td valign="top">
<div id="titulo_campo_texto"> <b><?php echo $mantenimientotexto10;?></b></div>
<div id="enlaces"><a href="<?php echo $ruta_absoluta;?>/mantenimiento/documentos"> <?php echo $mantenimientotexto9;?></a></div>
</td>
</tr>
</table>


<?php
if (isset($_REQUEST['seleccion']))
{
$selecccion=$_REQUEST['seleccion'];
switch ($selecccion) {
case 'origen_entradas':
$tabla='origen';
$tipo_e_s='e';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_origen, nombre_cas,nombre_val FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_origen, nombre_val,nombre_cas FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");
					}				
$nombre_tabla=$mantenimientotexto13;	
break;
case 'organismo_entradas':
$tabla='organismo';
$tipo_e_s='e';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_organismo, nombre_cas,nombre_val FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_organismo, nombre_val,nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");
					}
$nombre_tabla=$mantenimientotexto14;		
break;
case 'destino_entradas':
$tabla='destino';
$tipo_e_s='e';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_destino, nombre_cas,nombre_val FROM  registro_destino where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_destino, nombre_val,nombre_cas FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");
					}	
				$nombre_tabla=$mantenimientotexto15;	
break;
case 'origen_salidas':
$tabla='destino';
$tipo_e_s='s';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_destino, nombre_cas,nombre_val FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_destino, nombre_val,nombre_cas FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");
					}				
$nombre_tabla=$mantenimientotexto16;	
break;
case 'organismo_salidas':
$tabla='organismo';
$tipo_e_s='s';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_organismo, nombre_cas,nombre_val FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_organismo, nombre_val,nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");
					}
$nombre_tabla=$mantenimientotexto17;	
break;
case 'destino_salidas':
$tabla='origen';
$tipo_e_s='s';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_origen, nombre_cas,nombre_val FROM  registro_origen where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_origen, nombre_val,nombre_cas FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");
					}	
				$nombre_tabla=$mantenimientotexto18;	
break;
case 'documentos':
$tipo_e_s='d';
$tabla='tipo_documento';
if ($_SESSION["idioma_secretictac"]=='cas')
					{
						$tipo_org =mysql_query("SELECT id_tipo_documento, nombre_cas,nombre_val FROM  registro_tipo_documento where cod_centro='$upload_centro' order by nombre_cas");
					}
if ($_SESSION["idioma_secretictac"]=='val')
					{
						$tipo_org =mysql_query("SELECT id_tipo_documento, nombre_val,nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_val");
					}	
				$nombre_tabla=$mantenimientotexto19;	
break;
}
?>



<div id="campo_input"></div>

<div id="titulo_2"><?php echo $nombre_tabla;?></div>
<table class="borde_tabla" style='float: left;'>
<tr>
<th width="230px" ><div id="cabecera_tabla" align='left'><?php echo "$mantenimientotexto11";?></div></th>
<th width="70px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="75px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>

<?php
$i=1;

while ($consulta_org = mysql_fetch_row($tipo_org))
{
$id_nombre=$consulta_org[0];
$nombre= $consulta_org[1];
$nombre_2= $consulta_org[2];
$link_editar="$ruta_absoluta/mantenimiento_1/$id_nombre/$selecccion/$tabla";
$link_borrar="$ruta_absoluta/borrar_mantenimiento/$id_nombre/$selecccion/$tabla";

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
	
$contar_registros_docu = "SELECT id_registro FROM registro where $tabla='$id_nombre' and cod_centro='$upload_centro'";
$result = mysql_query($contar_registros_docu);
$numero = mysql_num_rows($result);	
if($numero!=0)
{
$frase_borrado=$mantenimientotexto22 ." ".$numero." ". $mantenimientotexto23;
}
	else
{
$frase_borrado=$mantenimientotexto24;
}
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_campo_texto3" align="left"><?php echo "$nombre";?>
</div>
<div id="titulo_campo_texto4" align="left"><?php echo "$nombre_2";?>
</div>
<div id="titulo_campo_texto3" align="right"><?php echo "$mantenimientotexto21: $numero";?>
</div>
</td>

<td >
<div id="enlaces"  class="transparente edit" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>

<td>
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$frase_borrado";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
</td>
</tr>

<?php
$i=$i+1;
}
?>

</table>

<?php
if (isset($_REQUEST['id_nombre']))
{
$id_nombre_rec=$_REQUEST['id_nombre'];
$tabla_consulta="registro_".$tabla;
$id_consulta="id_".$tabla;
$registro_seleccionado =mysql_query("SELECT * FROM $tabla_consulta where cod_centro='$upload_centro' and $id_consulta='$id_nombre_rec'");
$row = mysql_fetch_array($registro_seleccionado);
$id_nombre_consulta=($row [$id_consulta]);
$nombre_castellano=($row ["nombre_cas"]);
$nombre_valenciano=($row ["nombre_val"]);

}
else {
	$id_nombre_consulta=$codigo_tipo;
	$nombre_castellano='';
	$nombre_valenciano='';
}

?>
<div  style='float: left;padding: 0px 0px 0px 10px;' >

<div id="cabecera_formulario">
<?php echo "<b>$mantenimientotexto12</b>";?>
</div>

<form  name="Form1" class="formulario_borde2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_mantenimiento">

<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_tipo' value='<?php echo "$id_nombre_consulta";?>'  >
<input type="hidden" name='tabla' value='<?php echo "$tabla";?>'  >
<input type="hidden" name='tipo_e_s' value='<?php echo "$tipo_e_s";?>'  >
<input type="hidden" name='eleccion' value='<?php echo "$selecccion";?>'  >

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto15</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='255' autocomplete="off" style='width:300px;' name='nombre_castellano'  value='<?php echo $nombre_castellano;?>'/>
</div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto16</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='255' autocomplete="off" style='width:300px;' name='nombre_valenciano'  value='<?php echo $nombre_valenciano;?>'/>
</div>

<div id="campo_input"  align="right">
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name="boton" type="submit" value="<?php echo "$boton_guardar";?>"  />

</div>
</form>


</div>
<?php
}

desconectar();
?>
</div>







<?php include ("../pie_pagina.php");?>
