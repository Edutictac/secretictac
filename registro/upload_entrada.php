<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../ruta_absoluta.php");
include ("../conexion.php");
include ("../funciones.php");
conectar();


$id_registro=$_REQUEST['id_registro'];
$entrada_salida=$_REQUEST['ent_sal'];

$anyo=$_REQUEST['anyo'];
$anyo=str_replace($search,$replace,$anyo);
$anyo=limpiar_tags($anyo);


$codigo_registro=$_POST['codigo_registro'];
$codigo_registro=str_replace($search,$replace,$codigo_registro);
$codigo_registro=limpiar_tags($codigo_registro);

$fecha_adjunto=$_POST['fecha_registro'];
$fecha_adjunto=str_replace($search,$replace,$fecha_adjunto);
$fecha_adjunto=limpiar_tags($fecha_adjunto);
$fecha_adjunto=fecha1($fecha_adjunto);


$fecha_registro=$_POST['fecha_registro'];
$fecha_registro=str_replace($search,$replace,$fecha_registro);
$fecha_registro=limpiar_tags($fecha_registro);
$fecha_registro=f_datefI($fecha_registro);



$fecha_entrada_salida=$_POST['fecha_entrada_salida'];
$fecha_entrada_salida=str_replace($search,$replace,$fecha_entrada_salida);
$fecha_entrada_salida=limpiar_tags($fecha_entrada_salida);
$fecha_entrada_salida=f_datefI($fecha_entrada_salida);

$tipo_documento=$_POST['tipo_documento'];
$tipo_documento=str_replace($search,$replace,$tipo_documento);
$tipo_documento=limpiar_tags($tipo_documento);

$asunto=$_POST['asunto'];
$asunto=str_replace($search,$replace,$asunto);
$asunto=limpiar_tags($asunto);

$observaciones=$_POST['observaciones'];
$observaciones=str_replace($search,$replace,$observaciones);
$observaciones=limpiar_tags($observaciones);

$origen=$_POST['origen'];
$origen=str_replace($search,$replace,$origen);
$origen=limpiar_tags($origen);

$procedencia=$_POST['procedencia'];
$procedencia=str_replace($search,$replace,$procedencia);
$procedencia=limpiar_tags($procedencia);

$organismo=$_POST['organismo'];
$organismo=str_replace($search,$replace,$organismo);
$organismo=limpiar_tags($organismo);

$destino=$_POST['destino'];
$destino=str_replace($search,$replace,$destino);
$destino=limpiar_tags($destino);

$dirigido=$_POST['dirigido'];
$dirigido=str_replace($search,$replace,$dirigido);
$dirigido=limpiar_tags($dirigido);

$nombre_archivo_texto = $_FILES["archivo_registro"]["name"];



if (isset($_POST['atendido']))
$atendido="s";
else
$atendido="n";

$sql = "SELECT id_registro FROM registro where id_registro='$id_registro' and cod_centro='$upload_centro'";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);


if ($numero==0)
{
$qry="insert into registro(id_registro,cod_centro,codigo_registro,fecha_entrada_salida,fecha_registro,tipo_documento,anyo,asunto,observaciones,origen,procedencia,organismo,destino,dirigido,entrada_salida,atendido,nombre_archivo) 
values ('$id_registro','$upload_centro','$codigo_registro','$fecha_entrada_salida','$fecha_registro','$tipo_documento','$anyo','$asunto','$observaciones','$origen','$procedencia','$organismo','$destino','$dirigido','$entrada_salida','$atendido','$nombre_archivo_texto')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());
}
else 
{
mysql_query("update registro SET fecha_entrada_salida='$fecha_entrada_salida', fecha_registro='$fecha_registro',tipo_documento='$tipo_documento',asunto='$asunto',observaciones='$observaciones',origen='$origen',procedencia='$procedencia',organismo='$organismo',destino='$destino',dirigido='$dirigido',entrada_salida='$entrada_salida',atendido='$atendido' where id_registro='$id_registro' and cod_centro='$upload_centro' ");
}





    if ($nombre_archivo!= '') {
    	//comprobamos el archivo
$tempFile = $_FILES["archivo_registro"]["tmp_name"];
$nombre_archivo = $_FILES["archivo_registro"]["name"];
 // comprobar extension con php
$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
$tipo_archivo=finfo_file($finfo, $tempFile);
finfo_close($finfo);
      if (!in_array($tipo_archivo,$archivos_permitidas_php_pdf)) 
      {    	
       die('<b>'.$_FILES["archivo_registro"]["name"].'</b> no es archivo v&aacute;lido!<br/>'.$_FILES["archivo_registro"]["name"].' es un archivo <b>'.$tipo_archivo.'</b><br>'.
        '<a href="javascript:history.go(-1);">'.
        '&lt;&lt VOLVER</a>');
        exit();
      }
    }


