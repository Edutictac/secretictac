<?php
include ("../permisos.php");
$archivo="error_log";
if (file_exists($archivo))
{
unlink($archivo) ;
}
?>
<style type="text/css">

.jdkgj{
   color:#2e3191;
	text-decoration: underline;
	font-weight: bold;
	background-color: #c0c0c0;

}
</style>

<script type="text/javascript">
function popup(url,ancho,alto) {
var posicion_x;
var posicion_y;
posicion_x=(screen.width/2)-(ancho/2);
posicion_y=(screen.height/2)-(alto/2);
window.open(url, "secretictac", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>


<script type="text/javascript" >
function previa(){
document.Form1.submit();}




function mostrar(NDivs)
{

  for(i=1;i<=2;i++)
  {
     document.getElementById('div'+i).style.display = 'none';

  }
       if(i=NDivs)
     {
        document.getElementById('div'+i).style.display = 'block';
            
         
     }
}

function ocultar()
{

  for(i=1;i<=2;i++)
  {
     document.getElementById('div'+i).style.display = 'none';
     document.getElementById('div0').style.display = 'none';

  }
      
}


</script>


<div id="container">

<div id="tabla_centrar2"  align="left">

<?php
conectar();


$acceso_permitido = mysql_query("SELECT listados  FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["listados"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>

<?php

if (isset($_REQUEST['enlaces_pagina']))
{
$enlaces_pagina=$_REQUEST['enlaces_pagina'];
}
else
{
$enlaces_pagina='20';
}


if (isset($_REQUEST['busqueda']))
{
$busqueda=$_REQUEST['busqueda'];
}
else
{
$busqueda='aa';
}

if($busqueda=='')
$busqueda='aa';
$first = $busqueda[0];

if($first!='"')
{
//funcion para resaltar y sustituir el texto
function resaltar($buscar, $texto) {
    $claves = explode(" ",$buscar);
    $clave = array_unique($claves);
    $num = count($clave);
    for($i=0; $i < $num; $i++)
        $texto = preg_replace("/(".trim($clave[$i]).")/i","<span class='jdkgj'>\\1</span>",$texto);
    return $texto;
}
}
else
{
//funcion para resaltar y sustituir el texto
function resaltar($buscar, $texto) {
    $buscar=str_replace('"','',$buscar);
    $texto = preg_replace("/(".trim($buscar).")/i","<span class='jdkgj'>\\1</span>",$texto);
    return $texto;
}
}

//busqueda de palabras
if (isset($_REQUEST['busqueda']))
{
$busqueda=$_REQUEST['busqueda'];
$texto_busqueda=$busqueda;
}
else {
	$busqueda='';
	$texto_busqueda='';
}

//consultas
$anyo_elegido=$_REQUEST['anyo'];
if($anyo_elegido!=$registrotexto59)
$consulta_anyo="and anyo='$anyo_elegido'";
else 
$consulta_anyo='';


$entrada_salida=$_REQUEST['tipo_registro'];
$consulta_entrada_salida="and entrada_salida='$entrada_salida'";



if (isset($_REQUEST['tipo_documento']))
{
$tipo_documento=$_REQUEST['tipo_documento'];
}
else 
$tipo_documento=$registrotexto59;

if($tipo_documento!=$registrotexto59)
$consulta_tipo_documento="and tipo_documento='$tipo_documento'";
else 
$consulta_tipo_documento='';

if($tipo_documento!=$registrotexto59)
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
	$nombre_docum=$registrotexto59;
		}



//remitente
if (isset($_REQUEST['origen']))
{
$origen=$_REQUEST['origen'];
}
else 
$origen=$registrotexto59;

if($origen!=$registrotexto59)
$consulta_origen="and origen='$origen'";
else 
$consulta_origen='';

if($origen!=$registrotexto59)
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
	$nombre_origen=$registrotexto59;
		}

//organismo

if (isset($_REQUEST['organismo']))
{
$organismo=$_REQUEST['organismo'];
}
else 
$organismo=$registrotexto59;

if($organismo!=$registrotexto59)
$consulta_organismo="and organismo='$organismo'";
else 
$consulta_organismo='';

if($organismo!=$registrotexto59)
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
	$nombre_organismo=$registrotexto59;
		}
		
//destinatario
if (isset($_REQUEST['destino']))
{
$destino=$_REQUEST['destino'];
}
else 
$destino=$registrotexto59;

if($destino!=$registrotexto59)
$consulta_destino="and destino='$destino'";
else 
$consulta_destino='';
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
	$nombre_destino=$registrotexto59;
		}



