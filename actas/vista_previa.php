<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>
<script type="text/javascript" src="<?php echo $ruta_absoluta;?>/jquery-latest.js"></script>
<script>
 $(function() {
$("#hrefPrint").click(function() {
// Print the DIV.
$("#printdiv").print();
return (false);
});
});

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
       
              if (document.Form1.orden.value.length==0){
       alert('<?php echo "$advertencia_rellenar"; ?>')
       document.Form1.orden.focus()
       return 0;
       }
       document.Form1.submit();
 }

function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}


function confirmar ( mensaje ) {
return alert( mensaje );
}

</script>

<div id="container">

<div id="tabla_centrar2" style="margin-left:140px;margin-right:140px" align="left">
<?php
$activo='actas';
$activado_editar_actas="activado";
//include ("../menu.php");
conectar();
$tipo_acta=$_REQUEST['tipo_acta'];
$id_acta=$_REQUEST['id_acta'];
$div_seleccionado=$_REQUEST['div_seleccionado'];
$anyo=$_REQUEST['anyo'];






$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$tipo_acta' ");
$row = mysql_fetch_array($tipo_sel);
$id_tipo_seleccion=($row ["id_tipo"]);
if ($_SESSION["idioma_secretictac"]=='cas')
$nombre_acta= ($row ["nombre_cas"]);
if ($_SESSION["idioma_secretictac"]=='val')
$nombre_acta= ($row ["nombre_val"]);



$acta_sel =mysql_query("SELECT * FROM actas where cod_centro='$upload_centro' and id_acta='$id_acta' ");
$row = mysql_fetch_array($acta_sel);
$fecha= f_datef($row ["fecha"]);
$fecha_mysql=($row ["fecha"]);
$texto= ($row ["texto"]);
$texto=str_replace($replace,$search,$texto);
$acuerdos= ($row ["acuerdos"]);
$acuerdos=str_replace($replace,$search,$acuerdos);
$anyo= ($row ["anyo"]);

?>

<?php 
				$nombre_ciutat=mysql_query("SELECT POBLACION,NOMBRE_CENTRO FROM 1_centro where cod_centro='$upload_centro'");
				$row5 = mysql_fetch_array($nombre_ciutat);
				$nombre_poblacio=ucwords(strtolower($row5["POBLACION"]));
				$nombre_centro=$row5["NOMBRE_CENTRO"];
				
?>
<script type="text/javascript" src="<?php echo "$ruta_absoluta/";?>print_html/jquery.PrintArea.js_4.js"></script>
<script type="text/javascript" src="<?php echo "$ruta_absoluta/";?>print_html/core.js"></script>
<link href="<?php echo "$ruta_absoluta/";?>print_html/css/core.css" rel="stylesheet" media="print" type="text/css" />


<div id="titulo_1" align="justify">
<?php echo "$actatexto58";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto59";?>
</div>



<div align="left" style='padding: 0px;margin-left:8px;margin-bottom:55px;'>

<button  style="float:right;margin-left:3px;margin-bottom:0px;" name="boton" type="button" class="print" rel="acuerdos"  onclick="return confirmar('<?php echo "$actatexto86";?>')"  title="<?php echo $actatexto70;?>"/>
<img src="<?php echo "$ruta_absoluta/images/imprimir_acuerdos.png";?>" style='width:30px'>
</button>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" class="print" rel="acta" onclick="return confirmar('<?php echo "$actatexto86";?>')"  title="<?php echo $actatexto69;?>"/>
<img src="<?php echo "$ruta_absoluta/images/imprimir_acta.png";?>" style='width:30px'>
</button>
<?php
if($div_seleccionado==0)
{
?>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="window.location.href='<?php echo "$ruta_absoluta/editar_actas/$anyo/$tipo_acta";?>'"  title="<?php echo $boton_volver;?>"/>
<img src="<?php echo "$ruta_absoluta/images/volver.png";?>" style='width:30px'>
</button>
<?php
}
else {
?>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="window.location.href='<?php echo "$ruta_absoluta/redactar_actas/$tipo_acta/$id_acta/$div_seleccionado";?>'"  title="<?php echo $boton_volver;?>"/>
<img src="<?php echo "$ruta_absoluta/images/volver.png";?>" style='width:30px'>
</button>
<?php
}
?>
</div>


<div style="float:left;">

<div id="acta" align="left">

<div id="titulo_2" style="float:left; padding-top:10px;" align='left'>
<?php echo "$nombre_centro - $nombre_poblacio";?>
</div>

<div id="titulo_2" style="float:right;;padding-top:10px;" align='right'>
<?php echo "$nombre_acta $actatexto71 $fecha";?>
</div>

<div style="clear:both;"></div>
<div id="cabecera_impresion"></div>
<div id="asistentes" style="float:left;margin-bottom:10px;">
<?php
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


