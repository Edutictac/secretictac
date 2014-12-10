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
   <li class='<?php echo $activo_tipo_asistente;?>'><a href='<?php echo "$ruta_absoluta";?>/tipo_asistentes'><?php echo $actatexto7;?></a></li>
   <li class='<?php echo $activo_tipo_acta;?>'><a href='<?php echo "$ruta_absoluta";?>/tipo_actas'><?php echo $actatexto8;?></a></li>
   <li class='<?php echo $activo_importar_asistentes;?>'><a href='<?php echo "$ruta_absoluta";?>/importar_asistentes'><?php echo $actatexto9;?></a></li>
   <li class='<?php echo $activo_firmas;?>'><a href='<?php echo "$ruta_absoluta";?>/actas_firmas'><?php echo $actatexto10;?></a></li>
   <li class='<?php echo $activo_permisos;?>'><a href='<?php echo "$ruta_absoluta";?>/permisos_ver_acta'><?php echo $actatexto60;?></a></li>

</ul>
</div>