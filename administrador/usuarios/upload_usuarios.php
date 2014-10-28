<?php
session_start();
$upload_centro=$_SESSION['cod_centro'];
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");
conectar();



$boton = $_REQUEST["nombre_boton"];

switch ($boton) {
  case 'CERRAR':

header("Location: $ruta_absoluta/crear_usuario");
exit();
break;

case 'GUARDAR':
$comprobar_usuario= $_REQUEST['comprobar_usuario'];

$usuario= $_REQUEST['usuario'];
$usuario=str_replace($search,$replace,$usuario);
$usuario=limpiar_tags($usuario);


$nombre_usuario=$_POST['nombre_usuario'];
$nombre_usuario=str_replace($search,$replace,$nombre_usuario);
$nombre_usuario=limpiar_tags($nombre_usuario);

$contrasenya=$_POST['contrasenya'];
$contrasenya=str_replace($search,$replace,$contrasenya);
$contrasenya=limpiar_tags($contrasenya);

$tipo_usuario=$_POST['tipo_usuario'];
$tipo_usuario=str_replace($search,$replace,$tipo_usuario);
$tipo_usuario=limpiar_tags($tipo_usuario);

if ($comprobar_usuario==1)
{
$sql1 = "SELECT usuario FROM usuarios where usuario='$usuario' and COD_CENTRO='$upload_centro'";
$result1 = mysql_query($sql1);
$numero1 = mysql_num_rows($result1);

	if ($numero1!=0)
	{
		echo "<script>alert('El usuario ya existe, escoger otro nombre de usuario');</script>" ;
   echo "<script>location.href='$ruta_absoluta/crear_usuario';</script>";
   exit();
		}
		
		else 
			{$qry="insert into usuarios (usuario,contra,nombre_usuario,COD_CENTRO,PERMISO) values ('$usuario',md5('$contrasenya'),'$nombre_usuario','$upload_centro','$tipo_usuario')";
			mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
}

else {

mysql_query("update usuarios SET nombre_usuario='$nombre_usuario', PERMISO='$tipo_usuario' where usuario='$usuario' and COD_CENTRO='$upload_centro' ");

}
mysql_close();
//CERRAMOS LA CONEXION
header("Location: $ruta_absoluta/crear_usuario");
exit();
break;


}

?>