$ruta_archivo=($_REQUEST["ruta_archivo"]);
$tempFile = $_FILES["archivo_registro"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo_registro"]["size"];
$tipo = $_FILES["archivo_registro"]["type"];
$nombre_archivo = $_FILES["archivo_registro"]["name"];
$nombre_archivo=sanear_string($nombre_archivo);

$targetPath='../archivos/registro/'.$upload_centro.'/';
$codigo_fecha = date("dmyHis");//paralinkmensaje

  if (!file_exists($targetPath))
    {
    mkdir(str_replace('//','/',$targetPath), 0777, true);
    }


if($_FILES['archivo_registro']['size']!=0){
//borro primero el que habia antes

if($ruta_archivo!=''){
$archivo_registro_borrar=$targetPath.$ruta_archivo;

                                 if (file_exists($archivo_registro_borrar))
                                  {
                                    unlink($archivo_registro_borrar) ;

                                     }
}

$targetFile =  $targetPath.$codigo_fecha.$nombre_archivo;
$link_documento=$codigo_fecha.$nombre_archivo;
move_uploaded_file($tempFile,$targetFile);
mysql_query("update registro SET ruta_archivo='$link_documento',nombre_archivo='$nombre_archivo_texto' WHERE id_registro='$id_registro' and cod_centro='$upload_centro'");
}


$boton = $_REQUEST["nombre_boton"];

switch ($boton) {
case 'tipo_doc':

header("Location: $ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida");
exit();
break;

case 'origen':
header("Location: $ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida");
exit();
break;

case 'organismo':
header("Location: $ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida");
exit();
break;


case 'destino':
header("Location: $ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida");
exit();
break;

case 'GUARDAR':
header("Location: $ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida");
exit();
break;


case 'ADJUNTO':
?>
<form  name="Form3"  method="post" action="<?php echo "$ruta_absoluta";?>/adjunto_remito" target="_blank">
<input type="text" name="fecha" value="<?php echo $fecha_adjunto;?>">
<input type="text" name="codigo" value="<?php echo $codigo_registro;?>">
<input type="text" name="organismo" value="<?php echo $organismo;?>">
<input type="text" name="destino" value="<?php echo $destino;?>">
<input type="text" name="dirigido" value="<?php echo $dirigido;?>">

<input type="text" name="procedencia" value="<?php echo $procedencia;?>">

<input type="text" name="origen" value="<?php echo $origen;?>">
<textarea  name="asunto" id="TextArea1" style="width:350px;height:80px;" rows="5"  cols="39"><?php echo "$asunto";?></textarea>
</form>

<script type="text/javascript" >
 document.Form3.submit();
</script>
<!--
<script type="text/javascript"> window.open('','_blank').location.href='<?php echo "$ruta_absoluta/adjunto_remito/$codigo_registro/$asunto/$fecha_adjunto";?>';</script>
-->
<?php
echo "<script>location.href='$ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida';</script>";
exit();
break;

}

?>

