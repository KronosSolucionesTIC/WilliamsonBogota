<?
include "../lib/sesion.php";
include("../lib/database.php");

$cod_clase = $_GET['cod_clase'];
$cod_tipo = $_GET['cod_tipo'];		
$cod_estado = $_GET['cod_estado'];
	
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
                  <td width="15%"  class="boton"><div align="center">ARTICULO</div></td>
                  <td width="20%"  class="boton"><div align="center">DESCRIPCION</div></td>
                  <td width="15%"  class="boton"><div align="center">ESTADO</div></td>
                </tr>
                <?
				if($cod_tipo == 0){
				$sql = "SELECT cod_equipo,consecutivo_equipo FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = $cod_estado";
				$db = new Database();
				$db->query($sql);
				
					$estilo="formsleo";
					while($db->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}

						$cod_equipo = $db->cod_equipo;					
				
						$sqle = "SELECT nom_clase,nom_equipo,desc_tipo_equipos FROM equipos
						INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
						INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
						WHERE cod_equipo = $cod_equipo";
						$dbe = new Database();
						$dbe->query($sqle);					
						$dbe->next_row();
						
						$sqlee = "SELECT * FROM estado_arrend_equipo
						WHERE cod_est_arrend_equipo = $cod_estado";
						$dbee = new Database();
						$dbee->query($sqlee);					
						$dbee->next_row();
					
				?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$db->consecutivo_equipo?>
                  </div></td>
                  <td  class="textotabla01">
				    <div align="center">
				      <?=$dbe->nom_clase?>
                      <?=$dbe->nom_equipo?>
                      <?=$dbe->desc_tipo_equipos?>                                  
			        </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbee->desc_est_arrend_equipo?>               
                  </div></td>
                </tr>
                <? if($i==1) { $i=2; }
				else {$i=1;	 }  
				?>
                <? } } ?>
                
                <?
				if($cod_tipo != 0){
				$sql = "SELECT cod_equipo,consecutivo_equipo FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = $cod_estado AND tipo_equipo = $cod_tipo";
				$db = new Database();
				$db->query($sql);
				
					$estilo="formsleo";
					while($db->next_row()){ 	
						  if($i==1) {$color='#CCCCCC'; $color_est='#FFFFFF';} else {$color='#FFFFFF'; $color_est='#F2F4F7';}

						$cod_equipo = $db->cod_equipo;					
				
						$sqle = "SELECT nom_clase,nom_equipo,desc_tipo_equipos FROM equipos
						INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
						INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
						WHERE cod_equipo = $cod_equipo";
						$dbe = new Database();
						$dbe->query($sqle);					
						$dbe->next_row();
						
						$sqlee = "SELECT * FROM estado_arrend_equipo
						WHERE cod_est_arrend_equipo = $cod_estado";
						$dbee = new Database();
						$dbee->query($sqlee);					
						$dbee->next_row();
									
				?>
                <tr bgcolor="<?=$color?>">
                  <td  class="textotabla01"><div align="center">
                    <?=$db->consecutivo_equipo?>
                  </div></td>
                  <td  class="textotabla01">
				    <div align="center">
				      <?=$dbe->nom_clase?>
                      <?=$dbe->nom_equipo?>
                      <?=$dbe->desc_tipo_equipos?>                                  
			        </div></td>
                  <td  class="textotabla01"><div align="center">
                    <?=$dbee->desc_est_arrend_equipo?>               
                  </div></td>
                </tr>
                <? if($i==1) { $i=2; }
				else {$i=1;	 }  
				?>
                <? } } ?>
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
	