<script type="text/php"> 
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
	</script><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head> 
	<link rel="STYLESHEET" href="../css/print_static.css" type="text/css" /> 
	<link rel="STYLESHEET" href="../../../css/print_static.css" type="text/css" /> 
	<body> 
		<div id="body"> 
		<div id="section_header"> 
		</div> 
		
		<div id="content"> 
		<div class="page" style="font-size: 7pt"> 
		<table style="width: 100%;" class="change_order_items"> 
		<TR> <TD id="td_7" rowspan="3" align="center"><img src="../images/logo.jpg" width="160" height="74"></TD><TD id="td_2" align="center" class="normal"><strong>FORMATO DE COTIZACION EXPORTACION MARITIMA FCL</strong></TD> 
<TD id="td_3" align="center" class="normal"><strong>VERSION 1</strong></TD> 
</TR><TR> 
<TD id="td_5" align="center" class="normal"><strong>FIA-DCM-052</strong></TD> 
<TD id="td_6" align="center" class="normal"><strong>FECHA FEBRERO DE 2008</strong></TD> 
</TR><TR> 
<TD id="td_8" align="center" class="normal"><strong>COTIZACION No CZ10020002</strong> </TD> 
<TD id="td_9" align="center" class="normal"><strong>PAGINA 1 DE 2</strong></TD> 
</TR> 
</table><table style="width: 100%; font-size: 8pt;" ><tr><td width="46%" valign="top"><table style="width: 100%; font-size: 8pt;" ><tr><td width="46%" valign="top"><table style="width: 100%;" border="1" bordercolor="#000000" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td bgcolor="#FFFFFF"><table style="width: 97%;" border="0" cellpadding="1" bordercolor="#000000" > 
      <tr> 
        <td width="35%" class="even_row_1"><strong>FECHA</strong></td> 
        <td width="65%" class="even_row_1">2010-03-12</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>SE&Ntilde;ORES</strong></td> 
        <td class="even_row_1">IDENTIFICACION PLASTICA S.A</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>ATN. SR</strong></td> 
        <td class="even_row_1">KARINA GORDILLO</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>E-MAIL</strong></td> 
        <td class="even_row_1">yill_mr@hotmail.com</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>MERCANCIA:</strong></td> 
        <td class="even_row_1">NO PELIGROSA</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>TIPO:</strong></td> 
        <td class="even_row_1">IMPRESORAS MX 2000</td> 
      </tr> 
      <tr> 
        <td class="even_row_1"><strong>MONEDA</strong></td> 
        <td class="even_row_1">D�?LAR AMERICANO</td> 
        </tr> 
      <tr> 
        <td class="even_row_1"><strong>TERMINO DE NEGOCIACION</strong></td> 
        <td class="even_row_1">EX WORK</td> 
      </tr> 
    </table></td></tr></table></td> 
		<td width="7%">&nbsp;</td> 
		<td width="47%" valign="top"><table width="100%" border="1" bordercolor="#000000" cellpadding="0" cellspacing="0"> 
          <tr> 
            <td bgcolor="#FFFFFF"  valign="top"> 
			<table width="98%" border="0" align="center" > 
          <tr><td class="even_row_1" align="center">JMC LOGISTICS CARGO LTDA</td> 
          </tr> 
          <tr> 
            <td class="even_row_1" align="center">NIT 8301215864</td> 
          </tr> 
          <tr> 
            <td class="even_row_1" align="center">CALLE 25C N 84B-05 OF 401</td> 
          </tr> 
		   <tr> 
            <td class="even_row_1" align="center">PBX (571) 4108238/4299982</td> 
          </tr> 
		   <tr> 
            <td class="even_row_1" align="center">FAX 4299474</td> 
          </tr> 
		   
		   <tr> 
            <td class="even_row_1" align="center">yill_mr@hotmail.com</td> 
          </tr> 
		   <tr> 
            <td class="even_row_1" align="center">diana.cornejo@mclogisticscargo.com</td> 
          </tr> 
		   <tr> 
		     <td class="even_row_1" align="center">www.jmclogistics.com</td> 
		     </tr> 
		   <tr> 
		     <td class="even_row_1" align="center"></td> 
		     </tr> 
		   <tr> 
            <td class="even_row_1" align="center"></td> 
          </tr> 
      </table></td></tr></table></td></tr></table><table style="width: 100%;  font-size: 8pt;"> 
	<tr><td style="width: 100%;  font-size: 8pt; text-align:justify" class="change_order_items">DE ACUERDO CON SU AMABLE SOLICITUD DE COTIZACION DE TRANSPORTE INTERNACIONAL A CONTINUACION NOS PERMITIMOS INFORMAR LAS TARIFAS VIGENTES DE CARGA NO PELIGROSA PARA DICHO TRAYECTO, LAS CUALES ESTAMOS SEGUROS SERAN FAVORABLE A SU INTERES.</td></tr> 
	<tr> 
 		<td>&nbsp;</td> 
	</tr> 
	<tr> 
  <td><table style="width: 100%;" bordercolor="#000000" cellpadding="-1" cellspacing="0" border="0"  > 
    <tr> <td class="subfongris" align="center" >EXPORTACION MARITIMA FCL</td> 
    </tr> 
    <tr> 
      <td class="even_row_1">&nbsp;COTIZACION BASADA EN </td> 
    </tr> 
    <tr> 
      <td><table style="width: 100%;" cellpadding="-1" cellspacing="0" border="1" class="change_order_items" > 
          <tr> 
            <td class="even_row_1">No PIEZAS</td> 
            <td class="even_row_1">1</td> 
            <td class="even_row_1">PESO BRUTO KGS</td> 
            <td class="even_row_1">800</td> 
          </tr> 
          <tr> 
            <td class="even_row_1">KILO VOLUMEN</td> 
            <td class="even_row_1">1273</td> 
            <td class="even_row_1">VALOR SEGUN TERMINO ADUANA USD</td> 
            <td class="even_row_1">700000</td> 
          </tr> 
          <tr> 
            <td class="even_row_1">DIMENSION</td> 
            <td class="even_row_1"><table style="width: 100%;" cellpadding="-1" cellspacing="0" border="1" class="change_order_items"> 
                <tr><td class="even_row_1">2.87m X 1.66m X1.6</td> </tr> 
            </table></td> 
            <td  class="even_row_1">TRAYECTO</td> 
            <td  class="even_row_1">ESTADOS UNIDOS-MINIAPOLIS  /   COLOMBIA-BOGOTA</td> 
          </tr> 
      </table></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td><table style="width: 100%;" cellpadding="-1" cellspacing="0" border="1" class="change_order_items"> 
  <tr> 
    <td width="6%" class="subfongris">PAIS</td> 
    <td width="11%" class="subfongris">ORIGEN</td><td width="11%"  class="subfongris" >TARIFA ESCALONADA KG /USD</td><td width="25%" class="subfongris">TIEMPO DE TRANSITO </td> 
    <td width="26%" class="subfongris">FRECUENCIA</td> 
    <td width="21%" class="subfongris">TARIFA A VIGENTE </td> 
  	</tr> 
  	<tr> 
		<td  class="even_row_1">ESTADOS UNIDOS</td> 
		<td  class="even_row_1">MINIAPOLIS</td><td width="11%"  ><table style="width: 100%;" cellpadding="-1" cellspacing="0" border="1" class="change_order_items"> 
      <tr></tr><tr></tr></table></td><td class="even_row_1" ></td><td class="even_row_1">LUNES A VIERNES</td><td class="even_row_1">31 DIC 2010</td></tr></table></td></tr></table><table class="change_order_items"> 
	<tr><td colspan="7" align="center" class="subfongris">COSTOS NO INCLUIDOS EN LAS TARIFAS</td></tr> 
	<tbody> 
	<tr> 
	<th colspan="2" rowspan="2" class="subfongris">RECARGO EN ORIGEN </th> 
	<td style="border-right-style: none;" class="subfongris">TARIFAS</td> 
	<td colspan="2" style="border-right-style: none;" class="subfongris">MINIMA</td> 
	<td colspan="2" style="text-align: center" class="subfongris">LIQUIDACION</td> 
	</tr> 
	<tr> 
	<th class="subfongris">USD</th> 
	<th class="subfongris">USD</th> 
	<th class="subfongris">PESOS</th> 
	<th class="subfongris">USD</th> 
	<th class="subfongris">PESOS</th> 
	</tr><tr class="even_row_1"> 
		<td colspan="2" >ELABORACION DECLARACION DE VALOR C/U $12.000 </td> 
		<td style="border-left-style: none;">12000</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">6.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">12.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >ELABORACION DECLARACION DE IMPORTACION C/U $12.000</td> 
		<td style="border-left-style: none;">12000</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">6.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">12.000</td></tr><tr class="even_row_1"> 
		<td colspan="2" >AGENCIAMIENTO ADUANERO 0.35% SOBRE EL VALOR CIF + IVA</td> 
		<td style="border-left-style: none;">0.35</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">2.450.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">4.900.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >DELIVERY MIN 45 </td> 
		<td style="border-left-style: none;">175</td> 
		<td class="change_order_total_col" style="border-left-style: none;">45</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">175.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">350.000</td></tr><tr class="even_row_1"> 
		<td colspan="2" >PICK-UP MIN 45 </td> 
		<td style="border-left-style: none;">250</td> 
		<td class="change_order_total_col" style="border-left-style: none;">45</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">250.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">500.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >SED /HAWB </td> 
		<td style="border-left-style: none;">35</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">35.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">70.000</td></tr><tr class="even_row_1"> 
		<td colspan="2" >AWB /HAWB </td> 
		<td style="border-left-style: none;">45</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">45.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">90.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >COLLECT FEE 5% SOBRE EL FLETE MIN</td> 
		<td style="border-left-style: none;">5</td> 
		<td class="change_order_total_col" style="border-left-style: none;">35</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">63.65</td> 
