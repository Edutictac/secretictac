<?php
include ("../../ruta_absoluta.php");
$usuario=($_GET["usuario"]);

include ("../../conexion.php");
conectar();


mysql_query("DELETE FROM usuarios WHERE usuario ='$usuario'");

desconectar();
header("Location: $ruta_absoluta/crear_usuario");
?>

