<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
include ("../../idioma.php");
include ("../../ruta_absoluta.php");
include ("../../conexion.php");
include ("../../funciones.php");

conectar();
$fecha_guardado=date("Y-m-d H-i-s");
$id_arxiu=$upload_centro.md5($usuario).$fecha_guardado;



$id_ruta =mysql_query("SELECT * FROM copies_carpeta where cod_centro='$upload_centro'");
$row = mysql_fetch_array($id_ruta);
$id_carpeta=($row ["id_carpeta"]);
$nombre_carpeta=($row ["ruta"]);
$numero_copies=($row ["numero_copies"]);

if ($numero_copies!='')
$numero_copies=$numero_copies-1;

$nombre_base= $dbname . date("Y-m-d-H-i-s");
$nombre_archivo =$nombre_base. '.sql';
$nombre_sql_zip=$nombre_base. '.zip';
$backup_file = $nombre_carpeta.'/'.$nombre_archivo;



      function agregar_zip($dir, $zip){ 
        if (is_dir($dir)) { 
          if ($da = opendir($dir)) {          
            while (($archivo = readdir($da))!== false) {   
              if (is_dir($dir . $archivo) && $archivo!="." && $archivo!=".."){
                echo "<strong>Creando directorio: $dir$archivo</strong><br/>";                 
                agregar_zip($dir.$archivo . "/", $zip);  
              }elseif(is_file($dir.$archivo) && $archivo!="." && $archivo!=".."){
                echo "Agregando archivo: $dir$archivo <br/>";                                    
                $zip->addFile($dir.$archivo, $dir.$archivo);                     
              }             
            }
            closedir($da); 
          }
        }       
      }         

     
      $zip = new ZipArchive();
      $dir = '../../archivos/';
      $rutaFinal=$nombre_carpeta.'/';

      $archivoZip = $rutaFinal.'arxius_'.$dbname . date("Y-m-d-H-i-s") . '.zip';
      $archivo_zip_nombre='arxius_'.$dbname . date("Y-m-d-H-i-s") . '.zip';
      if($zip->open($archivoZip,ZIPARCHIVE::CREATE)===true) {  
        agregar_zip($dir, $zip);
        $zip->close();

                 
      }
  


//copia de los datos
$command = "mysqldump --opt --databases -h $dbhost -u $dbuser -p$dbpass  --routines --triggers $dbname  > $backup_file";

// ejecución y salida de éxito o errores
system($command,$output);

//comprimo el archivo sql creado
$zip = new ZipArchive();

$filename = $nombre_carpeta.'/'.$nombre_base.'.zip';
if($zip->open($filename,ZIPARCHIVE::CREATE)===true) {
        $zip->addFile($nombre_carpeta.'/'.$nombre_archivo,$nombre_archivo);
        $zip->close();
        echo 'Creado '.$filename;
}
else {
        echo 'Error creando '.$filename;
}

//borro el archivo sql creado ahora que esta comprimido
unlink($backup_file);


if ($output!='0')
{
echo "<script>alert('$copiestexte12');</script>";
echo "<script>location.href='$ruta_absoluta/copies_seguretat';</script>";	
	}

else {
	$qry="insert into copies_arxius(id_arxiu,cod_centro,nom,nom_arxius,data) values 
('$id_arxiu','$upload_centro','$nombre_sql_zip','$archivo_zip_nombre','$fecha_guardado')";
mysql_query($qry) or die("Query: $qry <br />Error: ".mysql_error());


if ($numero_copies!='')
{
$archivos_conservar =mysql_query("SELECT * FROM copies_arxius where cod_centro='$upload_centro' order by data desc limit $numero_copies,1");
$row = mysql_fetch_array($archivos_conservar);
$data_valid=($row ["data"]);

$archivos_borrar =mysql_query("SELECT * FROM copies_arxius where cod_centro='$upload_centro' and data < '$data_valid'");
while($row_nombre = mysql_fetch_array($archivos_borrar))
{
$nom=($row_nombre ["nom"]);
$nom_arxius=($row_nombre ["nom_arxius"]);
$datos_delete=$nombre_carpeta.'/'.$nom;
$arxius_delete=$nombre_carpeta.'/'.$nom_arxius;
if (file_exists($datos_delete))
{
unlink($datos_delete);
}

if (file_exists($arxius_delete))
{
unlink($arxius_delete);
}
}
}

mysql_query("DELETE FROM copies_arxius WHERE data < '$data_valid' and cod_centro='$upload_centro'");

echo "<script>alert('$copiestexte11 $nombre_carpeta');</script>";
echo "<script>location.href='$ruta_absoluta/copies_seguretat';</script>";	
}
desconectar();
?>
