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
              
       if (document.Form1.usuario.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.usuario.focus()
       return 0;
       }
              if (document.Form1.nombre_usuario.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.nombre_usuario.focus()
       return 0;
       }
       
       if ( document.getElementById( "contra" )) {
       if (document.Form1.contrasenya.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.contrasenya.focus()
       return 0;
       }
    }
       
        if (document.getElementById("eleccion_tipo").value==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.tipo_usuario.focus()
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
$activo='configuracion';
$activado_crear_usuarios="activado";
include ("../../menu.php");
conectar();
?>




<?php

$acceso_permitido = mysql_query("SELECT crear_usuarios  FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["crear_usuarios"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align="justify">
<?php echo "$crear_usuarios2";?>
</div>

<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['usuario']))
{
$id_usuario_seleccionado=$_REQUEST['usuario'];
$usuario_seleccionado =mysql_query("SELECT * FROM usuarios where COD_CENTRO='$upload_centro' and usuario='$id_usuario_seleccionado' ");
$row = mysql_fetch_array($usuario_seleccionado);
$usuario_seleccionado=($row ["usuario"]);
$nombre_usuario_seleccionado= ($row ["nombre_usuario"]);
$permiso_seleccionado=($row ["PERMISO"]);

//BUSCAR EL PEMISO DEL USUARIO EDITADO
$nombre_permiso = mysql_query("SELECT tipo FROM 1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$permiso_seleccionado'");
$row1 = mysql_fetch_array($nombre_permiso);
$tipo_nombre= ($row1 ["tipo"]);

?>
<div id="campo_input" style="float:left;padding-top:10px;width:700px;" align='justify'>
<?php echo "$crear_usuarios3";?>
</div>
<?php
}
else 
{
$nombre_usuario_seleccionado='';
$usuario_seleccionado='';
$permiso_seleccionado='0';
$tipo_nombre=$editar_permisos3;
?>
<div id="campo_input" style="float:left;padding-top:10px;width:700px;" align='justify'>
<?php echo "$crear_usuarios4";?>
</div>
<?php
}
?>





<table class="borde_tabla" style='float: left;'>
<tr>
<th width="250px" ><div id="cabecera_tabla" align='left'><?php echo "$crear_usuarios5";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="80px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_borrar";?></div></th>
</tr>

<?php
$i=1;
$id_usuario =mysql_query("SELECT * FROM usuarios where COD_CENTRO='$upload_centro' order by nombre_usuario ");
while ($row = mysql_fetch_array($id_usuario))
{
$nombre_usuario=($row ["nombre_usuario"]);
$usuario=($row ["usuario"]);
$permiso=($row ["PERMISO"]);

$nombre_permiso1 = mysql_query("SELECT tipo FROM 1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
$row12= mysql_fetch_array($nombre_permiso1);
$tipo_nombre1= ($row12 ["tipo"]);

$link_editar="$ruta_absoluta/crear_usuario/$usuario";
$link_borrar="$ruta_absoluta/borrar_usuario/$usuario";

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
?>



<tr class='background<?php echo $color_backgrund;?>' > 
<td>
<div id="titulo_5" align="left"><?php echo "$nombre_usuario";?>
</div>

<div id="titulo_6" align="left"><?php echo $crear_usuarios11.': '.$tipo_nombre1;?>
</div>
</td>

<td>
<div id="enlaces"  class="transparente edit" align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>

<td>
<div id="enlaces"  class="transparente delete" align="center">
<a href='<?php echo "$link_borrar";?>' onclick="return confirmar('<?php echo "$crear_usuarios6 $nombre_usuario ?";?>')" target="_self">
<?php echo "$boton_borrar";?>
</a>
</td>
</tr>

<?php
$i=$i+1;
}
?>

</table>


<div  style='float:left;padding: 0px 0px 0px 10px;' >
<?php
if (!isset($_REQUEST['usuario']))
$texto_cabecera_formulario=$crear_usuarios12;
else
$texto_cabecera_formulario=$crear_usuarios13;
?>


<div id="cabecera_formulario">
<?php echo "<b>$texto_cabecera_formulario</b>";?>
</div>

<form class="formulario_borde2" name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/upload_usuarios">

<div id="campo_input"  align="left"></div>
<?php
if (!isset($_REQUEST['usuario']))
{
?>
<input type='hidden' name='comprobar_usuario'  value='1'> 
<?php
}
?>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$crear_usuarios7</b>";?>
</div>
<div id="campo_input"  align="left">
<input type="text" required maxlength='20' autocomplete="off" <?php if (isset($_REQUEST['usuario'])){?> readonly="readonly" style="background-color:<?php echo "$color_campo_no_editable";?>;" <?php }?> name='usuario' value='<?php echo "$usuario_seleccionado";?>'  >
</div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$crear_usuarios8</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' required maxlength='255' style='width:240px;' autocomplete="off" name='nombre_usuario'  value='<?php echo "$nombre_usuario_seleccionado";?>'/>
</div>


<?php
if (!isset($_REQUEST['usuario']))
{
?>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$crear_usuarios9</b>";?>
</div>
<div id="campo_input"  align="left">
<input type='text' id="contra"  maxlength='50' style='width:200px;' autocomplete="off" name='contrasenya' required value=''/>
</div>
<?php
}
?>



<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$crear_usuarios10</b>";?>
</div>
<div id="campo_input" align="justify">
<?php
$consulta=mysql_query("SELECT * FROM 1_tipos_permisos where cod_centro='$upload_centro' order by tipo");
   	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='tipo_usuario' id='eleccion_tipo'>";
	echo "<option value='$permiso_seleccionado'>$tipo_nombre</option>";
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

<input name="boton" type="button"  onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>"  />

<?php
if (isset($_REQUEST['usuario']))
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


