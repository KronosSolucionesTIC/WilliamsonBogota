<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if ($contrato != 'todos') {

//ACTUALIZACION DE PAGOS ATRASADOS	
		$sql_con ="SELECT cod_calc FROM`contrato_alquiler` 
		WHERE cod_calc = $contrato";
		$db_con= new  Database();
		$db_con->query($sql_con);
		while ($db_con->next_row()) {
		$contrato = $db_con->cod_calc;
		
				$sqlp ="SELECT cod_pago, fecha_ini_pago, fecha_fin_pago, valor_tot_pago, valor_descuento, valor_calculado,valor_recibido, saldo_pago, estado_pago, cod_equipo, cod_contrato,cod_cliente,
fecha_ini_contrato, estado_contrato,DAY(fecha_ini_contrato) as dia,MONTH(fecha_ini_pago) as num_mes,YEAR(fecha_ini_pago) as ano,TIMESTAMPDIFF(MONTH,(fecha_ini_pago),CURDATE()) as meses From pagos
				INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = pagos.cod_contrato)
				WHERE cod_contrato = $contrato ORDER BY fecha_ini_pago DESC";
				$dbdatosp= new  Database();
				$dbdatosp->query($sqlp);
				$dbdatosp->next_row(); 

	
				for ($ii=1 ;  $ii <= $dbdatosp->meses  ; $ii++) 
					{	
					$sqle ="SELECT * FROM `listado_equipos`
					WHERE cod_contrato = $contrato";
					$dbdatose= new  Database();
					$dbdatose->query($sqle);
					
						$sqlpa ="SELECT * ,DAY((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as dia,MONTH((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as mes,YEAR((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as ano,(DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH)) as fecha_fin FROM pagos
						WHERE cod_contrato = $contrato ORDER BY fecha_ini_pago DESC";
						$dbpa= new  Database();
						$dbpa->query($sqlpa);
						$dbpa->next_row();
						
					while ($dbdatose->next_row())
					{	
						// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1. INGRESO EN PAGOS
						$valor_total_pago = $dbdatosp->valor_tot_pago;	
						$fecha_ini_pago = $dbpa->fecha_fin_pago;
						$ano_fin = $dbpa->ano;
						$mes_fin = $dbpa->mes;
						$dia_facturacion = $dbdatosp->dia;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion;					
						$total_pago = $dbdatose->canon_equipo;
						$equipo = $dbdatose->cod_equipo;
						$campos="(fecha_ini_pago,fecha_fin_pago,valor_tot_pago,valor_recibido,saldo_pago,estado_pago,cod_equipo,cod_contrato)";
						$valores="('".$fecha_ini_pago."','".$fecha_fin_pago."','".$total_pago."','0','".$total_pago."','1','".$equipo."','".$contrato."')" ;
						$id = insertar_maestro("pagos",$campos,$valores);						
						
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion2 = $dbdatosp->dia - 1;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion2;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
						
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion3 = $dbdatosp->dia - 2;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion3;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
							
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion4 = $dbdatosp->dia - 3;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion4;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
						
					}
				}
	
	}
///////////////
		
	$sql ="SELECT * FROM contrato_alquiler
	INNER JOIN cliente ON (cliente.cod_cli = contrato_alquiler.cod_cliente)
	WHERE cod_calc = $contrato";
	$dbdatos= new  Database();
	$dbdatos->query($sql);
	$dbdatos->next_row(); 	
	
		$sqlf ="SELECT * FROM `factura` ORDER BY cod_fac DESC";
		$dbf= new  Database();
		$dbf->query($sqlf);
		$dbf->next_row();
		$cons_factura = $dbf->cod_fac + 1; 	
	
				$sqlp ="SELECT *,DAY(fecha_ini_contrato) as dia,`fecha_ini_pago`,MONTH(fecha_ini_pago) as num_mes,YEAR(fecha_ini_pago) as ano,TIMESTAMPDIFF(MONTH,(fecha_ini_pago),CURDATE()) as meses From pagos
				INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc=pagos.cod_contrato)
				WHERE cod_contrato = $contrato ORDER BY fecha_pago DESC";
				$dbdatosp= new  Database();
				$dbdatosp->query($sqlp);
				$dbdatosp->next_row(); 
	
	}
	
