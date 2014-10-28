<?php
session_start();
$boton = $_REQUEST["nombre_boton"];
switch ($boton) {
  case castellano:
     $_SESSION["idioma"]= "cas";
     header("Location: login.php");
     exit();
     break;
  case valenciano:
     $_SESSION["idioma"]= "val";
    header("Location: login.php");
    exit();
    break;

  default:
}
?>