<td class="change_order_unit_col" style="border-right-style: none;">127.300</td></tr><tr class="even_row_1"> 
		<td colspan="2" >TRASLADO ZONA ADUANERA /KG MIN</td> 
		<td style="border-left-style: none;">0.07</td> 
		<td class="change_order_total_col" style="border-left-style: none;">20</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">56.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">112.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >LIBERACION</td> 
		<td style="border-left-style: none;">35</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">35.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">70.000</td></tr><tr class="even_row_1"> 
		<td colspan="2" >DESCONSOLIDACION</td> 
		<td style="border-left-style: none;">40</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">40.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">80.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >SECURITY /KJG</td> 
		<td style="border-left-style: none;">0.20</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">160.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">320.000</td></tr><tr class="even_row_1"> 
		<td colspan="2" >FUEL SURCHARGE /KG</td> 
		<td style="border-left-style: none;">0.90</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">720.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">1.440.000</td></tr><tr class="even_row_2"> 
		<td colspan="2" >FELETE INTERNACIONAL</td> 
		<td style="border-left-style: none;">2.25</td> 
		<td class="change_order_total_col" style="border-left-style: none;">0</td> 
		<td class="change_order_unit_col" style="border-left-style: none;">0</td> 
		<td class="change_order_total_col" style="border-left-style: none;">1.800.00</td> 