else {


//ACTUALIZACION DE PAGOS ATRASADOS	
		$sql_con ="SELECT * FROM contrato_alquiler
		INNER JOIN cliente ON (cliente.cod_cli = contrato_alquiler.cod_cliente)
		WHERE cod_cliente = $clientes";
		$db_con= new  Database();
		$db_con->query($sql_con);
		while ($db_con->next_row()) {
		$contrato = $db_con->cod_calc;
		
				$sqlp ="SELECT cod_pago, fecha_ini_pago, fecha_fin_pago, valor_tot_pago, valor_descuento, valor_calculado,valor_recibido, saldo_pago, estado_pago, cod_equipo, cod_contrato,cod_cliente,
fecha_ini_contrato, estado_contrato,DAY(fecha_ini_contrato) as dia,MONTH(fecha_ini_pago) as num_mes,YEAR(fecha_ini_pago) as ano,TIMESTAMPDIFF(MONTH,(fecha_ini_pago),CURDATE()) as meses From pagos
				INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = pagos.cod_contrato)
				WHERE cod_contrato = $contrato ORDER BY fecha_ini_pago DESC";
				$dbdatosp= new  Database();
				$dbdatosp->query($sqlp);
				$dbdatosp->next_row(); 

	
				for ($ii=1 ;  $ii <= $dbdatosp->meses  ; $ii++) 
					{	
					$sqle ="SELECT * FROM `listado_equipos`
					WHERE cod_contrato = $contrato";
					$dbdatose= new  Database();
					$dbdatose->query($sqle);
					
						$sqlpa ="SELECT * ,DAY((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as dia,MONTH((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as mes,YEAR((DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH))) as ano,(DATE_ADD(fecha_fin_pago,INTERVAL 1 MONTH)) as fecha_fin FROM pagos
						WHERE cod_contrato = $contrato ORDER BY fecha_ini_pago DESC";
						$dbpa= new  Database();
						$dbpa->query($sqlpa);
						$dbpa->next_row();
						
					while ($dbdatose->next_row())
					{	
						// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1. INGRESO EN PAGOS
						$valor_total_pago = $dbdatosp->valor_tot_pago;	
						$fecha_ini_pago = $dbpa->fecha_fin_pago;
						$ano_fin = $dbpa->ano;
						$mes_fin = $dbpa->mes;
						$dia_facturacion = $dbdatosp->dia;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion;					
						$total_pago = $dbdatose->canon_equipo;
						$equipo = $dbdatose->cod_equipo;
						$campos="(fecha_ini_pago,fecha_fin_pago,valor_tot_pago,valor_recibido,saldo_pago,estado_pago,cod_equipo,cod_contrato)";
						$valores="('".$fecha_ini_pago."','".$fecha_fin_pago."','".$total_pago."','0','".$total_pago."','1','".$equipo."','".$contrato."')" ;
						$id = insertar_maestro("pagos",$campos,$valores);						
						
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion2 = $dbdatosp->dia - 1;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion2;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
						
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion3 = $dbdatosp->dia - 2;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion3;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
							
						$sqlup ="SELECT fecha_fin_pago FROM pagos ORDER BY cod_pago DESC LIMIT 1";
						$dbup= new  Database();
						$dbup->query($sqlup);
						$dbup->next_row();
						
						if ($dbup->fecha_fin_pago == 0000-00-00){
						$dia_facturacion4 = $dbdatosp->dia - 3;
						$fecha_fin_pago = $ano_fin."-".$mes_fin."-".$dia_facturacion4;
						$campos = "fecha_fin_pago='".$fecha_fin_pago."'";
						$error=editar("pagos",$campos,'cod_pago',$id) ;	
							}
						
					}
				}
	
	}
///////////////

	$sql ="SELECT * FROM contrato_alquiler
	INNER JOIN cliente ON (cliente.cod_cli = contrato_alquiler.cod_cliente)
	WHERE cod_cliente = $clientes";
	$dbdatos= new  Database();
	$dbdatos->query($sql);
	$dbdatos->next_row();
	
	$sqlf ="SELECT * FROM `factura` ORDER BY cod_fac DESC";
	$dbf= new  Database();
	$dbf->query($sqlf);
	$dbf->next_row();
	$cons_factura = $dbf->cod_fac + 1; 	
	
	$sqlp ="SELECT *,DAY(fecha_ini_contrato) as dia,`fecha_pago`,MONTH(fecha_pago) as num_mes,YEAR(fecha_pago) as ano,TIMESTAMPDIFF(MONTH,(fecha_pago),CURDATE()) as meses From pagos

INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc=pagos.cod_contrato)
WHERE cod_cliente = $clientes ORDER BY fecha_pago DESC";
	$dbdatosp= new  Database();
	$dbdatosp->query($sqlp);
	$dbdatosp->next_row(); 
	
}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 

    $total_factura = $valor_pago ;
	$saldo_factura = $saldo;
	 
	 // RUTINA PARA  INSERTAR REGISTROS NUEVOS 3. MODIFICACION EN PAGOS	ATRASADOS
	 for ($ii=0 ;  $ii < $val_inicial_item_contac ; $ii++) 
		{  			
			// CUANDO EL PAGO REALIZADO ES MAYOR O IGUAL AL PAGO PENDIENTE
			if ($valor_pago >= $_POST["saldo".$ii]) {
			$valor_total_pago = $_POST["saldo".$ii];
			$descuento_unidad = $_POST["descuento_unidad".$ii];
			$saldo_descuento = $valor_total_pago - $descuento_unidad;
			$valor_recibido = $saldo_descuento ;
			$valor_saldo = $valor_pago - $saldo_descuento ;
			$valor = 0;
			$estado = 2;
			$valor_pago = $valor_saldo;
			$paga = $valor_recibido;
			}
			
			// CUANDO EL PAGO ES MAYOR A 0
			elseif($valor_pago > 0) {
			$valor_total_pago = $_POST["saldo".$ii];
			$descuento_unidad = $_POST["descuento_unidad".$ii];
			$saldo_descuento = $valor_total_pago - $descuento_unidad;
			$valor_recib = $_POST["valor_recib".$ii];
			$valor_recibido = $valor_pago;
			$valor_saldo = $saldo_descuento - $valor_pago;
			$paga = $valor_pago;
			$valor_pago = 0;
			$valor = $valor_saldo;
			$estado = 1;
			}
			
			// CUANDO EL PAGO ES IGUAL A 0
			elseif($valor_pago == 0) {
			$valor_total_pago = $_POST["saldo".$ii];
			$descuento_unidad = $_POST["descuento_unidad".$ii];
			$saldo_descuento = $valor_total_pago - $descuento_unidad;
			$valor_recibido = $saldo_descuento;
			$valor = $saldo_descuento ;
			$paga = 0;
				if ($saldo_descuento == 0){
					$estado = 2;
				}
				else {
					$estado = 1;
				}
			}		
			
			$campos="fecha_fin_pago ='".$_POST["fecha_fin_pago_".$ii]."',valor_tot_pago = '".$valor_total_pago."' ,valor_descuento ='".$_POST["descuento_unidad".$ii]."',valor_calculado ='".$saldo_descuento."',saldo_pago ='".$valor."',valor_recibido ='".$valor_recibido."',estado_pago ='".$estado."'";
			$error=editar("pagos",$campos,"cod_pago",$_POST["cod_pago_".$ii]);
			
			// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3. INGRESO EN D_FACTURA
			if ($contrato != 'todos') {
			$campos="(factura,contrato,cod_equipo,fecha_ini_pago,fecha_fin_pago,valor_pago,valor_descuento,valor_con_descuento,valor_recibido,saldo)";
			$valores="('".$cons_factura."','".$contrato."','".$_POST["cod_equipo_".$ii]."','".$_POST["fecha_ini_pago_".$ii]."','".$_POST["fecha_fin_pago_".$ii]."','".$_POST["saldo".$ii]."','".$_POST["descuento_unidad".$ii]."','".$saldo_descuento."','".$paga."','".$valor."')" ;
			$error=insertar("d_factura",$campos,$valores);
			} else {
			$campos="(factura,contrato,valor_pago,valor_con_descuento,valor_recibido,saldo)";			
			$valores="('".$cons_factura."','".$_POST["cod_contrato_".$ii]."','".$_POST["saldo".$ii]."','".$saldito."','".$paga."','".$valor."')" ;
			$error=insertar("d_factura",$campos,$valores);
			}								
		}
	
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3. INGRESO EN FACTURA
		$campos="(fech_factura,fecha_registro,total_deuda,descuento,total_calculado,total_factura,saldo_deuda,forma_pago,cliente,tipo_factura)";
		$valores="('".$fecha_factura."','".date("Y-m-d")."','".$total_pago."','".$descuento."','".$total_descuento."','".$total_factura."','".$saldo_factura."','".$forma_pago."','".$clientes."','1')" ;
		$error=insertar("factura",$campos,$valores);
				
		if ($error==1) {
				header("Location: con_pagos.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
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
if (document.getElementById('fecha_factura').value =='' || document.getElementById('valor_pago').value =='' || document.getElementById('forma_pago').value ==0){
    alert("Digite la informacion completa");
	return false;}
else {
	return true;}
}

function calcular_saldo(){  
var total_pago = document.getElementById('total_descuento').value;
var recibido = document.getElementById('valor_pago').value;
var saldo=0;

total_pago = parseInt(total_pago);
recibido = parseInt(recibido);
saldo = total_pago - recibido;
	if (saldo < 0){
		alert('El valor del pago deber ser menor o igual al saldo');
		document.getElementById('saldo').value = 0 ;
		document.getElementById('valor_pago').value = 0 ;
	}
  	else{
		document.getElementById('saldo').value = saldo ; 
	}	
}

function calcular_total(){  
var total_deuda = document.getElementById('total_pago').value;
var descuento = document.getElementById('descuento').value;
var total = 0;

total_deuda = parseInt(total_deuda);
descuento = parseInt(descuento);
total = total_deuda - descuento;
   document.getElementById('total_descuento').value = total ;
}


function cambiar_saldo(i){  
var descuento = document.getElementById('descuento_unidad'+i).value;
var saldo = document.getElementById('saldo'+i).value;
var contador = document.getElementById('contador').value;
var k = document.getElementById('valor_inicio').value;
var total_deuda = document.getElementById('total_pago').value;
var saldo_calculado = 0;
var total_pago = 0;
	
	descuento = parseInt(descuento);
	saldo = parseInt(saldo);
	saldo_calculado = saldo - descuento;
	if (descuento > saldo){
	alert('El descuento no debe ser mayor al saldo');
	document.getElementById('descuento_unidad'+i).value = 0;
	document.getElementById('descuento_unidad'+i).focus();
	return false;
	}
	else {	
	var total_descuento = 0;
		
	for (i=0; i<=contador; i++) {
	var descuento_unidad = document.getElementById('descuento_unidad'+k).value;
	descuento_unidad = parseInt(descuento_unidad);
	total_descuento = total_descuento + descuento_unidad;
	k++;
	document.getElementById('descuento').value = total_descuento ;
	total_deuda = parseInt(total_deuda);
	total_pago = total_deuda - total_descuento;	
	document.getElementById('total_descuento').value = total_pago ;	
	}
}
}

function texto_saldo(e){  

	document.getElementById('saldo').value = 'Clik para calcular';
	 tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    
    tecla_final = String.fromCharCode(tecla);
    
    return patron.test(tecla_final);
   	
}

function prueba(){
	//TOMA EL VALOR DE LOS CAMPOS
	var cantidad = document.getElementById('contador').value;
	var i = document.getElementById('valor_inicio').value;
	var contador = document.getElementById('val_inicial_item_contac').value;
	
	for (j=1; j<= cantidad; j++) {
	var fecha_texto_original = document.getElementById('fecha_fin_texto_original_'+i).value;
	var fecha_inicio = document.getElementById('fecha_ini_pago_'+i).value;
	var fecha_fin_original = document.getElementById('fecha_fin_original_'+i).value;
	var saldo_original = document.getElementById('saldo_descuento'+i).value;
	var total_deuda = document.getElementById('total_pago_original').value;
	var total_descuento = document.getElementById('descuento').value;
	var saldo = document.getElementById('saldo'+i).value;
	var saldo_calculado = 0;
	
		//PONE LA FECHA ACTUAL
		if (document.getElementById('pago_entrega').checked == true){
			var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			var f = new Date();
			fecha_texto = (meses[f.getMonth()] + " " + f.getDate() + "/" + f.getFullYear());
			fecha = (f.getFullYear() + "-" + (f.getMonth()+1) + "-" + f.getDate());
			document.getElementById('fecha_fin_texto_pago_'+i).value = fecha_texto;
			document.getElementById('fecha_fin_pago_'+i).value = fecha;
			
			//LLAMA A LA FUNCION DE CALCULAR LOS DIAS
			var dias = daysBetween(fecha,fecha_inicio);
			
			//CALCULA EL VALOR A PAGAR
			saldo = parseInt(saldo);
			dias = parseInt(dias);
			total_deuda = parseInt(total_deuda);
		
			valor_dia = saldo / 30 ;
			saldo_calculado = valor_dia * dias;
			var saldo_calculado = Math.round(saldo_calculado);
			
			document.getElementById('saldo'+i).value = saldo_calculado;
			var total_deuda_calculada = 0;
				for(ii=0; ii< contador; ii++){
					var saldo = document.getElementById('saldo'+ii).value; 
					saldo = parseInt(saldo);
					total_deuda_calculada = total_deuda_calculada + saldo;
				} 
			total_descuento = parseInt(total_descuento);
			total = total_deuda_calculada - total_descuento;
			document.getElementById('total_pago').value = total_deuda_calculada;
			document.getElementById('total_descuento').value = total;
			i++;
		}
		
			if (document.getElementById('pago_entrega').checked == false){
				document.getElementById('fecha_fin_texto_pago_'+i).value = fecha_texto_original;
				document.getElementById('fecha_fin_pago_'+i).value = fecha_fin_original;
				document.getElementById('saldo'+i).value = saldo_original;
				document.getElementById('total_pago').value = total_deuda;
				var total_deuda_calculada = 0;
				
					for(ii=0; ii< contador; ii++){
						var saldo = document.getElementById('saldo'+ii).value; 
						saldo = parseInt(saldo);
						total_deuda_calculada = total_deuda_calculada + saldo;
					} 
				total_descuento = parseInt(total_descuento);
				total = total_deuda_calculada - total_descuento;
				document.getElementById('total_pago').value = total_deuda_calculada;
				document.getElementById('total_descuento').value = total;
				i++;
			}
		}

	}
	
	
//SACA LOS DIAS ENTRE DOS FECHAS
function daysBetween(date1, date2){ 
   if (date1.indexOf("-") != -1) { date1 = date1.split("-"); } else if (date1.indexOf("/") != -1) { date1 = date1.split("/"); } else { return 0; } 
   if (date2.indexOf("-") != -1) { date2 = date2.split("-"); } else if (date2.indexOf("/") != -1) { date2 = date2.split("/"); } else { return 0; } 
   if (parseInt(date1[0], 10) >= 1000) { 
       var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);
   } else if (parseInt(date1[2], 10) >= 1000) { 
       var sDate = new Date(date1[2]+"/"+date1[0]+"/"+date1[1]);
   } else { 
       return 0; 
   } 
   if (parseInt(date2[0], 10) >= 1000) { 
       var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);
   } else if (parseInt(date2[2], 10) >= 1000) { 
       var eDate = new Date(date2[2]+"/"+date2[0]+"/"+date2[1]);
   } else { 
       return 0; 
   } 
   var one_day = 1000*60*60*24; 
   var daysApart = Math.abs(Math.ceil((sDate.getTime()-eDate.getTime())/one_day)); 
   return daysApart; 
} 
</script>


