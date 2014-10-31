<?php
function conectar()
{
	mysql_connect("localhost","root", "");
	mysql_select_db("secretictac");
}

function desconectar()
{
	mysql_close();
}
?>
