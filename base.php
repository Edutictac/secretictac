<?php
if(!isset ($_SESSION["idioma_secretictac"]))
$_SESSION["idioma_secretictac"]="cas";
include("ruta_absoluta.php");
include("idioma.php");
include("colores.php");
include("funciones.php");
?>
<html lang="es">
<head>
    <meta charset="ISO-8859-1"/>
        <meta name="description" content="Registro de entrada-salida" />

<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
<meta http-equiv="Pragma" content="no-cache" />
<LINK REL="Shortcut Icon" HREF="<?php echo "$ruta_absoluta";?>/images/secretictac.ico">
<TITLE>SECRETICTAC</TITLE>

<link rel="stylesheet" href="<?php echo "$ruta_absoluta";?>/css/estilo_botones.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo "$ruta_absoluta";?>/css/div.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo "$ruta_absoluta";?>/sombra.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo "$ruta_absoluta";?>/css/styles.css">

</HEAD>


<body >
<header>
<div id="wb_Image1" >
<img src="<?php echo "$ruta_absoluta/";?>images/baner.png" id="Image1" alt="" align="top" border="0" style="width:<?php echo "$tamanyo_pagina";?>px;">
</div>

</header>