//destino salida

if (isset($_REQUEST['destino_salida']))
{
$destino_salida=$_REQUEST['destino_salida'];
}
else 
$destino_salida=$registrotexto59;

if($destino_salida!=$registrotexto59)
$consulta_destino_salida="and origen='$destino_salida'";
else 
$consulta_destino_salida='';

if($destino_salida!=$registrotexto59)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_destino_salida=mysql_query("SELECT nombre_cas FROM registro_origen where cod_centro='$upload_centro' and id_origen='$destino_salida' ");
				$row = mysql_fetch_array($nombre_destino_salida);
				  $nombre_destino_salida=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_destino_salida=mysql_query("SELECT nombre_val FROM registro_origen where cod_centro='$upload_centro' and id_origen='$destino_salida' ");
				$row = mysql_fetch_array($nombre_destino_salida);
				  $nombre_destino_salida=$row ["nombre_val"];
				}

}
else
{
	$nombre_destino_salida=$registrotexto59;
		}


//documento de salida
if (isset($_REQUEST['tipo_documento_salida']))
{
$tipo_documento_salida=$_REQUEST['tipo_documento_salida'];
}
else 
$tipo_documento_salida=$registrotexto59;

if($tipo_documento_salida!=$registrotexto59)
$consulta_tipo_documento_salida="and tipo_documento='$tipo_documento_salida'";
else 
$consulta_tipo_documento_salida='';

if($tipo_documento_salida!=$registrotexto59)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_documento_salida=mysql_query("SELECT nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento_salida' ");
				$row = mysql_fetch_array($nombre_documento_salida);
				  $nombre_docum_salida=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_documento_salida=mysql_query("SELECT nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' and id_tipo_documento='$tipo_documento_salida' ");
				$row = mysql_fetch_array($nombre_documento_salida);
				  $nombre_docum_salida=$row ["nombre_val"];
				}

}
else
{
	$nombre_docum_salida=$registrotexto59;
		}


//organismo salida

if (isset($_REQUEST['organismo_salida']))
{
$organismo_salida=$_REQUEST['organismo_salida'];
}
else 
$organismo_salida=$registrotexto59;

if($organismo_salida!=$registrotexto59)
$consulta_organismo_salida="and organismo='$organismo_salida'";
else 
$consulta_organismo_salida='';

if($organismo_salida!=$registrotexto59)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_organismo_salida=mysql_query("SELECT nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo_salida' ");
				$row = mysql_fetch_array($nombre_organismo_salida);
				  $nombre_organismo_salida=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_organismo_salida=mysql_query("SELECT nombre_val FROM registro_organismo where cod_centro='$upload_centro' and id_organismo='$organismo_salida' ");
				$row = mysql_fetch_array($nombre_organismo_salida);
				  $nombre_organismo_salida=$row ["nombre_val"];
				}

}
else
{
	$nombre_organismo_salida=$registrotexto59;
		}
		

//remitente
if (isset($_REQUEST['destino_remitente']))
{
$destino_remitente=$_REQUEST['destino_remitente'];
}
else 
$destino_remitente=$registrotexto59;

if($destino_remitente!=$registrotexto59)
$consulta_destino_remitente="and destino='$destino_remitente'";
else 
$consulta_destino_remitente='';
if($destino_remitente!=0)
{
					if ($_SESSION["idioma_secretictac"]=='cas')
					{
				$nombre_destino_remitente=mysql_query("SELECT nombre_cas FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino_remitente' ");
				$row = mysql_fetch_array($nombre_destino_remitente);
				  $nombre_destino_remitente=$row ["nombre_cas"];
				  }
				if ($_SESSION["idioma_secretictac"]=='val')
				{
				$nombre_destino_remitente=mysql_query("SELECT nombre_val FROM registro_destino where cod_centro='$upload_centro' and id_destino='$destino_remitente' ");
				$row = mysql_fetch_array($nombre_destino_remitente);
				  $nombre_destino_remitente=$row ["nombre_val"];
				}

}
else
{
	$nombre_destino_remitente=$registrotexto59;
		}

$activo='registro';
$activado_listados="activado";

include ("../menu.php");
conectar();
?>
<div id="titulo_1"  align="justify">
<?php 
echo "$registrotexto48";
?>
</div>

<div  style='float:left;padding: 0px 0px 0px 0px;'>

<div id="titulo_campo_texto" align="justify">
<?php echo "$registrotexto49";?>
</div>


