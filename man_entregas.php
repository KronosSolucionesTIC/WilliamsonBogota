<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?	
	
if ($codigo == 0) {
	$sqlc ="SELECT * FROM cliente
	where cod_cli=$clientes";
	$dbc= new  Database();
	$dbc->query($sqlc);
    $dbc->next_row();
		
	$sqla ="SELECT * FROM contrato_alquiler WHERE cod_calc = $contrato";
	$dba= new  Database();
	$dba->query($sqla);
	$dba->next_row(); 	

		 	$sqlo ="SELECT * FROM otro_si ORDER BY cod_otro_si DESC";
			$dbo= new  Database();
			$dbo->query($sqlo);
   			$dbo->next_row();
			$cons_otro_si = $dbo->cod_otro_si + 1;
			
				$sqle ="SELECT * FROM entregas ORDER BY cod_entrega DESC";
				$dbe= new  Database();
				$dbe->query($sqle);
   				$dbe->next_row();
				$cons_entrega = $dbe->cod_entrega + 1;
				
					$sqlsd ="SELECT SUM(valor_tot_pago) as saldo_deuda FROM pagos WHERE cod_contrato = $contrato AND estado_pago = 1 AND fecha_ini_pago <= CURDATE()";
					$dbsd= new  Database();
					$dbsd->query($sqlsd);
    				$dbsd->next_row();
					$saldo_deuda = $dbsd->saldo_deuda;
}
if ($codigo != 0) {
	$sqle ="SELECT * FROM entregas WHERE cod_entrega = $codigo";
	$dbe= new  Database();
	$dbe->query($sqle);
	$dbe->next_row();
	$contrato = $dbe->cod_contrato;
	
		$sqla ="SELECT * FROM contrato_alquiler where cod_calc = $contrato";
		$dba= new  Database();
		$dba->query($sqla);
    	$dba->next_row();
		$cliente = $dba->cod_cliente;
	
			$sqlc ="SELECT * FROM cliente where cod_cli = $cliente";
			$dbc= new  Database();
			$dbc->query($sqlc);
    		$dbc->next_row();
}
$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 

		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1 MODIFICACION DEL ESTADO DE LOS EQUIPOS 
		$campos="estado_arrend_equipo='2'";
		 for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++)
		{  		
			if($_POST["seleccion_".$ii]==1) 
			{
			$error=editar("equipos",$campos,'cod_equipo',$_POST["equipo_".$ii]); 
			$suma_equipos = $ii;				
			}	
		
		}
		
		if($suma_equipos == ($val_inicial_item_contac - 1)) {
		$tipo_entrega = 2;
		} else {
		$tipo_entrega = 1;
		}
		
			// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN ENTREGA	
			$campos="(cod_contrato,fecha_entrega,tipo_entrega,observaciones,saldo_deuda)";
			$valores="('".$contrato."','".$fecha_entrega."','".$tipo_entrega."','".$observaciones."','".$saldo_deuda."')" ;
			$error=insertar("entregas",$campos,$valores);
		
			// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN ENTREGAS_EQUIPOS	
			$campos="(cod_entrega,cod_equipo)";
			for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
				{ 
					if($_POST["seleccion_".$ii]==1) 
						{		
						$valores="('".$cons_entrega."','".$_POST["equipo_".$ii]."')";
						$error = insertar("entregas_equipos",$campos,$valores); 
						}
				}
					
				// RUTINA PARA EDITAR REGISTROS 3. INGRESO EN OTRO SI
				$campos="(fecha_otro_si,contrato_otro_si,entrega_otro_si,tipo_otro_si)";
				$valores="('".date('Y-m-d')."','".$contrato."','".$cons_entrega."','1')" ;
				$error=insertar("otro_si",$campos,$valores);
		
					// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3.1 INGRESO EN OTRO SI EQUIPOS
					$campos="(equipo_otro_si,otro_si)";
					for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
					{ 		
						if($_POST["seleccion_".$ii]==0) 
						{
							$valores="('".$_POST["equipo_".$ii]."','".$cons_otro_si."')";
							$error=insertar("otro_si_equipos",$campos,$valores); 
						}
					}
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.2 MODIFICACION DEL LISTADO DE EQUIPOS DEL CONTRATO
		 		for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++)
				{  		
					if($_POST["seleccion_".$ii]==1) 
					{
						eliminar("listado_equipos",$_POST["equipo_".$ii],'cod_equipo');
					}		
				}
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3 INGRESO DE FECHA DE MODIFICACION DEL CONTRATO
		$campos="fecha_mod_contrato='".$fecha_entrega."'";
		$error=editar("contrato_alquiler",$campos,'cod_calc',$contrato);
				
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 4 CANCELACION DEL CONTRATO
		$sqlle ="SELECT count(*) as cantidad From listado_equipos WHERE cod_contrato = $contrato";
		$dble= new  Database();
		$dble->query($sqlle);
		$dble->next_row();
		
		$sqlp ="SELECT count(*) as cantidad From pagos WHERE cod_contrato = $contrato and estado_pago = 1 and fecha_ini_pago <= CURDATE()";
		$dbp= new  Database();
		$dbp->query($sqlp);
		$dbp->next_row();
		
		if ($dble->cantidad <= 0) {
			if ($dbp->cantidad <= 0) {
		$campos="estado_contrato='2'";
		$error = editar("contrato_alquiler",$campos,'cod_calc',$contrato);
			}
		}
		
		if ($error==1) {
				header("Location: con_entregas.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
        }

if($guardar==1 and $codigo!=0) { 

	// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN ENTREGA	
	$campos="fecha_entrega='".$fecha_entrega."',observaciones='".$observaciones."'";
	$error=editar("entregas",$campos,'cod_entrega',$codigo);		
	if ($error==1) {
		header("Location: con_entregas.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
    {
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
    }

}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-size: 12px}
</style> 

<? inicio() ?>

<script language="javascript">
		
function datos_completos(){  
if (document.getElementById('fecha_entrega').value ==''){
    alert("Digite la informacion completa");
	return false;}
else {
	return true;}
}


var i=2;
var total_pago = 0;
function cargar_equipos() 
{ 
<!--1. SE ALMACENAN EL CODIGO DE CADA CAMPO-->
<?
		$sqlf ="SELECT * FROM `equipos` ";		
		$dbf= new  Database();
		$dbf->query($sqlf);
		while($dbf->next_row()){ 
		echo "if(document.getElementById('cod_equipo').value==$dbf->cod_equipo) {";	
		echo  "document.getElementById('plano').value= '$dbf->consecutivo_equipo'; ";
		echo  "document.getElementById('nombre_equipo').value= '$dbf->nom_equipo'; ";
		echo  "document.getElementById('canon_arrend_equipo').value= '$dbf->canon_arrend_equipo'; ";
		echo  "document.getElementById('valor_deposito').value= '$dbf->valor_deposito'; ";
		$tot = $dbf->valor_deposito + $dbf->canon_arrend_equipo;
		echo  "document.getElementById('valor_total').value= '$tot'; ";
		echo  "document.getElementById('codigo_equipo').value= '$dbf->cod_equipo';} ";
		}
?>

var v_plano = document.getElementById('plano').value;
var v_nombre = document.getElementById('nombre_equipo').value;
var v_equipo = document.getElementById('codigo_equipo').value;
var v_canon = document.getElementById('canon_arrend_equipo').value;
var v_deposito = document.getElementById('valor_deposito').value;
var v_total = document.getElementById('valor_total').value;
var v_total_1 = document.getElementById('valor_total_1').value;

v_total = parseInt(v_total);
v_total_1 = parseInt(v_total_1);
if (total_pago == 0) {
  total_pago =  v_total_1;
  }
total_pago = (v_total + total_pago)  ;
<!--2. SE CAMBIA EL VALOR DEL CONTADOR-->
document.getElementById('val_inicial_item_contac').value = i;
document.getElementById('total_pago').value = total_pago ;
<!--3. SE CREA EL ITEM CON LOS VALORES SELECCIONADOS-->
var t=document.getElementById('trae').innerHTML; 
t=t.substring(0,(t.length-8)); 
t+="<tr><td id='fila_item_"+i+"'>&nbsp;</td><td >&nbsp;</td><td><input name='plano_"+i+"' type='text' size='20' disabled='disabled' id='plano_"+i+"' value='"+v_plano+"' /><input type='hidden' name='codigo_equipo_"+i+"' id='codigo_equipo_"+i+"' value='"+v_equipo+"' /><input type='visible' name='canon_arrend_equipo_"+i+"' id='canon_arrend_equipo_"+i+"' value='"+v_canon+"' /><input type='visible' name='valor_deposito_"+i+"' id='valor_deposito_"+i+"' value='"+v_deposito+"' /><input type='visible' name='valor_total_"+i+"' id='valor_total_"+i+"' value='"+v_total+"' /></td><td><input name='nombre_equipo_"+i+"' type='text' size='20' disabled='disabled' id='nombre_equipo_"+i+"' value='"+v_nombre+"' /></td><td align='center'><input name='button"+i+"' type='button'  class='botones' id='menos"+i+"' onclick='borrar_item()' value='  -  ' /></td></tr></table>"; 
document.getElementById('trae').innerHTML=t;
i++; 
} 	

function borrar_item() 
{ 
var t=document.getElementById('trae').innerHTML; 
var j=t.lastIndexOf("<TBODY>"); 
if(j>-1){ 
t=t.substring(0,j);
t+="</TABLE>"; 
document.getElementById('trae').innerHTML=t; 
} 
}

function cambiar_seleccion (selec){
if (document.getElementById(selec).value == 0){
document.getElementById(selec).value = 1 ;
}
else {
document.getElementById(selec).value = 0 ;
}
}
			
</script>


<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_entregas.php"  method="post" enctype="multipart/form-data">
<table width="830" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td width="830" bgcolor="#E9E9E9"><table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
         <td width="5" height="19">&nbsp;</td>
        <td width="20" ><img src="imagenes/icoguardar.png" alt="Nuevo Registro" width="16" height="16" border="0"  onclick="cambio_guardar()" style="cursor:pointer"/></td>
        <td width="61" class="ctablaform">Guardar</td>
        <td width="21" class="ctablaform"><a href="con_alquiler.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_alquiler.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo"   id="codigo"   value="<?=$codigo?>" />
		  <input type="hidden" name="clientes" id="clientes" value="<?=$clientes?>" />
		  <input type="hidden" name="contrato" id="contrato" value="<?=$contrato?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="26" class="textotabla1 Estilo1"> ENTREGA DE EQUIPOS:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top"><table width="830" border="0">
      <tr>
        <td width="824"><table width="824" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td width="104" class="textotabla1">N&deg; contrato :</td>
            <td width="300" class="textotabla1"><span class="ctablaform">
             <?=$dba->consecutivo?>
            </span></td>
            <td width="178" class="textotabla1">Saldo a la fecha:</td>
            <td width="242" class="textotabla1"><span class="ctablaform">$
              <?=number_format($dbsd->saldo_deuda,0,".",".")?></span></td>
          </tr>
          <tr>
            <td colspan="4" class="botonforms"><div align="center">DATOS DEL CLIENTE </div></td>
            </tr>
          
          <tr>
            <td class="textotabla1">Nombre:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbc->nom1_cli?>
              <?=$dbc->nom2_cli?>
              <?=$dbc->apel1_cli?>
              <?=$dbc->apel2_cli?>
              <span class="textorojo">
              <input name="v_cod_cliente_fac" type="hidden" class="textfield002" id="v_cod_cliente_fac" onkeypress="return validaInt_1()" value="<? if ($codigo!=0) { ?><?=$dbdatos->cod_cliente_cont?><? } else { ?><?=$codigo_cliente?><? }?>" />
            </span></span></td>
            <td class="textotabla1">No. Identificaci&oacute;n:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbc->cedula_cli?>
			</span>			</td>
            </tr>
          <tr>
            <td class="textotabla1">Direcci&oacute;n:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbc->direccion_cli?>
			</span>			</td>
            <td class="textotabla1">Tel&eacute;fono:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbc->telefono_cli?>
			</span>			</td>
            </tr>
          <tr>
            <td class="textotabla1">E-mail:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbc->email_cli?>
			</span>			</td>
            <td class="textotabla1">Celular:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbc->celular_cli?>
			</span>			</td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="botonforms"><div align="center">DATOS CONTRATO </div></td>
            </tr>
          
          <tr>
            <td colspan="7" class="textotabla1" ><div id="trae" align="center">
                <table  width="58%" border="1">
				<tr>
				  <td width="31%" class="botonforms" ><div align="center">PLANO</div></td>
				  <td width="41%" class="botonforms" ><div align="center">EQUIPO</div></td>
				  <td width="28%" colspan="7" class="botonforms" ><div align="center">SELECCIONE</div></td>
          </tr>
                   <?
				   if ($codigo == 0) {
						$sql ="SELECT * FROM `listado_equipos` 
						INNER JOIN equipos ON (equipos.cod_equipo = listado_equipos.cod_equipo)
						WHERE cod_contrato = $contrato";	
						$dbdatos_1= new  Database();
						$dbdatos_1->query($sql);
						$jj=1;
						while($dbdatos_1->next_row()){ 
						echo "<tr id='fila_item_$jj'>";
//PLANO
						echo "<td>$dbdatos_1->consecutivo_equipo<input name='equipo_$jj' type='hidden' id='equipo_$jj' value='$dbdatos_1->cod_equipo' /></td>";

//EQUIPO
						echo "<td>$dbdatos_1->nom_equipo</td>";

//BOTON SELECCION
						echo "<td><input name='seleccion' type='checkbox' id='seleccion' value='' onclick='cambiar_seleccion(\"seleccion_$jj\");' /><input name='seleccion_$jj' type='hidden' id='seleccion_$jj' value='' /></td>";
					
						echo "</tr>";
						$jj++;
						}
					}
					 if ($codigo != 0) {
						$sql ="SELECT * FROM `otro_si_equipos` 
						INNER JOIN equipos ON (equipos.cod_equipo = otro_si_equipos.equipo_otro_si)
						WHERE otro_si = $codigo";	
						$dbdatos_1= new  Database();
						$dbdatos_1->query($sql);
						$jj=1;
						while($dbdatos_1->next_row()){ 
						echo "<tr id='fila_item_$jj'>";
//PLANO
						echo "<td>$dbdatos_1->consecutivo_equipo<input name='equipo_$jj' type='hidden' id='equipo_$jj' value='$dbdatos_1->cod_equipo' /></td>";

//EQUIPO
						echo "<td>$dbdatos_1->nom_equipo</td>";	
						echo "</tr>";
						$jj++;
						}
					}

				?>				 
                  </table>
				  </div>				  </td>
          </tr>
          
          <tr>
            <td class="textotabla1">Fecha entrega:</td>
            <td class="textotabla1">
			<? if ($codigo == 0) { ?><input name="fecha_entrega" type="text" class="textfield2" id="fecha_entrega" value="<?=$dbe->fecha_entrega?>"/>
            <img src="imagenes/date.png" alt="Calendario" name="calendario2" width="18" height="18" id="calendario2" style="cursor:pointer"/> <span class="textorojo">* </span>
            <? } else {?>
            <input name="fecha_entrega" type="text" class="textfield2" id="fecha_entrega" disabled="disabled" value="<?=$dbe->fecha_entrega?>"/>
            <img src="imagenes/date.png" alt="Calendario" name="calendario2" width="18" height="18" id="calendario2" style="cursor:pointer"/> <span class="textorojo">* </span>
            <? } ?>
                </td>
            <td class="textotabla1">Observaciones:</td>
            <td><textarea name="observaciones" id="observaciones" cols="45" rows="4" class="textfield02">
            <?=$dbe->observaciones?></textarea></td>
          </tr>
          <tr>
            <td class="textotabla1"><input type="hidden" name="val_inicial_item_contac" id="val_inicial_item_contac" value="<?=$jj;?>" /></td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><!--SOLAPA GARANTIA-->
              <!--FIN SOLAPA GARANTIA--></td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><!--SOLAPA GARANTIA--><!--FIN SOLAPA GARANTIA--></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center"><img src="imagenes/spacer.gif"  width="624" height="4" /></div></td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>
<script type="text/javascript">	
			Calendar.setup(
				{
					inputField  : "fecha_entrega",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario2" ,  
					align       :"T3",
					singleClick :true
				}
				
			);		
			
					
</script>
</form> 

</body>
</html>