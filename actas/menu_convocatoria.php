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


<div id='cssmenu' class="borde_tab">
<ul>
   <li class='<?php echo $activo_convocatoria;?>'><a href='<?php echo "$ruta_absoluta";?>/convocatorias_actas'><?php echo $actatexto79;?></a></li>
   <li class='<?php echo $activo_listado_convocatorias;?>'><a href='<?php echo "$ruta_absoluta";?>/listado_convocatorias'><?php echo $actatexto81;?></a></li>

</ul>
</div>