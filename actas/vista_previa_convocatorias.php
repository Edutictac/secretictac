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

function confirmar ( mensaje ) {
return alert( mensaje );
}

</script>

<div id="container">

<div id="tabla_centrar2" style="margin-left:20px;margin-right:20px" align="left">
<?php
$activo='actas';
$activado_editar_actas="activado";
//include ("../menu.php");
conectar();
$tipo_acta=$_REQUEST['tipo_acta'];
$id_convocatoria=$_REQUEST['id_convocatoria'];

$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$tipo_acta' ");
$row = mysql_fetch_array($tipo_sel);
$id_tipo_seleccion=($row ["id_tipo"]);
if ($_SESSION["idioma_secretictac"]=='cas')
$nombre_acta= ($row ["nombre_cas"]);
if ($_SESSION["idioma_secretictac"]=='val')
$nombre_acta= ($row ["nombre_val"]);
$encabezado_convocatoria=($row ["encabezado_convocatoria"]);



$acta_sel =mysql_query("SELECT * FROM actas_convocatorias where cod_centro='$upload_centro' and id_convocatoria='$id_convocatoria' ");
$row = mysql_fetch_array($acta_sel);
$fecha= f_datef($row ["fecha"]);
$fecha_convocatoria=($row ["fecha_convocatoria"]);
$texto_cas= ($row ["texto_cas"]);
$texto_cas=str_replace($replace,$search,$texto_cas);
$texto_val= ($row ["texto_val"]);
$texto_val=str_replace($replace,$search,$texto_val);
?>

<?php 
				$nombre_ciutat=mysql_query("SELECT POBLACION,NOMBRE_CENTRO FROM 1_centro where cod_centro='$upload_centro'");
				$row5 = mysql_fetch_array($nombre_ciutat);
				$nombre_poblacio=$row5["POBLACION"];
	     $nombre_poblacio=mb_convert_case($nombre_poblacio, MB_CASE_TITLE, "UTF-8");
				$nombre_centro=$row5["NOMBRE_CENTRO"];
				
?>
<script type="text/javascript" src="<?php echo "$ruta_absoluta/";?>print_html/jquery.PrintArea.js_4.js"></script>
<script type="text/javascript" src="<?php echo "$ruta_absoluta/";?>print_html/core.js"></script>
<link href="<?php echo "$ruta_absoluta/";?>print_html/css/core.css" rel="stylesheet" media="print" type="text/css" />

<div id="titulo_1" align="justify">
<?php echo "$actatexto87";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto88";?>
</div>



<div align="left" style='padding: 0px;margin-left:8px;margin-bottom:55px;'>

<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" class="print" rel="convocatoria" onclick="return confirmar('<?php echo "$actatexto86";?>')"  title="<?php echo $actatexto69;?>"/>
<img src="<?php echo "$ruta_absoluta/images/imprimir.png";?>" style='width:25px'>
</button>

<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="javascript:window.history.back();"  title="<?php echo $boton_volver;?>"/>
<img src="<?php echo "$ruta_absoluta/images/volver.png";?>" style='width:28px'>
</button>
</div>

<?php
$result=mysql_query("SELECT * FROM 1_centro WHERE COD_CENTRO='$upload_centro'");
$row = mysql_fetch_array($result);
$nombre_centro1= ($row ["NOMBRE_CENTRO"]);
$direccion1= ($row ["DIRECCION"]);
$poblacion1= ($row ["POBLACION"]);
$provincia1= ($row ["PROVINCIA"]);
$cp1= ($row ["cp"]);
$web1= ($row ["WEB"]);
$email1= ($row ["EMAIL"]);
$telefono1= ($row ["TELEFONO"]);
$fax1= ($row ["FAX"]);
$frase1_1= ($row ["FRASE1"]);
$frase2_1= ($row ["FRASE2"]);
$frase3_1= ($row ["FRASE3"]);

$distancia_logo=($row ["CMLOGO"]);
$distancia_logo_conse=($row ["CMLOGO_CONSE"]);

$nombre_logo_centro=($row ["NOMBRE_LOGO"]);
$nombre_logo_conselleria=($row ["NOMBRE_LOGO_CONSELLERIA"]);
//Logo

$nombre_logo_centro="$ruta_absoluta/archivos/datos_centro/".$upload_centro."/".$nombre_logo_centro;
$nombre_logo_conselleria="$ruta_absoluta/archivos/datos_centro/".$upload_centro."/".$nombre_logo_conselleria;
?>

<div id="convocatoria" align="left">
<div id="margenes_impresion">

