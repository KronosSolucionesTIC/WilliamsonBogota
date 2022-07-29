<? include("conf/clave.php");?>
<? include("lib/database.php");
exit;
?>
<? 
$dbnom = new Database();
$sql ="select * from empresa where cod_jmc=1";
$dbnom->query($sql);
if($dbnom->next_row()){ 
	$nombre = $dbnom->nom_jmc;
}
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre?></title>

</head>
<script language="javascript">
function inicio() {
	if (document.getElementById("txt_usuario").value !="" & document.getElementById("txt_clave").value != "") {
		var ruta ="validar.php?usuario="+document.getElementById("txt_usuario").value + "&&clave=" + document.getElementById("txt_clave").value +"&&proyecto=1";
	    //menu=window.open(ruta,"sis_dis","toolbar=no,scrollbars=no,fullscreen=no");
	    menu=window.open(ruta,"sis_dis");
		document.forma.submit();
		//alert(menu.value)		
	}
	else {
		alert("Datos Incompletos");
		document.getElementById("txt_usuario").focus();
		}	
}

function alerta() {
	alert('Usuario No Autorizado, Rectifique sus Datos ');
}
</script>
<style type="text/css">
td img {display: block;}
</style>


<link href="css/styles.css" rel="stylesheet" type="text/css">
<table width="955" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="indextrainign.png" fwbase="index.gif" fwstyle="Dreamweaver" fwdocid = "444729399" fwnested="0" -->
  <tr>
    <td><img src="imagenes/spacer.gif" width="689" height="1" border="0" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="12" height="1" border="0" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="201" height="1" border="0" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="53" height="1" border="0" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4" class="" ><img name="cab_login" src="imagenes/cab_login.gif" width="955" height="94" border="0" id="cab_login" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="94" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><img name="foto" src="imagenes/foto.jpg" width="940" height="313" border="0" id="foto" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="313" border="0" alt="" /></td>
  </tr>
  <tr>
    <td rowspan="3"><img name="titulotrarining" src="imagenes/titulotrarining.png" width="689" height="156" border="0" id="titulotrarining" alt="" /></td>
    <td colspan="3"><img name="registro" src="imagenes/registro.gif" width="266" height="42" border="0" id="registro" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="42" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="index_r4_c2" src="imagenes/index_r4_c2.gif" width="12" height="79" border="0" id="index_r4_c2" alt="" /></td>
    <td valign="top" bgcolor="#ffffff"><table width="160" border="0" align="center">
      <tr>
        <td width="53" class="textotabla1">Usuario</td>
        <td width="97" class="textotabla1"><input name="txt_usuario" id="txt_usuario" type="text" class="textotabla01" size="10" /></td>
      </tr>
      <tr>
        <td class="textotabla1">Clave</td>
        <td class="textotabla1"><input name="txt_clave" id="txt_clave" type="password" class="textotabla01" size="10" /></td>
      </tr>
    </table>
        <p style="margin:0px;"></p></td>
    <td rowspan="2"><img name="index_r4_c4" src="imagenes/index_r4_c4.gif" width="53" height="114" border="0" id="index_r4_c4" alt="" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="79" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="2"><img src="imagenes/entrar.gif" alt="" name="entrar" width="213" height="35" border="0" usemap="#entrarMap" id="entrar" /></td>
    <td><img src="imagenes/spacer.gif" width="1" height="35" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="4" ><div align="right"><img src="imagenes/abajologin.jpg" alt="" name="abajologin" width="955" height="37" border="0" usemap="#abajologinMap" id="abajologin" /> <FONT color="#BDBCBA" size="1" ><STRONG style="text-align:right">Copyright  
        <?=date("Y");?>
        , Dise&ntilde;o y Desarrollo 
	      Kaome Estudio</STRONG></FONT> </div></td>
    <td><img src="imagenes/spacer.gif" width="1" height="37" border="0" alt="" /></td>
  </tr>
</table>
<map name="abajologinMap" id="abajologinMap">
  <area shape="rect" coords="807,4,904,20" href="#" />
</map>

<map name="entrarMap"><area shape="rect" coords="89,4,199,28" onClick="inicio()" style="cursor:pointer"></map>