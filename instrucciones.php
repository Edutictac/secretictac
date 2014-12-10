<?php
include ("permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}

?>

<div id="container">

<div id="tabla_centrar2" align="left">

<?php
$activo='inicio';
$activado_instrucciones='activado';
include ("menu.php");
conectar();
?>


<div id="titulo_1" align="justify">
<?php echo "$inicio_instrucciones";?>
</div>


<div id="campo_input"   style="float:left;padding-top:10px;width:700px;" align="justify">
<?php echo "$iniciotexto1";?>
</div>


<?php
desconectar();
?>
</div>









<?php include ("pie_pagina.php");?>