<form  name="Form1" method="get" action="<?php echo "$ruta_absoluta";?>/registro/listado.php"  id="Form1">

<div id="titulo_campo_texto">
<?php echo "<b>$registrotexto6</b>";?>
</div>
<div id="campo_input" style="vertical-align: middle;" align="justify">
<?php
$consulta=mysql_query("SELECT distinct anyo FROM registro where cod_centro='$upload_centro' order by anyo");
   	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='anyo' style='width:100px'>";
	echo "<option value='$anyo_elegido'>$anyo_elegido</option>";
	echo "<option value='$registrotexto59'>$registrotexto59</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";

?>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

<input type="radio" id="RadioButton" <?php if ($entrada_salida=='e') echo 'checked';?> onclick="mostrar(1)" name="tipo_registro" value="e">
<?php echo "$registrotexto5"; ?>
 &nbsp; &nbsp; &nbsp; &nbsp;
<input type="radio" id="RadioButton" <?php if ($entrada_salida=='s') echo 'checked';?>  onclick="mostrar(2)" name="tipo_registro" value="s">
<?php echo "$registrotexto46"; ?>
</div>

<div id="titulo_campo_texto">
<?php echo "<b>$registrotexto60</b>";?>
</div>
<div id="campo_input"  align="justify"></div> 

<?php
if($entrada_salida=='e')
$display_entrada='block';
else 
$display_entrada='none';
?>


<div id="div1" style="display:<?php echo $display_entrada;?>">
<table>
<tr>
<td>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto57</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto51</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto52</b>";?>
</div>
</td>
<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto54</b>";?>
</div>
</td>
</tr>


<tr>
<td>
<div id="campo_input"  align="justify">
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:140px;' name='tipo_documento'>";
	echo "<option value='$tipo_documento'>$nombre_docum</option>";
	echo "<option value='$registrotexto59'>$registrotexto59</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</td>

<td valign="top">
<div id="campo_input2"   align="justify">
<!--si es de dalida, esto es el nombre del destino-->
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_origen,nombre_cas FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_origen,nombre_val FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");


	echo "<select style='width:140px;' name='origen'>";
	echo "<option value='$origen'>$nombre_origen</option>";
		echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

</td>
<td valign="top">
<div id="campo_input2" style="float: left;"  align="justify">
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_organismo,nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_organismo,nombre_val FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");


	echo "<select style='width:140px;' name='organismo'>";
	echo "<option value='$organismo'>$nombre_organismo</option>";
			echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

</td>

<td valign="top">
<div id="campo_input2" style="float: left;"  align="justify">
<!--si es de entrada, esto es el origen-->
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_destino,nombre_cas FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_destino,nombre_val FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='e' order by nombre_val");


	echo "<select style='width:140px;' name='destino'>";
	echo "<option value='$destino'>$nombre_destino</option>";
				echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</td>
</tr>
</table>
</div>

<?php
if($entrada_salida=='s')
$display_salida='block';
else 
$display_salida='none';
?>

<div id="div2" style="display:<?php echo $display_salida;?>">
<table >
<tr>
<td>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto57</b>";?>
</div>

<td>
<div id="titulo_campo_texto2" align="left">
<?php echo "<b>$registrotexto54</b>";?>
</td>


<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto52</b>";?>
</div>
</td>

<td>
<div id="titulo_campo_texto2"  align="left">
<?php echo "<b>$registrotexto51</b>";?>
</div>
</td>

</tr>
<tr>
<td>
<div id="campo_input"  align="justify">
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_cas FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_tipo_documento,nombre_val FROM registro_tipo_documento where cod_centro='$upload_centro' order by nombre_val");


	echo "<select style='width:140px;' name='tipo_documento_salida'>";
	echo "<option value='$tipo_documento_salida'>$nombre_docum_salida</option>";
	echo "<option value='$registrotexto59'>$registrotexto59</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</td>

<td valign="top">
<div id="campo_input2"   align="justify">
<!--si es de dalida, esto es el nombre del destino-->
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_origen,nombre_cas FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_origen,nombre_val FROM registro_origen where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");


	echo "<select style='width:140px;' name='destino_salida'>";
	echo "<option value='$destino_salida'>$nombre_destino_salida</option>";
		echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
?>
</div>

</td>

<td valign="top">
<div id="campo_input2" style="float: left;"  align="justify">
<?php
//organismo salida
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_organismo,nombre_cas FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_organismo,nombre_val FROM registro_organismo where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");


	echo "<select style='width:140px;' name='organismo_salida'>";
	echo "<option value='$organismo_salida'>$nombre_organismo_salida</option>";
			echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>

