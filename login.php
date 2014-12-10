<?php
session_start();
include ("base.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>

<script>
function valida_codigo(){
  if (document.Form1.nick.value.length==0){
       alert('<?php echo "$login_falta_usuario"; ?>')
       document.Form1.nick.focus()
       return 0;
       }
      if (document.Form1.pass.value.length==0){
       alert('<?php echo "$login_falta_contra"; ?>')
       document.Form1.pass.focus()
       return 0;
       }


       document.Form1.submit();
 }
 
 
 
function submitenter(myfield,e)
{
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
else return true;

if (keycode == 13)
   {
   	   if (document.Form1.cod.value.length==0){
       alert('<?php echo "$login_falta_codigo"; ?>')
       document.Form1.cod.focus()
       return false;
       }
  if (document.Form1.nick.value.length==0){
       alert('<?php echo "$login_falta_usuario"; ?>')
       document.Form1.nick.focus()
       return false;
       }
      if (document.Form1.pass.value.length==0){
       alert('<?php echo "$login_falta_contra"; ?>')
       document.Form1.pass.focus()
       return false;
       }
   myfield.form.submit();
   return false;
   }
else{
	   return true;
     }
}

 </script>



<div id="container">

<section>
			<div id='tabla_centrar' align='center'>
			<table height='500px' width="90%" BORDER=0 CELLSPACING=0 CELLPADDING=0>
			<tr>
			<td valign='top' align='center'>
			
			<!--TITULO-->
			<div id='titulo_1' align='center'>
			<?php echo "$login_titulo";?>
			</div>
			
			<div id="formulario" style="width:300px;">
			<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/comprobar_usuario" id="Form1" >
			
			<div id='titulo_1' align='center'><?php echo "$version_docges";?></div>
			
			<table  BORDER=0 CELLSPACING=0 CELLPADDING=0>
			
			<tr>
			<td align='left' valign='middle'>
			<!--CURSO ACADEMICO-->
			<div id='titulo_3' align='right'><b><?php echo "$idi_curso_academico";?></b></div>
			</td>
			<td align='left' valign='middle'>
			<div id='titulo_3' align='left'>
			<input type="text" maxlength="4"  readonly="readonly" style="background-color:<?php echo "$color_campo_no_editable";?>;width:40px;" name="curso_academico" value="<?php echo "$any_academico";?>" />
			</div>
			</td>
			</tr>
			
			
			<tr>
			<td align='left' valign='middle'>
			<!--COD CENTRO-->
			<div id='titulo_3' align='right'><b><?php echo "$idi_codigo";?></b></div>
			</td>
			<td align='left' valign='middle'>
			<div id='titulo_3' align='left'><input type="text" readonly="readonly" maxlength="20"   style="background-color:<?php echo "$color_campo_no_editable";?>;width:100px;" name="cod" value='<?php echo "$codigo_centro_inicial";?>' /></div>
			</td>
			</tr>
			
			
			<tr>
			<td align='left' valign='middle'>
			<!--USUARIO-->
			<div id='titulo_3' align='right'><b><?php echo "$idi_usuario";?></b></div>
			</td>
			<td align='left' valign='middle'>
			<div id='titulo_3' align='left'><input type="text" autofocus onKeyPress="return submitenter(this,event)" autocomplete="off" maxlength="20"  style="width:130px;" name="nick"  value="" /></div>
			</td>
			</tr>
			
			<tr>
			<td align='left' valign='middle'>
			<!--CONTRASENYA-->
			<div id='titulo_3' align='right'><b><?php echo "$idi_contrasenya";?></b></div>
			</td>
			<td align='left' valign='middle'>
			<div id='titulo_3' align='left'><input type="password" onKeyPress="return submitenter(this,event)"  maxlength="50" id="Editbox2"  style="width:130px;" name="pass" value=''/></div>
			</td>
			</tr>
			
			<tr>
			<td colspan='2' align='left' valign='middle'>
			<div id='titulo_3' align='right'>
			<input type="button" onclick="valida_codigo()" value="<?php echo "$login_boton_entrar";?>" >
			</div>
			</td>
			</tr>
			</table>
			
			<div id='titulo_4' align='center'><b><?php echo "$idi_resolucion";?></b></div>
			  
			<div id='titulo_4' align='center'><b><?php echo "$idi_licencia";?> </b></div>
			
			
			
			</form>
			</div>
			
			
			<table  BORDER=0 CELLSPACING=0 CELLPADDING=0>
			<tr>
			<td>
			
			<div id="enlaces" align='center'>
			<!--
			<a href='<?php echo "$ruta_absoluta";?>/generar_contrasenya.php' >
			<?php echo "<b>$cambio_contratexto2</b>";?>
			</a>
			&nbsp;|&nbsp;
			-->
			<a href='<?php echo "$ruta_absoluta";?>/camb_contra' >
			<?php echo "<b>$cambio_contratexto1</b>";?>
			</a>
			</div>
			</td>
			</tr>
			</table>
			
			</td>
			</tr>
			
			
			
			
			</table>
			
			</div>

</section>
<?php include ("pie_pagina.php");?>

</div>

</BODY>
</HTML>
