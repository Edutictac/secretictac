<?php
include ("../permisos.php");
?>

<script>

function valida_codigo(formulario, archivo){

 if (document.Form1.titulo.value.length==0){

       alert("Faltan Datos")

       document.Form1.titulo.focus()

       return 0;

       }

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



function validar_sin_archivo(){
var a="GUARDAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}



function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

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
conectar();


$acceso_permitido = mysql_query("SELECT modificar_documentos FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido))
{
$permiso_acceso_pagina= ($row ["modificar_documentos"]);
}

if ($permiso_acceso_pagina<>1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

//recogo los parametros
$documento_id=$_REQUEST['id_documentos'];
$busqueda3 = mysql_query("SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' and id_documentos='$documento_id' ");
$row4 = mysql_fetch_array($busqueda3);

        $id_documentos=($row4 ["id_documentos"]);
        $nombre	=($row4 ["nombre"]);
        $privada=($row4 ["privada"]);
        $fecha=($row4 ["fecha"]);
        $fecha=f_datef($fecha);
        $tipo=($row4 ["tipo"]);
        
?>
<div id="container">
<div id="tabla_centrar2" align='left'>
<?php
$activo='documentos';
$activado_modificar_documentos="activado";
include ("../menu.php");
?>

<div  style='float:left;padding: 0px 0px 0px 0px;' >
<div id="titulo_1" align='left'>
<b><?php echo "$compartirtexto17";?></b>
</div>


<table>
<tr><td>

<form name="Form1" id="test_upload"  action="<?php echo "$ruta_absoluta";?>/guar_docu_comp_editado"  enctype="multipart/form-data" method="post">
<!--numero documento-->
<div id="campo_input" align="left">
<input type="hidden" style="width:400px;"id="pa" name="doc_id"  value="<?php echo  "$id_documentos" ; ?>" />
</div>


<div id="titulo_campo_texto" align="left">
<?php echo "<b>$compartirtexto34</b>";?>
</div>
<div id="campo_input" align="left">
<input type="text" maxlength="255" autocomplete="off" style="width:400px;"id="titulo" name="titulo"  value="<?php echo  "$nombre" ; ?>" />
</div>


<?php
if($tipo=='archivo')
{
?>

<div id="campo_input" style="z-index:12;" align="left">
<input type="radio" style="vertical-align: middle;" <?php if($privada=='NO') echo "checked"; ?> id="RadioButton" checked name="tipo_documento" value="NO">
<span style="vertical-align: middle;"><?php echo "<b>$compartirtexto11</b>"; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;

<input type="radio" style="vertical-align: middle;"  <?php if($privada=='SI') echo "checked"; ?> id="RadioButton" name="tipo_documento" value="SI">
<span style="vertical-align: middle;"><?php echo "<b>$compartirtexto12</b>"; ?></span>

<input type="hidden"autocomplete="off" onBlur="esFechaValida(this);" style="width:80px;text-align: right;" id="fecha_d" name="fecha_d"  value="<?php echo  "$fecha" ; ?>" />

</div>


<!--DOCUMENTO
<div id="campo_input" align="left">
<input type="file"   id="archivo1" name="archivo" style="width:390px;" />
</div>
-->

<?php
//include ('dropbox.php');
?>

<div id='campo_input'></div>

<?php
}
?>
<!--variable para seleccionar el tipo de boton apretado-->

<input type="hidden" maxlength="20" id="Editbox2" style="position:absolute;left:0px;top:0px;width:108px;font-family:Arial;font-size:11px;z-index:0" name="nombre_boton" tabindex=2 value="">

<div id="campo_input" align="left">


<input name="boton" type="button" onclick="validar_sin_archivo()" value="<?php echo "$boton_guardar";?>"  />


<input name="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_volver";?>"  />
</div>

</form>



</td></tr>
</table>



<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>





</div>
</div>


<?php
desconectar();
?>






<?php include ("../pie_pagina.php");?>




