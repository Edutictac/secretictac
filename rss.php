<style>

/*RSS*/
/** noticias inicio **/
/** contenedor mas noticias **/
#enlaces_rss{
text-decoration: none;
color: #3B5998;
font-family: Arial, Helvetica, sans-serif;
padding: 0px 0 0 0;
font-size: 12px;

}
#enlaces_rss a{
text-decoration: none;
color: #0000ff;
}

#enlaces_rss a:hover{
text-decoration: underline;
color: #DF1602;
}

#enlaces_rss_todas{
text-decoration: none;
color: #ffffff;
font-family: Arial, Helvetica, sans-serif;
padding: 0px 0 0 0;
font-size: 14px;

}
#enlaces_rss_todas a{
text-decoration: none;
color: #ffffff;
}

#enlaces_rss_todas a:hover{
text-decoration: underline;
color: #DF1602;
}
	#titulo_modulo4{
   font-family: Arial, Helvetica, sans-serif;
   font-size:16px;
   color:#ffffff;
   padding: 5px;
   background:#c0c0c0;
    display:block;
}
.crsl-item {
  background: #f0f0f0;
  padding: 8px;
   margin: 4px 0px 4px 0px;
  -webkit-box-shadow: 0 2px 3px rgba(0,0,0,1);
  -moz-box-shadow: 0 2px 3px rgba(0,0,0,1);
  box-shadow: 0 2px 3px rgba(0,0,0,0.4);
  font-family: Arial, Helvetica, sans-serif;
   font-size: 12px;
}


/** fecha **/

.crsl-item .postdate {
  display:inline-block;
  padding: 6px;
     margin: 0px 0px 7px 0px;
  color: #fff;
  text-shadow: 1px 1px 0 rgba(0,0,0,0.4);
  font-size: 12px;
  font-weight: bold;
  background: #4e90da;
  text-align: left;

}



/** leer mas **/

.crsl-item p.readmore a {
  display: block;
  float: right;
  color: #4e90da;
  bottom: 0;
  padding: 3px 5px;
  text-decoration: none;
  font-weight: bold;
  font-family: Arial, Helvetica, sans-serif;
  -webkit-border-radius: 3px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  
}


.crsl-item p.readmore a:hover {
  background: #4b6caa;
  color: #fff;
}

/** titulo **/
.crsl-item h3 {
font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  margin-bottom: 12px;
  color:#3B5998;
  padding: 10px 0px 5px 0px;
}
.crsl-item h3 a {
  text-decoration: none;
  color:#3B5998;
}
.crsl-item h3 a:hover {
  text-decoration: underline;
}

.clear_clase {
	padding-top: 10px;
  clear: both;
} 
/** hasta aqui noticias inicio **/



</style>

<div   style="margin:0px 10px 0px 20px;float:left; width:275px;border: 0px solid #9395af;"  >
<div id='titulo_modulo4' class='crsl-item' style="width:280px; ">
<?php
 if($idioma=="val")
{
 echo "<b>NOTICIES SECRETICTAC</b>";
 $ver_todas='Veure totes';
}
 if($idioma=="cas")
{

 echo "<b>NOTICIAS SECRETICTAC</b>";
 $ver_todas='Ver todas';
}
?>
<div id="enlaces_rss_todas" align="right">
<a  href="http://aulares.com/noticias_rss.php" target="_blank"><?php echo $ver_todas;?> &raquo;</a>
</div>
</div>
<?php
$numero_noticias='10';
$rss = simplexml_load_file('http://aulares.com/actualizacion/rss_secretictac/rss_secretictac.php');

$i = 1;
foreach ($rss->channel->item as $item) {
	$k=1;

	$titulo=utf8_decode(htmlentities($item->title));
	
	$link=$item->link;
	$fecha=date('M d, Y ',strtotime($item->pubDate));
	$descripcion=utf8_decode(($item->description));
	$descripcion=str_replace("&quot;",'"',$descripcion);
$descripcion=str_replace($replace,$search,$descripcion);
$descripcion= str_replace("<p>","",$descripcion);
$descripcion= str_replace("</p>","",$descripcion);				
	

	 echo "<div class='crsl-item' style='float:left;width:275;'>";
	 	echo "<div class='postdate' style='align:right;float:right;' >".$fecha."</div>";
 echo "<div id='enlaces_rss'  align='justify' style='margin:0px 5px 0px 5px;padding-right:10px;clear:both;'><a href='$link' target='_blank'>$titulo</a></div>";

  echo "<div id='enlaces_rss' align='justify' style='margin:0px 5px 0px 5px;padding-right:0px;'>" . $descripcion."</div>";
  echo "<p class='readmore'><a href='$link' target='_blank'> Continuar llegint	&raquo; </a></p>";

  echo "<div style='border-bottom: 0px solid #C00;margin:10px 15px 10px 105px'></div>";
  echo "</div>";

  
  $k=$k+1;
 if ($i++ == $numero_noticias) break;
} 

?>


</div>
