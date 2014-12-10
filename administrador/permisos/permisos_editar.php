<?php
include ("../../permisos.php");
?>

<script>

function valida_codigo(){
       var a="GUARDAR";
       document.Form1.nombre_boton.value=a;
       document.Form1.submit();
 }

function cerrar(){
var a="CERRAR";
document.Form1.nombre_boton.value=a;
document.Form1.submit();}

</script>

<style type="text/css">
#ver_menu_principal{
   padding: 0px 0px 0px 10px;
   font-family: Arial, Helvetica, sans-serif;
   font-weight: bold;
   font-size:14px;
   color:#002f00;
   vertical-align: middle;

      }
#ver_menu_secundario{
   padding: 0px 0px 0px 30px;
   font-family: Arial, Helvetica, sans-serif;
   font-size:13px;
   color:#002f00;
   vertical-align: middle;

      }
#ver_menu_terciario{
   padding: 0px 0px 0px 50px;
   font-family: Arial, Helvetica, sans-serif;
   font-size:12px;
   color:#002f00;
    font-style: italic;
    	vertical-align: middle;

      }

#ver_menu_cuarto{
   padding: 0px 0px 0px 70px;
   font-family: Arial, Helvetica, sans-serif;
   font-size:12px;
   color:#002f00;
    font-style: italic;
    	vertical-align: middle;
      }
</style>


<?php
$eleccion_tipo=$_POST['tipo_usuario'];
conectar();


$nombre_permiso = mysql_query("SELECT tipo FROM 1_tipos_permisos where cod_centro='$upload_centro' and id_tipo='$eleccion_tipo'");
while ($row1 = mysql_fetch_array($nombre_permiso))
{
$tipo_nombre= ($row1 ["tipo"]);
}

$acceso_permitido = mysql_query("SELECT permisos FROM 1_permisos where cod_centro='$upload_centro' and id_tipo='$permiso'");
while ($row = mysql_fetch_array($acceso_permitido ))
{
$permiso_acceso_pagina= ($row ["permisos"]);
}

if ($permiso_acceso_pagina!=1)
{
echo "<script>alert('PERMISO DENEGADO');</script>";
echo "<script>location.href='$ruta_absoluta/cerrar_sesion.php';</script>";

}

?>
<div id="container">
<div id="tabla_centrar2" align='left'>
<?php
$activo='configuracion';
$activado_permisos="activado";
include ("../../menu.php");
?>

<div id="titulo_1" align='left'>
<b><?php echo "$editar_permisos1";?></b>
</div>

<div id="campo_input" style="float:left;padding-top:10px;width:700px;" align="justify">
<?php echo "$editar_permisos5";?>
</div>

<div id="campo_input" align="justify">
<?php echo "$editar_permisos4 <b>$tipo_nombre</b>";?>
</div>

<div id="" align="left">
<form  name="Form1" method="post" action="<?php echo "$ruta_absoluta";?>/upload_permisos_usuarios"  id="Form1">
<?php

$tipo_permiso = mysql_query("SELECT * FROM 1_permisos where cod_centro='$upload_centro' and id_tipo= '$eleccion_tipo'");
while ($row = mysql_fetch_array($tipo_permiso))
{
$ver_administrador= ($row ["administrador"]);
$ver_tipos_permisos= ($row ["tipo_permisos"]);
$ver_permisos= ($row ["permisos"]);
$ver_crear_usuarios= ($row ["crear_usuarios"]);
$ver_definir_centro= ($row ["definir_centro"]);
$ver_compartir_documentos= ($row ["compartir_documentos"]);
$ver_subir_documentos= ($row ["subir_documentos"]);
$ver_modificar_documentos= ($row ["modificar_documentos"]);

$ver_entradas=($row ["entradas"]);
$ver_salidas=($row ["salidas"]);
$ver_listados=($row ["listados"]);
$ver_configuracion=($row ["configuracion"]);
$ver_registro=($row ["registro"]);
$ver_imprimir_libros=($row ["imprimir_libros"]);
$ver_actas=($row ["actas"]);
$ver_crear_actas=($row ["crear_actas"]);
$ver_listado_actas=($row ["listado_actas"]);
$ver_redactar_actas=($row ["redactar_actas"]);
$ver_busqueda_actas=($row ["busqueda_actas"]);
$ver_convocatorias_actas=($row ["convocatorias_actas"]);
}
?>

