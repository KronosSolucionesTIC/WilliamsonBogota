<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="js/js.js"></script>
 <script language="javascript">
function datos_completos()
{  
if(document.getElementById("clientes").value==0 || document.getElementById("paciente").value==0 || document.getElementById("tipo_contrato").value==0){
alert("Seleccione los campos");
	return false; }
if (document.getElementById("tipo_contrato").value==2 && document.getElementById("responsable").value==0){
alert("Seleccione los campos");
}

else
	document.forma.submit();
	
}


function buscar_paciente(pac,cli ) {
var combo=document.getElementById(pac);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;

<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT cod_pac,cod_cliente,concat(apel1_pac," ",apel2_pac," ",nom1_pac," ",nom2_pac," - ",cedula_pac) as nombre_pac FROM paciente

INNER JOIN cliente ON (cliente.cod_cli  = paciente.cod_cliente) ORDER BY apel1_pac';

	$db->query($sql);
	while($db->next_row()){ 			
		echo "if(document.getElementById(cli).value==$db->cod_cliente) {";	
		echo "combo.options[cant] = new Option('$db->nombre_pac','$db->cod_pac'); ";	
		echo  "cant++; } ";
		
	}
	

?>

}

function abrir(dato){

var url="formatos/formato_contrato_cae.php?codigo="+dato;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")

}

function activar_responsable () {
if (document.getElementById('tipo_contrato').value == 1) {
document.getElementById('responsable').disabled = true ;
}
else {
document.getElementById('responsable').disabled = false ;
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
<form id="forma" name="forma" method="post" action="man_alquiler.php" enctype="multipart/form-data">
                  <table width="710" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td width="710" bgcolor="#E9E9E9"><table width="707" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="3" class="titulosupsub">SELECCIONE UN CLIENTE </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform">Tipo contrato:</td>
                          <td><? combo_evento("tipo_contrato","tipo_contrato","cod_tipo_contrato","desc_tipo_contrato","","onChange= activar_responsable()","desc_tipo_contrato"); ?></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="1"></td>
                          <td width="1" height="33"> </td>
                          <td width="121" class="ctablaform">Clientes: </td>
                          <td width="150"><? combo_evento1("clientes","cliente","cod_cli","nom1_cli","","onchange='buscar_paciente(\"paciente\",\"clientes\")'",    
							"apel1_cli"); ?>                            &nbsp;&nbsp;</a> </td>
                          <td width="150">&nbsp;</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform"> Responsable:</td>
                          <td><? combo_evento1("responsable","responsable","cod_cli","nom1_cli","","",    
							"apel1_cli"); ?></td>
                          <td>&nbsp;</td>
                        </tr>
                        
                          <tr>
                            <td></td>
                            <td height="33"></td>
                            <td class="ctablaform">Pacientes:</td>
                            <td class="ctablaform"><? combo_evento1("paciente","paciente","cod_pac","nom1_pac","","",    
							"apel1_pac"); ?></td>
                            <td class="ctablaform"><div align="right"><span class="titulosup04"> </span>
                              <input type="button" name="Siguiente" value="Siguiente" onClick="datos_completos()">
                              <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>" />
                              <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
                              <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
                              <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
                            </div></td>
                          </tr>
                          <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="3" class="ctablaform">&nbsp;</td>
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
