<?php
include ("../permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>
<style type="text/css">

.jdkgj{
   color:#2e3191;
	text-decoration: underline;
	font-weight: bold;
	background-color: #c0c0c0;

}
</style>



<div id="container">

<div id="tabla_centrar2" align="left">

<?php

$activo='actas';
$activado_busqueda_actas="activado";
include ("../menu.php");
conectar();

$acceso_permitido = mysql_query("SELECT busqueda_actas FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["busqueda_actas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}
?>



<div id="titulo_1" align="justify">
<?php echo "$actatexto76";?>
</div>
<?php
?>
<div id="titulo_campo_texto" align="justify">
<?php echo "$actatexto77";?>
</div>
<?php
if(isset($_REQUEST['anyo']) )
$anyo_elegido=$_REQUEST['anyo'];
else 
$anyo_elegido=$registrotexto59;
//consulta para el año
if($anyo_elegido!=$registrotexto59)
$consulta_anyo="and anyo='$anyo_elegido'";
else 
$consulta_anyo='';


if (isset($_REQUEST['tipo_acta']))
{
$id_tipo_seleccionado=$_REQUEST['tipo_acta'];
				if ($id_tipo_seleccionado!='0')
				{
				$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo_seleccionado' ");
				$row = mysql_fetch_array($tipo_sel);
				$id_tipo_seleccion=($row ["id_tipo"]);
				
				if ($_SESSION["idioma_secretictac"]=='cas')
				$nombre_acta= ($row ["nombre_cas"]);
				if ($_SESSION["idioma_secretictac"]=='val')
				$nombre_acta= ($row ["nombre_val"]);
				
				//consulta de tipo de acta
				$consulta_tipo_acta="and id_tipo_acta='$id_tipo_seleccion'";
			}
			else {
				$id_tipo_seleccion='0';
					$nombre_acta= $rsstexto2;
					$consulta_tipo_acta='';
				}
				
}
else 
{
$id_tipo_seleccion='0';
$nombre_acta= $rsstexto2;
$consulta_tipo_acta='';
}


if (isset($_REQUEST['enlaces_pagina']))
{
$enlaces_pagina=$_REQUEST['enlaces_pagina'];
}
else
{
$enlaces_pagina='20';
}




//busqueda de palabras
if (isset($_REQUEST['busqueda']))
{
$busqueda=$_REQUEST['busqueda'];
$texto_busqueda=$busqueda;
}
else {
	$busqueda='';
	$texto_busqueda='';
}

?>






<form  name="Form1"  style="margin-top:10px;" method="get" action="<?php echo "$ruta_absoluta";?>/actas/busqueda_actas.php"  id="Form1">
<div id="titulo_campo_texto">
<?php echo "<b>$registrotexto6</b>";?>
</div>

<div id="campo_input" style="vertical-align: middle;" align="justify">
<?php
$consulta=mysql_query("SELECT distinct anyo FROM actas where cod_centro='$upload_centro' order by anyo");
   	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='anyo' style='width:100px'>";
	echo "<option value='$anyo_elegido'>$anyo_elegido</option>";
	echo "<option value='$registrotexto59'>$registrotexto59</option>";
	while($registro=mysql_fetch_row($consulta))
	{

		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
  	}

	echo "</select>";

?>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<b><?php echo "$actatexto30";?></b>
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_acta'>";
	echo "<option value=$id_tipo_seleccion>$nombre_acta</option>";
		echo "<option value='0'>$rsstexto2</option>";
	
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
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$actatexto78</b>";?>
</div>
<div id="campo_input"   align="justify">
<input type="text" autocomplete="off" name="busqueda"  style='width:400px;'  value="<?php echo $texto_busqueda;?>">
</div>

<div id="titulo_campo_texto"  style='float:left;' align="left">
<?php echo "<b>$registrotexto69</b>";?>&nbsp;&nbsp;
<input type="text" autocomplete="off" name="enlaces_pagina"  style='width:40px;'  value="<?php echo $enlaces_pagina;?>">
</div>

<button  style='float:left;padding: 0px;margin-left:20px;margin-top:-5px;' name="boton" type="submit"  title="<?php echo $registrotexto68;?>"/>
<img src="<?php echo "$ruta_absoluta/images/filtrar.png";?>" style='width:30px'>
</button>
</form>

<div id="campo_input"  align="justify"></div> 

<?php

$_pagi_cuantos = $_REQUEST['enlaces_pagina'];
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo = "borde";

if ($busqueda!='')
		{
		$_pagi_sql="SELECT * FROM actas where  MATCH (texto) AGAINST ('$busqueda' IN BOOlEAN MODE) and cod_centro='$upload_centro' $consulta_anyo $consulta_tipo_acta order by fecha desc";
		}
		else		
		{		
		$_pagi_sql = "SELECT * FROM actas where cod_centro='$upload_centro' $consulta_anyo $consulta_tipo_acta order by fecha desc";
		}


include("../paginator_listado.php");
?>
<div id="numeracion" >
<?php echo"<p>".$_pagi_navegacion."</p>";?>
</div>


<table class="borde_tabla" width="700px" style='float: left;'>
<tr>
<th width="80px" ><div id="cabecera_tabla" align='left'><?php echo "$compartirtexto28";?></div></th>
<th width="500px" ><div id="cabecera_tabla" align='left'><?php echo "$actatexto68";?></div></th>
<th width="100px" ><div id="cabecera_tabla" align='center'><?php echo "$tipo_texto7";?></div></th>
<th width="100px" ><div id="cabecera_tabla" align='center'><?php echo "$boton_vista_previa";?></div></th>
</tr>
<?php
$i=1;
while ($row = mysql_fetch_array($_pagi_result))
{
$id_tipo_acta=($row ["id_tipo_acta"]);
				$tipo_acta_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo_acta' ");
				$row3 = mysql_fetch_array($tipo_acta_sel);
	
				if ($_SESSION["idioma_secretictac"]=='cas')
				$nombre_acta= ($row3 ["nombre_cas"]);
				if ($_SESSION["idioma_secretictac"]=='val')
				$nombre_acta= ($row3 ["nombre_val"]);
	
		
		$id_acta=($row ["id_acta"]);
		$fecha_ver= f_datef($row ["fecha"]);
		$anyo= ($row ["anyo"]);
   $texto= Recortar((quitar_html($row ["texto"])),250);
   $link_editar="$ruta_absoluta/redactar_actas_busqueda/$id_tipo_acta/$id_acta/1/$busqueda";
   $link_imprimir="$ruta_absoluta/vista_previa_busqueda/$id_tipo_acta/$id_acta/$anyo/$busqueda";



if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";

		//miramos las actas sobre las que tiene permiso
		$sql = "SELECT id_tipo_acta FROM actas_permisos where id_tipo_acta='$id_tipo_acta' and id_tipo_permisos='$permiso' and cod_centro='$upload_centro'";
   $result = mysql_query($sql);
   $numero = mysql_num_rows($result);
   if ($numero!=0)
   {
?>
<tr class='background<?php echo $color_backgrund;?>' > 
<td >
<div id="titulo_5" align="left"><?php echo "$fecha_ver";?>
</div>
</td>

<td>
<div id="titulo_9" align="justify"><?php echo "$nombre_acta";?></div>

<div id="titulo_5" align="justify"><?php echo "$texto";?></div>
</td>


<td >
<div id="enlaces"  align="center">
<a href='<?php echo "$link_editar";?>' target="_self">
<?php echo "$tipo_texto7";?>
</a>
</td>


<td >
<div id="enlaces"  align="center">
<a href='<?php echo "$link_imprimir";?>' target="_self">
<?php echo "$boton_vista_previa";?>
</a>
</td>
</tr>

<?php  	
 $i=$i+1;  	
   }
}
?>
</table>


<?php
desconectar();
?>
<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>