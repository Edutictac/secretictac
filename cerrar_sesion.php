<?php
session_start();
if(isset($_SESSION['nombre_usuario']))
unset($_SESSION['nombre_usuario']);
session_destroy();
header("Location:index.php");
?>
