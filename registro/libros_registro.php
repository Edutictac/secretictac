<?php
include ("../permisos.php");
?>

<script>
 function envia(){
       document.Form1.submit();
}
</script>

<?php
conectar();
?>

<div id="container">
<div id="tabla_centrar2" align='left'>

<?php
$activado_imprimir_libros="activado";
include ("../menu.php");
conectar();
?>


<?php

$acceso_permitido = mysql_query("SELECT imprimir_libros FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["imprimir_libros"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align='left'>
<b><?php echo "$imprimirtexto2";?></b>
</div>


<div id="titulo_2" align="left">
<?php echo "$imprimirtexto3";?>
</div>
<div id="campo_input" align="justify"></div>

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/impreso_registro" target="_blank"  id="Form1">
<div id="titulo_campo_texto">
<?php echo "<b>$registrotexto6</b>";?>
</div>
<div id="campo_input" style="float:left;vertical-align: middle;" align="justify">
<?php
$consulta=mysql_query("SELECT distinct anyo FROM registro where cod_centro='$upload_centro' order by anyo");
   	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='anyo' >";
	echo "<option value='0'>$registrotexto50</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";

?>
 &nbsp; &nbsp; &nbsp; &nbsp;
<input type="radio" id="RadioButton"  name="tipo_registro" value="e">
<?php echo "<b>$registrotexto5</b>"; ?>
 &nbsp; &nbsp; &nbsp; &nbsp;
<input type="radio" id="RadioButton"   name="tipo_registro" value="s">
<?php echo "<b>$registrotexto46</b>"; ?>
</div>

<button  style='float:left;padding: 0px;margin-left:20px;margin-bottom:0px;' name="boton" type="submit"  title="<?php echo $boton_imprimir;?>"/>
<img src="<?php echo "$ruta_absoluta/images/imprimir.png";?>" style='width:20px'>
</button>

</form>


<?php
desconectar();
?>



</div>
<?php include ("../pie_pagina.php");?>

</div>
</BODY>
</HTML>

