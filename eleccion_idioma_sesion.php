<?php
session_start();
$boton = $_REQUEST["nombre_boton"];
switch ($boton) {
  case castellano:
     $_SESSION["idioma_secretictac"]= "cas";
     header("Location: login.php");
     exit();
     break;
  case valenciano:
     $_SESSION["idioma_secretictac"]= "val";
    header("Location: login.php");
    exit();
    break;

  default:
}
?>

