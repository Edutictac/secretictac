<?php
//archivos permitidos en los uploads
$archivos_permitidos_js_imagen=' ".jpg" ';
$archivos_permitidos_js=' ".odt", ".pdf",".jpg",".doc",".xls",".ods" ';
$archivos_permitidos_js_pdf=' ".pdf" ';
$archivos_permitidas_php = array("application/vnd.oasis.opendocument.text","application/pdf","image/jpeg","application/msword","application/excel","application/vnd.oasis.opendocument.spreadsheet");
$archivos_permitidas_php_imagen = array("image/jpeg");
$archivos_permitidas_php_pdf = array("application/pdf");


//reemplazo comillas y dobles comillas
$search=array("'",'"','&#39;');
$replace=array('’','”','’');


//funcion para limpiar el nombre de los archivos
function sanear_string($string)
{

    $string = trim($string);

$string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
              " "),
        '',
        $string
    );

    return $string;
}


//funcion para limpiar los datos que se reciben de un formulario
function limpiar_tags($tags){
$tags = strip_tags($tags);
$tags = stripslashes($tags);
$tags = addslashes($tags);
//$tags = htmlentities($tags);
$tags=mysql_escape_string($tags);
//si admite la version, mejor $tags=mysql_real_escape_string($tags);
return $tags;
}


//CALCULO AÑO ACADEMICO
$fecha_actual = date("Y-m-d");
$year_A=substr($fecha_actual,0,4);
$month_A=substr($fecha_actual,5,2);
$day_A=substr($fecha_actual,8,2);

   // If ($month_A < 8 and $month_A >= 1)
     //   $any_academico = $year_A - 1;
  //  Else
        $any_academico = $year_A;
        
//PASAR A FORMATO EUROPEO LA FECHA
function f_datef($date) //para importacion csv
{
$year=substr($date,0,4);
$month=substr($date,5,2);
$day=substr($date,8,2);
$date=$day."/".$month."/".$year;
return ($date);
}

//PASAR A FORMATO barra de direcciones
function fecha1($date) //para importacion csv
{
$year=substr($date,6,4);
$month=substr($date,3,2);
$day=substr($date,0,2);
$date=$day."_".$month."_".$year;
return ($date);
}

//PASAR A FORMATO normal
function fecha2($date) //para importacion csv
{
$year=substr($date,6,4);
$month=substr($date,3,2);
$day=substr($date,0,2);
$date=$day."/".$month."/".$year;
return ($date);
}

//PASAR A FECHA MYSQL
function f_datefI($date) //para importacion csv
{
$year=substr($date,6,4);
$month=substr($date,3,2);
$day=substr($date,0,2);
$date=$year."-".$month."-".$day;
return ($date);
}

?>
