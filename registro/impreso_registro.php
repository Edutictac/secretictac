<?php
session_start();
$upload_centro=$_SESSION['cod_centro_secretictac'];
if(!isset ($_SESSION["idioma_secretictac"]))
$_SESSION["idioma_secretictac"]="cas";
include("../idioma.php");
include("../colores.php");
$ejex_inicial='7';

require('../conexion.php');
include('../funciones.php');

conectar();
$anyo=$_POST['anyo'];
$tipo_registro=$_POST['tipo_registro'];

//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE


require('../reportes/fpdf.php');

class PDF_MC_Table extends FPDF 
{ 
var $widths; 
var $aligns; 

function SetWidths($w) 
{ 
    //Set the array of column widths 
    $this->widths=$w; 
} 

function SetAligns($a) 
{ 
    //Set the array of column alignments 
    $this->aligns=$a; 
} 

function fill($f)
{
	//juego de arreglos de relleno
	$this->fill=$f;
}

function Row($data) 
{ 
    //Calculate the height of the row 
    $nb=0; 
    for($i=0;$i<count($data);$i++) 
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i])); 
    $h=5*$nb; 
    //Issue a page break first if needed 
    $this->CheckPageBreak($h); 
    //Draw the cells of the row 
    for($i=0;$i<count($data);$i++) 
    { 
        $w=$this->widths[$i]; 
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L'; 
        //Save the current position 
        $x=$this->GetX(); 
        $y=$this->GetY(); 
        //Draw the border 
        //$this->Rect($x,$y,$w,$h,$style); 
        $this->line($x,$y+$h-1,285,$y+$h-1); 
        //Print the text 
        $this->MultiCell($w,3,$data[$i],0,$a,0); 
        //Put the position to the right of the cell 
        $this->SetXY($x+$w,$y); 
        
         
    } 
    //Go to the next line 
    $this->Ln($h); 
} 

function CheckPageBreak($h) 
{ 
    //If the height h would cause an overflow, add a new page immediately 
    if($this->GetY()+$h>$this->PageBreakTrigger) 
        $this->AddPage($this->CurOrientation); 
        $this->SetX(7);
} 

function NbLines($w,$txt) 
{ 
    //Computes the number of lines a MultiCell of width w will take 
    $cw=&$this->CurrentFont['cw']; 
    if($w==0) 
    $w=$this->w-$this->rMargin-$this->x; 
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize; 
    $s=str_replace("\r",'',$txt); 
    $nb=strlen($s); 
    if($nb>0 and $s[$nb-1]=="\n") 
        $nb--; 
    $sep=-1; 
    $i=0; 
    $j=0; 
    $l=0; 
    $nl=1; 
    while($i<$nb) 
    { 
        $c=$s[$i]; 
        if($c=="\n") 
        { 
            $i++; 
            $sep=-1; 
            $j=$i; 
            $l=0; 
            $nl++; 
            continue; 
        } 
        if($c==' ') 
            $sep=$i; 
        $l+=$cw[$c]; 
        if($l>$wmax) 
        { 
            if($sep==-1) 
            { 
                if($i==$j) 
                    $i++; 
            } 
            else 
                $i=$sep+1; 
            $sep=-1; 
            $j=$i; 
            $l=0; 
            $nl++; 
        } 
        else 
            $i++; 
    } 
    return $nl; 
} 
} 


class PDF extends PDF_MC_Table
{

//Cabecera de página
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
$this->SetX(7);
$this->SetFont('Arial','B',10);
if($tipo_registro=='e')
$this->MultiCell(170,5,$imprimirtexto4.'. '.$imprimirtexto5.' '.$anyo,0,'L',0);
 else 
$this->MultiCell(170,5,$imprimirtexto6.'. '.$imprimirtexto5.' '.$anyo,0,'L',0);
//print column titles
$this->SetFillColor($rojo,$verde,$azul);
$this->SetFont('Arial','B',8);
$this->Ln(5);
$this->SetX(7);

if($tipo_registro=='e')
$this->Cell(15,$row_height,$registrotexto63,0,0,'L',0);
else 
$this->Cell(15,$row_height,$registrotexto66,0,0,'L',0);

$this->Cell(17,$row_height,$registrotexto64,0,0,'L',0);

if($tipo_registro=='e')
$this->Cell(17,$row_height,$registrotexto65,0,0,'L',0);
else 
$this->Cell(17,$row_height,$registrotexto67,0,0,'L',0);

$this->Cell(25,$row_height,$registrotexto57,0,0,'L',0);
$this->Cell(38,$row_height,$registrotexto51,0,0,'L',0);
$this->Cell(38,$row_height,$registrotexto52,0,0,'L',0);

if($tipo_registro=='e')
$this->Cell(28,$row_height,$registrotexto53,0,0,'L',0);
else 
$this->Cell(28,$row_height,$registrotexto58,0,0,'L',0);

$this->Cell(38,$row_height,$registrotexto54,0,0,'L',0);
$this->Cell(65,$row_height,$registrotexto17,0,0,'L',0);
$this->Line(7, 44, 285, 44);
$this->Ln(4);
}

}


