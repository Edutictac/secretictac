<?php
include ("../../permisos.php");
$archivo="../../administrador/permisos/error_log";
if (file_exists($archivo))
{
unlink($archivo);
}
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
$activado_permisos="activado";
include ("../../menu.php");
conectar();
?>

<?php

$acceso_permitido = mysql_query("SELECT permisos FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["permisos"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<div id="titulo_1" align='left'>
<b><?php echo "$editar_permisos1";?></b>
</div>



<div id="titulo_2" align="left">
<?php echo "$editar_permisos2";?>
</div>

<div id="campo_input" align="justify"></div>

<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/modifi_permisos_usu"  id="Form1">
<div id="campo_input" align="justify">
<?php
$consulta=mysql_query("SELECT * FROM 1_tipos_permisos where cod_centro='$upload_centro' order by tipo");
   	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='tipo_usuario' id='eleccion_tipo' onchange='envia()'>";
	echo "<option value='0'>$editar_permisos3</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</form>





<?php
desconectar();
?>



</div>
<?php include ("../../pie_pagina.php");?>

</div>
</BODY>
</HTML>
