<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script>
 function envia(){
       document.Form1.submit();
}
</script>

<div id="container">

<div id="tabla_centrar2" align="left">

<?php

$activo='actas';
$activado_convocatorias_actas="activado";
include ("../menu.php");
conectar();

$acceso_permitido = mysql_query("SELECT convocatorias_actas FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["convocatorias_actas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}
?>

<div id="titulo_1" align="justify">
<?php echo "$actatexto81";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto85";?>
</div>

<?php
$activo_listado_convocatorias='active';
include ("menu_convocatoria.php");
?>

<?php

				if(isset($_REQUEST['anyo']))
				$anyo_seleccionado=$_REQUEST['anyo'];
				else 
				$anyo_seleccionado=$upload_anyo_academico;
				
	?>			

<div id='campo_input' style="width:700px;float:left;" align="left">
<?php
$busqueda_anyo = mysql_query("SELECT distinct anyo FROM actas_convocatorias where cod_centro='$upload_centro' order by anyo desc");
while ($row5 = mysql_fetch_array($busqueda_anyo))
{
$anyo_academico= ($row5 ["anyo"]);
$link_anyo_academico="$ruta_absoluta/listado_convocatorias/$anyo_academico";
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
if ($_SESSION["idioma_secretictac"]=='cas')
$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val");

	while($row = mysql_fetch_array($tipo_sel))
	{
				$id_tipo=($row ["id_tipo"]);
				
				if ($_SESSION["idioma_secretictac"]=='cas')				
				$nombre_acta= ($row ["nombre_cas"]);
				if ($_SESSION["idioma_secretictac"]=='val')
				$nombre_acta= ($row ["nombre_val"]);
				
		$sql = "SELECT id_tipo_acta FROM actas_permisos where id_tipo_acta='$id_tipo' and id_tipo_permisos='$permiso' and cod_centro='$upload_centro'";
   $result = mysql_query($sql);
   $numero = mysql_num_rows($result);
   if ($numero!=0)
   {
   	
  $bus_convocatorias =mysql_query("SELECT * FROM actas_convocatorias where cod_centro='$upload_centro' and 	anyo='$anyo_seleccionado' and id_tipo_acta='$id_tipo'");
 $numero1 = mysql_num_rows($bus_convocatorias);
	if ($numero1!=0)
   {
   	?>


<div  style='float:left;padding: 10px 10px 10px 10px;width:330px' >
<div id="cabecera_formulario">
<?php echo "<b>$nombre_acta</b>";?>
</div>

 <?php
 
 

	while($row = mysql_fetch_array($bus_convocatorias))
	{
				 $id_convocatoria=($row ["id_convocatoria"]);
			  $fecha_ver= f_datef($row ["fecha"]);
			  $link_editar="$ruta_absoluta/convocatorias_actas/$id_tipo/$id_convocatoria";
			  ?>
						<div id="enlaces" style="float:left;margin-top:5px; " >
         <a href='<?php echo "$link_editar";?>' target="_self">
						<?php echo "$fecha_ver";?>
						</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
 
<?php
}
?>
 </div>	
<?php
}
?>





<?php
}//llave que cierra sise tiene permiso
}//llave que cierra el recorrido por todas las actas
desconectar();
?>

<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>
