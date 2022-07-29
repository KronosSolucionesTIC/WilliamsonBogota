<?
include "../lib/sesion.php";
include("../lib/database.php");
			
$cod_estado = $_GET['cod_estado'];

 	$sql = "SELECT desc_est_arrend_equipo FROM estado_arrend_equipo
	WHERE cod_est_arrend_equipo = $cod_estado";
	$db = new Database();
	$db->query($sql);
	$db->next_row();	
	
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
			  <TD width="100%" class='ctablasup'><span class="textotabla1 Estilo1"><span class="Estilo5">EQUIPOS ORTOPEDICOS </span></span></TD>
		  </TR>
			
			
			<TR>
			  <TD align="center"><table width="82%" border="1" cellpadding="1" cellspacing="1" bordercolor="#333333" id="select_tablas" >
                <tr >
                  <td  class="boton">ESTADO:</td>
                  <td  class="boton"><span class="titulosup04">
                    <?=$db->desc_est_arrend_equipo?>
                  </span></td>
                  <td  class="boton">&nbsp;</td>
                  <td  class="boton">&nbsp;</td>
                  <td  class="boton">&nbsp;</td>
                </tr>
                <tr >
                  <td width="17%"  class="boton"><div align="center">ARTICULO</div></td>
                  <td width="37%"  class="boton"><div align="center">DESCRIPCION</div></td>
                  <td width="16%"  class="boton"><div align="right">CANON</div></td>
                  <td width="15%"  class="boton"><div align="right">DEPOSITO</div></td>
                  <td width="15%"  class="boton"><div align="right">VALOR ALQUILER </div></td>
                </tr>
                <?
				$sql_ver = "SELECT consecutivo_equipo,CONCAT(nom_clase,' ',nom_equipo,' ',desc_tipo_equipos) AS nombre,canon_arrend_equipo,valor_deposito,desc_est_arrend_equipo FROM equipos
				INNER JOIN estado_arrend_equipo ON ( estado_arrend_equipo.cod_est_arrend_equipo = equipos.estado_arrend_equipo )
    			INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo) 
				INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo) 
				WHERE estado_arrend_equipo= $cod_estado ORDER BY nombre";
				$db_ver = new Database();
				$db_ver->query($sql_ver);
				
					$estilo="formsleo";
					$total_equipos = 0;
					while($db_ver->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}
				?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$db_ver->consecutivo_equipo?>
                  </div></td>
                  <td  class="textotabla01">
                    <div align="center">
                      <?=$db_ver->nombre?>                  
                    </div></td>
                  <td  class="textotabla01"><div align="right">
                    <?=$db_ver->canon_arrend_equipo?>
                  </div></td>
                  <td  class="textotabla01"><div align="right">
                    <?=$db_ver->valor_deposito?>
                  </div></td>
                  <td  class="textotabla01">
                    <div align="right">
                      <? $total = $db_ver->canon_arrend_equipo+$db_ver->valor_deposito?>
                      <?=$total?>                  
                    </div></td>
                </tr>
                <? if($i==1) { $i=2; }
				else {$i=1;	 } 
				$total_equipos++;
				}  
				?>
                <tr >
                  <td colspan="5" >&nbsp;</td>
                </tr>
                <tr >
                  <td colspan="5" ><div align="right"><span class="boton">TOTAL DE EQUIPOS <?=$total_equipos?> EN ESTADO
                  <?=$db->desc_est_arrend_equipo?>
                  </span></div></td>
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
	