<?php
$asistentes_cargo =mysql_query( "SELECT distinct id_tipo_asistente FROM acta_asistentes_reunion where id_actas='$id_acta' and cod_centro='$upload_centro' order by orden_asistente") ;
	while($row1=mysql_fetch_array($asistentes_cargo))
	{
	$id_tipo_asistente= ($row1 ["id_tipo_asistente"]);
	if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_tipo1=mysql_query("SELECT nombre_cas FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				  $nombre_tipo_asis=$row12["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_tipo1=mysql_query("SELECT nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				$nombre_tipo_asis=$row12["nombre_val"];
				}
	
?>

<div id="asistentes_acta" class="subrayado" align="left">
<b><?php echo 	$nombre_tipo_asis;?></b>
</div>
<?php	
 $asistentes_reunion =mysql_query( "SELECT nombre FROM acta_asistentes_reunion where id_actas='$id_acta' and id_tipo_asistente='$id_tipo_asistente' and cod_centro='$upload_centro' order by nombre") ;
	while($row2=mysql_fetch_array($asistentes_reunion))
	{	
	 $nombre_asistente=ucwords(strtolower($row2["nombre"]));
	 ?>
	<div id="asistentes_acta" align="left">
<?php echo 	$nombre_asistente;?>
</div> 

	 
<?php
}
 }
 
				
$year=substr($fecha_mysql,0,4);
$month=substr($fecha_mysql,5,2);
$day=substr($fecha_mysql,8,2);

$search=array("01","02","03","04","05","06","07","08","09","10","11","12");
$replace=array("$enero","$febrero","$marzo","$abril","$mayo","$junio","$julio","$agosto","$septiembre","$octubre","$noviembre","$diciembre");
$mes=str_replace($search,$replace,$month);

			if ($_SESSION["idioma_secretictac"]=='val'){
$mes_val =$mes;
$comienza = $mes_val[0];

if ($comienza=='a' or $comienza=='e' or $comienza=='i'  or $comienza=='o' or $comienza=='u')
$fecha_acta=$day.$de_1.$mes.$de.$year;
else
$fecha_acta=$day.$de.$mes.$de.$year;
}
else
{
$fecha_acta=$day.$de.$mes.$de.$year;
}

?>
</div>

<div id="texto_acta" align="justify">
<?php echo 	$texto;?>
</div>

<div id="texto_acta" align="center">
<?php echo 	"$nombre_poblacio, $fecha_acta" ;?>
</div>

<div align="center">
<?php
$firma_acta =mysql_query( "SELECT * FROM actas_firmas where id_tipo_acta='$tipo_acta' and cod_centro='$upload_centro' order by orden") ;
	while($row2=mysql_fetch_array($firma_acta))
	{ 
	$id_tipo_asistente=$row2["id_tipo_asistente"];
			if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_tipo1=mysql_query("SELECT nombre_cargo_cas FROM acta_asistentes_reunion where cod_centro='$upload_centro' and id_tipo_asistente='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				  $nombre_tipo_asis=$row12["nombre_cargo_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_tipo1=mysql_query("SELECT nombre_cargo_val FROM acta_asistentes_reunion where cod_centro='$upload_centro' and id_tipo_asistente='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				$nombre_tipo_asis=$row12["nombre_cargo_val"];
				}
				
				$nombre_firma_cargo =mysql_query( "SELECT nombre FROM acta_asistentes_reunion where id_tipo_asistente='$id_tipo_asistente' and id_actas='$id_acta'  and cod_centro='$upload_centro'") ;
    	  while($row3=mysql_fetch_array($nombre_firma_cargo))
    	  {
     	 $nombre_firma=ucwords(strtolower($row3["nombre"]));
?>	





<div id="firmas"  style="display:inline-block; margin-left:10px;margin-right:10px;" align="center">
<div id="texto_acta" style="margin-bottom:50px;" align="center">
<?php echo 	"$nombre_tipo_asis" ;?>
</div>
<div id="texto_acta" align="center">
<?php echo 	"$actatexto73 $nombre_firma" ;?>
</div>
</div>

<?php
}
?>

<?php
}
?>
</div>
</div>

<?php
if($acuerdos!='')
{
	?>
<div id="acuerdos" style="clear:both">
<div id="titulo_2" style="float:left; padding-top:10px;" align='left'>
<?php echo "$nombre_centro - $nombre_poblacio";?>
</div>

<div id="titulo_2" style="float:right;;padding-top:10px;" align='right'>
<?php echo "$actatexto72 $nombre_acta $actatexto71 $fecha";?>
</div>

<div style="clear:both;"></div>
<div id="cabecera_impresion"></div>
<div id="texto_acta" align="justify">
<?php echo 	$acuerdos;?>
</div>

<div id="texto_acta" align="center">
<?php echo 	"$nombre_poblacio, $fecha_acta" ;?>
</div>

<div align="center">
<?php
$firma_acta =mysql_query( "SELECT * FROM actas_firmas where id_tipo_acta='$tipo_acta' and cod_centro='$upload_centro' order by orden") ;
	while($row2=mysql_fetch_array($firma_acta))
	{ 
	$id_tipo_asistente=$row2["id_tipo_asistente"];
			if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_tipo1=mysql_query("SELECT nombre_cargo_cas FROM acta_asistentes_reunion where cod_centro='$upload_centro' and id_tipo_asistente='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				  $nombre_tipo_asis=$row12["nombre_cargo_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_tipo1=mysql_query("SELECT nombre_cargo_val FROM acta_asistentes_reunion where cod_centro='$upload_centro' and id_tipo_asistente='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
				$nombre_tipo_asis=$row12["nombre_cargo_val"];
				}
				
				$nombre_firma_cargo =mysql_query( "SELECT nombre FROM acta_asistentes_reunion where id_tipo_asistente='$id_tipo_asistente' and id_actas='$id_acta'  and cod_centro='$upload_centro'") ;
    	  while($row3=mysql_fetch_array($nombre_firma_cargo))
    	  {
     	 $nombre_firma=ucwords(strtolower($row3["nombre"]));
?>	





<div id="firmas"  style="display:inline-block; margin-left:10px;margin-right:10px;" align="center">
<div id="texto_acta" style="margin-bottom:50px;" align="center">
<?php echo 	"$nombre_tipo_asis" ;?>
</div>
<div id="texto_acta" align="center">
<?php echo 	"$actatexto73 $nombre_firma" ;?>
</div>
</div>

<?php
}
?>

<?php
}
?>
</div>
</div>
<?php
}
?>

<?php
desconectar();
?>
</div>
<div id="separador" style="clear:both;"></div>
</div>

<?php include ("../pie_pagina.php");?>
