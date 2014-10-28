<?php
include("base.php");
?>

<script>
function envia_castellano(){
var a="castellano";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}
function envia_valenciano(){
var a="valenciano";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}
</script>


<div id="container">
<section>
<div id='tabla_centrar' align='center'>
<table height='500px' width="90%" BORDER=0 CELLSPACING=0 CELLPADDING=0>
<tr>
<td valign='top' align='center'>

<div id="formulario" style="width:300px;">
<form name="Form1" method="post" action="eleccion_idioma_sesion.php"  id="Form1">

<div id='titulo_1' style="width:300px;" align='center'>
<?php echo "$inicio_titulo";?>
</div>


<div id='titulo_2' style="width:300px;" align='center'>
<?php echo "$inicio_idioma";?>
</div>


<div id='separador'></div>


<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" style="position:relative;left:10px;top:0px;width:108px;font-family:Arial;font-size:11px;z-index:0" name="nombre_boton" tabindex=2 value="">

<table width="300px" BORDER=0 CELLSPACING=0 CELLPADDING=0>
<tr>
<td align='center'>
<input name="boton" type="image" onclick="envia_castellano()" id="Button1" src="images/cas.jpg"  value="c" style="width:45px;height:28px;border:1px solid blue;">
</td>
<td align='center'>
<input name="boton" type="image" onclick="envia_valenciano()" id="Button2" src="images/val.jpg"  value="v" style="width:45px;height:28px;border:1px solid blue;">
</td>
</tr>
</table>
</form>
</div>

</td>
</tr>
</table>

</div>


<?php include ("pie_pagina.php");?>
</section>
</BODY>
</HTML>
