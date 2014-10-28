<?php
include ("../permisos.php");
?>

<script>
function confirmar ( mensaje ) {
return confirm( mensaje );
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

?>

<div id="container">
<div id="tabla_centrar2" align="left">
<?php
$activado_modificar_documentos="activado";
include ("../menu.php");
?>

<div >
<div id="titulo_1" align='left'>
<b><?php echo "$compartirtexto14";?></b>
</div>


<?php
if($permiso=='1')
{
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo = "borde";
$_pagi_sql = "SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro'  order by nombre";
include("../paginator.inc.php");

}
else
{
$_pagi_cuantos = 30;
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo = "borde";
$_pagi_sql = "SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' and usuario='$nick_usuario' and tipo='archivo' order by nombre";
include("../paginator.inc.php");
}
?>

<table><!--tabla principal-->
<tr>
<td  style="border:0px #C0C0C0 solid;">
<div id="numeracion">
<?php echo"<p>".$_pagi_navegacion."</p>";?>
</div>
</td>
</tr>



<tr>
<td  width='100%'>

<table  width='100%' class= 'borde_tabla' cellpadding="0" cellspacing="0">
<tr>
<th colspan=4 >
<div id="cabecera_tabla" align='left'>
<?php echo "$compartirtexto15 ";?>
</div>
<?php
if($permiso=='1')
{
?>
<div id="cabecera_tabla" align='left'>
<?php echo "$compartirtexto22";?>
</div>
<?php
}
?>
</th>
</tr>

<tr>
<th width="400px" >
<div id="cabecera_tabla" align="left"><?php echo "<b>$compartirtexto33</b>";?></div>
</th>
<th width='1%';>
<div id="cabecera_tabla" align="center"><?php echo "<b>$compartirtexto12</b>";?></div>
</th>
<th width='1%';>
<div id="cabecera_tabla" align="center"><?php echo "<b>$compartirtexto19</b>";?></div>
</th>

<th >
<div id="cabecera_tabla" align="center">
<?php echo "<b>$boton_borrar</b>";?>
</div>
</th>
</tr>


<?php

while ($row4 = mysql_fetch_array($_pagi_result))
{
        $id_documentos=($row4 ["id_documentos"]);
        $numero_hijo	=($row4 ["numero_hijo"]);
        $nombre	=($row4 ["nombre"]);
        $fecha=($row4 ["fecha"]);
        $privada=($row4 ["privada"]);
        $tipo=($row4 ["tipo"]);
        $tipo_archivo=($row4 ["tipo_archivo"]);

        
        if($tipo=='carpeta')
        $imagen_cerrado=$ruta_absoluta.'/img_carpeta';
        else
        {
        include("tipo_icono.php");
        }

$busqueda3 = mysql_query("SELECT * FROM documentos_compartidos where COD_CENTRO='$upload_centro' and numero_padre='$numero_hijo'");
$total_count =mysql_num_rows($busqueda3);
?>

<tr>
<td >
<div id="enlaces">
<a href='<?php echo "$ruta_absoluta/modificar_documento_form/$id_documentos";?>' > <font color="<?php echo "$color_enlace_antes";?>" onmouseover="javascript:this.style.color='<?php echo "$color_enlace_despues";?>';this.style.textDecoration = 'none';" onmouseout="javascript:this.style.color='<?php echo "$color_enlace_antes";?>';this.style.textDecoration = 'none';">
<img  src="<?php echo "$imagen_cerrado";?>" style="opacity:1;filter:alpha(opacity=100);margin-right:3px;border:0px #000000 solid;" onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity=60" onmouseout="this.style.opacity=100;this.filters.alpha.opacity=100" width="16" >
<?php echo "$nombre";?>
</font>
</a>
</div>
</td>
<td width='1%'; >
<div id="titulo_6" align="center"><?php echo "$privada";?></div>
</td>



<td width='1%';>
<div id="titulo_6" align="center">
<a href="<?php echo "$ruta_absoluta/mover_doc_compar/$id_documentos&0";?>" >
<img  src="<?php echo "$ruta_absoluta";?>/img_mover" style="opacity:1;filter:alpha(opacity=100);margin:5px;border:0px #000000 solid;" onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity=60" onmouseout="this.style.opacity=100;this.filters.alpha.opacity=100" width="30" >
 </a>
</div>
</td>


<td width='1%'; >
<?php
if($total_count==0)
{
?>
<div id="titulo_6" align="center">
<a href="<?php echo "$ruta_absoluta/borrar_doc_compar/$id_documentos";?>" onclick="return confirmar('<?php echo "$compartirtexto16: ";?>\r <?php echo "$nombre";?>')">
<img  src="<?php echo "$ruta_absoluta";?>/img_borrar" style="opacity:1;filter:alpha(opacity=100);margin:3px;border:0px #000000 solid;" onmouseover="this.style.opacity=0.4;this.filters.alpha.opacity=40" onmouseout="this.style.opacity=100;this.filters.alpha.opacity=100" width="30" >
 </a>
</div>
<?php
}
?>
</td>
</tr>









<?php
}
desconectar();
?>

</table>
</td>
</tr>
</table>


<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>
<div id="campo_input" align="justify"></div>





</div>
</div>








<?php include ("../pie_pagina.php");?>




