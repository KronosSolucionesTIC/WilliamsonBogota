<?
include "../lib/sesion.php";
include("../lib/database.php");
			
$cod_equipo = $_GET['cod_equipo'];
	
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
	 <title><?=$nombre_aplicacion?> -- EQUIPOS POR ESTADO --</title>
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
			  <TD width="100%" class='ctablasup'>EQUIPOS ALQUILADOS</TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="82%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td width="15%"  class="boton"><div align="center">CONTRATO</div></td>
                  <td width="15%"  class="boton"><div align="center">ARTICULO</div></td>
                  <td width="20%"  class="boton"><div align="center">DESCRIPCION</div></td>
                  <td width="20%"  class="boton"><div align="center">CLIENTE</div></td>
                  <td width="15%"  class="boton"><div align="center">FECHA ENTREGA</div></td>
                  <td width="15%"  class="boton"><div align="center">FECHA DEVOLUCION </div></td>
                </tr>
                <?
				$sql_con = "SELECT * FROM listado_equipos
				INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = listado_equipos.cod_contrato)
				INNER JOIN cliente ON (cliente.cod_cli = contrato_alquiler.cod_cliente)
				INNER JOIN equipos ON (equipos.cod_equipo = listado_equipos.cod_equipo)
				INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
				INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
				where listado_equipos.cod_equipo  = $cod_equipo";
				$db_con = new Database();
				$db_con->query($sql_con);
				
					$estilo="formsleo";
					$total_contratos = 0;
					$total_a_pagar = 0;
					$total_recibido = 0;
					$total_saldo = 0;
					while($db_con->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
						  $a = $db_ver->num_mes;
						  $ano = $db_ver->ano;
		switch ($a) 
		{
   case 1: $a="Enero"; break;
   case 2: $a="Febrero"; break;
   case 3: $a="Marzo"; break;
   case 4: $a="Abril"; break;
   case 5: $a="Mayo"; break;
   case 6: $a="Junio"; break;
   case 7: $a="Julio"; break;
   case 8: $a="Agosto"; break;
   case 9: $a="Septiembre"; break;
   case 10: $a="Octubre"; break;
   case 11: $a="Noviembre"; break;
   case 12: $a="Diciembre"; break;
		}
				?>
				<? $fecha = $a."-".$ano; ?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->consecutivo?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->consecutivo_equipo?>
                  </div></td>
                  <td  class="textotabla01">
				    <div align="center">
				      <?=$db_con->nom_clase?>
                      <?=$db_con->nom_equipo?>
                      <?=$db_con->desc_tipo_equipos?>                                  
			        </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->nom1_cli?>
                    <?=$db_con->nom2_cli?>
                    <?=$db_con->apel1_cli?>
                    <?=$db_con->apel2_cli?>
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->fecha_ini_contrato?>               
                  </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$db_con->fecha_fin_contrato?>                  
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
	