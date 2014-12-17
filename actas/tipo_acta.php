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
      
       if (document.Form1.nombre_cas.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.nombre_cas.focus()
       return 0;
       }
       
       if (document.Form1.nombre_val.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.nombre_val.focus()
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

</script>


<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.md5($usuario).$codigo_fecha;

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
$activo_tipo_acta='active';
include("menu_crear.php");

?>

<div id="campo_input" style="float:left;width:700px;" align='justify'>
<?php echo "$actatexto12";?>
</div>


<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['id_tipo']))
{
$id_tipo_seleccionado=$_REQUEST['id_tipo'];
$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo_seleccionado' ");
$row = mysql_fetch_array($tipo_sel);
$id_tipo_seleccion=($row ["id_tipo"]);
$nombre_cas= ($row ["nombre_cas"]);
$nombre_val= ($row ["nombre_val"]);
$cabecera_actas= ($row ["encabezado_acta"]);
$cabecera_convocatorias= ($row ["encabezado_convocatoria"]);
}
else 
{
$id_tipo_seleccion=$codigo_tipo;
$nombre_cas= '';
$nombre_val= '';
}
?>

<table class="borde_tabla" style='float: left;'>
<tr>
<th width="250px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto8";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>

<?php
$i=1;
if ($_SESSION["idioma_secretictac"]=='cas')
$tipo_asis =mysql_query("SELECT * FROM  actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas ");
if ($_SESSION["idioma_secretictac"]=='val')
$tipo_asis =mysql_query("SELECT * FROM  actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val ");
while ($row = mysql_fetch_array($tipo_asis))
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
				
$link_editar="$ruta_absoluta/tipo_acta/$id_tipo";
$link_borrar="$ruta_absoluta/borrar_tipo_acta/$id_tipo";

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_5" align="left"><?php echo "$nombre_tipo_acta";?>
</div>
</td>

<td >
<div id="enlaces"  class="transparente edit" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>

<td >
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$actatexto17  $nombre_tipo_acta?";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
</td>
</tr>

<?php
$i=$i+1;
}
?>

</table>



<div  style='float: left;padding: 0px 10px 0px 10px;' >
<?php
if (!isset($_REQUEST['id_tipo']))
$texto_cabecera_formulario=$actatexto18;
else
$texto_cabecera_formulario=$actatexto14;
?>


<div id="cabecera_formulario">
<?php echo "<b>$texto_cabecera_formulario</b>";?>
</div>

<form  name="Form1" class="formulario_borde2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_tipo_acta">

<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_tipo' value='<?php echo "$id_tipo_seleccion";?>'  >

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto15</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='100' autocomplete="off" style='width:240px;' name='nombre_cas'  value='<?php echo "$nombre_cas";?>'/>
</div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto16</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='100' autocomplete="off" style='width:240px;' name='nombre_val'  value='<?php echo "$nombre_val";?>'/>
</div>

    <div id="campo_input"  align="left">
    <input type="checkbox"  name="cabecera_actas" <?php if ($cabecera_actas=='1') echo checked;?> value="1" >
   <b> <?php echo "$actatexto92";?></b>
    </div>
    
        <div id="campo_input"  align="left">
    <input type="checkbox"  name="cabecera_convocatorias" <?php if ($cabecera_convocatorias=='1') echo checked;?> value="1" >
   <b> <?php echo "$actatexto93";?></b>
    </div>


<div id="campo_input"  align="right">
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name="boton" type="button"   onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>"  />

<?php
if (isset($_REQUEST['id_tipo']))
{
?>
<input name="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_nuevo";?>"  />
<?php
}
?>
</div>
</form>




<?php
desconectar();
?>
</div>
<div id="separador" style="clear:both;"></div>

</div>







<?php include ("../pie_pagina.php");?>
