<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<link rel='STYLESHEET' href='../css/print_static.css' type='text/css' />
<link rel='STYLESHEET' href='../../../css/print_static.css' type='text/css' />
	<body>
		<div id='body'>
		<div id='section_header'>
		</div>
		
		<div id='content'>
		<div class='page' style='font-size: 7pt'>
		<table style='width: 100%;' cellpadding='-1' cellspacing='0' border='1' class='change_order_items'  >
		<TR> <script type="text/php">
	if ( isset($pdf) ) {
	
	  $font = Font_Metrics::get_font("verdana");
	  $size = 6;
	  $color = array(0,0,0);
	  $text_height = Font_Metrics::get_font_height($font, $size);
	
	  $foot = $pdf->open_object();
	  
	  $w = $pdf->get_width();
	  $h = $pdf->get_height();
	
	  // Draw a line along the bottom
	  $y = $h - $text_height - 24;
	  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);
	
	  $y += $text_height;
	
	 
	  //$pdf->text(100,100 , $text, $font, $size, $color);
	  $pdf->close_object();
	  $pdf->add_object($foot, "all");
	
	  global $initials;
	  $initials = $pdf->open_object();
	  
	  // Add an initals box
	  
	  $text = "Elaborado por: DIANA CORNEJO";
	  $width = Font_Metrics::get_text_width($text, $font, $size);
	  $pdf->text($w - 220 - $width - 150, $y, $text, $font, $size, $color);
	 
	  $text = "Revisado por: NIDIA CARRILLO";
	  $width = Font_Metrics::get_text_width($text, $font, $size);
	  $pdf->text($w - 120 - $width - 150, $y, $text, $font, $size, $color);
	  
	  $text = "Aprobado por: GILBERTO MENDEZ";
	  $width = Font_Metrics::get_text_width($text, $font, $size);
	  $pdf->text($w - 20 - $width - 150, $y, $text, $font, $size, $color);
	 
	 $fecha=date("Y-m-d");
	  $text = "FECHA: $fecha";
	  $width = Font_Metrics::get_text_width($text, $font, $size);
	  $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
	
	  $pdf->close_object();
	  $pdf->add_object($initials);
	
	  $text = "Pagina {PAGE_NUM} de {PAGE_COUNT}";  
	
	  // Center the text
	  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
	  $pdf->page_text($width, $y, $text, $font, $size, $color);
	  
	}
	</script><TD id='td_7' rowspan='3' align='center'><table width='200' border='0'>
        <tr><td><img src='../../../images/logo.jpg' width='160' height='74'></td></tr>
      </table></TD><TD id='td_2' align='center' class='normal'><strong>FORMATO DE COTIZACION IMPORTACION AEREA</strong></TD>