<td class="change_order_unit_col" style="border-right-style: none;">3.600.000</td></tr></tbody><tr><td colspan="3" style="text-align: left;">Tasa de cambio aproximada USD - $ 2.000.00</td> 
  <td colspan="2" style="text-align: right;"><strong>VALOR APROXIMADO :</strong></td><td class="change_order_total_col"><strong>5.841.65</strong></td> 
 		<td class="change_order_total_col"><strong>11.683.300</strong></td></tr> <tr> 
			<td colspan="3" style="text-align: left;">Ruta de embarque ESTADOS UNIDOS-MINIAPOLIS  /   COLOMBIA-BOGOTA</td> 
<td colspan="2" style="text-align: right;">&nbsp;</td><td class="change_order_total_col">&nbsp;</td> 
		<td class="change_order_total_col">&nbsp;</td></tr></table><table class="even_row_2"  align="left"> 
 		<tr> 
		<td colspan="2" style="padding-top: 0em">Nota:</td> 
		<td style="text-align: center; padding-top: 0em;">&nbsp;</td> 
	   </tr> 
	   <tr> 
  		<td colspan="3" style="white-space: normal">EL FS SURCHARGES ESTA SUJETO A CAMBIO SIN PREVIO AVISO.
FLETE COLLECT.</td> 
	   </tr> 
       <tr><td colspan="3" style="white-space: normal;  text-align: justify;font-size: 1em; margin: 0.5em; padding: 10px;">NOTA ESPECIAL:</span></p> 
      <p class="datos_clausuara">SE COBRARA EL GRAVAMEN FINACIERO QUE ES EL 0. 4% DE LOS PAGOS QUE SE EFECTUAN A TERCEROS.<br/> 
        Para la consignación del documento de transporte, favor indicar a JMC LOGISTICS CARGO LTDA. Las instrucciones de corte, el cliente será responsable por los prejuicios que ocasionan la información incorrecta de los documentos (volumen, número de piezas, identificación genérica de las mercancías etc.). Y asumirá las multas o sanciones aduaneras originadas por la información errónea. La propuesta comercial en referencia, esta basada en las condiciones actuales del mercado, por lo que cualquier variación por parte del transportista que intervienen en el transporte, afectará ésta en forma proporcional. Los gastos en origen que no sean parte del acuerdo de compra del exportador con el importador en el exterior y que sin embargo se causen por el normal manejo de la carga hasta su embarque serán cargados al exportador de dicho despacho. </p> 
      <p class="datos_clausuara">JMC LOGISTICS CARGO LTDA, se limita a la consecución de espacios y reservas actuando  bajo mandato, por lo que no representa a los daños de la carga ni a los transportadores que intervienen en el transporte, tampoco es responsable por cambios, demoras, imprevistos o fuerzas mayores que tengan los transportistas involucrados en sus diversos movimientos, de igual forma no es responsable por extravíos, pérdidas, daños, etc., que sufran las mercancías, ya que esta es responsabilidad directa del transportista.</p> 
      <p class="datos_clausuara">LAS TARIFAS EXCLUYEN:</p> 
      <p class="datos_clausuara">Carga peligrosa, perecederos, extra dimensional y menajes domésticos. JMC LOGISTICS CARGO LTDA,  tiene la liberad de seleccionar el transportista según las reservas y sujeto a disponibilidad del espacio. Todos los precios están sujetos a cambios sin previo aviso, la responsabilidad de JMC LOGISTICS CARGO LTDA,  se limita a las cláusulas legales estipuladas por las empresas participantes en cada contrato de transporte.</p> 
      <p class="datos_clausuara">SEGURO:</p> 
      <p class="datos_clausuara">En caso de que el cliente no autorice a JMC LOGISTICS CARGO LTDA, a tomar el seguro la mercancía viajara por cuenta y riesgo del cliente dueño de la carga o consignatario según corresponda, se exime de responsabilidad a JMC LOGISTICS CARGO LTDA, y no será responsable en ningún caso por daños totales y/o parciales a la carga. La aceptación de la presente oferta implica la renuncia a reclamar a JMC LOGISTICS CARGO LTDA, los daños a la mercancía producida por cualquier evento que se pueda ocasionar.</p> 
      <p class="datos_clausuara">FACTURACI�?N Y PAGOS:</p> 
      <p class="datos_clausuara">Todos los gastos locales están sujetos a la liquidación del IVA de acuerdo a la legislación vigente.<br /> 
      Forma de pago: contra entrega de documentos, exceptuando previo convenio.</p> 
      <h1> </h1> 
      <p class="datos_clausuara">Visítenos en nuestra página Web<br/> 
    www.kaome.com</p> 
    <p class="datos_clausuara"> </p> 
    <p class="datos_clausuara">Cordialmente,</td></tr> 
