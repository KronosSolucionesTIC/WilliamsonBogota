<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if($codigo==0) { 	 
	 
	$sqlc ="SELECT * FROM cliente
	where cod_cli=$clientes";
	$dbc= new  Database();
	$dbc->query($sqlc);
    $dbc->next_row();
	
		$sqlr ="SELECT * FROM responsable
		where cod_cli=$responsable";
		$dbr= new  Database();
		$dbr->query($sqlr);
    	$dbr->next_row();
	
		$sqlp ="SELECT * FROM paciente
		where cod_pac=$paciente";
   	 	$dbp= new  Database();
		$dbp->query($sqlp);
    	$dbp->next_row();
	
	 		$sqle ="SELECT * FROM equipos
			where cod_equipo=$equipo";
    		$dbe= new  Database();
			$dbe->query($sqle);
    		$dbe->next_row();
	
				$sqla ="SELECT * FROM consecutivo WHERE cod_cons = 9";
				$dbda= new  Database();
				$dbda->query($sqla);
				$dbda->next_row(); 
			
				$letra=$dbda->letra_cons;
				$num=$dbda->codigo_actual_cons+1; 
				$cons_contrato=$letra.date("ym").sprintf("%04s",$num);
	 
	 				$sqlle ="SELECT * FROM listado_equipos ORDER BY cod_listado_equipos DESC";
					$dble= new  Database();
					$dble->query($sqlle);
					$dble->next_row(); 
			
					$cons_listado_equipos=$dble->cod_listado_equipos + 1;
				
						$sqlcae ="SELECT * FROM contrato_alquiler ORDER BY cod_calc DESC";
						$dblcae= new  Database();
						$dblcae->query($sqlcae);
						$dblcae->next_row(); 			
					 	$cod_contrato=$dblcae->cod_calc + 1;
	
	}
	
