<?php
include ("../../ruta_absoluta.php");
$id_tipo=($_GET["id_tipo"]);

include ("../../conexion.php");
conectar();


mysql_query("DELETE FROM 1_tipos_permisos WHERE id_tipo ='$id_tipo'");

desconectar();
header("Location: $ruta_absoluta/tipo_permisos");
?>

