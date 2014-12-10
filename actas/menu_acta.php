<style>
#cssmenu{
	font-weight: bold;
  list-style: none;
  font-family: Arial, Helvetica, sans-serif;
  width: 700px;
  margin-bottom: 20px

 
}
#cssmenu ul li {
  float: left;
  margin-right: 0px;
}
#cssmenu ul li a {
  padding: 5px;
  color: #2e3191;
  font-size: 10px;
  text-decoration: none;
  background-color: #ffffff;
  border-right: 1px solid  #2e3191;
  border-left: 1px solid  #2e3191;
  border-top: 1px solid  #2e3191;
}


#cssmenu ul li a:hover,
#cssmenu ul li.active > a {
  color: #ffffff;
  background-color: #2e3191;
  padding-top: 10px;
  
}
.borde_tab{  	
  float: left;
  padding: 0px;
  border-bottom:5px;
  border-bottom-style: solid;
  border-bottom-color: #2e3191;
  
  
  }

</style>

<?php
if($div_seleccionado==1)
$activo1='active';
if($div_seleccionado==2)
$activo2='active';
if($div_seleccionado==3)
$activo3='active';
?>
<div id='cssmenu' class="borde_tab">
<ul>
   <li id='1' class='<?php echo $activo1;?>'><a href='#' onclick="mostrar(1)"><?php echo $actatexto51;?></a></li>
   <li id='2' class='<?php echo $activo2;?>'><a href='#' onclick="mostrar(2)"><?php echo $actatexto52;?></a></li>
   <li id='3' class='<?php echo $activo3;?>'><a href='#' onclick="mostrar(3)"><?php echo $actatexto53;?></a></li>

</ul>
</div>