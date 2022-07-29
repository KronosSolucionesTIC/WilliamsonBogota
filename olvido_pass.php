<? include("conf/clave.php")?>
<? include("lib/database.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:::: JMC LOGISTICS CARGO LTDA :::</title>
<style type="text/css">
<!--
body {
	background-image: url(imagenes/naranja.jpg);
	background-repeat: repeat;
	
}
.Estilo3 {font-size: 12px}
.Estilo4 {
	font-size: 12px;
	color: #CCCCCC;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.Estilo5 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 12px; font-family: Geneva, Arial, Helvetica, sans-serif; }
-->
</style>

<style type="text/css">
.Estilo4 {color: #FF9900; font-weight: bold; }
</style>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/stylesforms.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 16px}
-->
</style>
</head>
<script language="javascript">
function inicio() {
	if (document.getElementById("txt_usuario").value !="" & document.getElementById("txt_clave").value != "") {
		location.href = "confirmar.php?nit="+document.getElementById("txt_usuario").value&"usuario="+document.getElementById("txt_clave").value;
		document.forma.submit();		
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
<body onContextMenu="return false" background="imagenes/naranja.jpg">
<form  action="confirmar.php" name="forma" method="post" >
  <div align="center"  >
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="200" border="2" cellpadding="2" cellspacing="1" bordercolor="#FF7A15"  bgcolor="#FFFFFF">
  <tr>
    <td><table width="244" border="0" cellspacing="1" cellpadding="3"  align="center">
      <tr>
        <td colspan="2" class="titulosup"><div align="center" class="Estilo4">Olvido su contrase&ntilde;a. </div></td>
      </tr>
      <tr>
        <td width="87"><span class="Estilo4">Nit/CC:</span></td>
        <td width="132"><input name="txt_usuario" type="text" class="textotabla01" id="txt_usuario">        </td>
      </tr>
      <tr>
        <td><span class="Estilo4">Usuario:</span></td>
        <td><input name="txt_clave" type="text" class="textotabla01" id="txt_clave"></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><img src="imagenes/btninicio.gif" style="cursor:pointer" alt="inicio" width="140" height="20" onClick="inicio()"></div></td>
        </tr>
    </table>
      <div align="center"></div></td>
  </tr>
</table>
</div>

</form>

</body>
</html>

