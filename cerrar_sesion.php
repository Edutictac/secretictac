<?php
session_start();
if(isset($_SESSION['autentificado_secretictac']))
unset($_SESSION['autentificado_secretictac']);
//session_destroy();
header("Location:index.php");
?>
