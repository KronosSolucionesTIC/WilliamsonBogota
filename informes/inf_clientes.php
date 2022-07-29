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
	 <title><?=$nombre_aplicacion?> -- CLIENTES --</title>
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
			  <TD width="100%" class='ctablasup'>CLIENTES</TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="99%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td width="14%"  class="boton"><div align="center">CLIENTE</div></td>
                  <td width="10%"  class="boton"><div align="center">CONTRATO</div></td>
                  <td width="10%"  class="boton"><div align="center">ARTICULO</div></td>
                  <td width="11%"  class="boton"><div align="center">DESCRIPCION</div></td>
                  <td width="11%"  class="boton"><div align="center">FECHA ENTREGA</div></td>
                  <td width="11%"  class="boton"><div align="center">FECHA ULTIMPO PAGO</div></td>
                  <td width="11%"  class="boton"><div align="center">VALOR ULTIMO PAGO</div></td>
                  <td width="11%"  class="boton"><div align="center">SALDO DEUDA</div></td>
                </tr>
                <?
				$sqlup = "SELECT cod_contrato,cod_equipo,valor_recibido,saldo_pago,MAX(fecha_ini_pago) as fecha_ultimo_pago FROM pagos WHERE valor_recibido > 0 GROUP BY cod_contrato,cod_equipo";
				$dbup = new Database();
				$dbup->query($sqlup);
				
					$estilo="formsleo";
					while($dbup->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
					
					$cod_contrato =  $dbup->cod_contrato; 
					$sqlcon = "SELECT * FROM contrato_alquiler WHERE cod_calc = $cod_contrato";
					$dbcon = new Database();
					$dbcon->query($sqlcon);
					$dbcon->next_row();
					
					$cod_cliente =  $dbcon->cod_cliente; 
					$sqlcl = "SELECT CONCAT(apel1_cli,' ',apel2_cli,' ',nom1_cli,' ',nom2_cli) as nombre FROM cliente WHERE cod_cli = $cod_cliente";
					$dbcl = new Database();
					$dbcl->query($sqlcl);
					$dbcl->next_row();
					
					$cod_equipo =  $dbup->cod_equipo; 
					$sqle = "SELECT consecutivo_equipo,nom_clase,nom_equipo,desc_tipo_equipos FROM equipos
					INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
					INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
					WHERE cod_equipo = $cod_equipo";
					$dbe = new Database();
					$dbe->query($sqle);					
					$dbe->next_row();

					$sqlsd = "SELECT SUM(saldo_pago) as saldo_pago FROM pagos WHERE cod_equipo = $cod_equipo AND cod_contrato = $cod_contrato";
					$dbsd = new Database();
					$dbsd->query($sqlsd);					
					$dbsd->next_row();
						  
				?>
                <tr bgcolor="<?=$color?>">
                  <td height="27"  class="textotabla01"><div align="center">
                    <?=$dbcl->nombre?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbcon->consecutivo?>
                  </div></td>
                  <td  class="textotabla01">
				    <div align="center">
				      <?=$dbe->consecutivo_equipo?>
			      </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbe->nom_clase?>
                    <?=$dbe->nom_equipo?>
                    <?=$dbe->desc_tipo_equipos?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbcon->fecha_ini_contrato?>               
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbup->fecha_ultimo_pago?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbup->valor_recibido?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbsd->saldo_pago?>
                  </div></td>
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
	