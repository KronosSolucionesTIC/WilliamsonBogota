<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?
if ($codigo!="") {

$sql ="SELECT * FROM usuario WHERE cod_usu=$codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();
}


if($guardar==1 and $codigo==0) { // RUTINA PARA  INSERTAT REGISTROS NUEVOS

	$compos="(nom_usu,cc_usu,tel_usu,dir_usu,log_usu,pas_usu,car_usu,ciu_usu,codig_usu,cod_rol_usu)";
	$valores="('".$nombres."',".$cc.",'".$tele."','".$dir."','".$login."','".$pass."','".$cargo."','".$sucursal."','".$codigo_usu."','".$rol."')" ;
	$error=insertar('usuario',$compos,$valores); 

	if ($error==1) {
		header("Location: con_usuario.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

if($guardar==1 and $codigo!=0) { // RUTINA PARA  editar REGISTROS NUEVOS
	$compos="nom_usu='".$nombres."',cc_usu=".$cc.",tel_usu='".$tele."',dir_usu='".$dir."',log_usu='".$login."',pas_usu='".$pass."',car_usu='".$cargo."',ciu_usu='".$sucursal."',codig_usu='".$codigo_usu."',cod_rol_usu='".$rol."'";
	$error=editar("usuario",$compos,'cod_usu',$codigo); 
	//echo $error; exit;
	if ($error==1) {
		header("Location: con_usuario.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
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
if (document.getElementById('nombres').value == "" || document.getElementById('cc').value == "" )
	return false;
else
	return true;
}

function buscar_documento(){

var cajita_codigo=document.getElementById('cc').value;
var vec_codigo = new Array;
<?
$dbdatos111= new  Database();
$sql ="select cc_usu from usuario";
$dbdatos111->query($sql);
$i = 0;
while($dbdatos111->next_row()){
	echo "vec_codigo[$i]= '$dbdatos111->cc_usu';\n";	
	$i++;
 
}

?>
var encontre=0;
for (j=0; j<<?=$i?>;j++){
	if(cajita_codigo==vec_codigo[j])
		encontre=1;
}

if(encontre==1){	
	alert('El Documento ya esta registrado')
	document.getElementById('cc').value="";
	return false;
}

}
</script>

</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_usuario.php"  method="post">
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
        <td width="21" class="ctablaform"><a href="con_usuario.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_usuario.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
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
    <td class="textotabla1 Estilo1">USUARIOS:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<table width="629" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="78" class="textotabla1">Nombres:</td>
        <td width="144"><input name="nombres" id="nombres" type="text" class="textfield2"  value="<?=$dbdatos->nom_usu?>" /></td>
        <td width="9"><span class="textorojo">*</span></td>
        <td width="64"><span class="textotabla1">Correo @ </span></td>
        <td width="150"><label>
          <input name="dir" type="text" class="textfield2" id="dir"  value="<?=$dbdatos->dir_usu?>" />
        </label></td>
        <td width="11" class="textorojo">*</td>
        <td width="173" class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Cedula:</td>
        <td><input name="cc" type="text" class="textfield2" id="cc" onkeypress="return validaInt('%d', this,event)" value="<?=$dbdatos->cc_usu?>" onchange='buscar_documento()'/></td>
        <td><span class="textorojo">*</span></td>
        <td><span class="textotabla1">Telefonos:</span></td>
        <td><a href="#">
          <input name="tele" type="text" class="textfield2" id="empresa2"  value="<?=$dbdatos->tel_usu?>"/>
        </a></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Login:</td>
        <td><input name="login" type="text" class="textfield2" id="login" value="<?=$dbdatos->log_usu?>"/></td>
        <td>&nbsp;</td>
        <td><span class="textotabla1">Password:</span></td>
        <td ><a href="#">
          <input name="pass" type="password" class="textfield2" id="pass"  value="<?=$dbdatos->pas_usu?>"/>
        </a></td>
        <td class="textorojo">&nbsp;</td>
        <td class="textorojo">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Cargo</td>
        <td><? combo_ord("cargo","cargo","cod_car","nom_car",$dbdatos->car_usu," order by nom_car"); ?></td>
        <td>&nbsp;</td>
        <td class="textotabla1">Sucursal:</td>
        <td><? combo_ord("sucursal","sucursal","cod_suc","nom_suc",$dbdatos->ciu_usu," order by nom_suc"); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Codigo:</td>
        <td><input name="codigo_usu" type="text" class="textfield2" id="codigo_usu" value="<?=$dbdatos->codig_usu?>"/></td>
        <td>&nbsp;</td>
        <td class="textotabla1">Rol de usuario: </td>
        <td><? combo_ord("rol","rol","cod_rol","nom_rol",$dbdatos->cod_rol_usu," order by nom_rol"); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center"><img src="imagenes/spacer.gif" alt="." width="624" height="4" /></div></td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />
	</td>
  </tr>
</table>
</form> 

</body>

</html>