else {
 	$sqlc ="SELECT * FROM contrato_alquiler 
	INNER JOIN cliente ON (cliente.cod_cli = contrato_alquiler.cod_cliente)
	INNER JOIN paciente ON (paciente.cod_pac = contrato_alquiler.cod_paciente)
	WHERE cod_calc = $codigo";
	$dbc= new  Database();
	$dbc->query($sqlc);
    $dbc->next_row();
	$cons_contrato = $dbc->consecutivo;
	
		 	$sqlo ="SELECT * FROM otro_si ORDER BY cod_otro_si DESC";
			$dbo= new  Database();
			$dbo->query($sqlo);
   			$dbo->next_row();
			$cons_otro_si = $dbo->cod_otro_si + 1;

		$sqlp ="SELECT * FROM contrato_alquiler 
		INNER JOIN paciente ON (paciente.cod_pac = contrato_alquiler.cod_paciente)
		WHERE cod_calc = $codigo";
   		$dbp= new  Database();
		$dbp->query($sqlp);
    	$dbp->next_row();
	
	}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 

		
	// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.INGRESO EN CONTRATO ALQUILER	
	$campos="(consecutivo,cod_cliente,fecha_ini_contrato,adjunto,fecha_fin_contrato,fecha_ingreso,cod_paciente,cod_responsable,observ_contrato,estado_contrato,tipo_contrato)";
	$valores="('".$cons_contrato."','".$clientes."','".$fech_iniciacion."','','".$fech_terminacion."','".date("Y-m-d")."','".$paciente."','".$responsable."','".$observaciones."','1','".$tipo_contrato."')" ;
	$error=insertar("contrato_alquiler",$campos,$valores);	
	
	    // RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.1 MODIFICACION DEL CONSECUTIVO DEL CONTRATO		
		$campos="codigo_actual_cons='".$num."'";
		$error=editar("consecutivo",$campos,'cod_cons',9); 	
		
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN LISTADO EQUIPOS
		$campos="(cod_contrato,cod_equipo,canon_equipo,deposito_equipo,total_equipo)";
		 for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
		{  		
			$valores="('".$cod_contrato."','".$_POST["codigo_equipo_".$ii]."','".$_POST["canon_equipo_".$ii]."','".$_POST["deposito_".$ii]."','".$_POST["total_equipo_".$ii]."')";
			$error=insertar("listado_equipos",$campos,$valores); 				
		}
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3. MODIFICACION DEL ESTADO DEL EQUIPO	
		$campos="estado_arrend_equipo='1'";
		for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++)
		{ 
		$error=editar("equipos",$campos,'cod_equipo',$_POST["codigo_equipo_".$ii]); 
		}
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 4. INGRESO EN PAGOS
			$campos="(cod_pago,fecha_ini_pago,valor_tot_pago,valor_recibido,saldo_pago,estado_pago,cod_equipo,cod_contrato)";
		 for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
		{  		
			$valores="('','".$fech_iniciacion."','".$_POST["total_equipo_".$ii]."',0,'".$_POST["total_equipo_".$ii]."',1,'".$_POST["codigo_equipo_".$ii]."','".$cod_contrato."')";
			$id = insertar_maestro("pagos",$campos,$valores);
			
			$sqlpa ="SELECT * ,(DATE_ADD(fecha_ini_pago,INTERVAL 1 MONTH)) as fecha_fin FROM pagos
			WHERE cod_pago = $id ";
			$dbpa = new  Database();
			$dbpa->query($sqlpa);
			$dbpa->next_row();
			$fecha_fin_pago = $dbpa->fecha_fin;
			
			$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
			$error=editar("pagos",$campos,'cod_pago',$id) ;				
		}
						
		if ($error==1) {
				header("Location: con_contrato_alquiler.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
        }

if($guardar==1 and $codigo!=0) { 
		 
		// RUTINA PARA EDITAR REGISTROS 1.INGRESO EN CONTRATO ALQUILER	
		$campos="fecha_mod_contrato='".date('Y-m-d')."',observ_contrato='".$observaciones."'";
		$error=editar("contrato_alquiler",$campos,'cod_calc',$codigo);	
	    
				
		// RUTINA PARA EDITAR REGISTROS 2.INGRESO EN LISTADO EQUIPOS
		$campos="(cod_contrato,cod_equipo,canon_equipo,deposito_equipo,total_equipo)";
		 for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
		{  		
			$valores="('".$codigo."','".$_POST["codigo_equipo_".$ii]."','".$_POST["canon_equipo_".$ii]."','".$_POST["deposito_".$ii]."','".$_POST["total_equipo_".$ii]."')";
			$error=insertar("listado_equipos",$campos,$valores); 				
		}
		
			// RUTINA PARA EDITAR REGISTROS 2.1 INGRESO EN OTRO SI EQUIPOS
			$sqlc ="SELECT * FROM listado_equipos
			where cod_contrato = $codigo";
			$dbc= new  Database();
			$dbc->query($sqlc);
    		while ($dbc->next_row()){
				$codigo_equipo = $dbc->cod_equipo ;
				$campos="(equipo_otro_si,otro_si)";  		
				$valores="('".$codigo_equipo."','".$cons_otro_si."')";
				$error=insertar("otro_si_equipos",$campos,$valores); 				
			}
		
		// RUTINA PARA EDITAR REGISTROS 3. MODIFICACION DEL ESTADO DEL EQUIPO	
		$campos="estado_arrend_equipo='1'";
		for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++)
		{ 
		$error=editar("equipos",$campos,'cod_equipo',$_POST["codigo_equipo_".$ii]); 
		}
		
		// RUTINA PARA EDITAR REGISTROS 4.INGRESO EN PAGOS	
		$campos="(cod_pago,fecha_ini_pago,valor_tot_pago,valor_recibido,saldo_pago,estado_pago,cod_equipo,cod_contrato)";		
		for ($ii=1 ;  $ii < $val_inicial_item_contac ; $ii++) 
		{  		
			$valores="('','".$fech_iniciacion."','".$_POST["total_equipo_".$ii]."',0,'".$_POST["total_equipo_".$ii]."',1,'".$_POST["codigo_equipo_".$ii]."','".$codigo."')";
			$error=insertar("pagos",$campos,$valores); 	
			
			// RUTINA PARA EDITAR REGISTROS 4.1 EDICION DE LA FECHA FIN EN PAGOS
			$sqlep ="SELECT * ,(DATE_ADD(fecha_ini_pago,INTERVAL 1 MONTH)) as fecha_fin FROM pagos
			ORDER BY cod_pago DESC";
			$dbep= new  Database();
			$dbep->query($sqlep);
    		$dbep->next_row();
			$fecha_fin_pago = $dbep->fecha_fin;
			$codigo_pago = $dbep->cod_pago;
			
			$campos="fecha_fin_pago='".$fecha_fin_pago."'";
			$error=editar("pagos",$campos,'cod_pago',$codigo_pago);		
		}			
		
		// RUTINA PARA EDITAR REGISTROS 5. INGRESO EN OTRO SI	
		if ($val_inicial_item_contac > 0) {
		$campos="(fecha_otro_si,contrato_otro_si,tipo_otro_si )";
		$valores="('".$fech_iniciacion."','".$codigo."','2')" ;
		$error=insertar("otro_si",$campos,$valores);
		}
		
		if ($error==1) {
				header("Location: con_contrato_alquiler.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
        }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Alquiler equipos ortopédicos</title>
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
if (document.getElementById('fech_iniciacion').value ==''){
    alert("Digite la informacion completa");
	return false;}
else {
	return true;}
}


var i=1;
var total_pago = 0;
function agregar() 
{ 
<!--1. SE ALMACENAN EL CODIGO DE CADA CAMPO-->
var v_plano = document.getElementById('plano').value;
var v_nombre = document.getElementById('nom_equipo').value;
var v_equipo = document.getElementById('cod_equipo').value;
var v_canon = document.getElementById('canon_arrend_equipo').value;
var v_deposito = document.getElementById('valor_deposito').value;
var v_total = document.getElementById('valor_total').value;
var v_clase = document.getElementById('clase').value;

v_total = parseInt(v_total);
total_pago = (v_total + total_pago)  ;
<!--3. SE CREA EL ITEM CON LOS VALORES SELECCIONADOS-->
var t=document.getElementById('trae').innerHTML; 
t=t.substring(0,(t.length-8)); 
t+="<tr><td id='fila_item_"+i+"'><input name='clase_"+i+"' class='textfield2' type='text' size='20' disabled='disabled' id='clase_"+i+"' value='"+v_clase+"' /></td><td><input name='plano_"+i+"' class='textfield2' type='text' size='20' disabled='disabled' id='plano_"+i+"' value='"+v_plano+"' /><input type='hidden' name='codigo_equipo_"+i+"' id='codigo_equipo_"+i+"' value='"+v_equipo+"' /><td><input name='nombre_equipo_"+i+"' type='text' class='textfield2' size='20' disabled='disabled' id='nombre_equipo_"+i+"' value='"+v_nombre+"' /></td><td><input type='hidden' name='canon_equipo_"+i+"' id='canon_equipo_"+i+"' value='"+v_canon+"' /><input type='visible' disabled='disabled' class='textfield2' name='canon_arrend_equipo_"+i+"' id='canon_arrend_equipo_"+i+"' value='"+v_canon+"' /></td><td><input type='hidden' name='deposito_"+i+"' id='deposito_"+i+"' value='"+v_deposito+"' /><input type='visible' class='textfield2' name='valor_deposito_"+i+"' id='valor_deposito_"+i+"' disabled='disabled' value='"+v_deposito+"' /></td><td><input type='hidden' name='total_equipo_"+i+"' id='total_equipo_"+i+"' value='"+v_total+"' /><input type='visible' class='textfield2' name='valor_total_"+i+"' id='valor_total_"+i+"' disabled='disabled' value='"+v_total+"' /></td><td align='center'><input name='button"+i+"' type='button'  class='botones' id='menos"+i+"' onclick='borrar_item()' value='  -  ' /></td></tr></table>"; 
document.getElementById('trae').innerHTML=t;
i++; 
<!--2. SE CAMBIA EL VALOR DEL CONTADOR-->
document.getElementById('val_inicial_item_contac').value = i;
document.getElementById('total_pago').value = total_pago ;
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

function filtrar_equipos (equipo,clase){
var combo=document.getElementById(equipo);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
		$i=0;
		$sqlf ="SELECT * FROM `equipos`
		INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
		INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)";		
		$dbf= new  Database();
		$dbf->query($sqlf);
		while($dbf->next_row()){ 
		echo "if(document.getElementById(clase).value==$dbf->cod_clase  && $dbf->estado_arrend_equipo == 2) {";	
		echo "if(document.getElementById(clase).value==5){";
		echo "combo.options[cant] = new Option('$dbf->consecutivo_equipo - $dbf->nom_clase - $dbf->nom_equipo - $dbf->desc_tipo_equipos','$dbf->cod_equipo'); ";
		echo "}";
		echo "else {";
		echo "combo.options[cant] = new Option('$dbf->consecutivo_equipo - $dbf->nom_clase - $dbf->desc_tipo_equipos','$dbf->cod_equipo'); ";
		echo "}";
		echo "cant++; } ";
		}
?>
}

function cargar_equipo (clase,plano,total,deposito,alquiler,nombre,v_equipo){
var cod_equipo = document.getElementById(v_equipo).value;
var nombre_equipo = "";
var consec = ""; 
var c_equipo = ""; 
var alquiler_equipo = 0;
var deposito_equipo = 0;
var total_equipo = 0;
<?
		$sql_e ="SELECT * FROM `equipos` INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)";		
		$db_e= new  Database();
		$db_e->query($sql_e);
		while($db_e->next_row()){ 
		echo "if(document.getElementById(v_equipo).value==$db_e->cod_equipo) {";	
		echo "nombre_equipo = '$db_e->nom_equipo'; ";
		echo "consec = '$db_e->consecutivo_equipo'; ";
		echo "c_equipo = '$db_e->nom_clase'; ";
		echo "alquiler_equipo = '$db_e->canon_arrend_equipo'; ";
		echo "deposito_equipo= '$db_e->valor_deposito'; ";
		echo "alquiler_equipo = parseInt(alquiler_equipo); ";
		echo "deposito_equipo = parseInt(deposito_equipo); ";
		echo "total_equipo = (alquiler_equipo) ; ";
		echo  "document.getElementById(nombre).value= nombre_equipo ; ";
		echo  "document.getElementById(plano).value= consec ; ";
		echo  "document.getElementById(clase).value= c_equipo ; ";
		echo  "document.getElementById(alquiler).value= alquiler_equipo ; ";
		echo  "document.getElementById(deposito).value= deposito_equipo ; ";
		echo  "document.getElementById(total).value= total_equipo ;} ";
		}
?>

}

function calcular_total(){
var canon = parseInt (document.getElementById('canon_arrend_equipo').value );
var total = 0; 
total = canon;
document.getElementById('valor_total').value = total ;
}
			
</script>


<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_alquiler.php"  method="post" enctype="multipart/form-data">
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
		  <input type="hidden" name="paciente" id="paciente" value="<?=$paciente?>" />
          <input type="hidden" name="responsable" id="responsable" value="<?=$responsable?>" />
          <input type="hidden" name="tipo_contrato" id="tipo_contrato" value="<?=$tipo_contrato?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="26" class="textotabla1 Estilo1"> ALQUILER DE EQUIPOS ORTOPEDICOS:</td>
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
             <?=$cons_contrato?>
            </span></td>
            <td width="178" class="textotabla1">&nbsp;</td>
            <td width="242" class="textotabla1">&nbsp;</td>
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
			<span class="ctablaform"><?=$dbc->cedula_cli?>
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
			</span></td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
		  <? if ($tipo_contrato == 2) {?>
          <tr>
		    <td colspan="4" class="botonforms">
		      <div align="center">
		        DATOS DEL RESPONSABLE</div>			</td>
		    </tr>
          <tr>
            <td class="textotabla1">Nombre:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->nom1_cli?>
              <?=$dbr->nom2_cli?>
              <?=$dbr->apel1_cli?>
              <?=$dbr->apel2_cli?>
              <span class="textorojo">
                <input name="v_cod_cliente_fac" type="hidden" class="textfield002" id="v_cod_cliente_fac" onkeypress="return validaInt_1()" value="<? if ($codigo!=0) { ?><?=$dbdatos->cod_cliente_cont?><? } else { ?><?=$codigo_cliente?><? }?>" />
              </span></span></td>
            <td class="textotabla1">No. Identificaci&oacute;n:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->cedula_cli?>
            </span></td>
            </tr>
          <tr>
            <td class="textotabla1">Direcci&oacute;n:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->direccion_cli?>
            </span></td>
            <td class="textotabla1">Tel&eacute;fono:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->telefono_cli?>
            </span></td>
            </tr>
          <tr>
            <td class="textotabla1">E-mail:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->email_cli?>
            </span></td>
            <td class="textotabla1">Celular:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbr->celular_cli?>
            </span></td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
          <? } ?>
		  <tr>
		    <td colspan="4" class="botonforms">
		      <div align="center">
		        DATOS DEL PACIENTE </div>			</td>
		    </tr>
			<tr>
			  <td class="textotabla1">Nombre:</td>
			  <td class="textotabla1"><span class="ctablaform">
			    <?=$dbp->nom1_pac?>
			    <?=$dbp->nom2_pac?>
			    <?=$dbp->apel1_pac?>
			    <?=$dbp->apel2_pac?>
			    <span class="textorojo">
			      <input name="v_cod_cliente_fac2" type="hidden" class="textfield002" id="v_cod_cliente_fac2" onkeypress="return validaInt_1()" value="<? if ($codigo!=0) { ?><?=$dbdatos->cod_cliente_cont?><? } else { ?><?=$codigo_cliente?><? }?>" />
			      </span></span></td>
			  <td class="textotabla1">No. Identificaci&oacute;n:</td>
			  <td class="textotabla1">
			    <span class="ctablaform">
			      <?=$dbp->cedula_pac?>
		        </span>			  </td></tr>
	        <tr>
	          <td class="textotabla1">Direcci&oacute;n:</td>
	          <td class="textotabla1">
			  <span class="ctablaform">
			  <?=$dbp->direccion_pac?>
			  </span>			  </td>
	          <td class="textotabla1">Tel&eacute;fono:</td>
	          <td class="textotabla1">
			  <span class="ctablaform">
			  <?=$dbp->telefono_pac?>
			  </span>			  </td>
	          </tr>
	        <tr>
	  <td class="textotabla1">E-mail:</td>
	  <td class="textotabla1">
	  <span class="ctablaform">
	  <?=$dbp->email_pac?>
	  </span>	  </td>
	  <td class="textotabla1">Celular:</td>
	  <td class="textotabla1">
	  <span class="ctablaform">
	  <?=$dbp->celular_pac?>
	  </span>	  </td>
			</tr>
             <tr>
	  <td class="textotabla1">&nbsp;</td>
	  <td class="textotabla1">&nbsp;</td>
	  <td class="textotabla1"></td>
	  <td class="textotabla1">&nbsp;</td>
			</tr>
          <tr>
            <td colspan="4" class="botonforms"><div align="center">DATOS CONTRATO </div></td>
            </tr>
       <tr>
            <td colspan="7" class="textotabla1" ><div id="trae">
                <table  width="100%" border="1">
                  <tr >
                    <td  class="ctablasup">CLASE</td>
                    <td  class="ctablasup">CONSECUTIVO</td>
                    <td width="23%"  class="ctablasup">EQUIPO</td>
                    <td width="23%"  class="ctablasup">CANON</td>
                    <td width="23%"  class="ctablasup">DEPOSITO</td>
                    <td width="23%"  class="ctablasup">TOTAL</td>
                    <td width="25%"  class="ctablasup">AGREGAR</td>
                    </tr>
                  <tr >
                    <td width="17%" ><? combo_evento("clase_equipo","clase_equipos","cod_clase","nom_clase",$dbdatose->cod_cliente_inmueble,"onchange = filtrar_equipos(\"cod_equipo\",\"clase_equipo\")", "nom_clase"); ?>
                      <input type="hidden" name="clase" id="clase" value="" /></td>
                    <td width="17%" ><? combo_evento_where2("cod_equipo","equipos","cod_equipo","consecutivo_equipo",$dbdatose->cod_cliente_inmueble,"onchange = cargar_equipo(\"clase\",\"plano\",\"valor_total\",\"valor_deposito\",\"canon_arrend_equipo\",\"nom_equipo\",\"cod_equipo\")", "estado_arrend_equipo='2'","consecutivo_equipo"); ?>
                      <input type="hidden" name="plano" id="plano" value="" /></td>
                    <td ><input name="nom_equipo" type="text" class="textfield2" id="nom_equipo" disabled="disabled" value="<?=$dbdatos->fech_iniciacion?>" /></td>
                    <td ><input type="visible" name="canon_arrend_equipo" class="textfield2" id="canon_arrend_equipo"  onkeypress="calcular_total()" /></td>
                    <td ><input type="visible" name="valor_deposito" class="textfield2" id="valor_deposito" /></td>
                    <td ><input type="visible" name="valor_total" class="textfield2" readonly="readonly" onfocus="calcular_total()" id="valor_total"  /></td>
                    <td align="center"><input name="button" type='button'  class='botones' id="mas"  onclick="agregar();" value='  +  ' /></td>
                  </tr>
                  
				  <?
				if ($codigo!="") { // BUSCAR DATOS
				$sql ="SELECT * FROM listado_equipos 
					INNER JOIN equipos ON (equipos.cod_equipo = listado_equipos.cod_equipo)
					INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
					INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = listado_equipos.cod_contrato)
					WHERE cod_calc = $codigo";	
					$dbdatos_1= new  Database();
					$dbdatos_1->query($sql);
					$jj=0;
					while($dbdatos_1->next_row()){ 
						echo "<tr id='fila_item_contac_$jj'>";

//CLASE
						echo "<td align='center'><INPUT type='text'  name='clase_edi_$jj' id='clase_edi_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->nom_clase'>";

//CONSECUTIVO
						echo "<td align='center'><INPUT type='text'  name='consecutivo_edi_$jj' id='consecutivo_edi_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->consecutivo_equipo'>";

//EQUIPO
						echo "<td align='center'><INPUT type='text'  name='equipo_edi_$jj' id='equipo_edi_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->nom_equipo'>";
						
//CANON EQUIPO
						echo "<td align='center'><INPUT type='text'  name='canon_edi_equipo_$jj' id='canon_edi_equipo_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->canon_equipo'>";
				
//DEPOSITO EQUIPO
						echo "<td align='center'><INPUT type='text'  name='deposito_edi_$jj' id='deposito_edi_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->deposito_equipo'>";
						
//TOTAL EQUIPO	
						echo "<td align='center'><INPUT type='text'  name='total_edi_$jj' id='total_edi_$jj' disabled='disabled' class='textfield2' value='$dbdatos_1->total_equipo'>";
						
						echo "<td>&nbsp;</td>";
						
						echo "</tr>";
						$jj++;
						
					}
				}
				?>
                  </table>
				  </div>				  </td>
          </tr>
          <tr>
            <td class="textotabla1"><input type="hidden" name="val_inicial_item_contac" id="val_inicial_item_contac" value="<? if($codigo!=0) echo $jj-1; else echo "1"; ?>" />
              <input type="hidden" name="total_pago" id="total_pago" value="<?=($dbe->valor_deposito+$dbe->canon_arrend_equipo)?>" /></td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td class="textotabla1">Fecha iniciaci&oacute;n:</td>
            <td class="textotabla1"><input name="fech_iniciacion" type="text" class="textfield2" id="fech_iniciacion" readonly="no" value="<?=$dbc->fecha_ini_contrato?>" />
                <img src="imagenes/date.png" alt="Calendario" name="calendario" width="18" height="18" id="calendario" style="cursor:pointer"/> <span class="textorojo">* </span></td>
            <td class="textotabla1">Observaciones:</td>
            <td><textarea name="observaciones" id="observaciones" cols="45" rows="4" class="textfield02"><?=$dbc->observ_contrato?>
            </textarea></td>
          </tr>
          <tr>
            <td class="textotabla1">Fecha terminacion:</td>
            <td class="textotabla1"><input name="fech_terminacion" type="text" class="textfield2" id="fech_terminacion" readonly="readonly" value="<?=$dbc->fecha_fin_contrato?>" />
              <img src="imagenes/date.png" alt="Calendario" name="calendario2" width="18" height="18" id="calendario2" style="cursor:pointer"/> <span class="textorojo">* </span></td>
            <td class="textotabla1">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="titulosup04">Adjunto:</td>
            <td><input type="file" name="logo" class='botones'/>
                <? if($dbdatos->adjunto!=""){ ?>
                <img src="imagenes/down.png" alt="<?=$dbdatos->adjunto?>" title="<?=$dbdatos->adjunto?>" width="16" height="16" border="0" style="cursor:pointer" onclick="descargar('<?=$dbdatos->adjunto?>')" />
                <? } ?></td>
            <td class="textotabla1">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><!--SOLAPA GARANTIA-->
                <!--FIN SOLAPA GARANTIA--></td>
          </tr>
          <tr>
            <? $fechah = explode("-",$dbdatos->fech_notaria);
			 $diah = $fechah[2];  
			 $mesh = $fechah[1];
			 $anio = $fechah[0];  
		   ?>
            <td colspan="4" class="textotabla1">&nbsp;</td>
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
					inputField  : "fech_iniciacion",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario" ,  
					align       :"T3",
					singleClick :true
				}
				
			);	
						Calendar.setup(
				{
					inputField  : "fech_terminacion",      
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