<?php
include ("../permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<link rel="StyleSheet" href="<?php echo "$ruta_absoluta";?>/dtree.css" type="text/css" />
<script type="text/javascript" src="<?php echo "$ruta_absoluta";?>/dtree.js"></script>

<script>

function valida_codigo(formulario, archivo){

extensiones_permitidas = new Array(<?php echo "$archivos_permitidos_js";?>);
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


function modificar_documentos(){
         var a="MODIFICAR";
         document.Form1.nombre_boton.value=a;
         document.Form1.submit();}



function mostrar(NDivs)
{

  for(i=1;i<=2;i++)
  {
     document.getElementById('div'+i).style.display = 'none';
     document.getElementById('div0').style.display = 'none';

  }
       if(i=NDivs)
     {
        document.getElementById('div'+i).style.display = 'block';
        document.getElementById('div0').style.display = 'block';
         
     }
}

function ocultar()
{

  for(i=1;i<=2;i++)
  {
     document.getElementById('div'+i).style.display = 'none';
     document.getElementById('div0').style.display = 'none';

  }
      
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


<?php
$fecha_documento=date("Y-m-d");
$fi=f_datef($fecha_documento);

conectar();


$acceso_permitido = mysql_query("SELECT subir_documentos FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["subir_documentos"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}


$numero_aleatorio_padre = rand(1,100);
$numero_aleatorio_hijo = rand(200,300);
$fecha_hoy = date("dmyHis");


//recogo los parametros
$padre_recogido=$_REQUEST['nodo_padre'];

?>
<div id="container">

<div id="tabla_centrar2" align="left">
<?php
$activado_subir_documentos="activado";
include ("../menu.php");
?>

<div id="titulo_1" align='left'>
<b><?php echo "$compartirtexto4";?></b>
</div>

<!--
<div id="campo_input" align="justify">
<?php echo "$compartirtexto5";?>
</div>

<div id="campo_input" align="justify"></div>

-->


<div  style='float:left;padding: 0px 0px 0px 10px;width:700px;' >


<div id="formulario_borde" class="dtree">

	<p><a href="javascript: d.openAll();" onclick="ocultar()"><?php echo "<b>$compartirtexto2</b>";?></a> | <a href="javascript: d.closeAll();" onclick="ocultar()"><?php echo "<b>$compartirtexto3</b>";?></a>
| <a href="#" onclick="mostrar(1)"><?php echo "<b>$compartirtexto29</b>";?>	</a> | <a href="#"  onclick="mostrar(2)"><?php echo "<b>$compartirtexto30</b>";?>	</a>
	</p>
	
	
<form name="Form1" id="test_upload"  action="<?php echo "$ruta_absoluta";?>/guardar_documento_compartido"  enctype="multipart/form-data" method="post">
<!--id_padre-->
<div id="titulo_campo_texto" align="left">
<input type="hidden" style="width:400px;"id="pa" name="padre_recogido"  value="<?php echo  "$padre_recogido" ; ?>" />
</div>

<!--id_hijo-->
<div id="titulo_campo_texto" align="left">
<input type="hidden" style="width:400px;"id="hij" name="hijo"  value="<?php echo  "$numero_aleatorio_hijo$fecha_hoy" ; ?>" />
</div>

	<div id="div1" style="display:none">
<div id="campo_input" align="left">
<?php echo "<b>$compartirtexto31</b>";?> &nbsp;&nbsp;
<input type="text" maxlength="255" autocomplete="off" style="width:400px;"id="titulo" name="titulo"  value="" />
</div>
</div>


<div id="div2" style="display:none">
<div id="campo_input" style="z-index:12;" align="left">

<input  style="vertical-align: middle;" type="file"   id="archivo1" name="archivo" style="width:370px;" />

<input  type="radio" style="vertical-align: middle;" id="RadioButton" checked name="tipo_documento" value="NO">
<span style="vertical-align: middle;"><?php echo "<b>$compartirtexto11</b>"; ?> &nbsp;&nbsp;&nbsp;&nbsp;</span>

<input  style="vertical-align: middle;" type="radio"  id="RadioButton" name="tipo_documento" value="SI">
<span style="vertical-align: middle;"> <?php echo "<b>$compartirtexto12</b>"; ?></span>

<input type="hidden" autocomplete="off" onBlur="esFechaValida(this);" style="width:90px;text-align: right;" id="fecha_d" name="fecha_d"  value="<?php echo  "$fi" ; ?>" />

</div>

</div>
<?php
//include ('dropbox.php');
?>


<!--variable para seleccionar el tipo de boton apretado-->

<input type="hidden" maxlength="20" id="Editbox2" style="position:absolute;left:0px;top:0px;width:108px;font-family:Arial;font-size:11px;z-index:0" name="nombre_boton" tabindex=2 value="">

	<div id="div0" style="display:none">
<input name="boton" type="button" onclick="valida_codigo(this.form, this.form.archivo.value)" value="<?php echo "$boton_guardar";?>"  />
</div>
<!--
<input name="boton" type="button" onclick="modificar_documentos()" value="<?php echo "$compartirtexto14";?>" />
-->

</form>


	<script type="text/javascript"> 

		d = new dTree('d');

		d.add(0,-1,'<?php echo "$compartirtexto6";?>','<?php echo "$ruta_absoluta";?>/registro_archivos/0');
		
		<?php
		$nodos=mysql_query("SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' order by tipo desc, nombre");
        while ($row4 = mysql_fetch_array($nodos))
        {
        $id_documentos=($row4 ["id_documentos"]);
        $numero_padre=($row4 ["numero_padre"]);
        $numero_hijo=($row4 ["numero_hijo"]);
        $tipo=($row4 ["tipo"]);
        $nombre	=($row4 ["nombre"]);
        $link1=($row4 ["link"]);
        $link=$upload_centro.'/'.$link1;
        $fecha=($row4 ["fecha"]);
        $creado=($row4 ["creado"]);
        $usuario_creador=($row4 ["usuario"]);
        $privada=($row4 ["privada"]);
        $tipo_archivo=($row4 ["tipo_archivo"]);
        
        if($privada=='SI')
        {
        if ($usuario_creador==$nick_usuario)
        $mostrar='true';
        else
        $mostrar='false';
        }
        else
        $mostrar='true';
        
        
        

        if($tipo=='carpeta')
        {
        $link=$ruta_absoluta.'/registro_archivos/'.$numero_hijo;
        $target='_self';
        $imagen_cerrado='../img/folder.gif';
        $imagen_abierto='../img/folderopen.gif';
        $creacion="$compartirtexto10 $creado ($fecha)";
        }
        else
        {
               if($tipo_archivo=='dropbox')
               {
               $link=$link1;
               $target='_blank';
               include("tipo_icono.php");
               $creacion="$compartirtexto10 $creado ($fecha)";
               }
               else
               {
               $link=$ruta_absoluta.'/link_doc_comp/'.$link;
               $target='_blank';
               include("tipo_icono.php");
               $creacion="$compartirtexto10 $creado ($fecha)";
               }
               

        }
        
        if($mostrar=='true')
        {
        ?>

        d.add(<?php echo "$numero_hijo";?>,<?php echo "$numero_padre";?>,'<?php echo "$nombre";?>','<?php echo "$link";?>','<?php echo "$creacion";?>','<?php echo "$target";?>','<?php echo "$imagen_cerrado";?>','<?php echo "$imagen_abierto";?>');




        <?php
        }

         }
         ?>
        
		document.write(d);
        d.openTo(<?php echo "$padre_recogido";?>, true);

	</script>

</div>


<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>
</div>






</div>



<?php
desconectar();
?>






<?php include ("../pie_pagina.php");?>




