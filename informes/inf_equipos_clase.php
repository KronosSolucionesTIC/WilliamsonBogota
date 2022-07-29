<?
include "../lib/sesion.php";
include("../lib/database.php");
			
$cod_clase = $_GET['cod_clase'];
$cod_tipo = $_GET['cod_tipo'];
	
?>
<script language="javascript">
function imprimir(){
	document.getElementById('imp').style.display="none";
	document.getElementById('cer').style.display="none";
	window.print();
}

function abrir_detalle(cod_estado){
cod_clase = document.getElementById('clase').value;
cod_tipo = document.getElementById('tipo').value;
var url="inf_equipos_clase_alquilados.php?cod_clase="+cod_clase+"&cod_tipo="+cod_tipo+"&cod_estado="+cod_estado;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
}

function abrir_detalle_otros(cod_estado){
cod_clase = document.getElementById('clase').value;
cod_tipo = document.getElementById('tipo').value;
var url="inf_equipos_clase_otros.php?cod_clase="+cod_clase+"&cod_tipo="+cod_tipo+"&cod_estado="+cod_estado;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
}

</script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="informes/inf.js"></script>
 <link href="styles.css" rel="stylesheet" type="text/css" />
 <link href="../styles.css" rel="stylesheet" type="text/css" />
 <style type="text/css">
<!--
.Estilo1 {font-size: 9px}
-->
 </style>
 <link href="../css/styles.css" rel="stylesheet" type="text/css" />
 <link href="../css/stylesforms.css" rel="stylesheet" type="text/css" />
	 <title><?=$nombre_aplicacion?> -- EQUIPOS POR CLASE Y TIPO --</title>
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
			    <? if($cod_tipo == 0) {?>
				<?
				$sqlc = "SELECT * FROM clase_equipos WHERE cod_clase = $cod_clase";
				$dbc = new Database();
				$dbc->query($sqlc);
				$dbc->next_row();
				
				$sqlct = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase";
				$dbct = new Database();
				$dbct->query($sqlct);
				$dbct->next_row();
								
				$sqlca = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = 1";
				$dbca = new Database();
				$dbca->query($sqlca);
				$dbca->next_row();
				
				$sqlcl = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = 2";
				$dbcl = new Database();
				$dbcl->query($sqlcl);
				$dbcl->next_row();
				
				$sqlcm = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = 3";
				$dbcm = new Database();
				$dbcm->query($sqlcm);
				$dbcm->next_row();
				
				$sqlcb = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND estado_arrend_equipo = 4";
				$dbcb = new Database();
				$dbcb->query($sqlcb);
				$dbcb->next_row();
				?>
                <? } ?>
                <? if($cod_tipo != 0) {?>
				<?
				$sqlc = "SELECT * FROM clase_equipos WHERE cod_clase = $cod_clase";
				$dbc = new Database();
				$dbc->query($sqlc);
				$dbc->next_row();
				
				$sqlt = "SELECT * FROM tipo_equipos WHERE cod_tipo_equipos = $cod_tipo";
				$dbt = new Database();
				$dbt->query($sqlt);
				$dbt->next_row();
				
				$sqlct = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND tipo_equipo = $cod_tipo";
				$dbct = new Database();
				$dbct->query($sqlct);
				$dbct->next_row();
								
				$sqlca = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND tipo_equipo = $cod_tipo AND estado_arrend_equipo = 1";
				$dbca = new Database();
				$dbca->query($sqlca);
				$dbca->next_row();
				
				$sqlcl = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND tipo_equipo = $cod_tipo AND estado_arrend_equipo = 2";
				$dbcl = new Database();
				$dbcl->query($sqlcl);
				$dbcl->next_row();
				
				$sqlcm = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND tipo_equipo = $cod_tipo AND estado_arrend_equipo = 3";
				$dbcm = new Database();
				$dbcm->query($sqlcm);
				$dbcm->next_row();
				
				$sqlcb = "SELECT COUNT(*) AS cantidad FROM equipos WHERE clase_equipo = $cod_clase AND tipo_equipo = $cod_tipo AND estado_arrend_equipo = 4";
				$dbcb = new Database();
				$dbcb->query($sqlcb);
				$dbcb->next_row();
				?>
                <? } ?>
                <tr >
                  <td ><div align="center"><span class="textotabla01">
                    <strong>CLASE</strong></span></div></td>
                  <td ><div align="center"><span class="textotabla01"> <strong>ALQUILADO</strong></span></div></td>
                  <td ><div align="center"><span class="textotabla01"> <strong>LIBRE</strong></span></div></td>
                  <td ><div align="center"><span class="textotabla01"> <strong>MANTENIMIENTO</strong></span></div></td>
                  <td ><div align="center"><span class="textotabla01"> <strong>DE BAJA</strong></span></div></td>
			      <td ><div align="center"><span class="textotabla01"> <strong>TOTAL</strong></span></div></td>
		        </tr>
                <tr >
                  <td ><div align="left"><span class="textotabla01">
                    <?=$dbc->nom_clase?>
                  </span><span class="textotabla01">
                  <?=$dbt->desc_tipo_equipos?>
                  </span></div></td>
                  <td ><div align="center"><span class="textotabla01">
                    <?=$dbca->cantidad?>
                  </span></div></td>
                  <td ><div align="center"><span class="textotabla01">
                    <?=$dbcl->cantidad?>
                  </span></div></td>
                  <td ><div align="center"><span class="textotabla01">
                    <?=$dbcm->cantidad?>
                  </span></div></td>
                  <td ><div align="center"><span class="textotabla01">
                    <?=$dbcb->cantidad?>
                  </span></div></td>
                  <td >&nbsp;</td>
                </tr>
                <tr >
                  <td width="15%" >
                  <input name="clase" id="clase" type="hidden" value="<?=$cod_clase?>" />
                  <input name="tipo" id="tipo" type="hidden" value="<?=$cod_tipo?>" />
                  </td>
                  <td width="17%" ><div align="center">
                    <input name="imp2" type="button"  class="botones" id="imp3" onclick="abrir_detalle(1)" value="Ver detalle" />
                  </div></td>
                  <td width="17%" ><div align="center">
                    <input name="imp3" type="button"  class="botones" id="imp4" onclick="abrir_detalle_otros(2)" value="Ver detalle" />
                  </div></td>
                  <td width="17%" ><div align="center">
                    <input name="imp" type="button"  class="botones" id="imp2" onclick="abrir_detalle_otros(3)" value="Ver detalle" />
                  </div></td>
                  <td width="17%" ><div align="center">
                    <input name="imp4" type="button"  class="botones" id="imp5" onclick="abrir_detalle_otros(4)" value="Ver detalle" />
                  </div></td>
                  <td width="17%" ><div align="left"><span class="textotabla01">Total de 
                    equipos
                    
                  </span><span class="textotabla01">
                  <?=$dbct->cantidad?>
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
	