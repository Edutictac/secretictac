<nav>
<!--BOTON DESCONECTAR-->
<div id="boton" align="right"  style='float:right;padding: 0px 0px 0px 0px;'>
 <a href="<?php echo "$ruta_absoluta";?>/cerrar_sesion.php" class="button rojo delete"><?php echo $menu_boton_desconectar;?></a> 
</DIV>


<link href="<?php echo $ruta_absoluta;?>/css/styles.css" rel="stylesheet" type="text/css" />

<div class="menu_secretictac">
<ul class="contenedor" >

 <li><span  class="item_principal"><?php echo "$menu_inicio";?></span>
 
 			<ul class="item_secundario">
 						<li class='<?php echo $activado_inicio ;?>' ><a href="<?php echo "$ruta_absoluta";?>/inicio.php"><?php echo $pagina_inicio;?></a></li>
						
 				</ul>
 </li>
 
 <?php if ($permitir_registro==1){?>
 <li><span  class="item_principal"><?php echo "$registrotexto0";?></span>
 
 			<ul class="item_secundario">
 						<?php if ($permitir_entradas==1){?><li class='<?php echo $activado_entradas ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro_entrada/e"><?php echo $registrotexto1;?></a></li><?php }?>
							<?php if ($permitir_salidas==1){?><li class='<?php echo $activado_salidas ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro_entrada/s"><?php echo $registrotexto2;?></a></li><?php }?>
							<?php if ($permitir_listados==1){?><li class='<?php echo $activado_listados ;?>' ><a href="<?php echo "$ruta_absoluta";?>/registro/listado.php?anyo=<?php echo $upload_anyo_academico;?>&tipo_registro=e"><?php echo $registrotexto3;?></a></li><?php }?>
            	                   	
            	<?php if ($permitir_imprimir_libros==1){?><li class='<?php echo $activado_imprimir_libros ;?>' ><a href="<?php echo "$ruta_absoluta";?>/imprimir_libros"><?php echo $imprimirtexto1;?></a></li><?php }?>
						     	<?php if ($permitir_configuracion==1){?><li class='<?php echo $activado_configuracion ;?>' ><a href="<?php echo "$ruta_absoluta";?>/mantenimiento"><?php echo $registrotexto4;?></a></li><?php }?>
						
 				</ul>
 </li>
  <?php }?>
 
 <?php if ($permitir_compartir_documentos==1){?>
  <li><span  class="item_principal"><?php echo $compartirtexto26;?></span>
				<ul class="item_secundario">
 						<?php if ($permitir_subir_documentos==1){?><li class='<?php echo $activado_subir_documentos ;?>'><a href="<?php echo "$ruta_absoluta";?>/registro_archivos/0"><?php echo $compartirtexto27;?></a></li><?php }?>
				  	<?php if ($permitir_modificar_documentos==1){?><li class='<?php echo $activado_modificar_documentos ;?>'><a href="<?php echo "$ruta_absoluta";?>/modificar_documentos"><?php echo $compartirtexto32;?></a></li><?php }?>
 				</ul>
 </li>
 <?php }?>

<?php if ($permitir_administrador==1){?>
   <li><span  class="item_principal"><?php echo $tipo_texto3;?></span>
 			<ul class="item_secundario">
 						<?php if ($permitir_tipo_permisos==1){?><li class='<?php echo $activado_tivo_permisos ;?>'><a href="<?php echo $ruta_absoluta;?>/tipo_permisos"><?php echo $tipo_texto1;?></a></li> <?php }?>
						<?php if ($permitir_permisos==1){?><li class='<?php echo $activado_permisos ;?>'><a href="<?php echo $ruta_absoluta;?>/elegir_permiso"><?php echo $tipo_texto2;?></a></li><?php }?>
						<?php if ($permitir_crear_usuarios==1){?><li class='<?php echo $activado_crear_usuarios ;?>'><a href="<?php echo $ruta_absoluta;?>/crear_usuario"><?php echo $crear_usuarios1;?></a></li><?php }?>
						<?php if ($permitir_definir_centro==1){?><li class='<?php echo $activado_datos_centro ;?>'><a href="<?php echo $ruta_absoluta;?>/definir_centro"><?php echo $definir_centro1;?></a></li><?php }?>
 				 			
 				</ul>
 </li>
 <?php }?>
 
 
 </ul>
    
</div>

</nav>
