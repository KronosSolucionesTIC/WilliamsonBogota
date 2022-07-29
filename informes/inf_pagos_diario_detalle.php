<?
include "../lib/sesion.php";
include("../lib/database.php");
			
$fecha = $_GET['fecha'];
	
?>
<script language="javascript">
function imprimir(){
	document.getElementById('imp').style.display="none";
	document.getElementById('cer').style.display="none";
	window.print();
}

function abrir(dato){
	  var url="../formatos/factura.php?codigo="+dato;
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
	 <title><?=$nombre_aplicacion?> -- PAGOS DIARIO DETALLE --</title>
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
			  <TD width="100%" class='ctablasup'>PAGOS DIARIO DETALLE</TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td width="15%"  class="boton"><div align="center">No FACTURA</div></td>
                  <td width="15%"  class="boton"><div align="center">FECHA FACTURA</div></td>
                  <td width="20%"  class="boton"><div align="center">TOTAL FACTURA</div></td>
                  <td width="20%"  class="boton"><div align="center">CLIENTE</div></td>
                  <td width="15%"  class="boton"><div align="center">FORMA DE PAGO</div></td>
                  <td width="15%"  class="boton"><div align="center">VER FACTURA</div></td>
                </tr>
                <?
				$sql_con = "SELECT * FROM factura 
				WHERE fech_factura = '$fecha' AND total_factura > 0 ORDER BY cliente";
				$db_con = new Database();
				$db_con->query($sql_con);
				
					$estilo="formsleo";
					while($db_con->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
						  
						  	$cod_cliente = $db_con->cliente;
							$sqlcl = "SELECT * FROM cliente 
							WHERE cod_cli = $cod_cliente";
							$dbcl = new Database();
							$dbcl->query($sqlcl);
							$dbcl->next_row();
							
							$forma_pago = $db_con->forma_pago;
							$sqlfp = "SELECT * FROM tipo_pago 
							WHERE cod_tipo_pago = $forma_pago";
							$dbfp = new Database();
							$dbfp->query($sqlfp);
							$dbfp->next_row();
				?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->cod_fac?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->fech_factura?>
                  </div></td>
                  <td  class="textotabla01"><div align="right">$
                      <?=number_format($db_con->total_factura,0,".",".")?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbcl->nom1_cli?>
                    <?=$dbcl->nom2_cli?>
                    <?=$dbcl->apel1_cli?>
                    <?=$dbcl->apel2_cli?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbfp->desc_tipo_pago?>               
                  </div></td>
                  <td  class="textotabla01"><div align="center"><img src='../imagenes/mirar.png' alt="" width='16' height='16'  style="cursor:pointer"  onclick="abrir(<?=$db_con->cod_fac?>)" /></div></td>
                </tr>
                <? if($i==1) { $i=2; }
				else {$i=1;	 } 
				$total_contratos++;
				}  
				?>
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
	