<table>
<?php 
if ($encabezado_convocatoria=='1')
{
	?>
<thead>
<tr>
<td>
<div id="cabecera_logo">
		   <div id="logo_dcho">
				<img src="<?php echo $nombre_logo_conselleria;?>" height="60px" style="float:left;margin-right:5px" >
				</div>
   <div id="datos_centro" style="float:left;margin-top:5px;">
					<div id="texto_logo_izq">
				<?php echo "$frase1_1";?>
				</div>
					<div id="texto_logo_izq">
				<?php echo "$frase2_1" ;?>
				</div>
					<div id="texto_logo_izq">
				<?php echo "$frase3_1" ;?>
				</div>
				
</div>
		



<div id="datos_centro" style="float:right">
				<div id="texto_logo_der">
				<?php echo $nombre_centro1;?>
				</div>
				<div id="texto_logo_der">
				<?php echo "$direccion1 $cp1 $poblacion1 ( $provincia1 )";?>
				</div>
						<div id="texto_logo_der">
				<?php echo "Email: $email1" ;?>
				</div>
						<div id="texto_logo_der">
				<?php echo "Web: $web1" ;?>
				</div>
						<div id="texto_logo_der">
				<?php echo "Tlfn: $telefono1  FAX: $fax1" ;?>
				</div>				
</div>
				<div id="logo_izdo_der">
				<img src="<?php echo $nombre_logo_centro;?>" height="60px" style="float:right;margin-right:5px" >
				</div>

</div>
</td>
</tr>
</thead>
<?php
}
?>
<tr><td>
<div style="clear:both;"></div>
<div id="titulo_1" style="float:left; padding-top:10px;" align='left'>
<?php echo "$nombre_centro - $nombre_poblacio";?>
</div>

<div id="titulo_1" style="float:right;padding-top:10px;" align='right'>
<?php echo "$actatexto89 $nombre_acta $actatexto71 $fecha";?>
</div>


<div style="clear:both;"></div>
<div id="cabecera_impresion"></div>
<?php
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


<div id="convocatoria_cas" style="float:left;width:430px;margin-right:20px">
<div id="texto_acta" align="justify">
<?php echo 	$texto_cas;?>
</div>

</div> <!--termina div castellano-->


<div id="convocatoria_val" style="float:left;width:430px;margin-left:20px">
<div id="texto_acta" align="justify">
<?php echo 	$texto_val;?>
</div>


</div> <!--termina div valencia-->
</td></tr></table>
<?php		
$year=substr($fecha_convocatoria,0,4);
$month=substr($fecha_convocatoria,5,2);
$day=substr($fecha_convocatoria,8,2);

$search=array("01","02","03","04","05","06","07","08","09","10","11","12");
$replace=array("$enero","$febrero","$marzo","$abril","$mayo","$junio","$julio","$agosto","$septiembre","$octubre","$noviembre","$diciembre");
$mes=str_replace($search,$replace,$month);

if ($_SESSION["idioma_secretictac"]=='val'){
$mes_val =$mes;
$comienza = $mes_val[0];

if ($comienza=='a' or $comienza=='e' or $comienza=='i'  or $comienza=='o' or $comienza=='u')
$fecha_acta=$day." d'".$mes.$de.$year;
else
$fecha_acta=$day.$de.$mes.$de.$year;
}
else
{
$fecha_acta=$day.$de.$mes.$de.$year;
}
?>

<div id="texto_acta" align="center">
<?php echo 	"$nombre_poblacio, $fecha_acta" ;?>
</div>
<div align="center">
<?php

$firma_acta =mysql_query( "SELECT * FROM actas_firmas where id_tipo_acta='$tipo_acta' and cod_centro='$upload_centro' and firma_convocatoria='1' order by orden") ;
	while($row2=mysql_fetch_array($firma_acta))
	{ 
	$id_tipo_asistente=$row2["id_tipo_asistente"];
	
				$nombre_tipo1=mysql_query("SELECT nombre_val FROM actas_tipo_asistentes where cod_centro='$upload_centro' and id_tipo='$id_tipo_asistente' ");
				$row12 = mysql_fetch_array($nombre_tipo1);
			 $nombre_tipo_asis=$row12["nombre_val"];
			
				
				$nombre_firma_cargo =mysql_query( "SELECT nombre_asistente FROM actas_asistentes where tipo_asistente='$id_tipo_asistente' and id_tipo_acta='$tipo_acta' and cod_centro='$upload_centro'") ;
    	  while($row3=mysql_fetch_array($nombre_firma_cargo))
    	  {
     	 $nombre_firma=$row3["nombre_asistente"];
	      $nombre_firma=mb_convert_case($nombre_firma, MB_CASE_TITLE, "UTF-8");
?>	

<div id="firmas"  style="display:inline-block; margin-left:10px;margin-right:10px;" align="center">
<div id="texto_acta" style="margin-bottom:50px;" align="center">
<?php echo 	"$nombre_tipo_asis" ;?>
</div>
<div id="texto_acta" align="center">
<?php echo 	"$actatexto91_bis $nombre_firma" ;?>
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
</div>
<?php
desconectar();
?>

<div id="separador" style="clear:both;"></div>
</div>

<?php include ("../pie_pagina.php");?>
