<?
include "../lib/sesion.php";
include("../lib/database.php");
			
$fecha_inicial = $_GET['fecha_inicial'];
$fecha_final = $_GET['fecha_final'];
	
?>
<script language="javascript">
function imprimir(){
	document.getElementById('imp').style.display="none";
	document.getElementById('cer').style.display="none";
	window.print();
}

function abrir_detalle(i){	
var url="inf_pagos_diario_detalle.php?fecha="+i;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
}

</script>
 <link href="styles.css" rel="stylesheet" type="text/css" />
 <link href="../styles.css" rel="stylesheet" type="text/css" />
 <style type="text/css">
<!--
.Estilo1 {font-size: 9px}
-->
 </style>
 <link href="../css/styles.css" rel="stylesheet" type="text/css" />
 <link href="../css/stylesforms.css" rel="stylesheet" type="text/css" />
	 <title><?=$nombre_aplicacion?> -- PAGOS DIARIO --</title>
 <style type="text/css">
<!--
.Estilo5 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
 </style>
 <TABLE width="100%" border="0" cellspacing="0" cellpadding="0"   >
	
	<TR>
		<TD align="center">
		<TABLE width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" >
		
			<INPUT type="hidden" name="mapa" value="<?=$mapa?>">
			<INPUT type="hidden" name="id" value="<?=$id?>">

			<TR>
			  <TD width="100%" class='ctablasup'>PAGOS DIARIO</TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="96%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td width="12%" height="27"  class="boton"><div align="center">FECHA</div></td>
                  <td width="13%"  class="boton"><div align="center">TOTAL</div></td>
                  <td width="13%"  class="boton"><div align="center">DETALLE</div></td>
                </tr>
                <?
				$sqldf = "SELECT fech_factura,SUM(total_factura) as suma_dia FROM factura 
				WHERE DATE(fech_factura) BETWEEN '$fecha_inicial' AND '$fecha_final' AND total_factura > 0 GROUP BY fech_factura ORDER BY fech_factura
";
				$dbdf = new Database();
				$dbdf->query($sqldf);
				
					$estilo="formsleo";
					$total = 0;
					$j = 0;
					while($dbdf->next_row()){ 	
						if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
						$j++;
						$sqltf = "SELECT SUM(total_factura) as suma_total FROM factura 
						WHERE DATE(fech_factura) BETWEEN '$fecha_inicial' AND '$fecha_final' AND total_factura > 0 ";
						$dbtf = new Database();
						$dbtf->query($sqltf);
						$dbtf->next_row();
				?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$dbdf->fech_factura?>
                  </div></td>
                  <td  class="textotabla01"><div align="right">
                    $
                    <?=number_format($dbdf->suma_dia,0,".",".")?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <input name="detalle" type="button"  class="botones" id="detalle" onclick="abrir_detalle('<?=$dbdf->fech_factura?>')" value="Ver detalle" />
                  </div></td>
                </tr>
                <? 	if($i==1) 
						{$i=2;}
					else {$i=1;} 
				}  
				?>
                <tr >
                  <td colspan="3" >&nbsp;</td>
                </tr>
                <tr >
                  <td colspan="2" class="boton"><div align="right">VALOR TOTAL PAGOS</div></td>
                  <td class="boton"><div align="right">$
                    <?=number_format($dbtf->suma_total,0,".",".")?>
                  </div></td>
                </tr>
              </table></TD>
		  <TR>
			  <TD align="center">             </TD>
		  </TR>
			<TR>
			  <TD align="center"><p></TD>
		  </TR>
</TABLE>

 
<TABLE width="70%" border="0" cellspacing="0" cellpadding="0">
	
	<TR><TD colspan="3" align="center"><input name="button" type="button"  class="botones1" id="imp" onClick="imprimir()" value="Imprimr">
        <input name="button" type="button"  class="botones1"  id="cer" onClick="window.close()" value="Cerrar"></TD>
	</TR>

	<TR>
		<TD width="1%" background="images/bordefondo.jpg" style="background-repeat:repeat-y" rowspan="2"></TD>
		<TD bgcolor="#F4F4F4" class="pag_actual">&nbsp;</TD>
		<TD width="1%" background="images/bordefondo.jpg" style="background-repeat:repeat-y" rowspan="2"></TD>
	</TR>
	<TR>
	  <TD align="center">
	