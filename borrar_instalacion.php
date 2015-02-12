<?php
echo "<script>alert('Se va a proceder al borrado del directorio de instalación. Una vez borrado el archivo de instalación, no volver a ejecutarlo, puesto que se duplicaría la base de datos.');</script>";

$carpeta_eliminar='../install_secretictac-master';
function eliminarDir($carpeta){
foreach(glob($carpeta."/*") as $archivos_carpeta)
{ echo $archivos_carpeta;
if(is_dir($archivos_carpeta))
eliminarDir($archivos_carpeta);
else unlink($archivos_carpeta); }
rmdir($carpeta); }

eliminarDir($carpeta_eliminar);

echo "<script>location.href='index.php';</script>";
?>
