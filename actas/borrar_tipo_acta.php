<?php
include ("../ruta_absoluta.php");
$id_tipo=($_GET["id_tipo"]);

include ("../conexion.php");
conectar();


mysql_query("DELETE FROM actas_tipo_acta WHERE id_tipo ='$id_tipo'");

desconectar();
header("Location: $ruta_absoluta/tipo_actas");
?>

