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
if(document.getElementById("clientes").value==0){
	alert("Seleccione un cliente");
	return false; 
}

if(document.getElementById("contrato").value==0){
	alert("Seleccione un contrato");
	return false;
}

else 
	valor = valida_pagos();
	if(valor == 1){
		return false;
	}
	else {
		document.forma.submit();
	}
}



function buscar_contrato(con,cli) {
var combo=document.getElementById(con);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT * FROM contrato_alquiler
	WHERE estado_contrato = 1';

	$db->query($sql);
	while($db->next_row()){ 
		echo "if(document.getElementById(cli).value==$db->cod_cliente) {";	
		echo "combo.options[cant] = new Option('$db->consecutivo','$db->cod_calc'); ";	
		echo  "cant++; } ";
		
	}
	

?>

}

function valida_pagos(){
<?
		$sqlp ="SELECT *,MONTH(fecha_ini_pago) as num_mes_ini,YEAR(fecha_ini_pago) as ano_ini,DAY(fecha_ini_pago) as dia_ini,MONTH(fecha_fin_pago) as num_mes_fin,YEAR(fecha_fin_pago) as ano_fin,DAY(fecha_fin_pago) as dia_fin FROM `pagos` 
		INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = pagos.cod_contrato)
		INNER JOIN equipos ON (equipos.cod_equipo = pagos.cod_equipo)
		INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
		INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
		WHERE `saldo_pago` >0 and fecha_ini_pago <= CURDATE() ORDER BY fecha_ini_pago ASC";
				$dbdatosp= new  Database();
				$dbdatosp->query($sqlp);
				while ($dbdatosp->next_row()){
					echo "if(document.getElementById('contrato').value==$dbdatosp->cod_contrato){";
					echo "alert('Hay cuotas pendientes con el contrato');";
					echo "return 1;";
					echo "}";
				}
				
?>
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
<form id="forma" name="forma" method="post" action="man_pagos2.php" enctype="multipart/form-data">
                  <table width="710" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td width="710" bgcolor="#E9E9E9"><table width="707" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="9" class="titulosupsub">SELECCIONE UN CLIENTE </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="9" class="ctablaform"> ! IMPORTANTE PARA REALIZAR PAGOS X ADELANTADO EL CLIENTE SE DEBE ENCONTRAR AL DIA EN LOS PAGOS &iexcl;</td>
                        </tr>
                        <tr>
                          <td width="1"></td>
                          <td width="1" height="33"> </td>
                          <td width="121" class="ctablaform">Clientes: </td>
                          <td colspan="8">
                            <? combo_evento1("clientes","cliente","cod_cli","nom1_cli","","onchange='buscar_contrato(\"contrato\",\"clientes\")'",    
							"apel1_cli"); ?>                            &nbsp;&nbsp;</a>						 </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform">contratos:</td>
                          <td><? combo_evento_where("contrato","contrato_alquiler","cod_pac","nom1_pac","","onchange='cargar_equipos(\"contrato\")'"," WHERE cod_contrato = 1 ORDER BY nom1_pac"); ?></td>
                          <td align="center">&nbsp;</td>
                          <td class="ctablaform">No cuotas</td>
                          <td align="center">
                            <select name="cuotas" id="cuotas">
                            <option value="0">Seleccione...</option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                          </select></td>
                          <td align="center">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td class="ctablaform">&nbsp;</td>
                          <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td class="ctablaform">
                          </td>
         				  <td width="150"><div id="equipos" style="display:none" class="ctablaform">prueba</div></td>
                          <td width="4" align="center"></td>
                          <td width="133" align="center">&nbsp;</td>
                          <td width="109" align="center">&nbsp;</td>
                          <td width="13" align="center">&nbsp;</td>
                          <td width="61">&nbsp;</td>
                          <td width="4" class="ctablaform">&nbsp;</td>
                          <td width="110" align="center"><div align="left"></div></td>
                        </tr>
                          <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="9" class="ctablaform">
                            <div align="right"><span class="titulosup04">                            </span>
                              <input type="button" name="Siguiente" value="Siguiente" onClick="datos_completos()">
                              <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>" />
                              <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
                              <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
                              <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
                            </div></td>
                         </tr>
                      </table></td>
                    </tr>
                    
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="710" height="5" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="bottom"><span class="titulosup04">
                      <input name="contador" id="contador" type="hidden" class="textfield013" />
                      </span></td>
                    </tr>
        </table>
	  </form>
</td>
</tr>
</table>						
</body>
</html>
