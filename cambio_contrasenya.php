<?php
include ("seguridad.php");
include ("base.php");
include ("conexion.php");
conectar();

$id=$_SESSION['usuario_secretictac'];

$busqueda = mysql_query("SELECT * FROM usuarios WHERE usuario='$id' ");
while ($row = mysql_fetch_array($busqueda))
{
$usuario= ($row ["usuario"]);
$nombre_usuario= ($row ["nombre_usuario"]);
$permiso= ($row ["PERMISO"]);
}

?>

<div id="container">
<section>
<div id='tabla_centrar' align='center'>
<table height='500px' width="90%" BORDER=0 CELLSPACING=0 CELLPADDING=0>
<tr>
<td valign='top' align='center'>
<div id="formulario" style="width:470px;">
<form name="loginform" method="post" action='<?php echo "$ruta_absoluta";?>/actualizar_contrasenya_inicial' id="loginform">
<table cellspacing="0" cellpadding="2">
<tr>
<td colspan=2 >
<div id="titulo_3" align="justify">
<?php echo "$nombre_usuario $mensaje_bienvenida";
?>
</div>

<div id="separador"></div>
</td></tr>
<tr>
   <td align="right" ><div id=titulo_3><?php echo "<b>$idi_usuario_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="nick" type="text" readonly id="username" value="<?php echo "$usuario";?>" style="width:200px;background-color:#D6D6D6;" /></div></td>
</tr>
<tr>
   <td align="right" ><div id=titulo_3><?php echo "<b>$idi_antigua_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="pass" type="password" id="password" value="" maxlength="20" style="width:200px;" /></div></td>
</tr>
<tr>
   <td align="right" ><div id=titulo_3><?php echo "<b>$idi_nueva_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="contra1" type="password" id="password" value="" maxlength="20" style="width:200px;" /></div></td>
</tr>
<tr>
<td align="right" ><div id=titulo_3><?php echo "<b>$idi_confirmar_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="contra2" type="password" id="password" value="" maxlength="20" style="width:200px;" /></div></td>
</tr>
</tr>
<tr>

<td align="right" valign="bottom" colspan="2">
<div id=titulo_3>
<input type="submit" name="login" value="OK" id="login" />
</div>
</td>
</tr>
</table>
</form>
</div>
</table>
</div>

</section>

<?php include ("pie_pagina.php");?>

</div>
</BODY>
</HTML>
