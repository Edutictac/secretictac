<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");
conectar();


$secretari=str_replace($search,$replace,$_REQUEST['secretari']);
$secretari=limpiar_tags($secretari);

$contar=str_replace($search,$replace,$_REQUEST['contar']);
$contar=limpiar_tags($contar);

$inicio_entradas=str_replace($search,$replace,$_REQUEST['inicio_entradas']);
$inicio_entradas=limpiar_tags($inicio_entradas);

$inicio_salidas=str_replace($search,$replace,$_REQUEST['inicio_salidas']);
$inicio_salidas=limpiar_tags($inicio_salidas);



$cmlogo=str_replace($search,$replace,$_REQUEST['cmlogo']);
$cmlogo=limpiar_tags($cmlogo);

$n_centro=str_replace($search,$replace,$_REQUEST['n_centro']);
$n_centro=limpiar_tags($n_centro);

$direccion=str_replace($search,$replace,$_REQUEST['direccion']);
$direccion=limpiar_tags($direccion);

$poblacion=str_replace($search,$replace,$_REQUEST['poblacion']);
$poblacion=limpiar_tags($poblacion);

$provincia=str_replace($search,$replace,$_REQUEST['provincia']);
$provincia=limpiar_tags($provincia);

$cp=str_replace($search,$replace,$_REQUEST['cp']);
$cp=limpiar_tags($cp);

$telefono=str_replace($search,$replace,$_REQUEST['telefono']);
$telefono=limpiar_tags($telefono);

$fax=str_replace($search,$replace,$_REQUEST['fax']);
$fax=limpiar_tags($fax);

$email=str_replace($search,$replace,$_REQUEST['email']);
$email=limpiar_tags($email);

$web=str_replace($search,$replace,$_REQUEST['web']);
$web=limpiar_tags($web);




$cmlogo_conse=str_replace($search,$replace,$_REQUEST['cmlogo_conse']);
$cmlogo_conse=limpiar_tags($cmlogo_conse);

$frase1=str_replace($search,$replace,$_REQUEST['frase1']);
$frase1=limpiar_tags($frase1);

$frase2=str_replace($search,$replace,$_REQUEST['frase2']);
$frase2=limpiar_tags($frase2);

$frase3=str_replace($search,$replace,$_REQUEST['frase3']);
$frase3=limpiar_tags($frase3);


