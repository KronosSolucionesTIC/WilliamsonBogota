<? include("lib/database.php")?>
<? include("js/funciones.php")?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="js/js.js"></script>
 <script language="javascript">
function datos_completos()
{  
if(document.getElementById("tipo_cliente").value==0){
alert("Seleccione los campos");
	return false;
	}
	
else
	document.forma.submit();
	
}

function habilitar_responsable(){
if (document.getElementById('tipo_contrato').value == 1){
document.getElementById('tipo_responsable').disabled = true;
}
else {
document.getElementById('tipo_responsable').disabled = false;
}
}
</script>



<? inicio() ?>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/stylesforms.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="718" align="center">
<tr>
<td width="710" valign="top" >
<form id="forma" name="forma" method="post" action="man_cliente_arrend.php" enctype="multipart/form-data">
                  <table width="710" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td width="710" bgcolor="#E9E9E9"><table width="710" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td width="1"></td>
                          <td width="5" height="33"></td>
                          <td colspan="3" class="titulosupsub">SELECCIONE TIPO CLIENTE </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform">Tipo cliente : </td>
                          <td><select name="tipo_cliente" id="tipo_cliente" class="SELECT">
                              <option value="0">Seleccione</option>
                              <option value="1">Persona Natural</option>
                              <option value="2">Persona Juridica</option>
                          </select></td>
                          <td width="357"><span class="ctablaform">
                            <input type="button" name="Siguiente" value="Siguiente" onClick="datos_completos()">
                            <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>" />
                            <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
                            <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
                            <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
                          </span></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                    
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="710" height="5" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="bottom">&nbsp;</td>
                    </tr>
        </table>
	  </form>
</td>
</tr>
</table>						
</body>
</html>