<div id="ver_menu_principal">
<input id="ver_menu_principal" type="checkbox" name="registro"   <?php if ($ver_registro=='1') echo "checked"; ?>>
<?php echo "$registrotexto0";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="entradas"   <?php if ($ver_entradas=='1') echo "checked"; ?>>
<?php echo "$registrotexto1";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="salidas"   <?php if ($ver_salidas=='1') echo "checked"; ?>>
<?php echo "$registrotexto2";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="listados"   <?php if ($ver_listados=='1') echo "checked"; ?>>
<?php echo "$registrotexto3";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="imprimir_libros"   <?php if ($ver_imprimir_libros=='1') echo "checked"; ?>>
<?php echo "$registrotexto3";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="configuracion"   <?php if ($ver_configuracion=='1') echo "checked"; ?>>
<?php echo "$registrotexto4";?>
</div>




<div id="ver_menu_principal">
<input id="ver_menu_principal" type="checkbox" name="documentos_compar"   <?php if ($ver_compartir_documentos=='1') echo "checked"; ?>>
<?php echo "$compartirtexto26";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="subir_docum"   <?php if ($ver_subir_documentos=='1') echo "checked"; ?>>
<?php echo "$compartirtexto27";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="modif_docum"   <?php if ($ver_modificar_documentos=='1') echo "checked"; ?>>
<?php echo "$compartirtexto32";?>
</div>






<div id="ver_menu_principal">
<input id="ver_menu_principal" type="checkbox" name="actas"   <?php if ($ver_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto1";?>
</div>


<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="tipos_actas"   <?php if ($ver_crear_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto2";?>
</div>


<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="convocatorias_actas"   <?php if ($ver_convocatorias_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto75";?>
</div>


<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="redactar_actas"   <?php if ($ver_redactar_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto4";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="listar_actas"   <?php if ($ver_listado_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto3";?>
</div>


<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" name="busqueda_actas"   <?php if ($ver_busqueda_actas=='1') echo "checked"; ?>>
<?php echo "$actatexto74";?>
</div>










<div id="ver_menu_principal">
<input id="ver_menu_principal" type="checkbox" <?php if ($eleccion_tipo==1) ;?> name="administrador"   <?php if ($ver_administrador=='1') echo "checked"; ?>>
<?php echo "$tipo_texto3";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" <?php if ($eleccion_tipo==1) ;?> name="tipo_permisos"   <?php if ($ver_tipos_permisos=='1') echo "checked"; ?>>
<?php echo "$tipo_texto1";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" <?php if ($eleccion_tipo==1) ;?> name="permisos"   <?php if ($ver_permisos=='1') echo "checked"; ?>>
<?php echo "$tipo_texto2";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario"type="checkbox" <?php if ($eleccion_tipo==1) ;?> name="crear_usuarios"   <?php if ($ver_crear_usuarios=='1') echo "checked"; ?>>
<?php echo "$crear_usuarios1";?>
</div>

<div id="ver_menu_secundario">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="ver_menu_secundario" type="checkbox" <?php if ($eleccion_tipo==1) ;?> name="definir_centro"   <?php if ($ver_definir_centro=='1') echo "checked"; ?>>
<?php echo "$definir_centro1";?>
</div>

<input type="hidden" id="Editbox2" name="tipo_usuario"  value='<?php echo "$eleccion_tipo"; ?>'>

<div id="campo_input"></div>

<!--variable para seleccionar el tipo de boton apretado-->
<input type="hidden" maxlength="20" id="Editbox2" name="nombre_boton" tabindex=2 value="">

<input name ="boton" type="button"  onclick="valida_codigo();" value="<?php echo "$boton_guardar";?>" >
<input name ="boton" type="button"  onclick="cerrar()" value="<?php echo "$boton_volver";?>" >

</form>

</div>



<?php
desconectar();
?>

</div>

<?php include ("../../pie_pagina.php");?>

</div>
</BODY>
</HTML>
