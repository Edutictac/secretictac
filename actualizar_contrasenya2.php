<?php
include("seguridad.php");
include ("idioma.php");?>
<?php
$upload_centro=$_SESSION['cod_centro'];
include ("conexion.php");
conectar();
include ("funciones.php");


$usuario=$_POST['nick'];
$usuario=str_replace($search,$replace,$usuario);
$usuario=limpiar_tags($usuario);

$contras=$_POST['pass'];
$contras=str_replace($search,$replace,$contras);
$contras=limpiar_tags($contras);

$contra1=$_POST['contra1'];
$contra1=str_replace($search,$replace,$contra1);
$contra1=limpiar_tags($contra1);

$contra2=$_POST['contra2'];
$contra2=str_replace($search,$replace,$contra2);
$contra2=limpiar_tags($contra2);

$validacion=0;
$resp = mysql_query("select * from usuarios where usuario='$usuario' and COD_CENTRO='$upload_centro' ");
$sql = mysql_fetch_array($resp);
if(md5($contras) != $sql['contra'] or $contras=="" or $usuario=="" or $contra1=="" or $contra2=="" or $contra1!=$contra2 or $contra1==$contras ) {
echo "<script>alert('$idi_contrasenya_cambio_erronea');</script>";

}
else {

$validacion=1;
}

if($validacion==0){

 echo "<script>location.href='$ruta_absoluta/cambiar_contrasenya';</script>";
 }
 else{
   $contra=md5($contra1);
   mysql_query("update usuarios set contra='$contra',primera_vez='no' where usuario='$usuario' and COD_CENTRO='$upload_centro'");
   echo "<script>alert('$contrasenya_actualizada');</script>";

   echo '<script>location.href="inicio.php";</script>';


   //header ("Location: PORTADA.php");
   }
mysql_free_result($resp);
desconectar();
?>