<TD id='td_3' align='center' class='normal'><strong>VERSION 1</strong></TD>
</TR><TR>
<TD id='td_5' align='center' class='normal'><strong>FIA-DCM-052</strong></TD>
<TD id='td_6' align='center' class='normal'><strong>FECHA FEBRERO DE 2008</strong></TD>
</TR><TR>
<TD id='td_8' align='center' class='normal'><strong>COTIZACION No CZ10030021</strong> </TD>
<TD id='td_9' align='center' class='normal'><strong>PAGINA 1 DE 2</strong></TD>
</TR>
</table>
</div>
<table style='width: 100%; font-size: 8pt;' ><tr><td width='46%' valign='top'>
   <table style='width: 100%; font-size: 8pt;' ><tr><td width='46%' valign='top'>
	<table style='width: 100%;' border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
  <tr>
    <td bgcolor='#FFFFFF'><table style='width: 97%;' border='0' cellpadding='1' bordercolor='#000000' >
      <tr>
        <td width='35%' class='even_row_1'><strong>FECHA</strong></td>
        <td width='65%' class='even_row_1'>2010-03-24</td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>SE&Ntilde;ORES</strong></td>
        <td class='even_row_1'>JORGE ENRIQUE RAMOS CAICEDO</td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>ATN. SR</strong></td>
        <td class='even_row_1'></td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>E-MAIL</strong></td>
        <td class='even_row_1'>yill_mr@jmclogistics.com</td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>MERCANCIA:</strong></td>
        <td class='even_row_1'>NO PELIGROSA</td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>TIPO:</strong></td>
        <td class='even_row_1'>PLATA DOC</td>
      </tr>
      <tr>
        <td class='even_row_1'><strong>MONEDA</strong></td>
        <td class='even_row_1'>JEN</td>
        </tr>
      <tr>
        <td class='even_row_1'><strong>TERMINO DE NEGOCIACION</strong></td>
        <td class='even_row_1'>CIF</td>
      </tr>
    </table>
	
	 </td></tr></table></td>
		<td style='width:2%'>&nbsp;</td>
		<td width='47%' valign='top'><table width='100%' border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
          <tr>
            <td bgcolor='#FFFFFF'  valign='top'>
			<table width='98%' border='0' align='center' >
          <tr><td class='even_row_1' align='center'>JMC LOGISTICS CARGO LTDA</td>
          </tr>
          <tr>
            <td class='even_row_1' align='center'>NIT 8301215864</td>
          </tr>
          <tr>
            <td class='even_row_1' align='center'>CALLE 25C N 84B-05 OF 401</td>
          </tr>
		   <tr>
            <td class='even_row_1' align='center'>PBX (571) 4108238/4299982</td>
          </tr>
		   <tr>
            <td class='even_row_1' align='center'>FAX 4299474</td>
          </tr>
		   
		   <tr>
            <td class='even_row_1' align='center'>yill_mr@hotmail.com</td>
          </tr>
		   <tr>
            <td class='even_row_1' align='center'>diana.cornejo@mclogisticscargo.com</td>
          </tr>
		   <tr>
		     <td class='even_row_1' align='center'>www.jmclogistics.com</td>
		     </tr> <tr>
		     <td class='even_row_1' align='center'>&nbsp;</td>
		     </tr>
		   <tr>
		     <td class='even_row_1' align='center'>&nbsp;</td>
		     </tr>
		   <tr>
		     <td class='even_row_1' align='center'>&nbsp;</td>
		     </tr>
		   <tr>
		     <td class='even_row_1' align='center'>&nbsp;</td>
		     </tr>
		  <p>&nbsp;<BR/><p>&nbsp;<BR/>
      </table> </td></tr></table></td></tr></table>
	  
	 <table style='width: 100%;  font-size: 8pt;'>
	<tr><td style='width: 100%;  font-size: 8pt; text-align:justify' class='change_order_items'>DE ACUERDO CON SU AMABLE SOLICITUD DE COTIZACION DE TRANSPORTE INTERNACIONAL A CONTINUACION NOS PERMITIMOS INFORMAR LAS TARIFAS VIGENTES DE CARGA NO PELIGROSA PARA DICHO TRAYECTO, LAS CUALES ESTAMOS SEGUROS SERAN FAVORABLE A SU INTERES.</td></tr>
	<tr>
 		<td>&nbsp;</td>
	</tr>
	<tr>
      <td><table style='width: 100%;' cellpadding='-1' cellspacing='0' border='1' class='change_order_items' >
           <tr>
            <td colspan='4' class='subfongris'>
              IMPORTACION AEREA</td>
            </tr>
          <tr>
            <td colspan='4' class='even_row_1'>&nbsp;COTIZACION BASADA EN </td>
            </tr>
		  <tr>
            <td class='even_row_1'>No PIEZAS</td>
            <td class='even_row_1'>&nbsp;&nbsp;20&nbsp;&nbsp;CAJAS</td>
            <td class='even_row_1'>PESO BRUTO KGS</td>
            <td class='even_row_1'>&nbsp;&nbsp;800.00</td>
          </tr>
          <tr>
            <td class='even_row_1'>KILO VOLUMEN</td>
            <td class='even_row_1'>&nbsp;&nbsp;261.00</td>
            <td class='even_row_1'>VALOR SEGUN TERMINO ADUANA USD</td>
            <td class='even_row_1'>&nbsp;&nbsp;1.200.00</td>
          </tr>
          <tr>
            <td class='even_row_1'>VOLUMEN (m&sup3;)</td>
        
		    <td class='even_row_1'>&nbsp;&nbsp;1.56</td>
		
		 
            <td  class='even_row_1'>TRAYECTO</td>
            <td  class='even_row_1'>&nbsp;&nbsp;TOKIO / BOGOTA</td>
          </tr>
      </table></td></tr><tr><td>&nbsp;</td></tr><tr><td>
	  
	   <table style='width: 100%;' cellpadding='-1' cellspacing='0' border='1' class='change_order_items'>
  <tr>
    <td width='6%' class='subfongris'>PAIS</td>
    <td width='6%' class='subfongris'>ORIGEN</td><td width='11%'  class='subfongris' >TARIAFA ESCALONADA SOBRE JEN / KG</td> <td style='width:5%' class='subfongris'>TIEMPO DE TRANSITO </td>
    <td style='width:5%' class='subfongris'>FRECUENCIA</td>
    <td style='width:5%' class='subfongris'>TARIFA VIGENTE </td>
  	</tr>
  	<tr>
		<td  class='even_row_1' align='center'>&nbsp;&nbsp;JAPON</td>
		<td  class='even_row_1' align='center'>&nbsp;&nbsp;TOKIO</td><td width='11%' valign='top'  ><table style='width: 100%;' cellpadding='-1' cellspacing='0' border='1' class='change_order_items_1' >
      <tr><td class='subfongris' valign='top' >+100</td><td class='subfongris' valign='top' >MINIMA</td><td class='subfongris' valign='top' >+500</td><td class='subfongris' valign='top' >+1.000</td></tr>
		<tr><td class='even_row_2'>&nbsp;&nbsp;78.00</td><td class='even_row_2'>&nbsp;&nbsp;500.00</td><td class='even_row_2'>&nbsp;&nbsp;200.00</td><td class='even_row_2'>&nbsp;&nbsp;300.00</td></tr>
		 </table>
		 </td><td style='width:5%' class='even_row_1' align='center' >7 A 10 DIAS</td><td style='width:5%' class='even_row_1' align='center'>&nbsp;&nbsp;LUNES A VIERNES</td><td style='width:5%' class='even_row_1' align='center'>&nbsp;&nbsp;15 MARZO 2010</td></tr>
	 </table>
	 </td>
	 </tr>
	 </table>
	 <table style='width: 100%' cellpadding='-1' cellspacing='0' border='1' class='change_order_items'>
	<tr>
	<td colspan='7' align='center' class='subfongris'>COSTOS NO INCLUIDOS EN LAS TARIFAS</td>
	</tr>
	<tr>
	<th colspan='2' rowspan='2' class='subfongris'>RECARGO EN ORIGEN </th>
	<td width='9%' class='subfongris' style='border-right-style: none'>TARIFAS</td>
	<td colspan='2' style='border-right-style: none' class='subfongris'>MINIMA</td>
	<td colspan='2' style='text-align: center' class='subfongris'>LIQUIDACION</td>
	</tr>
	<tr>
	<td class='subfongris'>JPY</td>
	<td width='9%' class='subfongris'>USD</td>
	<td width='9%' class='subfongris'>PESOS</td>
	<td width='10%' class='subfongris'>USD</td>
	<td width='11%' class='subfongris'>PESOS</td>
	</tr><tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;FLETE INTERNACIONAL&nbsp;&nbsp;&nbsp;(Kg Vol)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>595&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >7.382.76&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>14.765.520
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_2'>
		<td colspan='2' >&nbsp;&nbsp;FUEL SURCHARGE&nbsp;&nbsp;&nbsp;(Kg Vol)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>75&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >930.60&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>1.861.200
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;TERMINAL CHARGES&nbsp;&nbsp;&nbsp;(Kg Vol)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>30&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >372.24&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>744.480
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_2'>
		<td colspan='2' >&nbsp;&nbsp;SECURITY&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>750&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >750.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>1.500.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;PICK UP&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>45000&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >45.000.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>90.000.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_2'>
		<td colspan='2' >&nbsp;&nbsp;CUSTOM CLEARENCE&nbsp;&nbsp;&nbsp;(Seleccione)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>10500&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >10.500.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>21.000.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;AMS FEE&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>4500&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >4.500.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>9.000.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_2'>
		<td colspan='2' >&nbsp;&nbsp;AWB FEE&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>6500&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >6.500.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>13.000.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;HANDLING CHARGES&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>12000&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >12.000.00&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>24.000.000
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_2'>
		<td colspan='2' >&nbsp;&nbsp;ADUANA DE EXPORTACIòN 0. 35%  SOBRE EL VALOR FOB &nbsp;&nbsp;&nbsp;(Vlr Aduana)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.35&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >4.20&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>8.400
      &nbsp;&nbsp;</td></tr>
		 <tr class='even_row_1'>
		<td colspan='2' >&nbsp;&nbsp;DOCUMENTACION&nbsp;&nbsp;&nbsp;(Valor Fijo)</td>
		<td class='change_order_total_col' style='border-left-style: none;'>25000&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0.00&nbsp;&nbsp;</td>
		<td class='change_order_total_col' style='border-left-style: none;'>0&nbsp;&nbsp;</td>
		<td class='change_order_total_col' >12.50&nbsp;&nbsp;</td>
