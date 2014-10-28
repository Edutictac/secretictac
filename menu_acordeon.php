<nav>
<!--BOTON DESCONECTAR-->
<div id="boton" align="right">
 <a href="<?php echo "$ruta_absoluta";?>/cerrar_sesion.php" class="button rojo delete"><?php echo $menu_boton_desconectar;?></a> 
</DIV>

<link href="<?php echo $ruta_absoluta;?>/css/menu_ver/css/dcaccordion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $ruta_absoluta;?>/css/menu_ver/js/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo $ruta_absoluta;?>/css/menu_ver/js/jquery.cookie.js'></script>
<script type='text/javascript' src='<?php echo $ruta_absoluta;?>/css/menu_ver/js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?php echo $ruta_absoluta;?>/css/menu_ver/js/jquery.dcjqaccordion.2.7.min.js'></script>
<script type="text/javascript">
$(document).ready(function($){
					$('#accordion-1').dcAccordion({
						eventType: 'click',
						autoClose: true,
						saveState: true,
						disableLink: true,
						speed: 'slow',
						showCount: true,
						autoExpand: true,
						cookie	: 'dcjq-accordion-1',
						classExpand	 : 'dcjq-current-parent'
					});
					$('#accordion-2').dcAccordion({
						eventType: 'click',
						autoClose: true,
						saveState: false,
						disableLink: true,
						speed: 'fast',
						autoExpand: true,
						showCount: false
						
					});
					$('#accordion-3').dcAccordion({
						eventType: 'click',
						autoClose: false,
						saveState: false,
						disableLink: false,
						showCount: false,
						speed: 'slow'
					});
					$('#accordion-4').dcAccordion({
						eventType: 'hover',
						autoClose: true,
						saveState: true,
						disableLink: true,
						menuClose: false,
						speed: 'slow',
						showCount: true
					});
					$('#accordion-5').dcAccordion({
						eventType: 'hover',
						autoClose: false,
						saveState: true,
						disableLink: true,
						menuClose: true,
						speed: 'fast',
						showCount: true
					});
					$('#accordion-6').dcAccordion({
						eventType: 'hover',
						autoClose: false,
						saveState: false,
						disableLink: false,
						showCount: false,
						menuClose: true,
						speed: 'slow'
					});
});
</script>
<link href="<?php echo $ruta_absoluta;?>/css/menu_ver/css/skins/grey.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="grey demo-container">


<ul class="accordion"  id="accordion-2">
 <li><a href="#">REGISTRO</a>
 			<ul>
 						<li><a href="#">Part B</a></li>
						<li><a href="#">Part C</a></li>
						<li><a href="<?php echo $ruta_absoluta;?>/inicio.php">Part D</a></li>
 				</ul>
 </li>
 
  <li><a href="<?php echo "$ruta_absoluta";?>/registro_archivos/0">COMPARTIR DOCUMENTOS</a>

 </li>
 
<?php if ($permitir_administrador==1){?>
   <li><a href="#"><?php echo $tipo_texto3;?></a>
 			<ul>
 						<?php if ($permitir_tipo_permisos==1){?><li class="test"><a href="<?php echo $ruta_absoluta;?>/tipo_permisos"><?php echo $tipo_texto1;?></a></li> <?php }?>
						<?php if ($permitir_permisos==1){?><li><a href="<?php echo $ruta_absoluta;?>/elegir_permiso"><?php echo $tipo_texto2;?></a></li><?php }?>
						<?php if ($permitir_crear_usuarios==1){?><li><a href="<?php echo $ruta_absoluta;?>/crear_usuario"><?php echo $crear_usuarios1;?></a></li><?php }?>
						<?php if ($permitir_definir_centro==1){?><li><a href="<?php echo $ruta_absoluta;?>/definir_centro"><?php echo $definir_centro1;?></a></li><?php }?>
 				 			
 				</ul>
 </li>
 <?php }?>
 
 
 
    
</div>

</nav>
