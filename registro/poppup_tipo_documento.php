<?php
include ("../seguridad.php");
include ("../base_poppus.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
$id_registro= $_REQUEST["id_registro"];
$tipo= $_REQUEST["tipo"];
$entrada_salida= $_REQUEST["tipo_registro"];


switch ($tipo) {
case 'tipo_documento':
$texto_cabecera=$registrotexto13;
break;

case 'origen':
$texto_cabecera=$registrotexto23;
break;


case 'organismo':
$texto_cabecera=$registrotexto29;
break;


case 'destino':
$texto_cabecera=$registrotexto34;
break;
}



?>

<div id="cabecera_formulario" align="justify">
<?php echo "<b>$texto_cabecera</b>";?>
</div>
<div id="container" style='margin:0px 20px 20px 20px;width:400px;height:300px'>

<div id="campo_input"  align="left"></div>
<div id="campo_input"  align="left"></div>

<div id="campo_input" align="justify">
<?php echo "$registrotexto14";?>
</div>

<form name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/upload_popup_tipo_doc">

<div id="campo_input"  align="left"></div>

<input type="hidden" name='id_registro' value='<?php echo "$id_registro";?>'  >
<input type="hidden" name='tipo' value='<?php echo "$tipo";?>'  >
<input type="hidden" name='entrada_salida' value='<?php echo "$entrada_salida";?>'  >

<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto15</b>";?>
</div>
<div id="campo_input"  align="left">
<input type="text" maxlength='255' autocomplete="off"   style="width:300px;"  name='nombre_cas' value=''  >
</div>


<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto16</b>";?>
</div>
<div id="campo_input"  align="left">
<input type="text" maxlength='255' autocomplete="off"   style="width:300px;"  name='nombre_val' value=''  >
</div>

<div id="titulo_campo_texto"  align="left">
<input name="boton" type="submit"  value="<?php echo "$boton_guardar";?>"  />
</div>
</form>

</div>



