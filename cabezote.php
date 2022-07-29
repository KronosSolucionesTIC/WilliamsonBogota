<?
$sql ="SELECT * FROM empresa 	WHERE cod_jmc = 1";
	$dbdatos= new  Database();
	$dbdatos->query($sql);
	$dbdatos->next_row(); 
?>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/stylesforms.css" rel="stylesheet" type="text/css">
<table width="100%" border="1" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <td rowspan="3" bgcolor="#FFFFFF" align="center"><div align="center" class="Estilo1" bgcolor="#FFFFFF"><img src="../images/<?=$dbdatos->logo_jmc?>" width="160" height="74"/></div></td>
	<?
$sql ="SELECT consecutivo_cotizacion_mcot, nom_tser, cod_tser_mcot FROM m_cotizacion inner join tipo_servicio on cod_tser=cod_tser_mcot ";
	$dbda= new  Database();
	$dbda->query($sql);
	$dbda->next_row(); 
?>
    <td colspan="2" bgcolor="#FFFFFF" class="titulosup02"><div align="center" class="Estilo1">FORMATO DE COTIZACION <?=strtoupper($dbda->nom_tser)?></div></td>
    <td bgcolor="#FFFFFF" class="textotabla01"><div align="center" class="Estilo1">VERSION 1 </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" class="titulosup02"><div align="center" class="Estilo1">FIA-ADC-052</div></td>
    <td bgcolor="#FFFFFF" class="textotabla01"><div align="center" class="Estilo1">FECHA FEBRERO DEL 2008</div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="titulosup02"><div align="center" class="Estilo1">COTIZACION No </div></td>
    <td bgcolor="#FFFFFF" class="titulosup02"><div align="center" class="Estilo1" bgcolor="#FFFFFF"><?=$dbda->consecutivo_cotizacion_mcot?></div></td>
    <td bgcolor="#FFFFFF" class="textotabla01"><div align="center" class="Estilo1">PAGINA 1 DE 1</div></td>
  </tr>
</table>