//Creación del objeto de la clase heredada
$pdf=new PDF('L','mm');
$pdf->AliasNbPages();
$pdf->AddPage();




$row_height = 6;
$row_height_contenido = 12;

$pdf->Ln(2);

$y_axis = $y_axis + $row_height;




$result=mysql_query("SELECT * FROM registro where cod_centro='$upload_centro' and anyo='$anyo' and entrada_salida='$tipo_registro' order by codigo_registro asc");

while ($row = mysql_fetch_array($result))
{
$id_registro=($row ["id_registro"]);
$codigo_registro=($row ["codigo_registro"]);
$codigo_registro=str_pad($codigo_registro, 6, "0", STR_PAD_LEFT);
$fecha_entrada_salida=f_datef($row ["fecha_entrada_salida"]);
$fecha_registro=f_datef($row ["fecha_registro"]);
$entrada_salida=($row ["entrada_salida"]);
$tipo_documento=($row ["tipo_documento"]);
$asunto=($row ["asunto"]);


$origen=($row ["origen"]);
$procedencia=($row ["procedencia"]);
$organismo=($row ["organismo"]);
$destino=($row ["destino"]);

if($tipo_documento!=0)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_documento=mysql_query("SELECT nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento' ");
				$row = mysql_fetch_array($nombre_documento);
				  $nombre_docum=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_documento=mysql_query("SELECT nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento' ");
				$row = mysql_fetch_array($nombre_documento);
				  $nombre_docum=$row ["nombre_val"];
				}

}
else
{
	$nombre_docum='';
		}



if($origen!=0)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_origen=mysql_query("SELECT nombre_cas FROM registro_origen where cod_centro='$upload_centro' and id_origen='$origen' ");
				$row = mysql_fetch_array($nombre_origen);
				  $nombre_origen=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_origen=mysql_query("SELECT nombre_val FROM registro_origen where cod_centro='$upload_centro' and id_origen='$origen' ");
				$row = mysql_fetch_array($nombre_origen);
				  $nombre_origen=$row ["nombre_val"];
				}

}
else
{
	$nombre_origen='';
		}
		
		

if($organismo!=0)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_organismo=mysql_query("SELECT nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo' ");
				$row = mysql_fetch_array($nombre_organismo);
				  $nombre_organismo=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_organismo=mysql_query("SELECT nombre_val FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo' ");
				$row = mysql_fetch_array($nombre_organismo);
				  $nombre_organismo=$row ["nombre_val"];
				}

}
else
{
	$nombre_organismo='';
		}
		
		
if($destino!=0)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_destino=mysql_query("SELECT nombre_cas FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino' ");
				$row = mysql_fetch_array($nombre_destino);
				  $nombre_destino=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_destino=mysql_query("SELECT nombre_val FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino' ");
				$row = mysql_fetch_array($nombre_destino);
				  $nombre_destino=$row ["nombre_val"];
				}

}
else
{
	$nombre_destino='';
		}
		
	
	

//un arreglo con alineacion de cada celda

//$pdf->SetAligns(array(‘C’,’L’,’R’));


$pdf->SetX(7);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',8);
    $pdf->SetWidths(array(15,17,17,25,38,38,28,38,65));
    
   if($tipo_registro=='e') 
   	$pdf->Row(array($codigo_registro,$fecha_registro,$fecha_entrada_salida,$nombre_docum,$nombre_origen,$nombre_organismo,$procedencia,$nombre_destino,$asunto));
   else
	   $pdf->Row(array($codigo_registro,$fecha_registro,$fecha_entrada_salida,$nombre_docum,$nombre_destino,$nombre_organismo,$procedencia,$nombre_origen,$asunto));
		
}

 //liberar memoria y cerrar conexion
mysql_free_result($result);
desconectar();


//Send file
$pdf->Output();

?>
