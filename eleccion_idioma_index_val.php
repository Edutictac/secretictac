<?php
session_start();
$_SESSION["idioma"]= "val";
//header("Location: menu.php");
echo '<script>location.href="javascript:history.go(-1)";</script>';

?>