<td class='change_order_total_col' style='border-right-style: none;'>25.000
      &nbsp;&nbsp;</td></tr>
		 
	   <tr>
	   <td colspan='3' style='text-align: left;'>&nbsp;&nbsp;Tasa de cambio aproximada USD - $ 2.000.00&nbsp;&nbsp;</td>
  <td colspan='2' style='text-align: right;'><strong>VALOR APROXIMADO : &nbsp;&nbsp;</strong></td><td class='change_order_total_col'><strong>87.952.30&nbsp;&nbsp;</strong></td>
 		<td class='change_order_total_col'><strong>175.904.600&nbsp;&nbsp;</strong></td></tr>
		  <tr>
		    <td colspan='7' style='text-align: left;'>&nbsp;&nbsp;Tasa de cambio aproximada JPY - USD &nbsp; 0.01167&nbsp;&nbsp; </td>
       </tr>
		  <tr>
			<td colspan='7' style='text-align: left;'>&nbsp;&nbsp;Ruta de embarque TOKIO-MIAMI-BOGOTA&nbsp;&nbsp;</td></tr></table>
		 <table   align='left'>
 		<tr>
		<td colspan='2' >Nota:</td>
	   </tr>
	   <tr>
  		<td colspan='3' style='text-align:justify; font-size: 12px'><br />SADEREWREWR
