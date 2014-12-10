<!--FORO DE SECRETICTAC-->

<div   style="margin:0px 5px 0px 0px;float:left; width:470px;border: 0px solid #9395af;"  >
<div id='cabecera_formulario' class='crsl-item' ">
<?php echo "<b>$rsstexto1</b>";?>
<div id="enlaces_rss_todas" align="right">
<a  href="http://edutictac.es/moodle/mod/forum/view.php?id=930" target="_blank"><?php echo $rsstexto2;?> &raquo;</a>
</div>
</div>
<?php
$numero_noticias='10';
$rss = simplexml_load_file('http://edutictac.es/moodle/rss/file.php/1724/cc2dfaa741f0878d8b6645bbaab38b13/mod_forum/177/rss.xml');

$i = 1;
foreach ($rss->channel->item as $item) {
	$k=1;

	$titulo=utf8_decode(htmlentities($item->title));
	
	$link=$item->link;
	$fecha=date('M d, Y ',strtotime($item->pubDate));
	$descripcion=(utf8_decode($item->description));
	$descripcion=str_replace("&quot;",'"',$descripcion);
$descripcion=str_replace($replace,$search,$descripcion);
$descripcion= str_replace("<p>","",$descripcion);
$descripcion= str_replace("</p>","",$descripcion);				
$descripcion=substr($descripcion,0,200)." (...)";

	if($i%2==0)
	$alineacion='float: right; clear: right;';
	else
	$alineacion='float: left; clear: left;';
	
	 echo "<div class='crsl-item' style='$alineacion;width:205;align:right'>";
	 
	 	echo "<div class='postdate' style='align:right;float:right;' >".$fecha."</div>";
 echo "<div id='enlaces_rss'  align='justify' style='margin:0px 5px 0px 5px;padding-right:10px;clear:both;'><a href='$link' target='_blank'>$titulo</a></div>";

  echo "<div id='enlaces_rss' align='justify' style='margin:0px 5px 0px 5px;padding-right:0px;'>" . $descripcion."</div>";
  echo "<p class='readmore'><a href='$link' target='_blank'>$rsstexto4	&raquo; </a></p>";

  echo "<div style='border-bottom: 0px solid #C00;margin:10px 15px 10px 105px'></div>";
  echo "</div>";

  
  $k=$k+1;
 if ($i++ == $numero_noticias)
 break;
} 

?>


</div>






<div   style="margin:0px 0px 0px 5px;float:left; width:230px;border: 0px solid #9395af;"  >
<div id='cabecera_formulario' class='crsl-item' style="width:235px; ">
<b><?php echo $rsstexto3;?></b>
<div id="enlaces_rss_todas" align="right">
<a  href="http://edutictac.es/moodle/mod/forum/view.php?id=931" target="_blank"><?php echo $rsstexto2;?> &raquo;</a>
</div>
</div>
<?php
$numero_noticias='10';
$rss = simplexml_load_file('http://edutictac.es/moodle/rss/file.php/1731/cc2dfaa741f0878d8b6645bbaab38b13/mod_forum/178/rss.xml');

$i = 1;
foreach ($rss->channel->item as $item) {
	$k=1;

	$titulo=utf8_decode (htmlentities($item->title));
	
	$link=$item->link;
	$fecha=date('M d, Y ',strtotime($item->pubDate));
	$descripcion=utf8_decode(($item->description));
	$descripcion=str_replace("&quot;",'"',$descripcion);
$descripcion=str_replace($replace,$search,$descripcion);
$descripcion= str_replace("<p>","",$descripcion);
$descripcion= str_replace("</p>","",$descripcion);				
$descripcion=substr($descripcion,0,400)." (...)";

	

	 echo "<div class='crsl-item_edutictac' style='float:left;width:230;'>";
	 	echo "<div class='postdate' style='align:right;float:right;' >".$fecha."</div>";
 echo "<div id='enlaces_rss'  align='justify' style='margin:0px 5px 0px 5px;padding-right:10px;clear:both;'><a href='$link' target='_blank'>$titulo</a></div>";

  echo "<div id='enlaces_rss' align='justify' style='margin:0px 5px 0px 5px;padding-right:0px;'>" . $descripcion."</div>";
  echo "<p class='readmore'><a href='$link' target='_blank'> $rsstexto4	&raquo; </a></p>";

  echo "<div style='border-bottom: 0px solid #C00;margin:10px 15px 10px 105px'></div>";
  echo "</div>";

  
  $k=$k+1;
 if ($i++ == $numero_noticias)
 break;
} 

?>


</div>