</td>


<td valign="top">
<div id="campo_input2" style="float: left;"  align="justify">
<!--si es de entrada, esto es el destinatario-->
<?php
if ($_SESSION["idioma_secretictac"]=='cas')
$consulta=mysql_query("SELECT id_destino,nombre_cas FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_cas");

if ($_SESSION["idioma_secretictac"]=='val')
$consulta=mysql_query("SELECT id_destino,nombre_val FROM registro_destino where cod_centro='$upload_centro' and entrada_salida='s' order by nombre_val");


	echo "<select style='width:140px;' name='destino_remitente'>";
	echo "<option value='$destino_remitente'>$nombre_destino_remitente</option>";
				echo "<option value='$registrotexto59'>$registrotexto59</option>";	
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";

?>
</div>
</td>

</tr>
</table>

</div>
<div id="titulo_campo_texto"  align="left">
<?php echo "<b>$registrotexto61</b>";?>
</div>
<div id="campo_input"   align="justify">
<input type="text" autocomplete="off" name="busqueda"  style='width:400px;clear:both'  value="<?php echo $texto_busqueda;?>">
</div>

<div id="titulo_campo_texto"  style='float:left;' align="left">
<?php echo "<b>$registrotexto69</b>";?>&nbsp;&nbsp;
<input type="text" autocomplete="off" name="enlaces_pagina"  style='width:40px;'  value="<?php echo $enlaces_pagina;?>">
</div>


<button  style='float:left;padding: 0px;margin-left:20px;margin-top:-5px;' name="boton" type="submit"  title="<?php echo $registrotexto68;?>"/>
<img src="<?php echo "$ruta_absoluta/images/vista_previa.png";?>" style='width:20px'>
</button>
</form>
<div id="campo_input"  align="justify"></div> 

<?php

$_pagi_cuantos = $_REQUEST['enlaces_pagina'];
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo = "borde";

if($entrada_salida=='e')
{


if ($busqueda!='')
		{
		$_pagi_sql="SELECT * FROM registro where  MATCH (asunto,nombre_archivo) AGAINST ('$busqueda' IN BOOlEAN MODE) and cod_centro='$upload_centro' $consulta_anyo $consulta_entrada_salida $consulta_tipo_documento $consulta_origen $consulta_organismo $consulta_destino order by anyo desc,codigo_registro desc";
		}
		else		
		{		
		$_pagi_sql = "SELECT * FROM registro where cod_centro='$upload_centro' $consulta_anyo $consulta_entrada_salida $consulta_tipo_documento $consulta_origen $consulta_organismo $consulta_destino order by anyo desc,codigo_registro desc";
		}
}



if($entrada_salida=='s'){
	
if ($busqueda!='')
					{
     	$_pagi_sql = "SELECT * FROM registro where MATCH (asunto,nombre_archivo) AGAINST ('$busqueda' IN BOOlEAN MODE) and  cod_centro='$upload_centro' $consulta_anyo $consulta_entrada_salida $consulta_tipo_documento_salida $consulta_destino_salida $consulta_organismo_salida $consulta_destino_remitente order by anyo desc,codigo_registro desc";
					}
					else		
					{		
					$_pagi_sql = "SELECT * FROM registro where cod_centro='$upload_centro' $consulta_anyo $consulta_entrada_salida $consulta_tipo_documento_salida $consulta_destino_salida $consulta_organismo_salida $consulta_destino_remitente order by anyo desc,codigo_registro desc";
					}
}

include("../paginator_listado.php");
?>

<div id="numeracion" >
<?php echo"<p>".$_pagi_navegacion."</p>";?>
</div>