<br />DDFDFDFDF
<br />FSDFRRRETRETRT
		<p > NOTA ESPECIAL:</span></p>
      <p class="datos_clausuara">SE COBRARA EL GRAVAMEN FINACIERO QUE ES EL 0. 4% DE LOS PAGOS QUE SE EFECTUAN A TERCEROS.<br/>
        Para la consignación del documento de transporte, favor indicar a JMC LOGISTICS CARGO LTDA. Las instrucciones de corte, el cliente será responsable por los prejuicios que ocasionan la información incorrecta de los documentos (volumen, número de piezas, identificación genérica de las mercancías etc.). Y asumirá las multas o sanciones aduaneras originadas por la información errónea. La propuesta comercial en referencia, esta basada en las condiciones actuales del mercado, por lo que cualquier variación por parte del transportista que intervienen en el transporte, afectará ésta en forma proporcional. Los gastos en origen que no sean parte del acuerdo de compra del exportador con el importador en el exterior y que sin embargo se causen por el normal manejo de la carga hasta su embarque serán cargados al exportador de dicho despacho. </p>
      <p class="datos_clausuara">JMC LOGISTICS CARGO LTDA, se limita a la consecución de espacios y reservas actuando  bajo mandato, por lo que no representa a los daños de la carga ni a los transportadores que intervienen en el transporte, tampoco es responsable por cambios, demoras, imprevistos o fuerzas mayores que tengan los transportistas involucrados en sus diversos movimientos, de igual forma no es responsable por extravíos, pérdidas, daños, etc., que sufran las mercancías, ya que esta es responsabilidad directa del transportista.</p>
      <p class="datos_clausuara">LAS TARIFAS EXCLUYEN:</p>
      <p class="datos_clausuara">Carga peligrosa, perecederos, extra dimensional y menajes domésticos. JMC LOGISTICS CARGO LTDA,  tiene la liberad de seleccionar el transportista según las reservas y sujeto a disponibilidad del espacio. Todos los precios están sujetos a cambios sin previo aviso, la responsabilidad de JMC LOGISTICS CARGO LTDA,  se limita a las cláusulas legales estipuladas por las empresas participantes en cada contrato de transporte.</p>
      <p class="datos_clausuara">SEGURO:</p>
      <p class="datos_clausuara">En caso de que el cliente no autorice a JMC LOGISTICS CARGO LTDA, a tomar el seguro la mercancía viajara por cuenta y riesgo del cliente dueño de la carga o consignatario según corresponda, se exime de responsabilidad a JMC LOGISTICS CARGO LTDA, y no será responsable en ningún caso por daños totales y/o parciales a la carga. La aceptación de la presente oferta implica la renuncia a reclamar a JMC LOGISTICS CARGO LTDA, los daños a la mercancía producida por cualquier evento que se pueda ocasionar.</p>
      <p class="datos_clausuara">FACTURACIÓN Y PAGOS:</p>
      <p class="datos_clausuara">Todos los gastos locales están sujetos a la liquidación del IVA de acuerdo a la legislación vigente.<br />
      Forma de pago: contra entrega de documentos, exceptuando previo convenio.</p>
      <h1> </h1>
      <p class="datos_clausuara">Visítenos en nuestra página Web<br/>
    www.jmclogistics.com</p>
    <p class="datos_clausuara"> </p>
    <p class="datos_clausuara">Cordialmente,</p><p>
		 <table  style='width:100%' >
		 <tr>
    <td><p style='padding-left: 4em'>Nidia Carrillo<br/>
    Gerente General<br/>
    nidia.carrillo@jmclogisticscargo.com<br/></td> 
   <td><p style='padding-left: 4em'>LEONARDO<br/>
    Soporte Ventas<br/>
	calle 10<br/></td>
  </tr>
       </table></p></td>
	   </tr>
    </table>
   </body>
</html>