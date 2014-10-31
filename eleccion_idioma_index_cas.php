<?php
session_start();
$_SESSION["idioma_secretictac"]= "cas";
//header("Location: menu.php");
echo '<script>location.href="javascript:history.go(-1)";</script>';
?>

