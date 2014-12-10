<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script>

function valida_importar(){
	
	       if (document.Form2.tipo_asistente_may.value==0){
       alert("<?php echo "$actatexto40";?>")
       return 0;
       }
       
var archivo=document.Form2.archivo.value
var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
if (archivo!=""){
if (extension!=".txt") 
{alert('<?php echo "$actatexto38";?>')
return 0;
}
}

    if (document.Form2.archivo.value.length==0){
       alert("<?php echo "$actatexto39";?>")
       return 0;
       }
       


       
document.Form2.submit();
 }

function cerrar(){
var a="CERRAR";
document.Form3.nombre_boton.value=a;
document.Form3.submit();}

function valida_codigo(){
       var a="GUARDAR";
       document.Form3.nombre_boton.value=a;
      
       if (document.Form3.nombre_asis_ne.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form3.nombre_asis_ne.focus()
       return 0;
       }
       
	     if (document.Form3.tipo_asistente_ne.value==0){
        alert('<?php echo "$advertencia_rellenar"; ?>')
       return 0;
       }

       document.Form3.submit();
 }
 
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
$activo_importar_asistentes='active';
include("menu_crear.php");
?>

<div id="campo_input" style="float:left;width:700px;" align='justify'>
<?php echo "$actatexto29";?>
</div>

<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['tipo_acta']))
{
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

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/importar_asistentes"  id="Form1">
<div id="campo_input" style="float:left;width:700px;" align='justify'>
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
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</form>




<?php
if (isset($_REQUEST['tipo_acta']))
{
?>
<!--formulario de importacion-->


<div  style='float:left;padding: 0px 10px 0px 0px;width:330px' >
<div id="cabecera_formulario">
<?php echo "<b>$actatexto34</b>";?>
</div>
<form  name="Form2" class="formulario_borde2"  method="post" action="<?php echo "$ruta_absoluta";?>/upload_importar_asistentes" enctype="multipart/form-data">
<div id="campo_input"  align="left"> </div>
<input type="hidden" name='id_asistentes' value='<?php echo "$codigo_tipo";?>'  >
<input type="hidden" name='tipo_acta_import' value='<?php echo "$id_tipo_seleccionado";?>'  >

<div id="campo_input"  align="left">
<input name="archivo" type="file" id="archivo1" style='width:240px;'>
</div>


<div id="titulo_campo_texto">
<b><?php echo "$actatexto37";?></b>
</div>
<div id="campo_input"  align="left">
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_asistente_may'>";
	echo "<option value='0'>$actatexto31</option>";
	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
<div id="campo_input"  align="right">
<input name="boton" type="button" onclick="valida_importar();" value="<?php echo "$boton_importar";?>"  />
</div>
</form>
</div>

<!--formulario de edicion-->

<div  style='float: left;padding: 0px 10px 0px 10px;width:330px' >

<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['id_asistentes']))
{
$id_asistente_elegido=$_REQUEST['id_asistentes'];
$asist_sel =mysql_query("SELECT * FROM actas_asistentes where cod_centro='$upload_centro' and id_asistente='$id_asistente_elegido' ");
$row = mysql_fetch_array($asist_sel);
$id_asist_selected=($row ["id_asistente"]);
$nombre_asis_sel= ($row ["nombre_asistente"]);
$tipo_asistente= ($row ["tipo_asistente"]);

							if ($_SESSION["idioma_secretictac"]=='cas'){
							$tipo_asis =mysql_query("SELECT nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$tipo_asistente'");
							$row1 = mysql_fetch_array($tipo_asis);
							$nombre_tipo_asistente=($row1 ["nombre_cas"]);
							}
							if ($_SESSION["idioma_secretictac"]=='val'){
							$tipo_asis =mysql_query("SELECT nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$tipo_asistente'");
							$row1 = mysql_fetch_array($tipo_asis);
							$nombre_tipo_asistente=($row1["nombre_val"]);
							}

}
else 
{
$id_asist_selected=$codigo_tipo;
$nombre_asis_sel= '';
$tipo_asistente= '0';
$nombre_tipo_asistente=$actatexto31;
}
?>

<?php
if (!isset($_REQUEST['id_asistentes']))
$texto_cabecera_formulario=$actatexto41;
else
$texto_cabecera_formulario=$actatexto42;
?>
<div id="cabecera_formulario">
<?php echo "<b>$texto_cabecera_formulario</b>";?>
</div>

<form  name="Form3" class="formulario_borde2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_asistente_ne">

<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_asistentes_ne' value='<?php echo "$id_asist_selected";?>'  >
<input type="hidden" name='tipo_acta_import_ne' value='<?php echo "$id_tipo_seleccionado";?>'  >


<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$actatexto43</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='200' autocomplete="off" style='width:240px;' name='nombre_asis_ne'  value='<?php echo "$nombre_asis_sel";?>'/>
</div>


<div id="campo_input">
<b><?php echo "$actatexto44";?></b>

<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_asistente_ne'>";
	echo "<option value='$tipo_asistente'>$nombre_tipo_asistente</option>";
	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>


<div id="campo_input"  align="right">
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name="boton" type="button"   onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>"  />

<?php
if (isset($_REQUEST['id_asistentes']))
{
?>
<input name="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_nuevo";?>"  />
<?php
}
?>
</div>
</form>

</div>

<!--tabla de usuarios-->
<div  style='float:left;min-height:500px;'><!--para la altura de la tabla minima-->
<table class="borde_tabla" >
<tr>
<th colspan="4"width="570px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto36: $nombre_acta";?></div></th>
</tr>
<tr>
<th width="360px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto32";?></div></th>
<th width="150px" ><div id="cabecera_tabla" align='center'><?php echo "$actatexto33";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>

<?php
$i=1;
$consulta_asistentes =mysql_query("SELECT * FROM  actas_asistentes where cod_centro='$upload_centro' and id_tipo_acta='$id_tipo_seleccionado' order by nombre_asistente ");
while ($row = mysql_fetch_array($consulta_asistentes))
{
$id_asistentes=($row ["id_asistente"]);
$nombre_asistente=($row ["nombre_asistente"]);
$tipo_asistente=($row ["tipo_asistente"]);

if ($_SESSION["idioma_secretictac"]=='cas'){
$tipo_asis =mysql_query("SELECT nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$tipo_asistente'");
$row1 = mysql_fetch_array($tipo_asis);
$nombre_tipo_asistente=($row1 ["nombre_cas"]);
}
if ($_SESSION["idioma_secretictac"]=='val'){
$tipo_asis =mysql_query("SELECT nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$tipo_asistente'");
$row1 = mysql_fetch_array($tipo_asis);
$nombre_tipo_asistente=($row1["nombre_val"]);
}

$link_editar="$ruta_absoluta/importar_asistentes/$id_asistentes/$id_tipo_seleccionado";
$link_borrar="$ruta_absoluta/borrar_asistentes/$id_asistentes/$id_tipo_seleccionado";

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_7" align="left"><?php echo "$nombre_asistente";?>
</div>
</td>

<td >
<div id="titulo_7" align="left"><?php echo "$nombre_tipo_asistente";?>
</div>
</td>

<td>
<div id="enlaces"  class="transparente edit" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>

<td >
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$actatexto35  $nombre_asistente ?";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
</td>
</tr>

<?php
$i=$i+1;
}
?>

</table>
</div>



<?php
}
desconectar();
?>
<div style="clear:both;" id="separdor"></div>

</div>


<?php include ("../pie_pagina.php");?>
