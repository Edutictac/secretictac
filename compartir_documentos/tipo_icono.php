<?php
switch ($tipo_archivo) {
                case 'application/pdf':
                $imagen_cerrado=$ruta_absoluta.'/img/pdf.ico';
                break;
                case 'image/jpeg':
                $imagen_cerrado=$ruta_absoluta.'/img/jpg.ico';
                break;
                case 'application/vnd.oasis.opendocument.text':
                $imagen_cerrado=$ruta_absoluta.'/img/oow.ico';
                break;
                case 'application/msword':
                $imagen_cerrado=$ruta_absoluta.'/img/word.ico';
                break;
                case 'dropbox':
                $imagen_cerrado=$ruta_absoluta.'/img/drop.ico';
                break;
                 case 'application/excel':
                $imagen_cerrado=$ruta_absoluta.'/img/excel.ico';
                break;
                
                 case 'application/vnd.oasis.opendocument.spreadsheet':
                $imagen_cerrado=$ruta_absoluta.'/img/calc.ico';
                break;
                
                default:
                $imagen_cerrado=$ruta_absoluta.'/img/page.gif';
                break;
                }
?>
