<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
$usuario=$_SESSION['usuario_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();


$codigo_fecha = date("dmyHis");
$id_codigo=$upload_centro.md5($usuario).$codigo_fecha;
$id_registro= $_REQUEST["id_registro"];
$tipo= $_REQUEST["tipo"];
$entrada_salida= $_REQUEST["entrada_salida"];

$nombre_cas=$_POST['nombre_cas'];
$nombre_cas=str_replace($search,$replace,$nombre_cas);
$nombre_cas=limpiar_tags($nombre_cas);

$nombre_val=$_POST['nombre_val'];
$nombre_val=str_replace($search,$replace,$nombre_val);
$nombre_val=limpiar_tags($nombre_val);


switch ($tipo) {
case 'tipo_documento':
$qry="insert into registro_tipo_documento(id_tipo_documento,cod_centro,nombre_val,nombre_cas,entrada_salida) values ('$id_codigo','$upload_centro','$nombre_val','$nombre_cas','$entrada_salida')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
desconectar();
?>
<script language="javascript">
window.opener.document.location='<?php echo "$ruta_absoluta/registro_entrada_tipo/$id_registro/$id_codigo";?>';
window.close();
</script>
<?php
break;

case 'origen':
$qry="insert into registro_origen(id_origen,cod_centro,nombre_val,nombre_cas,entrada_salida) values ('$id_codigo','$upload_centro','$nombre_val','$nombre_cas','$entrada_salida')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
desconectar();
?>
<script language="javascript">
window.opener.document.location='<?php echo "$ruta_absoluta/registro_entrada_origen/$id_registro/$id_codigo";?>';
window.close();
</script>
<?php
break;

case 'organismo':
$qry="insert into registro_organismo(id_organismo,cod_centro,nombre_val,nombre_cas,entrada_salida) values ('$id_codigo','$upload_centro','$nombre_val','$nombre_cas','$entrada_salida')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
desconectar();
?>
<script language="javascript">
window.opener.document.location='<?php echo "$ruta_absoluta/registro_entrada_organismo/$id_registro/$id_codigo";?>';
window.close();
</script>
<?php
break;


case 'destino':
$qry="insert into registro_destino(id_destino,cod_centro,nombre_val,nombre_cas,entrada_salida) values ('$id_codigo','$upload_centro','$nombre_val','$nombre_cas','$entrada_salida')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
desconectar();
?>
<script language="javascript">
window.opener.document.location='<?php echo "$ruta_absoluta/registro_entrada_destino/$id_registro/$id_codigo";?>';
window.close();
</script>
<?php
break;
}


?>

<?php
exit();

?>