//GUARDAMOS PRIMERO LOS DATOS DE TEXTO
	mysql_query("update 1_centro SET secretari='$secretari',CMLOGO='$cmlogo',NOMBRE_CENTRO='$n_centro',DIRECCION='$direccion',POBLACION='$poblacion',PROVINCIA='$provincia',cp='$cp',TELEFONO='$telefono',FAX='$fax',EMAIL='$email',WEB='$web',
				 CMLOGO_CONSE='$cmlogo_conse',FRASE1='$frase1',FRASE2='$frase2',FRASE3='$frase3',tipo_registro='$contar',inicio_entradas='$inicio_entradas',inicio_salidas='$inicio_salidas' WHERE COD_CENTRO='$upload_centro'");
 





    if ($nombre_archivo!= '') {
    	$tempFile = $_FILES["archivo"]["tmp_name"];
$nombre_archivo = $_FILES["archivo"]["name"];
 // comprobar extension con php
$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
$tipo_archivo=finfo_file($finfo, $tempFile);
finfo_close($finfo);
      if (!in_array($tipo_archivo,$archivos_permitidas_php_imagen)) 
      {    	
       die('<b>'.$_FILES["archivo"]["name"].'</b> no es archivo v&aacute;lido!<br/>'.$_FILES["archivo"]["name"].' es un archivo <b>'.$tipo_archivo.'</b><br>'.
        '<a href="javascript:history.go(-1);">'.
        '&lt;&lt VOLVER</a>');
        exit();
      }
    }




    if ($nombre_archivo_conse!= '') {
    	$tempFile_conse = $_FILES["archivo_logo_derecho"]["tmp_name"];
$nombre_archivo_conse = $_FILES["archivo_logo_derecho"]["name"];
 // comprobar extension con php
$finfo_conse = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
$tipo_archivo_conse=finfo_file($finfo_conse, $tempFile_conse);
finfo_close($finfo_conse);
      if (!in_array($tipo_archivo_conse,$archivos_permitidas_php_imagen)) 
      {    	
       die('<b>'.$_FILES["archivo_logo_derecho"]["name"].'</b> no es archivo v&aacute;lido!<br/>'.$_FILES["archivo_logo_derecho"]["name"].' es un archivo <b>'.$tipo_archivo_conse.'</b><br>'.
        '<a href="javascript:history.go(-1);">'.
        '&lt;&lt VOLVER</a>');
        exit();
      }
    }


$boton = $_REQUEST["nombre_boton"];
switch ($boton) {
  case 'PREVIA':
  $NOMBRE_LOGO=($_REQUEST["NOMBRE_LOGO"]);
$NOMBRE_LOGO_CONSELLERIA=($_REQUEST["NOMBRE_LOGO_CONSELLERIA"]);


$tempFile = $_FILES["archivo"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"];
$tipo = $_FILES["archivo"]["type"];
$nombre_archivo = $_FILES["archivo"]["name"];
$nombre_archivo=sanear_string($nombre_archivo);


$tempFile_conse = $_FILES["archivo_logo_derecho"]["tmp_name"];
$tamanio_conse=array();
$tamanio_conse = $_FILES["archivo_logo_derecho"]["size"];
$tipo_conse = $_FILES["archivo_logo_derecho"]["type"];
$nombre_archivo_conse = $_FILES["archivo_logo_derecho"]["name"];
$nombre_archivo_conse=sanear_string($nombre_archivo_conse);



$targetPath='../../archivos/datos_centro/'.$upload_centro.'/';
$codigo_fecha = date("dmyHis");//paralinkmensaje

  if (!file_exists($targetPath))
    {
    mkdir(str_replace('//','/',$targetPath), 0777, true);
    }
    
    
if($_FILES['archivo']['size']!=0){
//borro primero el que habia antes
$logo_centro_borrar=$targetPath .'/'.$NOMBRE_LOGO;

                                 if (file_exists($logo_centro_borrar))
                                  {
                                    unlink($logo_centro_borrar) ;

                                     }

$targetFile =  $targetPath . $codigo_fecha.$nombre_archivo;
$link_documento=$codigo_fecha.$nombre_archivo;
move_uploaded_file($tempFile,$targetFile);
mysql_query("update 1_centro SET NOMBRE_LOGO='$link_documento' WHERE COD_CENTRO='$upload_centro'");
}


if($_FILES['archivo_logo_derecho']['size']!=0){
	//borro primero el que habia antes
$logo_conse_borrar=$targetPath .'/'.$NOMBRE_LOGO_CONSELLERIA;

                                 if (file_exists($logo_conse_borrar))
                                  {
                                    unlink($logo_conse_borrar) ;

                                     }
                                     
$targetFile_conse =  $targetPath . $codigo_fecha.$nombre_archivo_conse;
$link_documento_conse=$codigo_fecha.$nombre_archivo_conse;
move_uploaded_file($tempFile_conse,$targetFile_conse);
mysql_query("update 1_centro SET NOMBRE_LOGO_CONSELLERIA='$link_documento_conse' WHERE COD_CENTRO='$upload_centro'");
}
?>
<script type="text/javascript"> window.open('','_blank').location.href='<?php echo " $ruta_absoluta/vista_previa";?>';</script>
<script>location.href='<?php echo "$ruta_absoluta/definir_centro";?>';</script>
<?php
exit();
break;

case 'GUARDAR':
$NOMBRE_LOGO=($_REQUEST["NOMBRE_LOGO"]);
$NOMBRE_LOGO_CONSELLERIA=($_REQUEST["NOMBRE_LOGO_CONSELLERIA"]);


$tempFile = $_FILES["archivo"]["tmp_name"];
$tamanio=array();
$tamanio = $_FILES["archivo"]["size"];
$tipo = $_FILES["archivo"]["type"];
$nombre_archivo = $_FILES["archivo"]["name"];
$nombre_archivo=sanear_string($nombre_archivo);


$tempFile_conse = $_FILES["archivo_logo_derecho"]["tmp_name"];
$tamanio_conse=array();
$tamanio_conse = $_FILES["archivo_logo_derecho"]["size"];
$tipo_conse = $_FILES["archivo_logo_derecho"]["type"];
$nombre_archivo_conse = $_FILES["archivo_logo_derecho"]["name"];
$nombre_archivo_conse=sanear_string($nombre_archivo_conse);



$targetPath='../../archivos/datos_centro/'.$upload_centro.'/';
$codigo_fecha = date("dmyHis");//paralinkmensaje

  if (!file_exists($targetPath))
    {
    mkdir(str_replace('//','/',$targetPath), 0777, true);
    }
    
    
if($_FILES['archivo']['size']!=0){
//borro primero el que habia antes
$logo_centro_borrar=$targetPath .'/'.$NOMBRE_LOGO;

                                 if (file_exists($logo_centro_borrar))
                                  {
                                    unlink($logo_centro_borrar) ;

                                     }

$targetFile =  $targetPath . $codigo_fecha.$nombre_archivo;
$link_documento=$codigo_fecha.$nombre_archivo;
move_uploaded_file($tempFile,$targetFile);
mysql_query("update 1_centro SET NOMBRE_LOGO='$link_documento' WHERE COD_CENTRO='$upload_centro'");
}


if($_FILES['archivo_logo_derecho']['size']!=0){
	//borro primero el que habia antes
$logo_conse_borrar=$targetPath .'/'.$NOMBRE_LOGO_CONSELLERIA;

                                 if (file_exists($logo_conse_borrar))
                                  {
                                    unlink($logo_conse_borrar) ;

                                     }
                                     
$targetFile_conse =  $targetPath . $codigo_fecha.$nombre_archivo_conse;
$link_documento_conse=$codigo_fecha.$nombre_archivo_conse;
move_uploaded_file($tempFile_conse,$targetFile_conse);
mysql_query("update 1_centro SET NOMBRE_LOGO_CONSELLERIA='$link_documento_conse' WHERE COD_CENTRO='$upload_centro'");
}

 
header("Location: $ruta_absoluta/definir_centro");
exit();
break;



}

?>
