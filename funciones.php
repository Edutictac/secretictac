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
$replace=array('�','�','�');


//funcion para limpiar el nombre de los archivos
function sanear_string($string)
{

    $string = trim($string);

$string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('�', '�', '�', '�', '�', '�', '�', '�'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('�', '�', '�', '�'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extra�o
    $string = str_replace(
        array("\\", "�", "�", "-", "~",
             "#", "@", "|", "!", "\"",
             "�", "$", "%", "&", "/",
             "(", ")", "?", "'", "�",
             "�", "[", "^", "`", "]",
             "+", "}", "{", "�", "�",
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

function quitar_html($tags){
$tags = strip_tags($tags);
return $tags;
}

//CALCULO A�O ACADEMICO
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

function Recortar($Texto,$Num_Caracteres)
	{
	   $result = "";
    $comp = strlen($Texto);
	   for($i=0;$i<($Num_Caracteres+1);$i++)
	   {
          if ($comp>$Num_Caracteres)
          $result .= $Texto[$i];
          else
          $result=$Texto;
	   }
	  $result .= "...";
	   return $result;
	}
	
	//funcion para reemplazar las entidades en sus caracteres normales
/*	
	$busca_entitat=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&ccedil;");
$sustituye_palabra=array("�","�","�","�","�","�","�");
	function quitaEntities(texto){
            texto = Replace(texto, "�", "&aacute;")
            texto = Replace(texto, "�", "&eacute;")
            texto = Replace(texto, "�", "&iacute;")
            texto = Replace(texto, "�", "&oacute;")
            texto = Replace(texto, "�", "&uacute;")
            texto = Replace(texto, "�", "&ntilde;")
            texto = Replace(texto, "�", "&ccedil;")

            texto = Replace(texto, "�", "&Aacute;")
            texto = Replace(texto, "�", "&Eacute;")
            texto = Replace(texto, "�", "&Iacute;")
            texto = Replace(texto, "�", "&Oacute;")
            texto = Replace(texto, "�", "&Uacute;")
            texto = Replace(texto, "�", "&Ntilde;")
            texto = Replace(texto, "�", "&Ccedil;")

            texto = Replace(texto, "�", "&agrave;")
            texto = Replace(texto, "�", "&egrave;")
            texto = Replace(texto, "�", "&igrave;")
            texto = Replace(texto, "�", "&ograve;")
            texto = Replace(texto, "�", "&ugrave;")

            texto = Replace(texto, "�", "&Agrave;")
            texto = Replace(texto, "�", "&Egrave;")
            texto = Replace(texto, "�", "&Igrave;")
            texto = Replace(texto, "�", "&Ograve;")
            texto = Replace(texto, "�", "&Ugrave;")

            texto = Replace(texto, "�", "&auml;")
            texto = Replace(texto, "�", "&euml;")
            texto = Replace(texto, "�", "&iuml;")
            texto = Replace(texto, "�", "&ouml;")
            texto = Replace(texto, "�", "&uuml;")

            texto = Replace(texto, "�", "&Auml;")
            texto = Replace(texto, "�", "&Euml;")
            texto = Replace(texto, "�", "&Iuml;")
            texto = Replace(texto, "�", "&Ouml;")
            texto = Replace(texto, "�", "&Uuml;")

            texto = Replace(texto, "�", "&acirc;")
            texto = Replace(texto, "�", "&ecirc;")
            texto = Replace(texto, "�", "&icirc;")
            texto = Replace(texto, "�", "&ocirc;")
            texto = Replace(texto, "�", "&ucirc;")

            texto = Replace(texto, "�", "&Acirc;")
            texto = Replace(texto, "�", "&Ecirc;")
            texto = Replace(texto, "�", "&Icirc;")
            texto = Replace(texto, "�", "&Ocirc;")
            texto = Replace(texto, "�", "&Ucirc;")
            return ();
}
*/
?>
