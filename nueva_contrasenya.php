<?php
include ("base.php");
include ("idioma.php");
?>

<div id="container">
<section>
<div id='tabla_centrar' align='center'>
<table height='500px' width="90%" BORDER=0 CELLSPACING=0 CELLPADDING=0>
<tr>
<td valign='top' align='center'>
<div id="formulario" style="width:400px;">
<form name="loginform" method="post" action='<?php echo "$ruta_absoluta";?>/guardar_nueva_contra' id="loginform">
<table cellspacing="0" cellpadding="2" >
<tr>
<td colspan=2 align="left">
<div id="titulo_3" align="justify">
<?php echo "$cambio_contratexto3";
?>
</div>
<div id="separador"></div>
</td></tr>

<tr>
   <td align="right"><div id=titulo_3><?php echo "<b>$idi_codigo</b>";?></div></td>
   <td><div id=titulo_3><input name="codigo" type="text" autocomplete="off" autofocus id="codi" value="" style="width:200px;background-color:#FFFFFF;" /></div></td>
</tr>

<tr>
   <td align="right" ><div id=titulo_3><?php echo "<b>$idi_usuario_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="nick" type="text" autocomplete="off" id="username" value="" style="width:200px;background-color:#FFFFFF;" /></div></td>
</tr>
<tr>
   <td align="right"><div id=titulo_3><?php echo "<b>$idi_antigua_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="pass" type="password" autocomplete="off" id="password" value="" maxlength="20" style="width:200px;background-color:#FFFFFF;" /></div></td>
</tr>
<tr>
   <td align="right"><div id=titulo_3><?php echo "<b>$idi_nueva_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="contra1" type="password" autocomplete="off" id="password" value="" maxlength="20" style="width:200px;background-color:#FFFFFF;"/></div></td>
</tr>
<tr>
<td align="right"><div id=titulo_3><?php echo "<b>$idi_confirmar_cambio</b>";?></div></td>
   <td><div id=titulo_3><input name="contra2" type="password" autocomplete="off" id="password" value="" maxlength="20" style="width:200px;px;background-color:#FFFFFF;" /></div></td>
</tr>
</tr>
<tr>

<td align="right" valign="bottom" colspan="2"><input type="submit" name="login" value="OK" id="login"  /></td>
</tr>
</table>
</form>
</div>
</td>
</tr>
</table>
</div>


</section>
<?php include ("pie_pagina.php");?>

</div>
</BODY>
</HTML>
