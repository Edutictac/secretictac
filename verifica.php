<?php
session_start();
include("idioma.php");
include("ruta_absoluta.php");
include ("funciones.php");



$_SESSION["curso_academico_sesion_secretictac"]= $_POST['curso_academico'];


$usuario=$_POST['nick'];
$usuario=str_replace($search,$replace,$usuario);
$usuario=limpiar_tags($usuario);

$contras=$_POST['pass'];
$contras=str_replace($search,$replace,$contras);
$contras=limpiar_tags($contras);


$cod_centro=$_POST['cod'];
$cod_centro=str_replace($search,$replace,$cod_centro);
$cod_centro=limpiar_tags($cod_centro);
$_SESSION["COD_CENTRO"]=$cod_centro;


include ("conexion.php");
conectar();


 
$resp = mysql_query("select * from usuarios where usuario='$usuario' and COD_CENTRO='$cod_centro'");
$sql = mysql_fetch_array($resp);


                  if(md5($contras) != $sql['contra'] or $contras=="" or $usuario=="" ) {
                  echo("<script>alert('$no_contrasenya');</script>");
                  echo '<script>location.href="login.php";</script>';
                  }
                  else {
                  $_SESSION["autentificado_secretictac"]= "secretictac_acceso";
                  $_SESSION['usuario_secretictac']=$usuario;
                  $_SESSION['clave_secretictac']=$contras;
                  $_SESSION['acceso_secretictac']=$sql['PERMISO'];
                  $_SESSION['cod_centro_secretictac']=$cod_centro;
                  $_SESSION['anyo_academico_secretictac']=$_REQUEST['curso_academico'];
                  $_SESSION["nombre_usuario_secretictac"]=$sql['nombre_usuario'];
                  if ($sql['primera_vez']=='si')
                  echo "<script>location.href='$ruta_absoluta/cambiar_contrasenya';</script>";
                  else
                        echo '<script>location.href="inicio.php";</script>';

                  }

desconectar();
?>