<table class="borde_tabla" width="700px" style='float: left;'>
<?php
$i=1;
while ($row = mysql_fetch_array($_pagi_result))
{
$id_registro=($row ["id_registro"]);
$codigo_registro=($row ["codigo_registro"]);
$codigo_registro=str_pad($codigo_registro, 6, "0", STR_PAD_LEFT);

$fecha_entrada_salida=f_datef($row ["fecha_entrada_salida"]);
$fecha_registro=f_datef($row ["fecha_registro"]);
$entrada_salida=($row ["entrada_salida"]);
$tipo_documento=($row ["tipo_documento"]);
$asunto=nl2br($row ["asunto"]);

if($busqueda!='')
$asunto=(resaltar($busqueda,$asunto));


$observaciones=($row ["observaciones"]);
$origen=($row ["origen"]);
$procedencia=($row ["procedencia"]);
$organismo=($row ["organismo"]);
$destino=($row ["destino"]);
$anyo=($row ["anyo"]);
$nombre_archivo_texto=($row ["nombre_archivo"]);
$ruta_archivo=($row ["ruta_archivo"]);
$link_archivo=$ruta_absoluta.'/link_doc_registro/'.$upload_centro.'/'.$ruta_archivo;
$dirigido=($row ["dirigido"]);




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
		
	

if($dirigido!=0)
{
	$nombre_dirigido=mysql_query("SELECT nombre_usuario FROM usuarios where COD_CENTRO='$upload_centro' and usuario='$dirigido' ");
				$row = mysql_fetch_array($nombre_dirigido);
				  $nombre_dirigido=$row ["nombre_usuario"];
				}
				
else{
	$nombre_dirigido='';
	}

if($i%2==0)
	$color_backgrund="1";
	else
	$color_backgrund="2";
	
?>
<tr class='background<?php echo $color_backgrund;?>' >
<td>
<div id="listado_titulo" align="left"><?php echo $registrotexto7.': '?>
<span class="registro_listado_titulo"><?php echo $codigo_registro;?></span>

&nbsp; &nbsp; &nbsp; 
<?php 
if($entrada_salida=='e')
echo "<b>$registrotexto9: </b>";
else
echo "<b>$registrotexto62:   </b>";
?>
<span class="registro_listado_titulo">
<?php echo $fecha_entrada_salida;?>
</span>

&nbsp; &nbsp; &nbsp; 
<?php echo $registrotexto8.': '?><span class="registro_listado_titulo"><?php echo $fecha_registro;?></span>


&nbsp; &nbsp; &nbsp;
<?php echo $registrotexto6.': '?><span class="registro_listado_titulo"><?php echo $anyo;?></span>
</div>


<?php 
if($entrada_salida=='e')
{
?>
<div id="listado_titulo" align="left"><?php echo $registrotexto51.': '?>
<?php
}
else 
{
	?>
	<div id="listado_titulo" align="left"><?php echo $registrotexto54.': '?>
	<?php
	}
	?>

<span class="registro_listado_titulo"><?php echo $nombre_origen;?></span>
</div>
<div id="listado_titulo" align="left">
<?php echo $registrotexto52.': '?><span class="registro_listado_titulo"><?php echo $nombre_organismo;?></span>
<?php 
if($entrada_salida=='e')
{
	?>
<?php echo $registrotexto53.': '?><span class="registro_listado_titulo"><?php echo $procedencia;?></span>
</div>
<?php
}
else {
	?>
<?php echo $registrotexto58.': '?><span class="registro_listado_titulo"><?php echo $procedencia;?></span>
</div>
<?php
}
?>
<?php 
if($entrada_salida=='e')
{
?>
<div id="listado_titulo" align="left"><?php echo $registrotexto54.': '?>
<?php
}
else 
{
	?>
	<div id="listado_titulo" align="left"><?php echo $registrotexto51.': '?>
	<?php
	}
	?>
<span class="registro_listado_titulo"><?php echo $nombre_destino;?></span>
</div>

<div id="listado_titulo" align="left"><?php echo $registrotexto57.': '?>
<span class="registro_listado_titulo"><?php echo $nombre_docum;?></span>
</div>

<div id="listado_titulo" align="left"><?php echo $registrotexto17.': '?>
<span class="registro_listado_titulo"><?php echo $asunto;?></span>
</div>


<button  onclick="window.location.href='<?php echo "$ruta_absoluta/registro_entrada_guar/$id_registro/$entrada_salida";?>'" style='float:right;padding: 0px;margin-right:8px;margin-bottom:5px;' name="boton" type="button"  title="<?php echo $registrotexto56;?>"/>
<img src="<?php echo "$ruta_absoluta/images/editar.png";?>" style='width:25px'>
</button>


<?php
if($ruta_archivo!='')
{
?>
<div id="listado_titulo" align="left"><?php echo $registrotexto55.': '?>
<span id="enlaces_archivo"><a href='<?php echo $link_archivo;?>' target="_blank" ><?php echo $nombre_archivo_texto;?></span>
</div>
<?php
}
?>

</td>
</tr>
<?php
$i=$i+1;
}
desconectar();
?>


</table>
</div>



</div>





<div id="separador1"> </div>


<?php include ("../pie_pagina.php");?>


