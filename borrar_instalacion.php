<?php
echo "<script>alert('Se va a proceder al borrado del directorio de instalaci�n. Una vez borrado el archivo de instalaci�n, no volver a ejecutarlo, puesto que se duplicar�a la base de datos.');</script>";

$carpeta_eliminar='../instalacion_secretictac';
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
