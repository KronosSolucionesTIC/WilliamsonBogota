<?php 
// directory donde esta instalado el spaw
$spaw_dir = '/cerros/admin/spaw/';

// URL de tu sitio, y que servira de base a las imágenes
$spaw_base_url = 'http://claudia/cerros/';

if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
  $spaw_root = $_SERVER['DOCUMENT_ROOT'].$spaw_dir;
else
  $spaw_root = $_SERVER['DOCUMENT_ROOT'].substr($spaw_dir,1,strlen($spaw_dir)-1);
  
//Valores por defecto
$spaw_default_toolbars = 'default';
$spaw_default_theme = 'default';
$spaw_default_lang = 'es';
$spaw_default_css_stylesheet = $spaw_dir.'wysiwyg.css';

// Añadir el scrit dentro del spaw o como fichero independiente
$spaw_inline_js = false;

// default dropdown content
$spaw_dropdown_data['style']['default'] = 'Normal';

$spaw_dropdown_data['font']['Arial,Helvetica,Verdana, Sans Serif'] = 'Arial';
$spaw_dropdown_data['font']['Courier, Courier New'] = 'Courier';
$spaw_dropdown_data['font']['Tahoma, Verdana, Arial, Helvetica, Sans Serif'] = 'Tahoma';
$spaw_dropdown_data['font']['Times New Roman, Times, Serif'] = 'Times';
$spaw_dropdown_data['font']['Verdana, Tahoma, Arial, Helvetica, Sans Serif'] = 'Verdana';

$spaw_dropdown_data['fontsize']['1'] = '1';
$spaw_dropdown_data['fontsize']['2'] = '2';
$spaw_dropdown_data['fontsize']['3'] = '3';
$spaw_dropdown_data['fontsize']['4'] = '4';
$spaw_dropdown_data['fontsize']['5'] = '5';
$spaw_dropdown_data['fontsize']['6'] = '6';

$spaw_dropdown_data['paragraph']['Normal'] = 'Normal';
$spaw_dropdown_data['paragraph']['Heading 1'] = 'Heading 1';
$spaw_dropdown_data['paragraph']['Heading 2'] = 'Heading 2';
$spaw_dropdown_data['paragraph']['Heading 3'] = 'Heading 3';
$spaw_dropdown_data['paragraph']['Heading 4'] = 'Heading 4';
$spaw_dropdown_data['paragraph']['Heading 5'] = 'Heading 5';
$spaw_dropdown_data['paragraph']['Heading 6'] = 'Heading 6';

// VALORES RELACIONADOS CON LAS IMÁGENES

// Extensiones permitidas.
$spaw_valid_imgs = array('gif', 'jpg', 'jpeg', 'png');

// Permitir el UPLOAD de ficheros
$spaw_upload_allowed = true;

// Librerias de imágenes, respecto de la raiz de tu sitio
$spaw_imglibs = array(
  array(
    'value'   => 'images/',
    'text'    => 'Imagenes',
  ),
  );

?>
