<?php
include ("permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
$activado_inicio='activado';
?>

<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$activo_inicio="active";
include ("menu.php");
conectar();
?>


<div id="titulo_1" align="justify">
<?php echo "$inicio_titulo";?>
</div>

<?php
$_pagi_sql = "SELECT * FROM registro where cod_centro='$upload_centro' and dirigido='$nick_usuario' and atendido='n' order by codigo_registro asc";
$result = mysql_query($_pagi_sql);
$numero = mysql_num_rows($result);

if ($numero!=0)
{
?>
<table class="borde_tabla" width="700px" style='float: left;'>
<tr>
<th >
<div id="cabecera_tabla" align='left'>
<?php echo "$registrotexto71 ";?>
</div>
</th>
</tr>
<?php
$i=1;
while ($row = mysql_fetch_array($result))
{
$id_registro=($row ["id_registro"]);
$codigo_registro=($row ["codigo_registro"]);
$codigo_registro=str_pad($codigo_registro, 6, "0", STR_PAD_LEFT);
$entrada_salida=($row ["entrada_salida"]);
$fecha_entrada_salida=f_datef($row ["fecha_entrada_salida"]);
$fecha_registro=f_datef($row ["fecha_registro"]);
$asunto=nl2br($row ["asunto"]);

$ruta_archivo=($row ["ruta_archivo"]);
$link_archivo=$ruta_absoluta.'/link_doc_registro/'.$upload_centro.'/'.$ruta_archivo;
if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";

?>
<tr>
<td id='background<?php echo $color_backgrund;?>'>
<div id="listado_titulo" align="left"><?php echo $registrotexto7.': '?>
<span class="registro_listado_titulo"><?php echo $codigo_registro;?></span>
<?php 
if($entrada_salida=='e')
echo "<b>$registrotexto9: </b>";
else
echo "<b>$registrotexto62:   </b>";
?>
<span class="registro_listado_titulo">
<?php echo $fecha_entrada_salida;?>
</span>

&nbsp; &nbsp; &nbsp; 
<?php echo $registrotexto8.': '?><span class="registro_listado_titulo"><?php echo $fecha_registro;?></span>

</div>
<div id="listado_titulo" align="left"><?php echo $registrotexto17.': '?>
<span class="registro_listado_titulo"><?php echo $asunto;?></span>
</div>
<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida";?>'" style='float:right;padding: 0px;margin-right:8px;margin-bottom:5px;' name="boton" type="button"  title="<?php echo $registrotexto56;?>"/>
<img src="<?php echo "$ruta_absoluta/images/editar.png";?>" style='width:25px'>
</button>

<?php
if($ruta_archivo!='')
{
?>

<div id="listado_titulo" align="left"><?php echo $registrotexto55.': '?>
<span id="enlaces_archivo"><a href='<?php echo $link_archivo;?>' target="_blank" ><?php echo $ruta_archivo;?></span>
</div>
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
<?php
}
?>

<div id="campo_input" style="float:left;width:700px;padding-top:10px" align="justify">
<?php echo "$iniciotexto1";?>
</div>





<?php
desconectar();
?>
</div>









<?php include ("pie_pagina.php");?>



