<?php
include ("../../permisos.php");

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
      
       if (document.Form1.tipo.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.tipo.focus()
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

<?php
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.md5($usuario).$codigo_fecha;
?>



<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$activo='configuracion';
$activado_tivo_permisos="activado";
include ("../../menu.php");
conectar();
?>




<?php

$acceso_permitido = mysql_query("SELECT tipo_permisos FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["tipo_permisos"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align="justify">
<?php echo "$tipo_texto4";?>
</div>

<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['id_tipo']))
{
$id_tipo_seleccionado=$_REQUEST['id_tipo'];
$permiso_seleccionado =mysql_query("SELECT * FROM 1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$id_tipo_seleccionado' ");
$row = mysql_fetch_array($permiso_seleccionado);
$id_tipo_seleccion=($row ["id_tipo"]);
$tipo_seleccion= ($row ["tipo"]);
?>
<div id="campo_input" style="float:left;padding-top:10px;width:690px;" align='justify'>
<?php echo "$tipo_texto9";?>
</div>
<?php
}
else 
{
$id_tipo_seleccion=$codigo_tipo;
$tipo_seleccion='';
?>
<div id="campo_input" style="float:left;padding-top:10px;width:690px;" align='justify'>
<?php echo "$tipo_texto5";?>
</div>
<?php
}

?>





<table class="borde_tabla" style='float: left;'>
<tr>
<th width="250px" ><div id="cabecera_tabla" align='left'><?php echo "$tipo_texto6";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>

<?php
$i=1;
$tipo_permiso =mysql_query("SELECT * FROM 1_tipos_permisos where cod_centro='$upload_centro' order by tipo ");
while ($row = mysql_fetch_array($tipo_permiso))
{
$id_tipo=($row ["id_tipo"]);
$tipo= ($row ["tipo"]);

$link_editar="$ruta_absoluta/tipo_permiso_editar/$id_tipo";
$link_borrar="$ruta_absoluta/borrar_tipo/$id_tipo";

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td>
<div id="titulo_5" align="left"><?php echo "$tipo";?>
</div>
</td>

<td>
<div id="enlaces"  class="transparente edit" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>

<td>
<?php if ($id_tipo!=1)
{
?>
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$tipo_texto10 $tipo ?";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
<?php
}
?>
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
$texto_cabecera_formulario=$tipo_texto11;
else
$texto_cabecera_formulario=$tipo_texto12;
?>


<div id="cabecera_formulario">
<?php echo "<b>$texto_cabecera_formulario</b>";?>
</div>

<form  name="Form1" class="formulario_borde2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_tipo_permisos">

<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_tipo' value='<?php echo "$id_tipo_seleccion";?>'  >

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$tipo_texto8</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' maxlength='40' autocomplete="off" style='width:240px;' name='tipo'  value='<?php echo "$tipo_seleccion";?>'/>
</div>

<div id="campo_input"  align="right">
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name="boton" type="button"   onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>"  />

<?php
if (isset($_REQUEST['id_tipo']))
{
?>
<input name="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_volver";?>"  />
<?php
}
?>
</div>
</form>


</div>

<?php
desconectar();
?>
</div>







<?php include ("../../pie_pagina.php");?>
