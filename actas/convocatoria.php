<?php
include ("../permisos.php");
?>

<script type='text/JavaScript' src='<?php echo "$ruta_absoluta/";?>scw.js'></script>
 <script src='<?php echo "$ruta_absoluta/ckeditor/ckeditor.js";?>'></script>
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

function valida_codigo(){
       var a="GUARDAR";
       document.Form2.nombre_boton.value=a;
       document.Form2.submit();
 }

function vista_previa(){
var a="VISTA_PREVIA";
document.Form2.nombre_boton.value=a;
document.Form2.submit();
}

function nuevo_doc(){
var a="NUEVO";
document.Form2.nombre_boton.value=a;
document.Form2.submit();
}



function confirmar ( mensaje ) {
return confirm( mensaje );
}

 function envia(){
       document.Form1.submit();
}

</script>


<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.md5($usuario).$codigo_fecha;

$activo='actas';
$activado_convocatorias_actas="activado";
$activo_convocatoria='active';

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
<?php echo "$actatexto79";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto80";?>
</div>



<?php
//distincion entre formulario de editar y formulario nuevo
if (isset($_REQUEST['tipo_acta']))
{
$id_tipo_seleccionado=$_REQUEST['tipo_acta'];
$tipo_sel =mysql_query("SELECT * FROM actas_tipo_acta where cod_centro='$upload_centro' and id_tipo='$id_tipo_seleccionado' ");
$row = mysql_fetch_array($tipo_sel);
$id_tipo_seleccion=($row ["id_tipo"]);

if ($_SESSION["idioma_secretictac"]=='cas')
$nombre_acta= ($row ["nombre_cas"]);
if ($_SESSION["idioma_secretictac"]=='val')
$nombre_acta= ($row ["nombre_val"]);
}
else 
{
$id_tipo_seleccion='0';
$nombre_acta= $actatexto31;
}
?>

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/convocatorias_actas"  id="Form1">
<div id="campo_input" style="float:left;width:700px;" align='justify'>
<b><?php echo "$actatexto30";?></b>
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo,nombre_cas FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_cas");
if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo,nombre_val FROM actas_tipo_acta where cod_centro='$upload_centro' order by nombre_val");

	echo "<select name='tipo_acta' onchange='envia()'>";
	echo "<option value=$id_tipo_seleccion>$nombre_acta</option>";
	
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
</form>



<?php
include ("menu_convocatoria.php");
if (isset($_REQUEST['tipo_acta']))
{
	
	
//distincion entre acta editar y acta nueva
if (isset($_REQUEST['id_convocatoria']))
{

$id_convocatoria=$_REQUEST['id_convocatoria'];
$acta_sel =mysql_query("SELECT * FROM actas_convocatorias where cod_centro='$upload_centro' and id_convocatoria='$id_convocatoria' ");
$row = mysql_fetch_array($acta_sel);
$id_convocatoria=($row ["id_convocatoria"]);
$fecha= f_datef($row ["fecha"]);
$fecha_convocatoria= f_datef($row ["fecha_convocatoria"]);
$texto_cas= ($row ["texto_cas"]);
$texto_cas=str_replace($replace,$search,$texto_cas);
$texto_val= ($row ["texto_val"]);
$texto_val=str_replace($replace,$search,$texto_val);
$anyo= ($row ["anyo"]);
}
else 
{

$id_convocatoria=$codigo_tipo;
$fecha= '';
$fecha_convocatoria='';
$texto_cas= '';
$texto_val='';
$anyo=$upload_anyo_academico;
}



?>
<div  style='float: left;padding: 0px 10px 0px 10px;' >
<form name="Form2" id="test_upload"  action="<?php echo "$ruta_absoluta";?>/upload_convocatoria"  method="post">
<input type="hidden" name='id_convocatoria' value='<?php echo "$id_convocatoria";?>'  >
<input type="hidden" name='tipo_acta_sel' value='<?php echo "$id_tipo_seleccion";?>'  >


<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<div style="width:700px" align="right">
<div align="right" style='padding: 0px;margin-left:8px;margin-top:0px;'>
<button  style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="vista_previa();" title="<?php echo $boton_vista_previa;?>"/>
<img src="<?php echo "$ruta_absoluta/images/vista_previa.png";?>" style='width:18px'>
</button>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="submit" onclick="valida_codigo()"   title="<?php echo $registrotexto43;?>"/>
<img src="<?php echo "$ruta_absoluta/images/guardar.png";?>" style='width:25px'>
</button>

<button style="float:right;" name="boton" type="button" onclick="nuevo_doc()"   title="<?php echo $boton_nuevo;?>"/>
<img src="<?php echo "$ruta_absoluta/images/nuevo_doc.png";?>" style='width:25px'>
</button>
</div>
</div>
<div  style="clear:both;"></div>



<!--FECHA -->
<div id="campo_input" style="margin-top:0px;" align="left">
<?php echo "<b>$actatexto84</b>";?> &nbsp;
<input type="text"  autocomplete="off" style="width:90px;text-align: right;'"  maxlength='10' onclick='scwShow(this,event);' onBlur='esFechaValida(this);' tabindex='false' name='fecha_acta' value='<?php echo "$fecha";?>'  >
 &nbsp; &nbsp; &nbsp;
<?php echo "<b>$actatexto54</b>";?> &nbsp;
<input type="text"  autocomplete="off" style="width:50px;text-align: right;'"  maxlength='4'  name='anyo' value='<?php echo "$anyo";?>'  >
</div>


<!--FECHA convocatoria-->
<div id="campo_input" style="margin-top:0px;" align="left">
<?php echo "<b>$actatexto90</b>";?> &nbsp;
<input type="text"  autocomplete="off" style="width:90px;text-align: right;'"  maxlength='10' onclick='scwShow(this,event);' onBlur='esFechaValida(this);' tabindex='false' name='fecha_convocatoria' value='<?php echo "$fecha_convocatoria";?>'  >
</div>


<div id="titulo_campo_texto" align="left">
<?php echo "<b>$actatexto82</b>";?> &nbsp;
</div>
<div id="campo_input" align="left">
<textarea id="edited" name="texto_cas"  rows="11" cols="82"><?php echo "$texto_cas";?>
</textarea>
</div>

<script> 
CKEDITOR.replace( 'texto_cas',
{
		  toolbar :
        [
['Font','FontSize'],
	  
	   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent'],
	   '/',
	   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight'],
	   ['Table','-','Link','TextColor','BGColor','Source']
        ]
});
//]]>
 </script>



<div id="titulo_campo_texto" style="margin-top:15px;" align="left">
<?php echo "<b>$actatexto83</b>";?> &nbsp;
</div>
<div id="campo_input" align="left">
<textarea id="edited" name="texto_val"  rows="11" cols="82"><?php echo "$texto_val";?>
</textarea>
</div>

<script> 
CKEDITOR.replace( 'texto_val',
{
		  toolbar :
        [
['Font','FontSize'],
	  
	   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent'],
	   '/',
	   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight'],
	   ['Table','-','Link','TextColor','BGColor','Source']
        ]
});
//]]>
 </script>


</form>
</div>
<?php
}//termina llave si hay tipo de acta seleccionado
desconectar();
?>

<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>
