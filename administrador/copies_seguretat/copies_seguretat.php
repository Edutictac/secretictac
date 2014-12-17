<?php
include ("../../permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>
<script>
function guardar_ruta(){
document.Form1.submit();
}
function copia_seguretat(){
document.Form2.submit();
}
function restaurar_dades(){
document.Form3.submit();
}
function restaurar_documents(){
document.Form4.submit();
}
</script>
<div id="container">

<div id="tabla_centrar2" align="left">
<?php
$codigo_fecha = date("dmyHis");
$codigo_carpeta=$upload_centro.md5($usuario).$codigo_fecha;

$activo='configuracion';
$activado_copies_seguretat="activado";
include ("../../menu.php");
conectar();
?>

<?php

$acceso_permitido = mysql_query("SELECT copies_seguretat  FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["copies_seguretat"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align="justify">
<?php echo "$copiestexte2";?>
</div>

<div id="campo_input" align="justify">
<?php echo "$copiestexte3";?>
</div>

<div id="campo_input" align="justify">
<?php echo "$copiestexte17";?>
</div>

<div  style='float:left;padding: 0px 10px 0px 0px;' >
<div id="cabecera_formulario">
<?php echo "<b>$copiestexte6</b>";?>
</div>

<form class="formulario_borde2" name="Form1" style="width:350px;"  method="post" action="<?php echo "$ruta_absoluta";?>/guardar_ruta">
<?php
$id_ruta =mysql_query("SELECT * FROM copies_carpeta where cod_centro='$upload_centro'");
$numero = mysql_num_rows($id_ruta);
if ($numero!=0)
{
$row = mysql_fetch_array($id_ruta);
$id_carpeta=($row ["id_carpeta"]);
$nombre_carpeta=($row ["ruta"]);
$numero_copies=($row ["numero_copies"]);
}
else
{
$id_carpeta=$codigo_carpeta;
$nombre_carpeta='';
$numero_copies='';
}
?>

<input type="hidden"   name='id_carpeta' value='<?php echo "$id_carpeta";?>'  >

<div id="titulo_campo_texto" style="margin-top:10px;" align="left">
<b><?php echo "$copiestexte4";?></b>
</div>
<div id="campo_input"  align="left">
<input type="text"  maxlength='500' style="width:350px;" autocomplete="off"  name='ruta' value='<?php echo "$nombre_carpeta";?>'  >
</div>

<div id="campo_input"  align="left"  style='float:left;padding: 0px 10px 0px 0px;' >
<b><?php echo "$copiestexte5";?></b>
<input type="text"  maxlength='3' autocomplete="off" style="width:40px;" name='numero_copies' value='<?php echo "$numero_copies";?>'  >
</div>

<div id="campo_input"  align="right">
<input name="boton" type="button"  onclick="guardar_ruta();" value="<?php echo "$boton_guardar";?>"  />
</div>
</form>
</div>


<div  style='float:left;padding: 0px 10px 0px 0px;' >
<div id="cabecera_formulario">
<?php echo "<b>$copiestexte7</b>";?>
</div>
<form class="formulario_borde2" style="height:115px;" name="Form2" method="post" action="<?php echo "$ruta_absoluta";?>/upload_copia">
<div id="titulo_campo_texto" style="margin-top:10px;" align="left">
<b><?php echo "$copiestexte8";?></b>
</div>
<div id="campo_input"  align="right">
<input name="boton" type="button"  onclick="copia_seguretat();" value="<?php echo "$copiestexte9";?>"  />
</div>
</form>
</div>




<div  style='float:left;padding: 0px 10px 0px 0px;' >
<div id="cabecera_formulario">
<?php echo "<b>$copiestexte14</b>";?>
</div>
<form class="formulario_borde2" style="width:350px;" name="Form3" enctype="multipart/form-data" method="post" action="<?php echo "$ruta_absoluta";?>/restaurar_datos">
<div id="titulo_campo_texto" style="margin-top:10px;" align="left">
<b><?php echo "$copiestexte15";?></b>
</div>

<input type="file" name="archivo"  style="width:330px;">

<div id="campo_input"  align="right">
<input name="boton" type="button"  onclick="restaurar_dades();" value="<?php echo "$copiestexte16";?>"  />
</div>
</form>
</div>


<div  style='float:left;padding: 0px 10px 0px 0px;' >
<div id="cabecera_formulario">
<?php echo "<b>$copiestexte20</b>";?>
</div>
<form class="formulario_borde2" style="width:320px;" name="Form4" enctype="multipart/form-data" method="post" action="<?php echo "$ruta_absoluta";?>/restaurar_documents">
<div id="titulo_campo_texto" style="margin-top:10px;" align="left">
<b><?php echo "$copiestexte21";?></b>
</div>

<input type="file" name="archivo" style="width:250px;" >

<div id="campo_input"  align="right">
<input name="boton" type="button"  onclick="restaurar_documents();" value="<?php echo "$copiestexte22";?>"  />
</div>
</form>
</div>



<?php
desconectar();
?>
</div>







<?php include ("../../pie_pagina.php");?>


