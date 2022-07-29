<?
error_reporting(E_ERROR);
if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
  $_root = $_SERVER['DOCUMENT_ROOT'].'/';
else
  $_root = $_SERVER['DOCUMENT_ROOT'];

//print $_root; exit;
$_root = "c:/apache/htdocs/Adecco/admin/administrador";


define('DR', $_root);
unset($_root);

// set $spaw_root variable to the physical path were control resides
// don't forget to modify other settings in config/spaw_control.config.php
// namely $spaw_dir and $spaw_base_url most likely require your modification
$spaw_root = DR.'/spaw/';

// include the control file
include $spaw_root.'spaw_control.class.php';

// here we add some styles to styles dropdown
$spaw_dropdown_data['style']['default'] = 'No styles';
$spaw_dropdown_data['style']['style1'] = 'Style no. 1';
$spaw_dropdown_data['style']['style2'] = 'Style no. 2';
?>

<html>
<head>
	<title>.:: Editor HTML ::.</title>
<link href="../lib/themes/default/css/dialog.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="loadEditor();">
<script>
function saveHTML() {
  if(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value] != null) {
	window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value = this['spaw1_rEdit'].document.body.innerHTML;
//	window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value = spaw1.document.body.innerHTML;
  }
//alert(this['spaw1_rEdit'].document.body.innerHTML);
  isSaved = true;
  window.opener.focus();
  window.close();
}

function loadEditor() {

  if(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value != '')
  {
  	this['spaw1_rEdit'].document.designMode = 'On';
//    this['spaw1_rEdit'].document.open();
	//this['spaw1_rEdit'].document.write('<style>table {border: 1px dotted #999999};td {border: 1px dotted #BBBBBB};body {font-family: Verdana,sans-serif; color: #000000; font-size: 10pt}</style>');
    this['spaw1_rEdit'].document.write(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value);
	this['spaw1_rEdit'].document.body.innerHTML = window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value;
//    this['spaw1_rEdit'].document.close();
//	alert(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value);
  }
}
</script>
<style type="text/css">
  pre {
    background : #FFFFFF;
    padding : 5 5 5 5;
  }
</style>
<form name="spawdemo" method="post" action="editor.php">
	<INPUT type="hidden" name="parent_form" value="<?= $parent_form?>">
    <INPUT type="hidden" name="parent_field" value="<?= $parent_field?>">
	<INPUT type="hidden" name="tmpdir" value="<?= $temp_dir?>">
        <?
$sw = new SPAW_Wysiwyg('spaw1' /*name*/,stripslashes($HTTP_POST_VARS['spaw1']) /*value*/);
$sw->show();
?>
        <br> <input name="button" type="button" class="bt" value="Guardar" onClick="saveHTML();">
        &nbsp;&nbsp;&nbsp;&nbsp; <input name="button2" type="button" class="bt" onClick="window.close();" value="Cerrar">
  </form>
</body>
</html>
