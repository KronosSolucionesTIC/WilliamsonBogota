<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if ($codigo!="") {
	  $sql ="SELECT * FROM sucursal   WHERE cod_suc = $codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();
}


if($guardar==1 and $codigo==0) { // RUTINA PARA  INSERTAR REGISTROS NUEVOS
	$campos="(nom_suc, nit_suc, cod_ciud_suc, direccion_suc, tel_suc, fax_suc, email_suc, cont_suc)";
	 $valores="('".$nombres."','".$nit."', '".$ciud_cod_ciud_suc."',  '".$dir."',  '".$tel1."','".$tel2."', '".$mail."', '".$contacto."')" ;
	
	$error=insertar("sucursal ",$campos,$valores); 
	if ($error==1) {
		header("Location: con_sucursal.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

if($guardar==1 and $codigo!=0) { // RUTINA PARA  editar REGISTROS 
	
	
	$campos="nom_suc='".$nombres."', nit_suc='".$nit."', cod_ciud_suc='".$ciud_cod_ciud_suc."',  direccion_suc='".$dir."',  tel_suc='".$tel1."', fax_suc='".$tel2."', email_suc='".$mail."', cont_suc='".$contacto."'";
	//exit;
	$error=editar("sucursal ",$campos,'cod_suc',$codigo); 
	if ($error==1) {
		header("Location: con_sucursal.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-size: 12px}
</style> 

<? inicio() ?>

<script language="javascript">
function datos_completos(){  
if (document.getElementById('nombres').value == "" ||  document.getElementById('nit').value == ""  )
	return false;
else
	return true;
}


function buscar_pais(ciudad, pais) {
var combo=document.getElementById(ciudad);
combo.options.length=0;
var cant=0;
<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT pais.nom_pais,pais.cod_pais, ciudad.nom_ciu, ciudad.cod_ciu, ciudad.cod_pais_ciu FROM ciudad INNER JOIN pais ON pais.cod_pais = cod_pais_ciu';
	$db->query($sql);
	while($db->next_row()){ 

		echo "if(document.getElementById(pais).value==$db->cod_pais) {";
		echo "combo.options[cant] = new Option('$db->nom_ciu','$db->cod_ciu');  ";
		echo  "cant++; } ";
	}
?>

}

function buscar_sucursal(){

var cajita_codigo=document.getElementById('nombres').value;
var vec_codigo = new Array;
<?
$dbdatos111= new  Database();
$sql ="select nom_suc from sucursal ";
$dbdatos111->query($sql);
$i = 0;
while($dbdatos111->next_row()){
	echo "vec_codigo[$i]= '$dbdatos111->nom_suc';\n";	
	$i++;
 
}

?>
var encontre=0;
for (j=0; j<<?=$i?>;j++){
	if(cajita_codigo==vec_codigo[j])
		encontre=1;
}

if(encontre==1){	
	alert('El sucursal  ya esta registrado')
	document.getElementById('nombres').value="";
	return false;
}

}
</script>

</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_sucursal.php"  method="post">
<table width="624" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td bgcolor="#E9E9E9"><table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
         <td width="5" height="19">&nbsp;</td>
        <td width="20" ><img src="imagenes/icoguardar.png" alt="Nuevo Registro" width="16" height="16" border="0"  onclick="cambio_guardar()" style="cursor:pointer"/></td>
        <td width="61" class="ctablaform">Guardar</td>
        <td width="21" class="ctablaform"><a href="con_sucursal.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_sucursal.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1">SUCURSAL:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<table width="629" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="66" class="textotabla1">Nombre:</td>
        <td width="153"><input name="nombres" id="nombres" type="text" class="textfield2"  value="<?=$dbdatos->nom_suc?>" onchange='buscar_sucursal()' />
          <span class="textorojo">*</span></td>
        <td width="18" align="left" class="textorojo">&nbsp;</td>
        <td width="61" class="textotabla1">Nit:</td>
        <td width="206"><input name="nit" id="nit" type="text" class="textfield2" onkeypress="return validaInt('%d', this,event)"  value="<?=$dbdatos->nit_suc?>"  />
          <span class="textorojo">*</span></td>
        <td width="96" class="textorojo">&nbsp;</td>
        <td width="29" class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Ciudad:</td>
        <td><? combo("ciud_cod_ciud_suc","ciudad","cod_ciu","nom_ciu",$dbdatos->cod_ciud_suc); ?>
		</td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Direccion:</td>
        <td><input name="dir" id="dir" type="text" class="textfield2"  value="<?=$dbdatos->direccion_suc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">Telefono:</td>
        <td><input name="tel1" id="tel1" type="text" class="textfield2"  value="<?=$dbdatos->tel_suc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
	  <tr>
	    <td class="textotabla1">Fax:</td>
	    <td><input name="tel2" id="tel2" type="text" class="textfield2"  value="<?=$dbdatos->fax_suc?>" /></td>
	    <td class="textorojo">&nbsp;</td>
	    <td class="textotabla1">E-mail:</td>
	    <td><input name="mail" id="mail" type="text" class="textfield2"  value="<?=$dbdatos->email_suc?>" /></td>
	    <td class="textorojo">&nbsp;</td>
	    <td class="textorojo">&nbsp;</td>
	    </tr>
	  <tr>
        <td class="textotabla1">Contacto:</td>
        <td><input name="contacto" id="contacto" type="text" class="textfield2"  value="<?=$dbdatos->cont_suc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
	  	  <tr>
        <td colspan="7" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
        </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center"><img src="imagenes/spacer.gif" alt="." width="624" height="4" /></div></td>
  </tr>
  
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>
</form> 

</body>
</html>

