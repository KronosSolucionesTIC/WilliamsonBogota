<?
//error_reporting(E_ERROR);

//echo "sitio es  ".$sitio_id; //exit;
if (!ereg('/$', $_SERVER['DOCUMENT_ROOT']))
  $_root = $_SERVER['DOCUMENT_ROOT'].'/';
else
  $_root = $_SERVER['DOCUMENT_ROOT'];

//echo $_root; exit;
//$_root = "c:/archivos de programa/easyphp1-7/www/lha/admin/";
$_root = "c:/appserv/www/esac";
//$spaw1 = "c:/appserv/www/alinova_produccion/admin/spaw/";

define('DR', $_root);
unset($_root);

// set $spaw_root variable to the physical path were control resides
// don't forget to modify other settings in config/spaw_control.config.php
// namely $spaw_dir and $spaw_base_url most likely require your modification
$spaw_root = DR.'spaw/';

//print $spaw_root; exit;

// include the control file
/*$p=$spaw_root.'spaw_control.class.php';
echo "spar_root en editor: $p";*/
//echo $spaw_root.'spaw_control.class.php'; exit();
//include $spaw_root.'spaw_control.class.php';
include '../spaw_control.class.php';

// here we add some styles to styles dropdown
$spaw_dropdown_data['style']['default'] = 'No styles';
$spaw_dropdown_data['style']['style1'] = 'Style no. 1';
$spaw_dropdown_data['style']['style2'] = 'Style no. 2';
?>

<html>
<head>
	<title>.:: Editor HTML ::.</title>
	<link href="../../../estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="loadEditor();" oncontextmenu="return false;">
<script language="JavaScript">

function cambiar_comillas (str) {
	do {    
		str = str.replace("'",'');
	} 
	while(str.indexOf("'") >= 0);
	//alert(str)
	return  str;
}

var str = 'cacao';str = str.replace('a','o');

function saveHTML() {

  if(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value] != null) 
  {
	var cadena=cambiar_comillas(this['spaw1_rEdit'].document.body.innerHTML);
	window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value =cadena ;
	//window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value = this['spaw1_rEdit'].document.body.innerHTML;
  }
//  alert(this['spaw1_rEdit'].document.body.innerHTML);
  isSaved = true;
  window.opener.focus();
  window.close();
}

function loadEditor() {
	
  if(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value != '')
  {
  	this['spaw1_rEdit'].document.designMode = 'On';
    this['spaw1_rEdit'].document.write(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value);
	this['spaw1_rEdit'].document.body.innerHTML = window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value;
    //alert(window.opener.document[document.spawdemo.parent_form.value].elements[document.spawdemo.parent_field.value].value);
	//alert();
  }
}
</script>
<style type="text/css">
  pre {
    background : #FFFFFF; 
    padding : 5 5 5 5;
  }
</style>

<SCRIPT>
	function cerrar_editorHtml(){
		if(confirm("NO SE HAN GUARDADO LOS CAMBIOS,¿DESEA CONTINUAR?"))
			window.close();
	}
</SCRIPT>

<form name="spawdemo" method="post" action="editor.php">
	<INPUT type="hidden" name="parent_form" value="<?=$parent_form?>">
    <INPUT type="hidden" name="parent_field" value="<?=$parent_field?>">
    <INPUT type="hidden" name="sitio_id" value="<?=$sitio_id?>">
<?
$sw = new SPAW_Wysiwyg('spaw1' ,stripslashes($HTTP_POST_VARS['spaw1']) /*value*/);
$sw->show();
?>
        <br> <input name="button" type="button" class="botones" value="Guardar" onClick="saveHTML();">
        &nbsp;&nbsp;&nbsp;&nbsp; <input name="button2" type="button" class="botones" onClick="cerrar_editorHtml();" value="Cerrar">
  </form>
</body>
</html>
