<script type="text/javascript" src="<?php echo $ruta_absoluta;?>/jquery-latest.js"></script>
<style>
#accordion {
 font-family: Arial, Helvetica, sans-serif;
 font-size:12px;
 list-style: none;
  padding: 0px;
  width: 200px;
  margin: 10px 20px 0px 0px;
   background-color: #2e3191;

 }
 #accordion div {
 display: block;
 font-weight: bold;
 color:white;
 cursor: pointer;
 padding: 5px;
 margin:0px;
 background-color: #2e3191;
 #background-image: url(images/flecha.png);
 #background-position: right center;
 #background-repeat:no-repeat;
 }
 
 #accordion ul {
 list-style-type: none;
 display: none;
 background: #eff2f5;
 
 }
 #accordion ul li {
 font-weight: normal;
 cursor: auto;
 padding: 5px;
 width: 187px;
 height: 15px;
 color: #2e3191;
 display:block;
 }
 #accordion ul li:hover {
 background-color: #d6dfec;
 font-weight: normal;
 color: #2e3191;
 display:block;
 }
  #accordion .activado {
 background-color: #d6dfec;
 font-weight: normal;
 padding: 5px;
 color: #2e3191;
 display:block;
 }
 #accordion a {
 text-decoration: none;
 color: #2e3191;
 display:block;
 }
</style>



<nav>
<!--BOTON DESCONECTAR-->
<div id="boton" align="right"  style='float:right;padding: 0px 0px 0px 0px;'>
 <a href="<?php echo "$ruta_absoluta";?>/cerrar_sesion.php" class="button rojo delete"><?php echo $menu_boton_desconectar;?></a> 
</DIV>




<div class="menu_secretictac">
<ul id="accordion" style="float:left">
	<li><div><?php echo "$menu_inicio";?></div></li>
	<ul id='inicio'>
		<li class='<?php echo $activado_inicio ;?>'><a href="<?php echo "$ruta_absoluta";?>/inicio.php"><?php echo $pagina_inicio;?></a></li>
		<li class='<?php echo $activado_instrucciones ;?>'><a href="<?php echo "$ruta_absoluta";?>/instrucciones.php"><?php echo $inicio_instrucciones;?></a></li>
	</ul>
	
 <?php if ($permitir_registro==1){?>					
					<li><div><?php echo "$registrotexto0";?></div></li>
					<ul id='registro'>
 							<?php if ($permitir_entradas==1){?><li class='<?php echo $activado_entradas ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro_entrada/e"><?php echo $registrotexto1;?></a></li><?php }?>
							<?php if ($permitir_salidas==1){?><li class='<?php echo $activado_salidas ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro_entrada/s"><?php echo $registrotexto2;?></a></li><?php }?>
							<?php if ($permitir_listados==1){?><li class='<?php echo $activado_listados ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro/listado.php?anyo=<?php echo $upload_anyo_academico;?>&tipo_registro=e"><?php echo $registrotexto3;?></a></li><?php }?>
            	                   	
            	<?php if ($permitir_imprimir_libros==1){?><li class='<?php echo $activado_imprimir_libros ;?>' ><a href="<?php echo "$ruta_absoluta";?>/imprimir_libros"><?php echo $imprimirtexto1;?></a></li><?php }?>
						     	<?php if ($permitir_configuracion==1){?><li class='<?php echo $activado_configuracion ;?>' ><a href="<?php echo "$ruta_absoluta";?>/mantenimiento"><?php echo $registrotexto4;?></a></li><?php }?>
					</ul>
  <?php }?>
  
   <?php if ($permitir_compartir_documentos==1){?>
					<li><div><?php echo $compartirtexto26;?></div></li>
					<ul id='documentos'>
		    	<?php if ($permitir_subir_documentos==1){?><li class='<?php echo $activado_subir_documentos ;?>'><a href="<?php echo "$ruta_absoluta";?>/registro_archivos/0"><?php echo $compartirtexto27;?></a></li><?php }?>
				  	<?php if ($permitir_modificar_documentos==1){?><li class='<?php echo $activado_modificar_documentos ;?>'><a href="<?php echo "$ruta_absoluta";?>/modificar_documentos"><?php echo $compartirtexto32;?></a></li><?php }?>
 			
					</ul>
	  <?php }?>


   <?php if ($permitir_actas==1){?>
					<li><div><?php echo $actatexto1;?></div></li>
					<ul id='actas'>
		    	<?php if ($permitir_crear_actas==1){?><li class='<?php echo $activado_crear_actas ;?>'><a href="<?php echo "$ruta_absoluta";?>/tipo_asistentes"><?php echo $actatexto2;?></a></li><?php }?>
 					 <?php if ($permitir_convocatorias_actas==1){?><li class='<?php echo $activado_convocatorias_actas ;?>'><a href="<?php echo "$ruta_absoluta";?>/convocatorias_actas"><?php echo $actatexto75;?></a></li><?php }?>  
        <?php if ($permitir_redactar_actas==1){?><li class='<?php echo $activado_redactar_actas ;?>'><a href="<?php echo "$ruta_absoluta";?>/redactar_actas"><?php echo $actatexto4;?></a></li><?php }?>
 					<?php if ($permitir_listado_actas==1){?><li class='<?php echo $activado_editar_actas ;?>'><a href="<?php echo "$ruta_absoluta";?>/editar_actas"><?php echo $actatexto3;?></a></li><?php }?>
					<?php if ($permitir_busqueda_actas==1){?><li class='<?php echo $activado_busqueda_actas ;?>'><a href="<?php echo "$ruta_absoluta";?>/busqueda_actas"><?php echo $actatexto74;?></a></li><?php }?>
 				 				
 				</ul>
	  <?php }?>






<?php if ($permitir_administrador==1){?>
					<li><div><?php echo $tipo_texto3;?></div></li>
					<ul id='configuracion'>
		      	<?php if ($permitir_tipo_permisos==1){?><li class='<?php echo $activado_tivo_permisos ;?>'><a href="<?php echo $ruta_absoluta;?>/tipo_permisos"><?php echo $tipo_texto1;?></a></li> <?php }?>
						<?php if ($permitir_permisos==1){?><li class='<?php echo $activado_permisos ;?>'><a href="<?php echo $ruta_absoluta;?>/elegir_permiso"><?php echo $tipo_texto2;?></a></li><?php }?>
						<?php if ($permitir_crear_usuarios==1){?><li class='<?php echo $activado_crear_usuarios ;?>'><a href="<?php echo $ruta_absoluta;?>/crear_usuario"><?php echo $crear_usuarios1;?></a></li><?php }?>
						<?php if ($permitir_definir_centro==1){?><li class='<?php echo $activado_datos_centro ;?>'><a href="<?php echo $ruta_absoluta;?>/definir_centro"><?php echo $definir_centro1;?></a></li><?php }?>
 				 			
					</ul>
			
	  <?php }?>
</ul>
</div>

<script>
$("#accordion > li").click(function(){

	if(false == $(this).next().is(':visible')) {
		$('#accordion > ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});

 $('#accordion > #<?php echo $activo;?> ').show();
</script>

</nav>
