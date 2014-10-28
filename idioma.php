<?php
$idioma=$_SESSION["idioma"];
if($idioma=="cas")
include("idiomas/cas.php");
if($idioma=="val")
include("idiomas/val.php");
?>
