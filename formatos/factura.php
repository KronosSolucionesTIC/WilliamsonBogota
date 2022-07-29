<? include("../lib/database.php")?>
<? include("../js/funciones.php")?>

<? 
if ($codigo!=0) {
  	$sqlfac ="SELECT * FROM factura
	INNER JOIN tipo_pago ON (tipo_pago.cod_tipo_pago = factura.forma_pago) 
  	WHERE cod_fac=$codigo";
	$dbfac= new  Database();
	$dbfac->query($sqlfac);
	$dbfac->next_row();
	$cliente = $dbfac->cliente;
	$total = $dbfac->total_factura;
	
	$sqlcli ="SELECT * FROM cliente
  	WHERE cod_cli = $cliente";
	$dbcli= new  Database();
	$dbcli->query($sqlcli);
	$dbcli->next_row();
		
	$sql ="SELECT *
 FROM
 empresa";
	$dbdatos= new  Database();
	$dbdatos->query($sql);
	$dbdatos->next_row();	
		
		
function num2letras($num, $fem = true, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'os'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 

         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . 'ón'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   return ucfirst($tex); 
} 


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<link href="../css/stylesforms.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo26 {font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo26 {font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo26 {font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo26 {font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo26 {font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo22 {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo22 {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo22 {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<script language="javascript">

function imprimir(){
document.getElementById("btnimp").style.display="none";
window.print();
}

</script>
</head>
<body>
<table width="643" border="0" align="center" class="lineatablafinablue">
  <tr>
    <td width="1335" height="334"><table width="729" height="217" border="0" bordercolor="#000000">
      <tr>
        <td height="21" colspan="2"><div align="left"><span class="Estilo22"><strong>
          <?=$dbdatos->nom_jmc?>
          </strong></span></div></td>
        <td height="21" colspan="3">&nbsp;</td>
        <td height="21"><div align="right" class="Estilo21"><strong><span class="Estilo22">RECIBO DE CAJA N&deg;</span>
          <?=$dbfac->cod_fac?>
        </strong> </div></td>
        </tr>
      <tr>
        <td width="138" height="21"><div align="left" class="Estilo21">
          <div align="left">Nit:</div>
        </div></td>
        <td width="116" height="21"><span class="Estilo22">
          <?=$dbdatos->nit_jmc?>
        </span></td>
        <td width="57" class="Estilo21">Direcci&oacute;n:</td>
        <td width="151"><span class="Estilo22">
          <?=$dbdatos->dir_jmc?>
        </span></td>
        <td width="106" class="Estilo21">Telefono:</td>
        <td width="135" height="21" align="center" class="Estilo10"><div align="left"><span class="Estilo22">
          <?=$dbdatos->tel_jmc?>
        </span></div></td>
        </tr>
      
      
      <tr>
        <td height="142" colspan="6"><table width="100%" height="76" border="0" align="center">
          <tr>
            <td colspan="6" class="ctablasup">DATOS CLIENTE </td>
            </tr>
          <tr>
            <td width="19%"><span class="textotabla1">Nombre:</span></td>
            <td width="17%"><span class="textotabla1">
              <?=$dbcli->nom1_cli?>
              <?=$dbcli->nom2_cli?>
              <?=$dbcli->apel1_cli?>
              <?=$dbcli->apel2_cli?>
              </span></td>
            <td width="16%"><span class="textotabla1">Identificaci&oacute;n</span></td>
            <td width="14%"><span class="textotabla1">
              <?=$dbcli->cedula_cli?>
              </span></td>
            <td width="15%"><span class="textotabla1">Direcci&oacute;n:</span></td>
            <td width="19%"><span class="textotabla1">
              <?=$dbcli->direccion_cli?>
              </span></td>
            </tr>
          <tr>
            <td> <span class="textotabla1">Telefono: </span></td>
            <td><span class="textotabla1">
              <?=$dbcli->telefono_cli?>
              </span></td>
            <td><span class="textotabla1">Celular:</span></td>
            <td><span class="textotabla1">
              <?=$dbcli->celular_cli?>
              </span></td>
            <td><span class="textotabla1">E-mail: </span></td>
            <td><span class="textotabla1">
              <?=$dbcli->email_cli?>
              </span></td>
            </tr>
          <tr>
            <td class="titulosup02">&nbsp;</td>
            <td class="Estilo10">&nbsp;</td>
            <td class="Estilo10">&nbsp;</td>
            <td class="Estilo10">&nbsp;</td>
            <td class="Estilo10">&nbsp;</td>
            <td align="center" class="Estilo10">&nbsp;</td>
            </tr>          
          </table>
          <table width="100%" border="0" align="center">
            <tr>
              <td colspan="5" height="82" valign="top"><table  width="100%" align="center">
                <tr >
                  <td width="90%"  colspan="3"><table width="101%">
                    <tr id="fila_vehiculo_0">
                      <td width="10%"  class="ctablasup">CONTRATO</td>
                      <td width="10%"  class="ctablasup">ARTICULO</td>
                      <td width="10%"  class="ctablasup">FECHA INICIO</td>
                      <td width="10%"  class="ctablasup">FECHA FIN</td>
                      <td width="10%"  class="ctablasup">VALOR A PAGAR</td>
                      <td width="10%"  class="ctablasup">DESCUENTO</td>
                      <td width="10%"  class="ctablasup">VALOR CON DESCUENTO</td>
                      <td width="10%" class="ctablasup">VALOR RECIBIDO</td>
                      <td width="10%" class="ctablasup">SALDO</td>
                      </tr>
                    <?
					$sqle ="SELECT * FROM factura 
					INNER JOIN d_factura ON (d_factura.factura= factura.cod_fac) 
					INNER JOIN contrato_alquiler  ON (contrato_alquiler.cod_calc= d_factura.contrato)
					INNER JOIN equipos ON (equipos.cod_equipo = d_factura.cod_equipo)
					INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
					INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
					INNER JOIN cliente ON (cliente.cod_cli= contrato_alquiler.cod_cliente)
 					WHERE cod_fac=$codigo";
					$dbdatose= new  Database();
					$dbdatose->query($sqle);
					 while ($dbdatose->next_row()) {
					 echo "<tr>";
					 echo "<td class='textotabla1'><div align='center'>$dbdatose->consecutivo</div></td>";
					 echo "<td class='textotabla1'><div align='center'>$dbdatose->nom_clase $dbdatose->nom_equipo $dbdatose->desc_tipo_equipos</div></td>";
					 echo "<td class='textotabla1'><div align='center'>$dbdatose->fecha_ini_pago</div></td>";
					 echo "<td class='textotabla1'><div align='center'>$dbdatose->fecha_fin_pago</div></td>";
					 echo "<td class='textotabla1'><div align='right'>$dbdatose->valor_pago</div></td>";
					 echo "<td class='textotabla1'><div align='right'>$dbdatose->valor_descuento</div></td>";
					 echo "<td class='textotabla1'><div align='right'>$dbdatose->valor_con_descuento</div></td>";
					 echo "<td class='textotabla1'><div align='right'>$dbdatose->valor_recibido</div></td>";
					 echo "<td class='textotabla1'><div align='right'>$dbdatose->saldo</div></td>";
					 echo "</tr>";
					 }
					 ?>
                    </table ></td>
                  </tr>
                </table>
                <table width="100%" align="center">
                  <tr>
                    <td class="ctablasup"><div align="right">TOTAL DEUDA:</div></td>
                    <td class='textotabla1'><div align="right">$
                      <?=number_format($dbfac->total_deuda,0,".",".")?>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="ctablasup"><div align="right"> DESCUENTO:</div></td>
                    <td class='textotabla1'><div align="right">$
                      <?=number_format($dbfac->descuento,0,".",".")?>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="ctablasup"><div align="right">TOTAL: </div></td>
                    <td class='textotabla1'><div align="right">$
                      <?=number_format($dbfac->total_calculado,0,".",".")?>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="ctablasup"><div align="right">VALOR RECIBIDO:</div></td>
                    <td class='textotabla1'><div align="right">$
                      <?=number_format($dbfac->total_factura,0,".",".")?>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="ctablasup"><div align="right">TOTAL SALDO:</div></td>
                    <td class='textotabla1'><div align="right">$
                      <?=number_format($dbfac->saldo_deuda,0,".",".")?>
                      </div></td>
                  </tr>
                </table>                </td>
              </tr>
            </table>          
          <p align="center" class="textotabla1">Firma y sello:</p>
          <p align="center" class="textotabla1">&nbsp;</p>
          <p align="center" class="textotabla1">Forma de pago: 
            <?=$dbfac->desc_tipo_pago?>
          </p>
          <p align="center" class="textotabla1">Recibimos la suma de (
            <?=num2letras($dbfac->total_factura)?> pesos ) $ (
            <?=number_format($dbfac->total_factura,0,".",".")?>), con un saldo 
            <? if ($dbfac->saldo_deuda >= 0 ) { ?> de deuda de (<?=num2letras($dbfac->saldo_deuda)?> pesos ) $ (<?=number_format($dbfac->saldo_deuda,0,".",".")?>)<? } ?> 
            <? if ($dbfac->saldo_deuda < 0 ) {?> a favor de (<?=num2letras($dbfac->saldo_deuda*-1)?> pesos ) $ (<?=number_format($deuda*-1,0,".",".")?>)<? } ?>
            , a la fecha
            <?=$dbfac->fech_factura?>
          </p></td>
      </tr>
      
      <tr>
        <td height="23" colspan="6" align="center"> <div id="imp">
  <input name="imprimir" id="btnimp" value="imprimir" type="button" onclick="imprimir()" />
  </div></td>
      </tr>
      
    </table>
	
	</td>
  </tr>
</table>
</body>
</html>
