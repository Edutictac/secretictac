<?php
include ("seguridad.php");
include ("base.php");
$usuario=$_SESSION['nombre_usuario_secretictac'];
$nick_usuario=$_SESSION['usuario_secretictac'];
$permiso=$_SESSION['acceso_secretictac'];
$upload_centro=$_SESSION['cod_centro_secretictac'];
$upload_anyo_academico=$_SESSION['anyo_academico_secretictac'];
?>


<?php
include ("conexion.php");
conectar();

$nombre_permiso1 = mysql_query("SELECT tipo FROM 1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
$row12= mysql_fetch_array($nombre_permiso1);
$tipo_nombre1= ($row12 ["tipo"]);




$tipo_permiso = mysql_query("SELECT * FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($tipo_permiso))
{

$permitir_administrador=($row ["administrador"]);
$permitir_permisos=($row ["permisos"]);
$permitir_tipo_permisos=($row ["tipo_permisos"]);
$permitir_crear_usuarios=($row ["crear_usuarios"]);
$permitir_definir_centro=($row ["definir_centro"]);
$permitir_compartir_documentos=($row ["compartir_documentos"]);
$permitir_subir_documentos=($row ["subir_documentos"]);
$permitir_modificar_documentos=($row ["modificar_documentos"]);
$permitir_entradas=($row ["entradas"]);
$permitir_salidas=($row ["salidas"]);
$permitir_listados=($row ["listados"]);
$permitir_configuracion=($row ["configuracion"]);
$permitir_registro=($row ["registro"]);
$permitir_imprimir_libros=($row ["imprimir_libros"]);
$permitir_actas=($row ["actas"]);
$permitir_crear_actas=($row ["crear_actas"]);
$permitir_listado_actas=($row ["listado_actas"]);
$permitir_redactar_actas=($row ["redactar_actas"]);
$permitir_busqueda_actas=($row ["busqueda_actas"]);
$permitir_convocatorias_actas=($row ["convocatorias_actas"]);
$permitir_copies_seguretat=($row ["copies_seguretat"]);
}

?>
<div id="container" style="z-index:1">
<!-- eleccion de idiomas en la pagina de inicio-->
<div id="wb_Image1" style="position:absolute;left:900px;top:-20px;z-index:0" align="right">
<a href="<?php echo "$ruta_absoluta";?>/eleccion_idioma_index_cas.php"><img src="<?php echo "$ruta_absoluta";?>/images/cas.jpg" id="Image1" alt="" align="top" border="0" style="width:21px;"></a></div>
<div id="wb_Image1" style="overflow:hidden;position:absolute;left:940px;top:-20px;z-index:0" align="right">
<a href="<?php echo "$ruta_absoluta";?>/eleccion_idioma_index_val.php"><img src="<?php echo "$ruta_absoluta";?>/images/val.jpg" id="Image1" alt="" align="top" border="0" style="width:21px;"></a></div>

<!--datos usuario -->
<?php
desconectar();
?>

<div id="wb_Text1" style="position:absolute;left:50px;top:-15px;height:14px;z-index:12;" align="left">
<font style="font-size:11px" color=<?php echo "$color_etiquetas";?> face="arial"><?php echo "$usuario &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$crear_usuarios11: $tipo_nombre1 ";?></font></div>
</div>

