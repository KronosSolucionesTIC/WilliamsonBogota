<?
include "../lib/sesion.php";
include("../lib/database.php");	
?>

<script language="javascript">
function imprimir(){
	document.getElementById('imp').style.display="none";
	document.getElementById('cer').style.display="none";
	window.print();
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
	 <title><?=$nombre_aplicacion?> -- PAGOS CARTERA --</title>
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
			  <TD width="100%" class='ctablasup'>PAGOS CARTERA</TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="98%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td width="11%"  class="boton"><div align="center">No IDENTIFICACION</div></td>
                  <td width="12%"  class="boton"><div align="center">CLIENTE</div></td>
                  <td width="11%"  class="boton"><div align="center">CONTRATO</div></td>
                  <td width="11%"  class="boton"><div align="center">ARTICULO</div></td>
                  <td width="11%"  class="boton"><div align="center">DESCRIPCION</div></td>
                  <td width="11%"  class="boton"><div align="center">0-30</div></td>
                  <td width="11%"  class="boton"><div align="center">31-60</div></td>
                  <td width="11%"  class="boton"><div align="center">61-90</div></td>
                  <td width="11%"  class="boton"><div align="center">+90</div></td>
                </tr>
                <?
				$sqlp = "SELECT cod_contrato,cod_equipo,fecha_ini_pago,saldo_pago,TIMESTAMPDIFF(DAY,(fecha_ini_pago),CURDATE()) as dias FROM pagos WHERE estado_pago=1 AND fecha_ini_pago <= CURDATE() ORDER BY fecha_ini_pago";
				$dbp = new Database();
				$dbp->query($sqlp);
				
					$estilo="formsleo";
					$total_contratos = 0;
					$total_a_pagar = 0;
					$total_recibido = 0;
					$total_saldo = 0;
					while($dbp->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
						 
						$contrato = $dbp->cod_contrato;	
						$cod_equipo = $dbp->cod_equipo;	
											  				
						$sqlcon = "SELECT consecutivo,cod_cliente FROM contrato_alquiler
						WHERE cod_calc = $contrato";
						$dbcon = new Database();
						$dbcon->query($sqlcon);
						$dbcon->next_row();
						$cliente = $dbcon->cod_cliente;
						
						$sqlc = "SELECT cedula_cli,nom1_cli,nom2_cli,apel1_cli,apel2_cli FROM cliente
						WHERE cod_cli = $cliente";
						$dbc = new Database();
						$dbc->query($sqlc);
						$dbc->next_row();
						
						$sqle = "SELECT consecutivo_equipo,nom_clase,nom_equipo,desc_tipo_equipos FROM equipos
						INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
						INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
						WHERE cod_equipo = $cod_equipo";
						$dbe = new Database();
						$dbe->query($sqle);
						$dbe->next_row();
				?>
				<? $fecha = $a."-".$ano; ?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$dbc->cedula_cli?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbc->nom1_cli?>
                    <?=$dbc->nom2_cli?>
                    <?=$dbc->apel1_cli?>
                    <?=$dbc->apel2_cli?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbcon->consecutivo?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbe->consecutivo_equipo?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbe->nom_clase?>
                    <?=$dbe->nom_equipo?>
                    <?=$dbe->desc_tipo_equipos?>
                  </div></td>
                  <td  class="textotabla01"><div align="right">
                    <? if($dbp->dias <= 30){?><?=$dbp->saldo_pago?>
					<? } else {?>
                    <?= 0 ?><? }?>
                  </div></td>
                  <td  class="textotabla01">
                    <div align="right">
                     <? if($dbp->dias >30 and $dbp->dias <= 60){?><?=$dbp->saldo_pago?>
                     <? } else {?>
                     <?= 0 ?><? }?>
                    </div></td>
                  <td  class="textotabla01"><div align="right">
                    <? if($dbp->dias > 60 and $dbp->dias <= 90){?><?=$dbp->saldo_pago?>
                    <? } else {?>
                    <?= 0 ?><? }?>
                  </div></td>
                  <td  class="textotabla01"><div align="right">
                     <? if($dbp->dias > 90){?><?=$dbp->saldo_pago?>
                     <? } else {?>
                     <?= 0 ?><? }?>
                  </div></td>
                </tr>
                <? if($i==1) { $i=2; }
				else {$i=1;	 } 
				$total_contratos++;
				}  
				?>
                <tr >
                  <td colspan="9" >&nbsp;</td>
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
	