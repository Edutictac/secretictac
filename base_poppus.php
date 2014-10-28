<?php
if(!isset ($_SESSION["idioma"]))
$_SESSION["idioma"]="cas";
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


<link rel="stylesheet" href="<?php echo "$ruta_absoluta";?>/css/div.css" type="text/css" media="screen" />

</HEAD>


<body style="background-color:#ffffff" >


