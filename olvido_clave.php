<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? include("js/correo_clave.php")?>	

<?
	if($envio==1){
		$db = new Database();
		$sql ="SELECT count(*) as cantidad FROM usuario WHERE cc_usu='$cedula' and dir_usu='$correo'";
		$db->query($sql);
		$db->next_row();
		$existe_usu=0;
		
		if($db->cantidad >0 )
		{
			$existe_usu=1;
		}
		
		if($existe_usu==1){
			$sql ="SELECT * FROM usuario INNER JOIN cargo ON cod_car=car_usu WHERE cc_usu='$cedula' and dir_usu='$correo'";
			$db->query($sql);
			$db->next_row();
			$codigo_usu=$db->cod_usu;
			$correo_usu=$db->dir_usu;
			$cedula_usu=$db->cc_usu;
			$nombre_usu=$db->nom_usu;
			$cargo_usu=$db->nom_car;
			$login=$db->log_usu;
			$password=$db->pas_usu;
			
			envios_clave($codigo_usu,$correo_usu,$cedula_usu,$nombre_usu,$cargo_usu, $login, $password);
			
		}
	} 
?>
<script language="javascript">
function inicio() {
	document.getElementById('envio').value=1
	document.forma.submit();
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link rel="shortcut icon" href="http://www.arandasoft.com/images/aranda.ico">-->
<title>.: Net-Kargo - Olvido su contrase&ntilde;a :.</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href="css/dialog_box.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <table width="955" border="0" align="center" cellpadding="0" cellspacing="0">
    <!-- fwtable fwsrc="plantilla_registro.png" fwpage="Page 1" fwbase="plantilla2.jpg" fwstyle="Dreamweaver" fwdocid = "1402732885" fwnested="0" -->
    <tr>
      <td><img src="img/spacer.gif" width="955" height="1" border="0" alt="" /></td>

      <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>

    <tr>

      <td align="center"><img align="absmiddle" name="cabez_registro" src="imagenes/cab_clave.png" width="955" height="161" border="0" id="cabez_registro" alt="" /></td>

      <td><img src="img/spacer.gif" width="1" height="161" border="0" alt="" /></td>
    </tr>

    <tr>

      <td background="imagenes/cuerpo_clavepng.png">
	  <form name="forma" id="forma" enctype="multipart/form-data" method="post">
	  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1">
        <tbody>
          <tr>
            <td colspan="3" class="asterisco">¿Olvido su contraseña? </td>
          </tr>
          <tr>
            <td colspan="3"  class="login"><br />
              <label>Net-Kargo enviara las instrucciones sobre como restablecer su contrase&ntilde;a a la direccion de correo electronico asociado a su cuenta. </label><br /><br /></td>
          </tr>
          <tr>
            <td height="11" colspan="3"  class="login" >Por favor escriba su correo electronico y cedula. </td>
          </tr>
          <tr>
            <td width="22%" height="12"  >&nbsp;</td>
            <td width="52%" class="normal" >&nbsp;</td>
            <td width="26%" rowspan="5" class="normal" valign="top" ><img src="imagenes/llave.png" width="67" height="126" /></td>
          </tr>
          <tr>
            <td height="12" bgcolor="#F2F4F7" class="normalforms Estilo1" ><strong>Correo Electronico: </strong></td>
            <td class="normal" ><input type="text" name="correo" class="forms" id="correo" /></td>
          </tr>
          <tr>
            <td bgcolor="#F2F4F7" class="normalforms Estilo1" >Cedula:</td>
            <td class="normal" ><input type="text" name="cedula" class="forms" id="cedula" /></td>
          </tr>
          <tr>
            <td >&nbsp; </td>
            <td class="normal" >&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"  ><table width="500" border="0" 

                        align="center" cellpadding="0" cellspacing="0">
             
                <tr >
                  <td align="right" bgcolor="#FFFFFF"><img src="img/spacer.gif" alt="111" width="1" height="1" /></td>
                </tr>
                <tr >
                  <td align="right" bgcolor="#63747C"><img src="img/spacer.gif" width="1" height="1" /></td>
                </tr>
                <tr >
                  <td height="30" align="right"><label>
				  <input type="hidden" name="envio" id="envio">
                    <input type="button" value="Enviar" class="botonforms" onClick="inicio()" style="cursor:pointer" />
                    </label>
                     <INPUT type="button" value="Cerrar" class="botonforms" onClick="window.close()" style="cursor:pointer"></td>
                </tr>
                <tr >
                  <td align="right" bgcolor="#63747C"><img src="img/spacer.gif" alt="1" width="1" height="1" /></td>
                </tr>
                <tr >
                  <td align="right" bgcolor="#FFFFFF"></td>
                </tr>
                <tr >
                  <td align="right" bgcolor="#FFFFFF"></td>
                </tr>
              
            </table></td>
          </tr>
        </tbody>
      </table>
	  </form>
	  </td>
      <td><img src="img/spacer.gif" width="1" height="378" border="0" alt="" /></td>
    </tr>

    <tr>

      <td valign="top">&nbsp;</td>

      <td><img src="img/spacer.gif" width="1" height="86" border="0" alt="" /></td>
    </tr>
  </table>
</body>
</html>