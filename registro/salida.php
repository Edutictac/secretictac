<?php
include ("../permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script type="text/javascript">
function popup(url,ancho,alto) {
var posicion_x;
var posicion_y;
posicion_x=(screen.width/2)-(ancho/2);
posicion_y=(screen.height/2)-(alto/2);
window.open(url, "secretictac", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>

<script>

function valida_codigo(formulario, archivo){

extensiones_permitidas = new Array(<?php echo "$archivos_permitidos_js_pdf";?>);
   mierror = "";
   if (!archivo) {
      var a="GUARDAR";
       document.Form1.nombre_boton.value=a;
       document.Form1.submit();
   }else{

      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

      permitida = false;
      for (var i = 0; i < extensiones_permitidas.length; i++) {
         if (extensiones_permitidas[i] == extension) {
         permitida = true;
         break;
         }
      }

      if (!permitida) {
         mierror = "<?php echo "$compartirtexto9";?>" + extensiones_permitidas.join();
         alert (mierror);
       }else{


       var a="GUARDAR";

       document.Form1.nombre_boton.value=a;

       document.Form1.submit();

 }
 }
  return 0;
 }

function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}




function tipo_doc(){
var a="tipo_doc";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

function origen(){
var a="origen";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

function organismo(){
var a="organismo";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

function destino(){
var a="destino";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

function confirmar ( mensaje ) {
return confirm( mensaje );
}

</script>

<script>
function esFechaValida(fecha,campo){



    if (fecha != undefined && fecha.value != "" ){
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)){
            alert("<?php echo "$fecha_erronea";?>");
            document.Form2.fecha_incidencia.focus()
            return false;


      }





        var dia  =  parseInt(fecha.value.substring(0,2),10);
        var mes  =  parseInt(fecha.value.substring(3,5),10);
        var anio =  parseInt(fecha.value.substring(6),10);

    switch(mes){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            numDias=30;
            break;
        case 2:
            if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
            break;
        default:
            alert("<?php echo "$fecha_erronea";?>");
            document.Form2.fecha_incidencia.focus()
            return false;

    }

       if (dia>numDias || dia==0){
            alert("<?php echo "$fecha_erronea";?>");
            document.Form2.fecha_incidencia.focus()
            return false;

        }
        return true;
    }
}

function comprobarSiBisisesto(anio){
if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
   return true;
    }

}
</script>
<script type='text/JavaScript' src='<?php echo "$ruta_absoluta/";?>scw.js'></script>

<div id="container">

<div id="tabla_centrar2"  align="left">

<?php
$activado_salidas="activado";
include ("../menu.php");
conectar();
$fecha_documento=date("Y-m-d");
$fi=f_datef($fecha_documento);

$codigo_fecha = date("dmyHis");
$id_nuevo_registro=$upload_centro.md5($usuario).$codigo_fecha;

?>




<?php

$acceso_permitido = mysql_query("SELECT entradas  FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["entradas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1"  align="justify">
<?php echo "$registrotexto5";?>
</div>

<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['id_registro']))
{
$id_registro_seleccionado=$_REQUEST['id_registro'];
$registro_seleccionado =mysql_query("SELECT * FROM registro where cod_centro='$upload_centro' and id_registro='$id_registro_seleccionado'");
$row = mysql_fetch_array($registro_seleccionado);
$id_registro=($row ["id_registro"]);
$codigo_registro=($row ["codigo_registro"]);
$fecha_entrada_salida=f_datef($row ["fecha_entrada_salida"]);
$fecha_registro=f_datef($row ["fecha_registro"]);

if (!isset($_REQUEST['id_tipo_tipodoc']))
$tipo_documento=($row ["tipo_documento"]);
else 
$tipo_documento=$_REQUEST['id_tipo_tipodoc'];

$asunto=($row ["asunto"]);
$observaciones=($row ["observaciones"]);

if (!isset($_REQUEST['id_tipo_origen']))
$origen=($row ["origen"]);
else 
$origen=$_REQUEST['id_tipo_origen'];


$procedencia=($row ["procedencia"]);

if (!isset($_REQUEST['id_tipo_organismo']))
$organismo=($row ["organismo"]);
else 
$organismo=$_REQUEST['id_tipo_organismo'];

if (!isset($_REQUEST['id_tipo_destino']))
$destino=($row ["destino"]);
else 
$destino=$_REQUEST['id_tipo_destino'];

$anyo=($row ["anyo"]);
$ruta_archivo=($row ["ruta_archivo"]);
$link_archivo=$ruta_absoluta.'/link_doc_registro/'.$upload_centro.'/'.$ruta_archivo;
$dirigido=($row ["dirigido"]);
}
else 
{
$ultimo_registro =mysql_query("SELECT codigo_registro FROM registro where cod_centro='$upload_centro' order by codigo_registro desc limit 1");
$row1 = mysql_fetch_array($ultimo_registro);

$id_registro=$id_nuevo_registro;
$codigo_ultimo_registro=($row1 ["codigo_registro"]);
$codigo_registro=$codigo_ultimo_registro+1;
$fecha_entrada_salida=$fi;
$fecha_registro=$fi;
$tipo_documento='0';
$asunto='';
$observaciones='';
$origen='';
$procedencia='';
$organismo='';
$destino='';
$anyo=$upload_anyo_academico;
$ruta_archivo='';
$dirigido='';
}


if($tipo_documento!=0)
{
					if ($_SESSION["idioma"]=='cas')
					{
				$nombre_documento=mysql_query("SELECT nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento' ");
				$row = mysql_fetch_array($nombre_documento);
				  $nombre_docum=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma"]=='val')
				{
				$nombre_documento==mysql_query("SELECT nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento' ");
				$row = mysql_fetch_array($nombre_documento);
				  $nombre_docum=$row ["nombre_val"];
				}

}
else
{
	$nombre_docum=$registrotexto11;
		}



if($origen!=0)
{
					if ($_SESSION["idioma"]=='cas')
					{
				$nombre_origen=mysql_query("SELECT nombre_cas FROM registro_origen where cod_centro='$upload_centro' and id_origen='$origen' ");
				$row = mysql_fetch_array($nombre_origen);
				  $nombre_origen=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma"]=='val')
				{
				$nombre_origen==mysql_query("SELECT nombre_val FROM registro_origen where cod_centro='$upload_centro' and id_origen='$origen' ");
				$row = mysql_fetch_array($nombre_origen);
				  $nombre_origen=$row ["nombre_val"];
				}

}
else
{
	$nombre_origen=$registrotexto22;
		}
		
		

if($organismo!=0)
{
					if ($_SESSION["idioma"]=='cas')
					{
				$nombre_organismo=mysql_query("SELECT nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo' ");
				$row = mysql_fetch_array($nombre_organismo);
				  $nombre_organismo=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma"]=='val')
				{
				$nombre_organismo==mysql_query("SELECT nombre_val FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo' ");
				$row = mysql_fetch_array($nombre_organismo);
				  $nombre_organismo=$row ["nombre_val"];
				}

}
else
{
	$nombre_organismo=$registrotexto27;
		}
		
		
if($destino!=0)
{
					if ($_SESSION["idioma"]=='cas')
					{
				$nombre_destino=mysql_query("SELECT nombre_cas FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino' ");
				$row = mysql_fetch_array($nombre_destino);
				  $nombre_destino=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma"]=='val')
				{
				$nombre_destino==mysql_query("SELECT nombre_val FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino' ");
				$row = mysql_fetch_array($nombre_destino);
				  $nombre_destino=$row ["nombre_val"];
				}

}
else
{
	$nombre_destino=$registrotexto32;
		}
		
	

if($dirigido!=0)
{
	$nombre_dirigido=mysql_query("SELECT nombre_usuario FROM usuarios where COD_CENTRO='$upload_centro' and usuario='$dirigido' ");
				$row = mysql_fetch_array($nombre_dirigido);
				  $nombre_dirigido=$row ["nombre_usuario"];
				}
				
else{
	$nombre_dirigido=$registrotexto45;
	}
?>

<div  style='float:left;padding: 0px 0px 0px 0px;'>

<div id="cabecera_formulario">
<?php echo "<b>$registrotexto46</b>";?>
</div>

<form  name="Form1" enctype="multipart/form-data"  method="post" action="<?php echo "$ruta_absoluta";?>/upload_entrada">
<div id="campo_input"  align="left"></div>
<input type="hidden" name='id_registro' value='<?php echo "$id_registro";?>'  >

<table>
<tr>
<td>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto6</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto7</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto8</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto9</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto10</b>";?>
</div>
</td>
</tr>


<tr>
<td valign="top">
<div id="titulo_campo_texto"  align="left">
<input type="text" maxlength='4' autocomplete="off" readonly="readonly" style="background-color:<?php echo "$color_campo_no_editable";?>;width:50px;"  name='anyo' value='<?php echo "$anyo";?>'  >
</div>
</td>

<td valign="top">
<div id="titulo_campo_texto2"  align="left">
<input type="text" maxlength='100' autocomplete="off" readonly="readonly"  style="background-color:<?php echo "$color_campo_no_editable";?>;width:120px;text-align:right"  name='codigo_registro' value='<?php echo "$codigo_registro";?>'  >
</div>
</td>

<td valign="top">
<div id="titulo_campo_texto2"  align="left">
<input type="text"  autocomplete="off" style="width:90px;text-align: right;'"  maxlength='10' onclick='scwShow(this,event);' onBlur='esFechaValida(this);' tabindex='false' name='fecha_registro' value='<?php echo "$fecha_registro";?>'  >
</div>
</td>

<td valign="top">
<div id="titulo_campo_texto2"  align="left">
<input type="text"  autocomplete="off" style="width:90px;text-align: right;'"  maxlength='10' onclick='scwShow(this,event);' onBlur='esFechaValida(this);' tabindex='false' name='fecha_entrada_salida' value='<?php echo "$fecha_entrada_salida";?>'  >
</div>
</td>

<td>

<div id="titulo_campo_texto2" style="float: left;"  align="justify">
<?php
if ($_SESSION["idioma"]=='cas')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma"]=='val')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:250px;' name='tipo_documento'>";
	echo "<option value='$tipo_documento'>$nombre_docum</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

<div id="boton"  style="float: left;" align="left" >
<a href="javascript:popup('<?php echo "$ruta_absoluta/pop_up_tipo/$id_registro/tipo_documento";?>',450,300)" onclick="tipo_doc();" class="button_solo gris add"  title="<?php echo $registrotexto20;?>">
</a>
</div>


</td>
</tr>
</table>


<table>
<tr>
<td>
<div id="titulo_campo_texto"  style="clear:both;"  align="left">
<?php echo "<b>$registrotexto17</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto18</b>";?>
</div>
</td>
</tr>

<tr>
<td>
<div id="titulo_campo_texto"  align="left">
<textarea  name="asunto" id="TextArea1" style="width:350px;height:80px;" rows="5"  cols="39"><?php echo "$asunto";?></textarea>
</div>
</td>

<td valign="top">
<div id="titulo_campo_texto2"  align="left">
<textarea  name="observaciones" id="TextArea1" style="width:350px;height:80px;" rows="5"  cols="39"><?php echo "$observaciones";?></textarea>
</div>
</td>
</tr>
</table>








<?php
if($ruta_archivo=='')
{
	?>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto35</b>";?>
</div>
<?php
}
else 
{
	?>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto36 <u>$ruta_archivo</u>. $registrotexto37 </b>";?>
</div>
<?php
}
?>
<input type="hidden"  name='ruta_archivo' value='<?php echo "$ruta_archivo";?>'  >

<div id="campo_input"  align="left">
<input  style="vertical-align: middle;" type="file"   id="archivo1"  name='archivo_registro' style="width:370px;" />
</div>


<div id="campo_input"  align="left"></div>

<div id="formulario_borde"  style="margin: 0px 0px 0px 0px;float: left;width:280px;" >

<div id="titulo_2" style="padding: 0px 5px 0px 5px; margin-top: -20px;background-color:ffffff;width:60px;">
<?php echo "<b>$registrotexto19</b>";?>
</div>

<div id="campo_input"  align="left"></div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto21</b>";?>
</div>
<div id="campo_input" style="float: left;"  align="justify">
<?php
if ($_SESSION["idioma"]=='cas')
$consulta=mysql_query("SELECT id_origen,nombre_cas FROM registro_origen where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma"]=='val')
$consulta=mysql_query("SELECT id_origen,nombre_val FROM registro_origen where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:200px;' name='origen'>";
	echo "<option value='$origen'>$nombre_origen</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

<div id="boton"  align="left" >
<a href="javascript:popup('<?php echo "$ruta_absoluta/pop_up_tipo/$id_registro/origen";?>',450,300)" onclick="origen();" class="button_solo gris add"  title="<?php echo $registrotexto26;?>">
</a>
</div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto24</b>";?>
</div>
<div id="campo_input"  align="left">
<input type="text" maxlength='255' autocomplete="off"   style="width:200px;"  name='procedencia' value='<?php echo "$procedencia";?>'  >
</div>



<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto25</b>";?>
</div>
<div id="campo_input" style="float: left;"  align="justify">
<?php
if ($_SESSION["idioma"]=='cas')
$consulta=mysql_query("SELECT id_organismo,nombre_cas FROM registro_organismo where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma"]=='val')
$consulta=mysql_query("SELECT id_organismo,nombre_val FROM registro_organismo where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:200px;' name='organismo'>";
	echo "<option value='$organismo'>$nombre_organismo</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

<div id="boton"  align="left" >
<a href="javascript:popup('<?php echo "$ruta_absoluta/pop_up_tipo/$id_registro/organismo";?>',450,300)" onclick="organismo();" class="button_solo gris add"  title="<?php echo $registrotexto28;?>">
</a>
</div>


</div>



<div id="formulario_borde"  style="margin: 0px 0px 0px 20px;float: left; clear:right;width:290px;" >

<div id="titulo_2" style="padding: 0px 5px 0px 5px; margin-top: -20px;background-color:ffffff;width:60px;">
<?php echo "<b>$registrotexto30</b>";?>
</div>

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto31</b>";?>
</div>
<div id="campo_input" style="float: left;"  align="justify">
<?php
if ($_SESSION["idioma"]=='cas')
$consulta=mysql_query("SELECT id_destino,nombre_cas FROM registro_destino where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma"]=='val')
$consulta=mysql_query("SELECT id_destino,nombre_val FROM registro_destino where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:210px;' name='destino'>";
	echo "<option value='$destino'>$nombre_destino</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>


<div id="boton"   style="float: left;"  align="left" >
<a href="javascript:popup('<?php echo "$ruta_absoluta/pop_up_tipo/$id_registro/destino";?>',450,300)" onclick="destino();" class="button_solo gris add"  title="<?php echo $registrotexto33;?>">
</a>
</div>

<div style="padding:50px 0px 50px 0px"> 
<div id="titulo_campo_texto"   align="left">
<?php echo "<b>$registrotexto44</b>";?>
</div>
<div id="campo_input"  align="justify">
<?php

$consulta=mysql_query("SELECT usuario,nombre_usuario FROM usuarios where COD_CENTRO='$upload_centro' order by nombre_usuario ");

	echo "<select style='width:270px;' name='dirigido'>";
	echo "<option value='$dirigido'>$nombre_dirigido</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</div>

</div>








<div id="campo_input"  style="clear:both;" align="left">
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

</div>

<div id="boton"  align="right" >
<?php
$avanzar1=$codigo_registro+1;
$ult_registro =mysql_query("SELECT id_registro,codigo_registro FROM registro where cod_centro='$upload_centro' order by codigo_registro desc limit 1");
$row3 = mysql_fetch_array($ult_registro);
$ult_registro=$row3 ["codigo_registro"];
$id_ult_registro=$row3 ["id_registro"];

$primer_registro =mysql_query("SELECT id_registro,codigo_registro FROM registro where cod_centro='$upload_centro' order by codigo_registro asc limit 1");
$row4= mysql_fetch_array($primer_registro);
$primer_registro=$row4 ["codigo_registro"];
$id_primer_registro=$row4 ["id_registro"];

$retroceder=$codigo_registro-1;
				$cual_retrocede=mysql_query("SELECT id_registro FROM registro where cod_centro='$upload_centro' and codigo_registro='$retroceder' ");
				$row = mysql_fetch_array($cual_retrocede);
				$retroceder=$row ["id_registro"];
				
				$cual_avanza=mysql_query("SELECT id_registro FROM registro where cod_centro='$upload_centro' and codigo_registro='$avanzar1' ");
				$row1 = mysql_fetch_array($cual_avanza);
				$avanzar=$row1["id_registro"];
	
?>

<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada";?>'" style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button"  title="<?php echo $registrotexto38;?>"/>
<img src="<?php echo "$ruta_absoluta/images/anyadir.png";?>" style='width:25px'>
</button>

<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada/$id_primer_registro";?>'" style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button"   title="<?php echo $registrotexto42;?>"/>
<img src="<?php echo "$ruta_absoluta/images/primero.png";?>" style='width:25px'>
</button>


<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada/$retroceder";?>'" style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button"  title="<?php echo $registrotexto40;?>"/>
<img src="<?php echo "$ruta_absoluta/images/anterior.png";?>" style='width:25px'>
</button>
<?php
if($avanzar1<=$ult_registro) 
{
?>

<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada/$avanzar";?>'" style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button"   title="<?php echo $registrotexto39;?>"/>
<img src="<?php echo "$ruta_absoluta/images/siguiente.png";?>" style='width:25px'>
</button>
<?php
}
else {
	?>
<button style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button" title="<?php echo $registrotexto39;?>"/>
<img src="<?php echo "$ruta_absoluta/images/siguiente.png";?>" style='width:25px'>
</button>
<?php
}
?>

<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada/$id_ult_registro";?>'" style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button"   title="<?php echo $registrotexto41;?>"/>
<img src="<?php echo "$ruta_absoluta/images/ultimo.png";?>" style='width:25px'>
</button>

<button  style='float:left;padding: 0px;margin-left:8px;margin-top:-2px;' name="boton" type="button" onclick="valida_codigo(this.form, this.form.archivo_registro.value)"   title="<?php echo $registrotexto43;?>"/>
<img src="<?php echo "$ruta_absoluta/images/guardar.png";?>" style='width:25px'>
</button>

</div>

</form>


</div>

<?php
desconectar();
?>

</div>







<?php include ("../pie_pagina.php");?>


