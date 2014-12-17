<?php
//clase para extraer zip
class Zip_manager{

function listar($var){
$entries = array();
$zip = zip_open($var);
if (!is_resource($zip)){
die ("No se puede leer el archivo.");
}
else{
while ($entry = zip_read($zip)){
$entries[] = zip_entry_name($entry);
}
}
zip_close($zip);
return $entries;
}

function extraer($var, $destino){
$zip = new ZipArchive;
if ($zip->open($var) === TRUE) {
$zip->extractTo($destino);
$zip->close();
return true;
} else {
return false;
}
}
}

//descomprension del archivo zip
$zip_manager = new Zip_manager();
$archivo_zip = "actualizacion.zip"; // aqui el nombre del archivo a extraer
$explode_carpeta = explode(".zip", $archivo_zip);  // Es lo que hace es quitarle el .zip
$carpeta_final = '../secretictac/';//esto lo he quitado para que se forme un unico directorio .$explode_carpeta[0];  // un simple explode...
$listado = $zip_manager->listar($archivo_zip);
//print_r($listado);
$resultado = $zip_manager->extraer($archivo_zip, $carpeta_final); // aqui pirmero el nombre del archivo y despues la carpeta del destino final.
if (!$resultado){
echo "Error: no se ha podido extraer el archivo";
}
else{
echo "<br>";
}

include ("conexion.php");
conectar();
//	CREAMOS TABLAS NUEVAS version 1.1

mysql_query ("CREATE TABLE IF NOT EXISTS actas (
  id_acta varchar(200) NOT NULL,
  texto text NOT NULL,
  acuerdos text NOT NULL,
  fecha date NOT NULL,
  id_tipo_acta varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  anyo varchar(4) NOT NULL,
  PRIMARY KEY (id_acta),
  FULLTEXT KEY BUSQUEDA (texto)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS actas_asistentes (
  id_tipo_acta varchar(500) NOT NULL,
  id_asistente varchar(500) NOT NULL,
  nombre_asistente varchar(200) NOT NULL,
  tipo_asistente varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

mysql_query ("CREATE TABLE IF NOT EXISTS actas_convocatorias (
  id_convocatoria varchar(200) NOT NULL,
  texto_cas text NOT NULL,
  texto_val text NOT NULL,
  fecha date NOT NULL,
  id_tipo_acta varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  anyo varchar(4) NOT NULL,
  fecha_convocatoria date NOT NULL,
  PRIMARY KEY (id_convocatoria),
  FULLTEXT KEY BUSQUEDA (texto_cas)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

mysql_query ("CREATE TABLE IF NOT EXISTS actas_firmas (
  id_tipo_acta varchar(500) NOT NULL,
  id_firma varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  id_tipo_asistente varchar(500) NOT NULL,
  orden int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS actas_permisos (
  id_tipo_acta varchar(500) NOT NULL,
  id_tipo_permisos varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  nombre_permiso varchar(250) NOT NULL,
  id_permiso varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS actas_tipo_acta (
  id_tipo varchar(500) NOT NULL,
  nombre_cas varchar(100) NOT NULL,
  nombre_val varchar(100) NOT NULL,
  cod_centro varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS actas_tipo_asistentes (
  id_tipo varchar(500) NOT NULL,
  nombre_cas varchar(100) NOT NULL,
  nombre_val varchar(100) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  orden int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS acta_asistentes_reunion (
  id_actas varchar(500) NOT NULL,
  id_asistente varchar(500) NOT NULL,
  nombre varchar(300) NOT NULL,
  nombre_cargo_cas varchar(200) NOT NULL,
  nombre_cargo_val varchar(200) NOT NULL,
  id_tipo_asistente varchar(500) NOT NULL,
  orden_asistente int(2) NOT NULL,
  cod_centro varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


//tablas de la version 1.2
mysql_query ("CREATE TABLE IF NOT EXISTS copies_arxius (
  id_arxiu varchar(500) NOT NULL,
  nom varchar(255) NOT NULL,
  data datetime NOT NULL,
  cod_centro varchar(20) NOT NULL,
  nom_arxius varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");


mysql_query ("CREATE TABLE IF NOT EXISTS copies_carpeta (
  id_carpeta varchar(500) NOT NULL,
  ruta varchar(500) NOT NULL,
  cod_centro varchar(20) NOT NULL,
  numero_copies varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//actualizamos las tablas antiguas

function add_column_if_not_exist($db, $column, $column_attr = "VARCHAR( 255 ) NULL" ){
  $exists = false;
  $columns = mysql_query("show columns from $db");
  while($c = mysql_fetch_assoc($columns)){
      if($c['Field'] == $column){
          $exists = true;
           echo "<div id='campo_input'>La columna <b>$column</b> ya existe en la base de datos <b>$db</b> y por lo tanto no se ha creado</div>";
          break;
      }
  }        
  if(!$exists){
      mysql_query("ALTER TABLE $db ADD $column  $column_attr");
	echo "<div id='campo_input'>La columna <b>$column</b> se ha creado en la base de datos <b>$db</b> </div>";
  }
}

//actualizacion tablas version 1.1
add_column_if_not_exist('1_permisos', 'actas', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('1_permisos', 'crear_actas', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('1_permisos', 'listado_actas', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('1_permisos', 'redactar_actas', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('1_permisos', 'busqueda_actas', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('1_permisos', 'convocatorias_actas', $column_attr = "VARCHAR(1) NULL" );

//actualizacion tablas version 1.2
add_column_if_not_exist('1_permisos', 'copies_seguretat', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('actas_firmas', 'firma_convocatoria', $column_attr = "VARCHAR(1) NOT NULL DEFAULT '1'" );
add_column_if_not_exist('actas_tipo_acta', 'encabezado_acta', $column_attr = "VARCHAR(1) NULL" );
add_column_if_not_exist('actas_tipo_acta', 'encabezado_convocatoria', $column_attr = "VARCHAR(1) NULL" );


desconectar();

    
echo "<script>alert('ACTUALITZACIÓ FINALITZADA');</script>";


echo "<script>location.href='index.php';</script>";
?>