<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_pagos.php"  method="post" enctype="multipart/form-data">
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
        <td width="21" class="ctablaform"><a href="con_pagos.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_pagos.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo"   id="codigo"   value="<?=$codigo?>" />
		  <input type="hidden" name="contrato"   id="contrato"   value="<?=$contrato?>" />
		  <input type="hidden" name="clientes"   id="clientes"   value="<?=$clientes?>" />		  
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="26" class="textotabla1 Estilo1">PAGOS:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top"><table width="900" border="0">
      <tr>
        <td width="900"><table width="897" border="0" cellspacing="0" cellpadding="0">
          
		  <? if ($contrato != 'todos') { ?> 
          <tr>
            <td width="150" class="textotabla1">&nbsp;</td>
            <td width="150" class="textotabla1">N&deg; contrato : </td>
            <td width="150" class="textotabla1"><span class="ctablaform">
              <?=$dbdatos->consecutivo?>
            </span></td>
            <td width="150" class="textotabla1">&nbsp;</td>
            <td width="150" class="textotabla1">&nbsp;</td>
            <td width="150" class="textotabla1">&nbsp;</td>
          </tr>
		  <? } ?>
          <tr>
            <td colspan="6" class="botonforms"><div align="center">DATOS DEL CLIENTE </div></td>
            </tr>
          
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">Nombre:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbdatos->nom1_cli?>
              <?=$dbdatos->nom2_cli?>
              <?=$dbdatos->apel1_cli?>
              <?=$dbdatos->apel2_cli?>
              <span class="textorojo">
              <input name="v_cod_cliente_fac" type="hidden" class="textfield002" id="v_cod_cliente_fac" onkeypress="return validaInt_1()" value="<? if ($codigo!=0) { ?><?=$dbdatos->cod_cliente_cont?><? } else { ?><?=$codigo_cliente?><? }?>" />
            </span></span></td>
            <td class="textotabla1">
              <? if ($dbdatos->tipo_persona == 1) { ?>
              No. Identificaci&oacute;n:
              <? } else { ?>
              NIT:
              <? } ?>
            </td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbdatos->cedula_cli?>
            </span></td>
            <td class="textotabla1">&nbsp;</td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">Direcci&oacute;n:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbdatos->direccion_cli?>
			</span>			</td>
            <td class="textotabla1">Tel&eacute;fono:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbdatos->telefono_cli?>
            </span></td>
            <td class="textotabla1">&nbsp;</td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">E-mail:</td>
            <td class="textotabla1">
			<span class="ctablaform">
			<?=$dbdatos->email_cli?>
			</span>			</td>
            <td class="textotabla1">Celular:</td>
            <td class="textotabla1"><span class="ctablaform">
              <?=$dbdatos->celular_cli?>
            </span></td>
            <td class="textotabla1">&nbsp;</td>
            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="9" class="textotabla1"><!--SOLAPA GARANTIA-->
                <!--FIN SOLAPA GARANTIA--></td>
          </tr>
          
          
          <tr>
            <td colspan="9" class="textotabla1"><!--SOLAPA GARANTIA--><!--FIN SOLAPA GARANTIA--></td>
          </tr>
        </table>
		</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><table bgcolor="#E9E9E9" valign="top" width="900" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td colspan="9" class="botonforms"><div align="center">DATOS DE FACTURACI&Oacute;N </div></td>
      </tr>
      <tr>
        <td width="51" class="textotabla1">&nbsp;</td>
        <td width="107" class="textotabla1">Fecha ultimo pago: </td>
        <td width="157" class="textotabla1"><?=$dbdatosp->fecha_ini_pago?>
          <input type="hidden" name="fecha_ultimo" id="fecha_ultimo" value="<?=$dbdatosp->fecha_pago?>" /></td>
        <td width="107" class="textotabla1">&nbsp;</td>
        <td width="107" class="textotabla1">Fecha actual: </td>
        <td width="144" class="textotabla1"><?=date ('Y-m-d')?></td>
        <td width="107" class="textotabla1">&nbsp;</td>
        <td width="63" class="textotabla1">&nbsp;</td>
        <td width="57" class="textotabla1"><input type="hidden" name="cant_meses" id="cant_meses" value="<?=$dbdatosp->meses?>" /></td>
      </tr>
      
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">Fecha factura: </td>
        <td class="textotabla1"><input name="fecha_factura" type="text" class="textfield2" id="fecha_factura" readonly="readonly" value="<?=date('Y-m-d')?>" />
          <img src="imagenes/date.png" alt="Calendario" name="calendario" width="18" height="18" id="calendario" style="cursor:pointer"/> <span class="textorojo">*</span></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">Forma pago: </td>
        <td class="textotabla1"><? combo_evento("forma_pago","tipo_pago","cod_tipo_pago","desc_tipo_pago","","", "desc_tipo_pago"); ?>
          <span class="textorojo">*</span></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms"><div align="center">CONTRATO</div></td>
        <td class="botonforms"><div align="center">ARTICULO</div></td>
        <td class="botonforms"><div align="center">FECHA INICIO</div></td>
        <td class="botonforms"><div align="center">FECHA FIN</div></td>
        <td class="botonforms"><div align="right">SALDO</div></td>
         <td class="botonforms"><div align="right">DESCUENTO</div></td>
        <td class="botonforms"><div align="right">
          <div align="center">PAGO DE ENTREGA</div>
        </div></td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
	  <?
	  if ($contrato != 'todos') {
	  	$sqld = "SELECT *,MONTH(fecha_ini_pago) as num_mes_ini,YEAR(fecha_ini_pago) as ano_ini,DAY(fecha_ini_pago) as dia_ini,MONTH(fecha_fin_pago) as num_mes_fin,YEAR(fecha_fin_pago) as ano_fin,DAY(fecha_fin_pago) as dia_fin FROM `pagos` 
		INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = pagos.cod_contrato)
		INNER JOIN equipos ON (equipos.cod_equipo = pagos.cod_equipo)
		INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
		INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
		WHERE cod_contrato = $contrato and `saldo_pago` >0 and fecha_ini_pago <= CURDATE() ORDER BY fecha_ini_pago ASC";
		$dbdatosd= new  Database();
		$dbdatosd->query($sqld);
		$total=0;
		$j = 0;
		$i = 0;
		while ($dbdatosd->next_row())
		{
		echo "<tr>";
        echo "<td class='textotabla1'>&nbsp;</td>";
		echo "<td class='textotabla1'><div align='center'>$dbdatosd->consecutivo</div><input type='hidden' name='cod_pago_$j'   id='cod_pago_$j'   value='$dbdatosd->cod_pago' /></td>";
		$a = $dbdatosd->num_mes_ini;
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
		$b = $dbdatosd->num_mes_fin;
		switch ($b) 
		{
   case 1: $b="Enero"; break;
   case 2: $b="Febrero"; break;
   case 3: $b="Marzo"; break;
   case 4: $b="Abril"; break;
   case 5: $b="Mayo"; break;
   case 6: $b="Junio"; break;
   case 7: $b="Julio"; break;
   case 8: $b="Agosto"; break;
   case 9: $b="Septiembre"; break;
   case 10: $b="Octubre"; break;
   case 11: $b="Noviembre"; break;
   case 12: $b="Diciembre"; break;
		}
		echo "<td class='textotabla1'><div align='center'>$dbdatosd->nom_clase $dbdatosd->nom_equipo $dbdatosd->desc_tipo_equipos</div><input type='hidden' name='cod_contrato_$j'   id='cod_contrato_$j'   value='$dbdatosd->cod_calc' />
		<input type='hidden' name='cod_equipo_$j'   id='cod_equipo_$j'   value='$dbdatosd->cod_equipo' /></td>";
		$saldito= number_format($dbdatosd->saldo_pago,0,'.','.');
        echo "<td class='textotabla1'><div align='center'>$a $dbdatosd->dia_ini/$dbdatosd->ano_ini<input type='hidden' name='fecha_ini_pago_$j'   id='fecha_ini_pago_$j'   value='$dbdatosd->fecha_ini_pago' /></div></td>";
		if (($dbdatosd->num_mes_ini == date('m') and $dbdatosd->ano_ini == date('Y')) or ($dbdatosd->num_mes_fin == date('m') and $dbdatosd->ano_fin== date('Y'))){
		$i++;
		if ($i == 1) {
		$k = $j;
		}
		echo "<td class='textotabla1'><div align='center'><input type='text' name='fecha_fin_texto_pago_$j'  style='text-align:center;' id='fecha_fin_texto_pago_$j'  readonly='readonly' value='$b $dbdatosd->dia_fin/$dbdatosd->ano_fin' /><input type='hidden' name='fecha_fin_texto_original_$j'   id='fecha_fin_texto_original_$j'   value='$b $dbdatosd->dia_fin/$dbdatosd->ano_fin' /><input type='hidden' name='fecha_fin_pago_$j'   id='fecha_fin_pago_$j'   value='$dbdatosd->fecha_fin_pago' /><input type='hidden' name='fecha_fin_original_$j'   id='fecha_fin_original_$j'   value='$dbdatosd->fecha_fin_pago' /></div></td>";
		echo "<td class='textotabla1'><input type='hidden' name='valor_tot_pago$j'   id='valor_tot_pago$j'   value='$dbdatosd->valor_tot_pago' /><input type='hidden' name='valor_recib$j'   id='valor_recib$j'   value='$dbdatosd->valor_recibido' /><div align='right'><input type='text' name='saldo$j' id='saldo$j' style='text-align:right;' value='$dbdatosd->saldo_pago' readonly = 'readonly'/><input type='hidden' name='saldo_descuento$j' id='saldo_descuento$j' style='text-align:right;' value='$dbdatosd->saldo_pago' /></td><td class='textotabla1'><input type='text' name='descuento_unidad$j' id='descuento_unidad$j' style='text-align:right;' onblur='cambiar_saldo($j);' value='0'/></div></td>";
		}
		else {
		echo "<td class='textotabla1'><div align='center'>$b $dbdatosd->dia_fin/$dbdatosd->ano_fin<input type='hidden' name='fecha_fin_pago_$j'   id='fecha_fin_pago_$j'   value='$dbdatosd->fecha_fin_pago' /></div></td>";
        echo "<td class='textotabla1'><div align='right'>$saldito</div><input type='hidden' name='valor_tot_pago$j'   id='valor_tot_pago$j'   value='$dbdatosd->valor_tot_pago' /><input type='hidden' name='valor_recib$j'   id='valor_recib$j'   value='$dbdatosd->valor_recibido' /><input type='hidden' name='saldo$j'   id='saldo$j'   value='$dbdatosd->saldo_pago' /><input type='hidden' name='saldo_descuento$j' id='saldo_descuento$j' style='text-align:right;' value='$dbdatosd->saldo_pago' /><input type='hidden' name='descuento_unidad$j' id='descuento_unidad$j' style='text-align:right;' /></td>";
		}
		$total = $total+$dbdatosd->saldo_pago ;	
      	echo "</tr>";
		$j++; 
		} 
		}
		else {
		$sqld = "SELECT *,MONTH(fecha_ini_pago) as num_mes_ini,YEAR(fecha_ini_pago) as ano_ini,DAY(fecha_ini_pago) as dia_ini,MONTH(fecha_fin_pago) as num_mes_fin,YEAR(fecha_fin_pago) as ano_fin,DAY(fecha_fin_pago) as dia_fin FROM `pagos` 
		INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = pagos.cod_contrato)
		INNER JOIN equipos ON (equipos.cod_equipo = pagos.cod_equipo)
		INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
		INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
		WHERE cod_cliente = $clientes and `saldo_pago` >0 and fecha_ini_pago <= CURDATE() ORDER BY fecha_ini_pago ASC";
		$dbdatosd= new  Database();
		$dbdatosd->query($sqld);
		$total=0;
		$j = 0;
		while ($dbdatosd->next_row())
		{
		echo "<tr>";
        echo "<td class='textotabla1'>&nbsp;</td>";
        echo "<td class='textotabla1'><div align='center'>$dbdatosd->consecutivo</div><input type='hidden' name='cod_pago_$j'   id='cod_pago_$j'   value='$dbdatosd->cod_pago' /></td>";
				$a = $dbdatosd->num_mes_ini;
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
			$b = $dbdatosd->num_mes_fin;
		switch ($b) 
		{
   case 1: $b="Enero"; break;
   case 2: $b="Febrero"; break;
   case 3: $b="Marzo"; break;
   case 4: $b="Abril"; break;
   case 5: $b="Mayo"; break;
   case 6: $b="Junio"; break;
   case 7: $b="Julio"; break;
   case 8: $b="Agosto"; break;
   case 9: $b="Septiembre"; break;
   case 10: $b="Octubre"; break;
   case 11: $b="Noviembre"; break;
   case 12: $b="Diciembre"; break;
		}
        echo "<td class='textotabla1'><div align='center'>$dbdatosd->nom_clase $dbdatosd->nom_equipo $dbdatosd->desc_tipo_equipos</div><input type='hidden' name='cod_contrato_$j'   id='cod_contrato_$j'   value='$dbdatosd->cod_calc' />
		<input type='hidden' name='cod_equipo_$j'   id='cod_equipo_$j'   value='$dbdatosd->cod_equipo' /></td>";
        echo "<td class='textotabla1'><div align='center'>$a $dbdatosd->dia_ini/$dbdatosd->ano_ini<input type='hidden' name='fecha_ini_pago_$j'   id='fecha_ini_pago_$j'   value='$dbdatosd->fecha_ini_pago' /></div></td>";
		echo "<td class='textotabla1'><div align='center'>$b $dbdatosd->dia_fin/$dbdatosd->ano_fin<input type='hidden' name='fecha_fin_pago_$j'   id='fecha_fin_pago_$j'   value='$dbdatosd->fecha_fin_pago' /></div></td>";
		if ($dbdatosd->num_mes_ini == 3){
		echo "<td class='textotabla1'><input type='hidden' name='valor_tot_pago$j'   id='valor_tot_pago$j'   value='$dbdatosd->valor_tot_pago' /><input type='hidden' name='valor_recib$j'   id='valor_recib$j'   value='$dbdatosd->valor_recibido' /><div align='right'><input type='visible' name='saldo$j'   id='saldo$j'   value='$dbdatosd->saldo_pago' readonly = 'readonly'/></div></td>";
		}
		else {
        echo "<td class='textotabla1'><input type='hidden' name='valor_tot_pago$j'   id='valor_tot_pago$j'   value='$dbdatosd->valor_tot_pago' /><input type='hidden' name='valor_recib$j'   id='valor_recib$j'   value='$dbdatosd->valor_recibido' /><div align='right'><input type='hidden' name='saldo$j'   id='saldo$j'   value='$dbdatosd->saldo_pago' readonly = 'readonly'/></div></td>";
		}
		$total = $total+$dbdatosd->saldo_pago ;	
      	echo "</tr>";
		$j++; 
		} 
		}
	  ?>
      
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td width="107" class="botonforms">&nbsp;</td>
        <td width="107" class="botonforms"><div align="right">TOTAL DEUDA: </div></td>
        <td class="titulosup04" id="valor_total"><div align="right">
          <input type="text" name="total_pago"   id="total_pago" style="text-align:right;"  readonly="readonly" value="<?=$total?>" />
        </div></td>
        <td class="textotabla1"><input type="hidden" name="total_pago_original" id="total_pago_original" value="<?=$total?>" />
          <input type="hidden" name="val_inicial_item_contac" id="val_inicial_item_contac" value="<?=$j?>" />
          <input type="hidden" name="contador" id="contador"   value="<?=$i?>" />
          <input type="hidden" name="valor_inicio" id="valor_inicio"   value="<?=$k?>" /></td>
        <td class="textotabla1"><div align="center">
          <input type="checkbox" name="pago_entrega" id="pago_entrega"  onclick="prueba()"/>
        </div></td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms"><div align="right">TOTAL DESCUENTO: </div></td>
        <td id="valor_total"><div align="right">
          <input name="descuento" type="text" style="text-align:right;"  id="descuento" readonly="readonly" Value="0"/>
        </div></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms"><div align="right">TOTAL: </div></td>
        <td class="titulosup04" id="valor_total3"><div align="right">
          <input name="total_descuento" type="text" style="text-align:right;"  id="total_descuento" onkeypress="return texto_saldo(event);" Value="<?=$total?>" readonly="readonly"/>
        </div></td>
        <td class="textotabla1"><input type="hidden" name="tot_factura_calculado" id="tot_factura_calculado" /></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms"><div align="right">VALOR PAGO: </div></td>
        <td class="titulosup04" id="valor_total2"><div align="right">
          <input name="valor_pago" type="text" style="text-align:right;"  id="valor_pago" onkeypress="return texto_saldo(event);" />
        </div></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms">&nbsp;</td>
        <td class="botonforms"><div align="right">SALDO: </div></td>
        <td class="titulosup04" id="valor_total"><div align="right">
          <input name="saldo" type="text" style="text-align:right;" id="saldo"   onfocus="calcular_saldo();" />
        </div></td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        </tr>
       
      <tr>
        <td colspan="12" class="textotabla1"><!--SOLAPA GARANTIA-->
            <!--FIN SOLAPA GARANTIA--></td>
      </tr>
      
      <tr>
        <td colspan="12" class="textotabla1"><!--SOLAPA GARANTIA-->
            <!--FIN SOLAPA GARANTIA--></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>

</form> 
<script type="text/javascript">	
	Calendar.setup(
				{
					inputField  : "fecha_factura",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario" ,  
					align       :"T3",
					singleClick :true
				}
				
			);				
			
</script>
</body>
</html>