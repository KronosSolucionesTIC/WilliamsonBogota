<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if ($codigo!="") {
$sql ="SELECT * FROM tamano_equipos  WHERE cod_tam_equipos=$codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();
}

if($guardar==1 and $codigo==0) { // RUTINA PARA  INSERTAR REGISTROS NUEVOS
	$compos="(cod_tam_equipos, desc_tam_equipos, cod_unidad, cod_clase_equipos)";
	$valores="('','".$nombres."','".$cod_unidad."','".$clase."')" ;
	$error=insertar("tamano_equipos",$compos,$valores); 
	if ($error==1) {
		header("Location: con_tamano_equipos.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
    {
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
    }
}

if($guardar==1 and $codigo!=0) { // RUTINA PARA  editar REGISTROS NUEVOS
	$compos="desc_tam_equipos='".$nombres."',cod_unidad='".$cod_unidad."',cod_clase_equipos='".$clase."'";
	$error=editar("tamano_equipos",$compos,'cod_tam_equipos',$codigo); 
	if ($error==1) {
		header("Location: con_tamano_equipos.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
    {
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
    }
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
if (document.getElementById('nombres').value == "" || document.getElementById('clase').value == 0 || document.getElementById('cod_unidad').value == 0 )
	return false;
else
	return true;
}

</script>

</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_tamano_equipos.php"  method="post">
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
        <td width="20" ><img src="imagenes/icoguardar.png" alt="Nueno Registro" width="16" height="16" border="0"  onclick="cambio_guardar()" style="cursor:pointer"/></td>
        <td width="61" class="ctablaform">Guardar</td>
        <td width="21" class="ctablaform"><a href="con_tamano_equipos.php?confirmacion=0&amp;editar=<?=$editar?>&amp;insertar=<?=$insertar?>&amp;eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_tamano_equipos.php?confirmacion=0&amp;editar=<?=$editar?>&amp;insertar=<?=$insertar?>&amp;eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
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
    <td class="textotabla1 Estilo1">TAMA&Ntilde;O EQUIPOS :</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<table width="629" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="textotabla1">Clase: </td>
        <td><? combo_evento("clase","clase_equipos","cod_clase","nom_clase",$dbdatos->cod_clase_equipos,"onchange='cargar_tipos(\"cod_partes\",\"tamano\",\"tipo\",\"nombre_equipo\",\"clase\")'", "nom_clase")?> 
            <span class="textorojo"> *</span></td>
        <td>&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td width="87" class="textotabla1">Valor:</td>
        <td width="120"><input name="nombres" type="text" class="textfield2" id="nombres"  value="<?=$dbdatos->desc_tam_equipos?>" maxlength="20" /></td>
       <td width="12"><span class="textorojo">*</span></td>
        <td width="67" class="textotabla1">Unidad:</td>
        <td width="124"><span class="textotabla1">
          <? combo_evento_where2("cod_unidad","unidades","cod_unidades","desc_unidades",$dbdatos->cod_unidad,"","cod_med_unidades='1'","desc_unidades"); ?>
        </span></td>
        </tr>
	  <tr> 
	  	<td class="textotabla1">&nbsp;</td>
		<td colspan="4">&nbsp;</td>
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
