<?php
include ("../permisos.php");

$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
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

function listado(){
var a="LISTADO";
document.Form2.nombre_boton.value=a;
document.Form2.submit();
}

function confirmar ( mensaje ) {
return confirm( mensaje );
}
 function envia(){
       document.Form1.submit();
}

function mostrar(NDivs)
{

  for(i=1;i<=3;i++)
  {
     document.getElementById('div'+i).style.display = 'none';
       var elemento = document.getElementById(i);
	      elemento.className = "inactive";
     
  }
       if(i=NDivs)
     {
        document.getElementById('div'+i).style.display = 'block';
        var elemento = document.getElementById(i);
	      elemento.className = "active";
	      document.Form2.div_seleccionado.value=i;

     }


}

function seleccionar_todo(){
   for (i=0;i<document.Form2.elements.length;i++)
      if(document.Form2.elements[i].type == "checkbox")
         document.Form2.elements[i].checked=1
}

function deseleccionar_todo(){
   for (i=0;i<document.Form2.elements.length;i++)
      if(document.Form2.elements[i].type == "checkbox")
         document.Form2.elements[i].checked=0
}


</script>


<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$codigo_fecha = date("dmyHis");
$codigo_tipo=$upload_centro.md5($usuario).$codigo_fecha;

$activo='actas';
if (isset($_REQUEST['id_acta']))
$activado_editar_actas="activado";
else 
$activado_redactar_actas="activado";

include ("../menu.php");
conectar();

$acceso_permitido = mysql_query("SELECT redactar_actas FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["redactar_actas"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";
}
?>

