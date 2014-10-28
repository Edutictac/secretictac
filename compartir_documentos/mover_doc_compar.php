<?php
include ("../permisos.php");
?>
<link rel="StyleSheet" href="<?php echo "$ruta_absoluta";?>/dtree.css" type="text/css" />
<script type="text/javascript" src="<?php echo "$ruta_absoluta";?>/dtree.js"></script>


<script>

function valida_codigo()
{

      var a="GUARDAR";
       document.Form1.nombre_boton.value=a;
       document.Form1.submit();

 }


function cerrar(){
         var a="CERRAR";
         document.Form1.nombre_boton.value=a;
         document.Form1.submit();
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
$doc_id=$_REQUEST['id_documentos'];
$padre_recogido=$_REQUEST['id_nuevo_padre'];

if($padre_recogido==0)
{
$nombre_carpeta=$compartirtexto6;
}
else
{
$carpeta_Seleccionada=mysql_query("SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' and numero_hijo='$padre_recogido' ");
        $row5 = mysql_fetch_array($carpeta_Seleccionada);

        $nombre_carpeta=($row5 ["nombre"]);
}
        
?>
<div id="container">
<div id="tabla_centrar_2" align='left'>

<?php
$activado_modificar_documentos="activado";
include ("../menu.php");
?>

<div  style='float:left;padding: 0px 0px 0px 10px;width:700px;' >

<div id="titulo_1" align='left'>
<b><?php echo "$compartirtexto21";?></b>
</div>

<div id="titulo_campo_texto" align="justify">
<?php echo "$compartirtexto20";?>
</div>
<table>
<tr><td>
<div class="dtree">
	<p><a href="javascript: d.openAll();"><?php echo "<b>$compartirtexto2</b>";?></a> | <a href="javascript: d.closeAll();"><?php echo "<b>$compartirtexto3</b>";?></a></p>

	<script type="text/javascript">

		d = new dTree('d');

		d.add(0,-1,'<?php echo "$compartirtexto6";?>','<?php echo "$ruta_absoluta";?>/mover_doc_compar/<?php echo "$doc_id";?>&0');

		<?php
		$nodos=mysql_query("SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' and tipo='carpeta' order by nombre");
        while ($row4 = mysql_fetch_array($nodos))
        {
        $id_documentos=($row4 ["id_documentos"]);
        $numero_padre=($row4 ["numero_padre"]);
        $numero_hijo=($row4 ["numero_hijo"]);

        $nombre	=($row4 ["nombre"]);

        $link=$ruta_absoluta.'/mover_doc_compar/'.$doc_id.'&'.$numero_hijo;
        $target='_self';
        $imagen_cerrado='../img/folder.gif';
        $imagen_abierto='../img/folderopen.gif';



        ?>

        d.add(<?php echo "$numero_hijo";?>,<?php echo "$numero_padre";?>,'<?php echo "$nombre";?>','<?php echo "$link";?>','','<?php echo "$target";?>','<?php echo "$imagen_cerrado";?>','<?php echo "$imagen_abierto";?>');
        <?php


         }
         ?>

		document.write(d);
        d.openTo(<?php echo "$padre_recogido";?>, true);

	</script>

</div>

<form name="Form1" id="test_upload"  action="<?php echo "$ruta_absoluta";?>/guardar_mover_doc"  enctype="multipart/form-data" method="post">
<!--id documento-->
<div id="campo_input" align="left">
<input type="hidden" style="width:400px;"id="pa" name="doc_id"  value="<?php echo  "$doc_id" ; ?>" />
</div>

<!--id nuevo padre-->
<div id="campo_input" align="left">
<input type="hidden" style="width:400px;" id="n_p" name="nuevo_padre"  value="<?php echo  "$padre_recogido" ; ?>" />
</div>


<!--variable para seleccionar el tipo de boton apretado-->

<input type="hidden" maxlength="20" id="Editbox2"  name="nombre_boton" value="">

<div id="campo_input" align="left">
<?php echo "$compartirtexto23 <b>$nombre_carpeta</b>";?>
</div>

<div id="campo_input" align="left">

<input name="boton" type="button" onclick="valida_codigo()" value="<?php echo "$boton_guardar";?>"/>
<input name="boton" type="button" onclick="cerrar()" value="<?php echo "$boton_volver";?>"  />
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