<tr> 
    <td><p style="padding-left: 4em">Nidia Carrillo<br/> 
    Gerente General<br/> 
    mail_gerente<br/></td> 
   <td><p style="padding-left: 4em">DIANA CORNEJO<br/> 
    Soporte Ventas<br/> 
   diana.cornejo@jmclogistics.com<br/></td> 
  </tr></table><br /> 
<b>Warning</b>:  fopen(../dompdf/www/test/cotizacion.html) [<a href='function.fopen'>function.fopen</a>]: failed to open stream: Permission denied in <b>/var/www/jmc/formatos/cuerpo.php</b> on line <b>444</b><br /> 
<br /> 
<b>Warning</b>:  fwrite(): supplied argument is not a valid stream resource in <b>/var/www/jmc/formatos/cuerpo.php</b> on line <b>446</b><br /> 
<br /> 
<b>Warning</b>:  fclose(): supplied argument is not a valid stream resource in <b>/var/www/jmc/formatos/cuerpo.php</b> on line <b>447</b><br /> 
 
<p><TABLE style="width: 100%;"border="1" bordercolor="#000000" cellpadding="0" cellspacing="0"><TR> 
<TD width="25%" valign="top" class="titulosup01">Elaborado por<BR> 
<FONT class="titulosup01"></FONT><BR> 
<FONT class="titulosup01"> DIANA CORNEJO </FONT> 
</TD> 
<TD width="24%" valign="top" class="titulosup01">Revisado por<BR> 
<FONT class="titulosup01"></FONT><BR> 
<FONT class="titulosup01"> NIDIA CARRILLO </FONT> 
 
</TD> 
<TD width="33%" valign="top" class="titulosup01">Aprobado por<BR> 
<FONT class="titulosup01"></FONT><BR> 
<FONT class="titulosup01"> GILBERTO MENDEZ</FONT> 
</TD> 
<TD width="18%" valign="top" class="titulosup01">Fecha<BR> 
<FONT class="titulosup01"></FONT><BR> 
<FONT class="titulosup01"> 18/01/08</FONT> 
</TD> 
 
</TR></TABLE> 
 
<a href="/jmc/dompdf/dompdf.php?base_path=www%2Ftest%2F&amp;input_file=www%2Ftest%2Fcotizacion.html" class="button">PDF</a> 
</p> 
</div> 
 
</div> 
</div> 
 
 
 
 
</body> 
</html> 