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
	
var archivo=document.Form1.archivo.value;
var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
if (archivo!=""){
if (extension!=".jpg") //Aqui escriben la extensión que desean aceptar
{alert(archivo +' '+'<?php echo "$extension_no_valida";?>')
document.Form1.archivo.focus();
return 0;
}
}

var archivo_conse=document.Form1.archivo_logo_derecho.value;
var extension_conse = (archivo_conse.substring(archivo_conse.lastIndexOf("."))).toLowerCase();
if (archivo_conse!=""){
if (extension_conse!=".jpg") //Aqui escriben la extensión que desean aceptar
{alert(archivo_conse +' '+'<?php echo "$extension_no_valida";?>')
document.Form1.archivo_conse.focus();
return 0;
}
}
       var a="GUARDAR";
       document.Form1.nombre_boton.value=a;
       document.Form1.submit();
 }

function cerrar(){
var a="PREVIA";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}



function mostrar(NDivs)
{
        document.getElementById('div1').style.display = 'block';
            
}

function ocultar()
{

     document.getElementById('div1').style.display = 'none';
      
}
</script>



<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$activado_datos_centro="activado";
include ("../../menu.php");
conectar();

$tipo_permiso = mysql_query("SELECT  definir_centro FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($tipo_permiso))
{
$permiso_acceso_pagina= ($row ["definir_centro"]);
}

if ($permiso_acceso_pagina<>1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}


$result=mysql_query("SELECT * FROM 1_centro WHERE COD_CENTRO='$upload_centro'");
$row = mysql_fetch_array($result);
$secretari= ($row ["secretari"]);
$tipo_registro= ($row ["tipo_registro"]);
$inicio_entradas= ($row ["inicio_entradas"]);
$inicio_salidas= ($row ["inicio_salidas"]);
$NOMBRE_LOGO= ($row ["NOMBRE_LOGO"]);
$nombre_centro_DATOS= ($row ["NOMBRE_CENTRO"]);
$direccion_DATOS= ($row ["DIRECCION"]);
$poblacion_DATOS= ($row ["POBLACION"]);
$provincia_DATOS= ($row ["PROVINCIA"]);
$cp_DATOS= ($row ["cp"]);
$web_DATOS= ($row ["WEB"]);
$email_DATOS= ($row ["EMAIL"]);
$telefono_DATOS= ($row ["TELEFONO"]);
$fax_DATOS= ($row ["FAX"]);
$NOMBRE_LOGO_CONSELLERIA= ($row ["NOMBRE_LOGO_CONSELLERIA"]);
$FRASE1= ($row ["FRASE1"]);
$FRASE2= ($row ["FRASE2"]);
$FRASE3= ($row ["FRASE3"]);
$cmlogo=($row ["CMLOGO"]);//distancia al margen izquierdo
$cmlogo_conse=($row ["CMLOGO_CONSE"]);//distancia al margen izquierdo


$ruta_foto_logo="$ruta_absoluta/imagen_logo_centro/".$upload_centro."/".$NOMBRE_LOGO;
$ruta_logo_conselleria="$ruta_absoluta/imagen_logo_conse/".$upload_centro."/".$NOMBRE_LOGO_CONSELLERIA;
?>

<div id="titulo_1" align="justify">
<?php echo "$definir_centro2";?>
</div>

<div id="campo_input" align='justify'>
<?php echo "$definir_centro3";?>
</div>





<!--mantenemos el formulario a la derecha-->
<div  style='float:left;padding: 0px 0px 0px 10px;width:700px;' >

<div id="cabecera_formulario">
<?php echo "<b>$definir_centro4</b>";?>
</div>



<form name="Form1"  action="<?php echo "$ruta_absoluta/";?>guardar_dat_centro"  enctype="multipart/form-data" method="post">

<div id="campo_input" align='left'></div>


<div id="formulario_borde"  style="margin: 10px 0px 20px 0px;float: left;" >

<div id="campo_input"  style="padding: 0px 5px 0px 5px; margin-top: -20px;background-color:ffffff;width:190px;"align='center'>
<!--titulo logo centro y datos-->
<b><?php echo "$definir_centro22";?></b>  
</div>

<div id="campo_input" align='left'></div><div id="campo_input" align='left'></div>



<!--SECRETARI-->
<div id="titulo_campo_texto" align='left'>
<b><?php echo "$definir_centro0";?></b>
</div>
<div id="campo_input" align='left'>
<input type="text" maxlength="255"  autocomplete="off" name="secretari"  style='width:400px;' value="<?php echo  "$secretari" ; ?>" />
</div>

<div id="campo_input" align='left'>
<?php echo $definir_centro27;?>
</div>


<div id="campo_input" align='left' style="display:none">
<input type="radio" id="RadioButton" <?php if ($tipo_registro=='a') echo 'checked';?> onclick="ocultar()" name="contar" value="a">
<?php echo "<b>$definir_centro23</b>"; ?>
</div>


<div id="campo_input" align='left'  style="display:none">
<input type="radio" id="RadioButton" <?php if ($tipo_registro=='c') echo 'checked';?>  onclick="mostrar(1)" name="contar" value="c">
<?php echo "<b>$definir_centro24</b>"; ?>
</div>


<?php
if($tipo_registro=='c')
$display_mostrar='block';
else 
$display_mostrar='none';
?>

<div id="div1"  style="margin: 0px 0px 0px 0px;display:block">
<div id="campo_input" align='left'>
<?php echo "<b>$definir_centro25</b>"; ?>&nbsp;&nbsp;
<input type="text" maxlength="11"  autocomplete="off" name="inicio_entradas"  style='width:100px;' value="<?php echo  "$inicio_entradas" ; ?>" />
</div>

<div id="campo_input" align='left'>
<?php echo "<b>$definir_centro26</b>"; ?>&nbsp;&nbsp;
<input type="text" maxlength="11"  autocomplete="off" name="inicio_salidas"  style='width:100px;' value="<?php echo  "$inicio_salidas" ; ?>" />
</div>

</div>

</div>



<div id="formulario_borde"  style="margin: 10px 0px 20px 0px;float: left;" >

<div id="campo_input"  style="padding: 0px 5px 0px 5px; margin-top: -20px;background-color:ffffff;width:260px;"align='center'>
<!--titulo logo centro y datos-->
<b><?php echo "$definir_centro20";?></b>  
</div>
<div id="campo_input" align='left'></div><div id="campo_input" align='left'></div>
<div id="titulo_campo_texto" style='float:left;padding: 0px 10px 0px 0px;' align='left'>
<img src='<?php echo "$ruta_foto_logo";?>'  style='width:100px;'/>
</div>

<input type="hidden"   name="NOMBRE_LOGO"  value="<?php echo  "$NOMBRE_LOGO" ; ?>" />
<input type="hidden"   name="NOMBRE_LOGO_CONSELLERIA"  value="<?php echo  "$NOMBRE_LOGO_CONSELLERIA" ; ?>" />





<!--NOMBRE CENTRO-->
<div id="titulo_campo_texto" align='left'>
<b><?php echo "$definir_centro5";?></b>
</div>
<div id="campo_input" align='left'>
<input type="text" maxlength="100"  autocomplete="off" name="n_centro"  style='width:300px;' value="<?php echo  "$nombre_centro_DATOS" ; ?>" />
</div>



<div id="campo_input" align='left'>
<!--DIRECCION-->
<b><?php echo "$definir_centro6";?></b>  
<input type="text" maxlength="100"  autocomplete="off" name="direccion" style='width:170px;' value="<?php echo  "$direccion_DATOS" ; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--poblacion-->
<b><?php echo "$definir_centro7";?> </b>
<input type="text" maxlength="100" autocomplete="off" name="poblacion"  style='width:150px;' value="<?php echo  "$poblacion_DATOS" ; ?>" />
</div>


<div id="campo_input" align='left'>
<!--provincia-->
<b><?php echo "$definir_centro8";?>  </b>
<input type="text" maxlength="100"  autocomplete="off" name="provincia" style='width:200px;' value="<?php echo  "$provincia_DATOS" ; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--cp-->
<b><?php echo "$definir_centro9";?> </b> 
<input type="text" maxlength="50" autocomplete="off" name="cp" style='width:100px;' value="<?php echo  "$cp_DATOS" ; ?>" />

</div>

<div id="campo_input" align='left'>
<!--telefono-->
<b><?php echo "$definir_centro10";?> </b>
<input type="text" maxlength="9" autocomplete="off" name="telefono"  style='width:100px;' value="<?php echo  "$telefono_DATOS" ; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--FAX-->
<b><?php echo "$definir_centro11";?> </b>   
<input type="text" maxlength="9" autocomplete="off" name="fax"  style='width:100px;' value="<?php echo  "$fax_DATOS" ; ?>" />
</div>

<div id="campo_input" align='left'>
<!--email-->
<b><?php echo "$definir_centro12";?> </b>  
<input type="text" maxlength="100" autocomplete="off" name="email" style='width:260px;' value="<?php echo  "$email_DATOS" ; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--web-->
<b><?php echo "$definir_centro13";?>  </b>
<input type="text" maxlength="100"  autocomplete="off" name="web" style='width:260px;'  tabindex=8 value="<?php echo  "$web_DATOS" ; ?>" />
</div>


<div id="campo_input" align='left'></div>
<!--ARCHIVO-->
<div id="titulo_campo_texto" align='left'>
<b><?php echo "$definir_centro14";?></b>
</div>
<div id="campo_input" align='left'>
<input type="file" id="log_cen" name="archivo" style="width:390px;"  />
</div>


<div id="campo_input" align='left'>
<b><?php echo "$definir_centro15";?> </b>
<input type="text" maxlength="3" style="width:50px;" autocomplete="off" name="cmlogo"   value="<?php echo  "$cmlogo" ; ?>" />
</div>

</div>




<div id="formulario_borde"  style="margin: 10px 0px 10px 0px;float: left;" >



<!--datos del logo conselleria-->

<!--titulo logo conselleria-->
<div id="campo_input"  style="padding: 0px 5px 0px 5px; margin-top: -20px;background-color:ffffff;width:320px;"align='center'>
<!--titulo logo centro y datos-->
<b><?php echo "$definir_centro21";?></b>  
</div>
<div id="campo_input" align='left'></div><div id="campo_input" align='left'></div>
<div id="titulo_campo_texto" style='float:left;padding: 0px 10px 0px 0px;' align='left'>
<img src='<?php echo "$ruta_logo_conselleria";?>'  style='width:100px;' />
</div>

<div id="campo_input" align='left'>
<b><?php echo "$definir_centro16";?>&nbsp;</b>
<input type="text" maxlength="100" style="width:320px;" autocomplete="off" name="frase1"   value="<?php echo  "$FRASE1" ; ?>" />
</div>

<div id="campo_input" align='left'>
<b><?php echo "$definir_centro17";?>&nbsp;</b>
<input type="text" maxlength="100" style=";width:320px;" autocomplete="off" name="frase2"  value="<?php echo  "$FRASE2" ; ?>" />
</div>

<div id="campo_input" align='left'>
<b><?php echo "$definir_centro18";?>&nbsp;</b>
<input type="text" maxlength="100" style="width:320px;" autocomplete="off"  name="frase3"   value="<?php echo  "$FRASE3" ; ?>" />
</div>

<div id="campo_input" align='left'></div>

<!--ARCHIVO LOGO CONSELLERIA-->


<div id="titulo_campo_texto" align='left'>
<b><?php echo "$definir_centro19";?></b>
</div>
<div id="campo_input" align='left'>
<input type="file" id="log_conse" name="archivo_logo_derecho" style="width:390px;" />
</div>

<div id="campo_input" align='left'>
<b><?php echo "$definir_centro15";?></b> &nbsp;&nbsp;
<input type="text" maxlength="3" style="width:50px;" autocomplete="off" name="cmlogo_conse" value="<?php echo  "$cmlogo_conse" ; ?>" />
</div>



</div>

<div id="campo_input" align='right' style="margin: 10px 0px 10px 0px;float: right;" >
<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name="boton" type="button"  onclick="valida_codigo()" value="<?php echo "$boton_guardar";?>"   />
<input name="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_vista_previa";?>"  />

</div>

</form>

</div>


</div>

<?php
desconectar();
?>








<?php include ("../../pie_pagina.php");?>




