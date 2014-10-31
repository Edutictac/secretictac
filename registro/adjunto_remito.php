<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
$upload_anyo_academico=$_SESSION['anyo_academico_secretictac'];
$permiso=$_SESSION['acceso_secretictac'];
$nick_usuario=$_SESSION['usuario_secretictac'];
if(!isset ($_SESSION["idioma_secretictac"]))
$_SESSION["idioma_secretictac"]="cas";
include("../idioma.php");
include("../colores.php");
include('../funciones.php');


require('../conexion.php');

conectar();
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE


require('../reportes/fpdf.php');
class PDF extends FPDF
{

//Cabecera de pÃ¡gina
function Header()
{
conectar();
$anyo=$_POST['anyo'];
$tipo_registro=$_POST['tipo_registro'];

$upload_centro=$_SESSION['cod_centro_secretictac'];
$result=mysql_query("SELECT * FROM 1_centro WHERE COD_CENTRO='$upload_centro'");
$row = mysql_fetch_array($result);
$nombre_centro1= ($row ["NOMBRE_CENTRO"]);
$direccion1= ($row ["DIRECCION"]);
$poblacion1= ($row ["POBLACION"]);
$provincia1= ($row ["PROVINCIA"]);
$cp1= ($row ["cp"]);
$web1= ($row ["WEB"]);
$email1= ($row ["EMAIL"]);
$telefono1= ($row ["TELEFONO"]);
$fax1= ($row ["FAX"]);
$frase1_1= ($row ["FRASE1"]);
$frase2_1= ($row ["FRASE2"]);
$frase3_1= ($row ["FRASE3"]);

$distancia_logo=($row ["CMLOGO"]);
$distancia_logo_conse=($row ["CMLOGO_CONSE"]);

$nombre_logo_centro=($row ["NOMBRE_LOGO"]);
$nombre_logo_conselleria=($row ["NOMBRE_LOGO_CONSELLERIA"]);
//Logo

$nombre_logo_centro="../archivos/datos_centro/".$upload_centro."/".$nombre_logo_centro;
if (file_exists("$nombre_logo_centro"))
{
 $size = GetImageSize($nombre_logo_centro);
 $anchura=$size[0];
 $altura=$size[1];
 $h=15;
 $w=$anchura/$altura*15;
 $diferencia_a_a= $w;
$this->Image($nombre_logo_centro, $distancia_logo, 10,$w,$h);
}

$nombre_logo_conselleria="../archivos/datos_centro/".$upload_centro."/".$nombre_logo_conselleria;
if (file_exists("$nombre_logo_conselleria"))
{
 $size_1 = GetImageSize($nombre_logo_conselleria);
 $anchura_1=$size_1[0];
 $altura_1=$size_1[1];
 $h_1=15;
 $w_1=$anchura_1/$altura_1*15;
 $diferencia_a_a_1= $w_1;
$this->Image($nombre_logo_conselleria, $distancia_logo_conse, 10,$w_1,$h_1);
}


//defini la $diferencia_a_a para logo conselleria con otro nombre

include ("../idioma.php");

//logo izquierdo
$this->SetFont('Arial','B',12);
$this->SetXY($distancia_logo_conse+$diferencia_a_a_1,12);
$this->Cell(15,4,$frase1_1,0,0,'L',0);
$this->SetXY($distancia_logo_conse+$diferencia_a_a_1,16);
$this->SetFont('Arial','',8);
$this->Cell(150,4,$frase2_1,0,0,'L',0);
$this->SetXY($distancia_logo_conse+$diferencia_a_a_1,20);
$this->Cell(150,4,$frase3_1,0,0,'L',0);


//logo derecho
$this->SetFont('Arial','B',12);
$this->SetXY($diferencia_a_a+$distancia_logo,4+5);
$this->Cell(150,4,$nombre_centro1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,8+5);
$this->SetFont('Arial','',8);
$this->Cell(150,4,$direccion1.' '.$cp1.' '.$poblacion1.' ( '.$provincia1.' )',0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,11+5);
$this->Cell(150,4,'Email: '.$email1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,14+5);
$this->Cell(150,4,'Web: '.$web1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,17+5);
$this->Cell(150,4,'Tlfn: '.$telefono1.'   '.'FAX: '.$fax1,0,0,'L',0);
$this->Ln(10);
}

}




//Creación del objeto de la clase heredada
$pdf=new PDF('P','mm','A4');
$pdf->SetAutoPageBreak(1,30);
$pdf->AddPage();


$ejex=30;
$ejey=50;


$codigo=$_REQUEST['codigo'];
$codigo=str_pad($codigo, 6, "0", STR_PAD_LEFT);
$fecha=fecha2($_REQUEST['fecha']);
$asunto=$_REQUEST['asunto'];

$result=mysql_query("SELECT * FROM 1_centro WHERE COD_CENTRO='$upload_centro'");
$row = mysql_fetch_array($result);
$secretari= ($row ["secretari"]);


$pdf->SetFont('Arial','',12);
$pdf->SetXY($ejex,$ejey);
$pdf->MultiCell(130,5,$registrotexto74,0,'J',0);


$pdf->SetX($ejex);
$pdf->MultiCell(130,5,$registrotexto73.': '.$codigo,0,'J',0);

$pdf->SetX($ejex);
$pdf->MultiCell(130,5,$compartirtexto28.': '.$fecha,0,'J',0);
$pdf->lN(25);
$pdf->SetFont('Arial','B',12);
$pdf->SetX($ejex);
$pdf->MultiCell(130,8,$registrotexto72,0,'J',0);

$pdf->SetFont('Arial','I',12);
$pdf->SetX($ejex);
$pdf->MultiCell(150,8,$asunto,0,'J',0);


$year=substr($fecha,6,4);
$month=substr($fecha,3,2);
$day=substr($fecha,0,2);

$search=array("01","02","03","04","05","06","07","08","09","10","11","12");
$replace=array("$enero","$febrero","$marzo","$abril","$mayo","$junio","$julio","$agosto","$septiembre","$octubre","$noviembre","$diciembre");
$mes=str_replace($search,$replace,$month);


if ($_SESSION["idioma_secretictac"]=="val"){
$mes_val =$mes;
$comienza = $mes_val[0];

if ($comienza=='a' or $comienza=='e' or $comienza=='i'  or $comienza=='o'   or $comienza=='u')
$fecha_formato_largo=$day.$de_1.$mes.$de.$year;
else
$fecha_formato_largo=$day.$de.$mes.$de.$year;
}
else
{
$fecha_formato_largo=$day.$de.$mes.$de.$year;
}


$ciudad = mysql_query("SELECT POBLACION FROM 1_centro where COD_CENTRO='$upload_centro'");
while ($row6 = mysql_fetch_array($ciudad))
{
$CIUDAD1=$row6 ["POBLACION"];
}


$pdf->Ln(15);
$pdf->SetX($ejex+60);
$pdf->MultiCell(100,5,$CIUDAD1.', '.$fecha_formato_largo,0,'C',0);

$pdf->Ln(35);
$pdf->SetX($ejex+60);
$pdf->MultiCell(100,5,$secretari,0,'C',0);



desconectar();


//Send file
$pdf->Output();

?>
