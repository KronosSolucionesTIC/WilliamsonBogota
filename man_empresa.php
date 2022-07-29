<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if ($codigo!="") {
	$sql ="SELECT * FROM empresa  WHERE cod_jmc = $codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();
}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { // RUTINA PARA  INSERTAR REGISTROS NUEVOS
if($logo != NULL){ 
		$file = $logo_name;
		copy("$logo","images/$file");
        $campos="(nom_jmc, nit_jmc, tel_jmc, dir_jmc, pag_jmc, mail_jmc, logo_jmc, fax_jmc, lugar_jmc)";
	    $valores="('".$nombres."','".$nit."','".$tel."','".$dir."','".$pag."','".$mail."', '".$file."','".$fax."', '".$lugar."')" ;
	    $error=insertar("empresa",$campos,$valores); 
	}
	else {
	    $campos="(nom_jmc, nit_jmc, tel_jmc, dir_jmc, pag_jmc, mail_jmc, fax_jmc, lugar_jmc)";
	    $valores="('".$nombres."','".$nit."','".$tel."','".$dir."','".$pag."','".$mail."','".$fax."', '".$lugar."')" ;
	    $error=insertar("empresa",$campos,$valores); 
	}

	if ($error==1) {
		header("Location: con_empresa.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

if($guardar==1 and $codigo!=0) { // RUTINA PARA  editar REGISTROS 

    if($logo != NULL){ 
		$file = $logo_name;
		copy("$logo","images/$file");
		$campos="nom_jmc='".$nombres."', nit_jmc='".$nit."',  tel_jmc='".$tel."', dir_jmc='".$dir."', pag_jmc='".$pag."', mail_jmc='".$mail."', logo_jmc='".$file."', fax_jmc='".$fax."', lugar_jmc='".$lugar."' ";
	$error=editar("empresa",$campos,'cod_jmc',$codigo);  
	}	
	else {
	$campos="nom_jmc='".$nombres."', nit_jmc='".$nit."',  tel_jmc='".$tel."', dir_jmc='".$dir."', pag_jmc='".$pag."', mail_jmc='".$mail."',fax_jmc='".$fax."',lugar_jmc='".$lugar."' ";
	//exit;
	$error=editar("empresa",$campos,'cod_jmc',$codigo); 
	
	}
	
	if ($error==1) {
		header("Location: con_empresa.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

</script>

</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_empresa.php"  method="post" enctype="multipart/form-data">
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
        <td width="21" class="ctablaform"><a href="con_empresa.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_empresa.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
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
    <td class="textotabla1 Estilo1">EMPRESA:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<table width="629" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="69" class="textotabla1">Nombre:</td>
        <td width="218"><input name="nombres" id="nombres" type="text" class="textfield2"  value="<?=$dbdatos->nom_jmc?>" />
          <span class="textorojo">*</span></td>
        <td width="18" align="left" class="textorojo">&nbsp;</td>
        <td width="61" class="textotabla1">Nit:</td>
        <td width="206"><input name="nit" id="nit" type="text" onkeypress="return validaInt('%d', this,event)" class="textfield2"  value="<?=$dbdatos->nit_jmc?>"  />
          <span class="textorojo">*</span></td>
        <td width="96" class="textorojo">&nbsp;</td>
        <td width="103" class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Direccion:</td>
        <td><input name="dir" id="dir" type="text" class="textfield2"  value="<?=$dbdatos->dir_jmc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">Telefono:</td>
        <td><input name="tel" id="tel" type="text" class="textfield2"  value="<?=$dbdatos->tel_jmc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
	  <tr>
        <td class="textotabla1">Pagina:</td>
        <td><input name="pag" id="pag" type="text" class="textfield2"  value="<?=$dbdatos->pag_jmc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">E-mail:</td>
        <td><input name="mail" id="mail" type="text" class="textfield2"  value="<?=$dbdatos->mail_jmc?>" /></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
	  	  <tr>
	  	    <td class="textotabla1">Fax:</td>
	  	    <td class="textfield2"><input name="fax" id="fax" type="text" class="textfield2"  value="<?=$dbdatos->fax_jmc?>" /></td>
	  	    <td>&nbsp;</td>
	  	    <td class="textotabla1">Lugar:</td>
	  	    <td><span class="textfield2">
	  	      <input name="lugar" id="lugar" type="text" class="textfield2"  value="<?=$dbdatos->lugar_jmc?>" />
	  	    </span></td>
	  	    <td class="textorojo">&nbsp;</td>
	  	    <td class="textorojo">&nbsp;</td>
  	      </tr>
	  	  <tr>
        <td width="69" class="textotabla1">Logo:</td>
        <td width="218" class="textfield2"><input type="file" name="logo" class='botones'/></td>
        <td width="18">&nbsp;</td>
        <td width="61">&nbsp;</td>
        <td width="206"><? if($dbdatos->logo_jmc != NULL) echo '<img src="images/'.$dbdatos->logo_jmc.'" alt="Logo de la empresa" width="24" height="24" border="0" />' ?></td>
        <td width="96" class="textorojo">&nbsp;</td>
        <td width="103" class="textorojo">&nbsp;</td>
      </tr>
	  	  <tr>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center"><img src="imagenes/spacer.gif" alt="." width="624" height="4" /></div></td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />
	</td>
  </tr>
</table>
</form> 

</body>
</html>
