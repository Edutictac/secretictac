<?php
if ($permiso=='ADMINISTRADOR' or $permiso=='DIRECCION')
{
?>
<!-- ESTA CONDICIONAL ES PARA QUITARLA SI SE QUIERE HACERLO EXTENSIVO A TODOS LOS USUARIOS-->

<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="i6meirjzm8ytiru"></script>

<?php

?>
<!--DOCUMENTO-->
<div id="campo_input" align="left">
<?php echo "<b>$compartirtexto24</b>";?>
</DIV>

<input type="dropbox-chooser" name="selected-file" id="db-chooser"/>

<!--QUITAR LAS SIGUIENTE LLAVE SI SE HA QUITADO LO DEL INICIO-->
<?php
}
?>
