<?php
session_start();
$upload_centro=$_SESSION['cod_centro'];
require('../../conexion.php');

conectar();
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE


require('../../reportes/fpdf.php');


class PDF extends FPDF
{
//Cabecera de página
function Header()
{
session_start();
$upload_centro=$_SESSION['cod_centro'];
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
$nombre_logo_pie=($row ["NOMBRE_LOGO_PIE"]);
//Logo

$nombre_logo_centro="../../archivos/datos_centro/".$upload_centro."/".$nombre_logo_centro;
if (file_exists("$nombre_logo_centro"))
{
 $size = GetImageSize($nombre_logo_centro);
 $anchura=$size[0];
 $altura=$size[1];
 $h=17;
 $w=$anchura/$altura*17;
 $diferencia_a_a= $w;
$this->Image($nombre_logo_centro, $distancia_logo, 10,$w,$h);
}

$nombre_logo_conselleria="../../archivos/datos_centro/".$upload_centro."/".$nombre_logo_conselleria;
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

include ("../../idioma.php");

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
$this->SetXY($diferencia_a_a+$distancia_logo,10);
$this->Cell(150,4,$nombre_centro1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,14);
$this->SetFont('Arial','I',8);
$this->Cell(150,4,$direccion1.' '.$cp1.' '.$poblacion1.' ( '.$provincia1.' )',0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,17);
$this->Cell(150,4,'Email: '.$email1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,20);
$this->Cell(150,4,'Web: '.$web1,0,0,'L',0);
$this->SetXY($diferencia_a_a+$distancia_logo,23);
$this->Cell(150,4,'Tlfn: '.$telefono1.'   '.'FAX: '.$fax1,0,0,'L',0);
$this->Ln(10);
}

}



//Creación del objeto de la clase heredada
$pdf=new PDF();

$pdf->Output();

?>