<?php
if (isset($_REQUEST['id_acta']))
{
	?>
	
<div id="titulo_1" align="justify">
<?php echo "$actatexto57";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto50";?>
</div>
<?php
}
else 
{
?>
<div id="titulo_1" align="justify">
<?php echo "$actatexto48";?>
</div>
<div id="campo_input" style="padding-top:10px;" align='justify'>
<?php echo "$actatexto50";?>
</div>
	<?php
}
?>


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

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/redactar_actas"  id="Form1">
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
if (isset($_REQUEST['tipo_acta']))
{
?>

<?php
//distincion entre acta editar y acta nueva
if (isset($_REQUEST['id_acta']))
{
$div_seleccionado=$_REQUEST['div_seleccionado'];
$id_acta=$_REQUEST['id_acta'];
$acta_sel =mysql_query("SELECT * FROM actas where cod_centro='$upload_centro' and id_acta='$id_acta' ");
$row = mysql_fetch_array($acta_sel);
$id_acta=($row ["id_acta"]);
$fecha= f_datef($row ["fecha"]);
$texto= ($row ["texto"]);
$texto=str_replace($replace,$search,$texto);
$acuerdos= ($row ["acuerdos"]);
$acuerdos=str_replace($replace,$search,$acuerdos);
$anyo= ($row ["anyo"]);
}
else 
{
$div_seleccionado=1;
$id_acta=$codigo_tipo;
$fecha= '';
$texto= '';
$acuerdos='';
$anyo=$upload_anyo_academico;
}
include ("menu_acta.php");
?>
<div  style='float: left;padding: 0px 10px 0px 10px;' >
<form name="Form2" id="test_upload"  action="<?php echo "$ruta_absoluta";?>/upload_acta"  method="post">
<input type="hidden" name='id_acta' value='<?php echo "$id_acta";?>'  >
<input type="hidden" name='tipo_acta_sel' value='<?php echo "$id_tipo_seleccion";?>'  >
<input type="hidden" name='div_seleccionado' value='<?php echo $div_seleccionado;?>'  >

<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<div style="width:700px" align="right">
<div align="right" style='padding: 0px;margin-left:8px;margin-top:0px;'>
<button  style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="vista_previa();" title="<?php echo $boton_vista_previa;?>"/>
<img src="<?php echo "$ruta_absoluta/images/vista_previa.png";?>" style='width:18px'>
</button>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="valida_codigo()"   title="<?php echo $registrotexto43;?>"/>
<img src="<?php echo "$ruta_absoluta/images/guardar.png";?>" style='width:25px'>
</button>

<?php
if (isset($_REQUEST['id_acta']) )
{
if (isset($_REQUEST['busqueda']))
{
?>
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="javascript:window.history.back();"  title="<?php echo $actatexto68;?>"/>
<img src="<?php echo "$ruta_absoluta/images/volver.png";?>" style='width:25px'>
</button>	
<?php
}
else
{
?>	
<button style="float:right;margin-left:3px;margin-top:0px;" name="boton" type="button" onclick="listado()"   title="<?php echo $actatexto68;?>"/>
<img src="<?php echo "$ruta_absoluta/images/listado.png";?>" style='width:25px'>
</button>
<?php
}
}
?>


<button style="float:right;" name="boton" type="button" onclick="nuevo_doc()"   title="<?php echo $boton_nuevo;?>"/>
<img src="<?php echo "$ruta_absoluta/images/nuevo_doc.png";?>" style='width:25px'>
</button>
</div>
</div>
<div  style="clear:both;"></div>

<?php
if($div_seleccionado==1)
$display1='block';
else 
$display1='none';
?>
<div id="div1" style="display:<?php echo $display1;?>">

<!--FECHA -->
<div id="campo_input" style="margin-top:0px;" align="left">
<?php echo "<b>$compartirtexto28</b>";?> &nbsp;
<input type="text"  autocomplete="off" style="width:90px;text-align: right;'"  maxlength='10' onclick='scwShow(this,event);' onBlur='esFechaValida(this);' tabindex='false' name='fecha_acta' value='<?php echo "$fecha";?>'  >
 &nbsp; &nbsp; &nbsp;
 
<?php
if($anyo==$upload_anyo_academico)
{
	?>
<?php echo "<b>$actatexto54</b>";?> &nbsp;
<input type="text"  autocomplete="off" style="width:50px;text-align: right;'"  maxlength='4'  name='anyo' value='<?php echo "$anyo";?>'  >
</div>
<?php
}
else 
{
?>
<?php echo "<b>$actatexto54</b>";?> &nbsp;
<input type="text"  autocomplete="off" readonly="readonly" style="background-color:<?php echo "$color_campo_no_editable";?>;width:50px;text-align: right;" maxlength='4'  name='anyo' value='<?php echo "$anyo";?>'  >
</div>
<?php
}
?>
	

<div id="titulo_campo_texto" align="left">
<?php echo "<b>$actatexto51</b>";?> &nbsp;
</div>
<div id="campo_input" align="left">
<textarea id="edited" name="texto"  rows="11" cols="82"><?php echo "$texto";?>
</textarea>
</div>

<script> 
CKEDITOR.replace( 'texto',
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
</div>

<?php
if($div_seleccionado==2)
$display2='block';
else 
$display2='none';
?>

<div id="div2" style="display:<?php echo $display2;?>">
<div id="titulo_campo_texto" align="left">
<?php echo "<b>$actatexto52</b>";?> &nbsp;
</div>
<div id="campo_input" align="left">
<textarea id="edited" name="acuerdos"  rows="11" cols="82"><?php echo "$acuerdos";?>
</textarea>
</div>

<script> 
CKEDITOR.replace( 'acuerdos',
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
</div>

<?php
if($div_seleccionado==3)
$display3='block';
else 
$display3='none';
?>

<div id="div3" style="display:<?php echo $display3;?>">
<div id="titulo_campo_texto" align="left">
<?php echo "<b>$actatexto53</b>";?> &nbsp;
</div>

<?php
if($anyo==$upload_anyo_academico)
{
?>
<div id="enlaces">
<a href="javascript:seleccionar_todo()"><b><?php echo "$actatexto55";?></b></a> |
<a href="javascript:deseleccionar_todo()"><b><?php echo "$actatexto56";?></b></a>
</div>
<table> 
<tr>
<?php
$num_col=3;
$filas=0;
$bus_prof=mysql_query("SELECT id_asistente,nombre_asistente FROM actas_asistentes where cod_centro='$upload_centro' and id_tipo_acta='$id_tipo_seleccion' order by nombre_asistente");
	while($row=mysql_fetch_array($bus_prof))
	{
	$id_asistente=($row["id_asistente"]);
	$nombre_asistente=($row["nombre_asistente"]);
				   
				$sql = "SELECT id_asistente FROM acta_asistentes_reunion where id_actas='$id_acta' and id_asistente='$id_asistente' and cod_centro='$upload_centro'";
				$result = mysql_query($sql);
				$numero = mysql_num_rows($result);
					if ($numero!=0)
  				$asiste_reun='checked';
  				else 
  				$asiste_reun='';
  
  $ancho_columnas=700/$num_col;
   if($filas%$num_col==0)
    {echo "<tr>";
    echo "<td valign='top' width=$ancho_columnas style='border:0px #C0C0C0 solid;' >";

    }
    else {
    echo "<td valign='top' width=$ancho_columnas style='border:0px #C0C0C0 solid;'>";

    }
?>
    
    <div id="titulo_8"  align="left">
    <input type="checkbox"  name="asiste[]" <?php echo $asiste_reun;?> value="<?php echo "$id_asistente";?>" >
    <?php echo "$nombre_asistente";?>
    </div>


<?php
 $filas=$filas+1;
 if($filas%$num_col==0)
 echo "</td></tr>";
 else
 echo "</td>";
?>

    <?php
	}
    ?>

</table>
<?php
}//termina en el caso de que el acta sea del mismo años academico
else 
{
?>
<table> 
<tr>
<?php
$num_col=3;
$filas=0;
$bus_prof=mysql_query("SELECT id_asistente,nombre FROM acta_asistentes_reunion where cod_centro='$upload_centro' and id_actas='$id_acta' order by nombre");
	while($row=mysql_fetch_array($bus_prof))
	{
	$id_asistente=($row["id_asistente"]);
	$nombre_asistente=($row["nombre"]);
  $link_borrar="$ruta_absoluta/borrar_antiguo_miembro/$id_tipo_seleccion/$id_acta/$id_asistente";
				   
				$sql = "SELECT id_asistente FROM acta_asistentes_reunion where id_actas='$id_acta' and id_asistente='$id_asistente' and cod_centro='$upload_centro'";
				$result = mysql_query($sql);
				$numero = mysql_num_rows($result);
					
  $ancho_columnas=700/$num_col;

    if ($numero!=0)
    {

					   if($filas%$num_col==0)
					    {echo "<tr>";
					    echo "<td valign='top' width=$ancho_columnas style='border:0px #C0C0C0 solid;' >";
					
					    }
					    else {
					    echo "<td valign='top' width=$ancho_columnas style='border:0px #C0C0C0 solid;'>";
					
					    }
					?>
					   
					    <div id="titulo_campo_texto"  align="left">
					     <a href='<?php echo "$link_borrar";?>' class="transparente delete " onclick="return confirmar('<?php echo "$actatexto35  $nombre_asistente?";?>')" target="_self">
            </a>
            <input type="hidden"  name="asiste[]" checked value="<?php echo "$id_asistente";?>" >
					    <?php echo "$nombre_asistente";?>
					    </div>
					   
					
					
					<?php
					 $filas=$filas+1;
					 if($filas%$num_col==0)
					 echo "</td></tr>";
					 else
					 echo "</td>";
					?>

    <?php
 }
	}
    ?>

</table>
<?php
}//termina distinto año academico
?>
</div>
</form>

</div>

<?php
}
desconectar();
?>
<div id="separador" style="clear:both;"></div>
</div>







<?php include ("../pie_pagina.php");?>
