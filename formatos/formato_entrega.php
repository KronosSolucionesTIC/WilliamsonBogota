<? include("../lib/database.php")?>
<? include("../js/funciones.php")?>

<?
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
         $t .= ' ' . $matsub[$sub] . '?n'; 
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
function nombre_mes($a){
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

return $a;

}


$sqli ="SELECT *,
  empresa.logo_jmc,
  empresa.cod_jmc
FROM
  empresa";
	$dbdatosee= new  Database();
	$dbdatosee->query($sqli);
	$dbdatosee->next_row();

	$sqlv ="SELECT * FROM entregas
	INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = entregas.cod_contrato)
	WHERE cod_entrega = $codigo";
	$dbv= new  Database();
	$dbv->query($sqlv);
	$dbv->next_row();

?>

<script language="javascript">

function imprimir()
{

	window.print();
}

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/print_static.css" rel="stylesheet" type="text/css" />
<title>:::...OTRO SI...:::</title>
<script type="text/javascript" src="../js/funciones.js">
function imprimir(){
document.getElementById("btnimp").style.display="none";
window.print();
}

</script>
 <link href="../css/styles.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
-->
<!--
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
-->
 </style>
 <link href="../css/editor.css" rel="stylesheet" type="text/css">
 <link href="../css/print.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
.Estilo14 {font-size: 14px}
-->
 </style>

 <link href="../css/stylesforms.css" rel="stylesheet" type="text/css" />
 <style type="text/css">
<!--
.Estilo15 {color: #000000}
.Estilo16 {font-size: 18px}
-->
 </style>
</head>
<body  onclick="imprimir()">
<table width="780" border="0" align="center" class="lineatablafinablue">
    <tr>
      <td colspan="4"><table width="71%" border="0" align="center">
        <tr>
           <td height="62"><div align="center"><strong>
            <?=$dbdatosee->nom_jmc?>
          </strong></div>
            <div align="center"><strong>
              <?=$nit=convertir_nit($dbdatosee->nit_jmc);?>
            </strong></div></td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="4"><p align="center">ENTREGA No.
        <?=$dbv->cod_entrega?>
  &nbsp;AL CONTRATO&nbsp; No.
  <?=$dbv->consecutivo?>
      </p>
        <p align="center">Se realiza a la fecha de (
          <?=$dbv->fecha_entrega?>
          ) la entrega de los siguientes equipos ortopedicos: <br />
  <?
				
					$sql_1 ="SELECT * FROM entregas_equipos
					INNER JOIN equipos on (equipos.cod_equipo = entregas_equipos.cod_equipo)
					INNER JOIN clase_equipos on (clase_equipos.cod_clase = equipos.clase_equipo)
					INNER JOIN tipo_equipos on (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)                   
					where cod_entrega  = $codigo";	
					$dbdatos_1= new  Database();
					$dbdatos_1->query($sql_1);
					echo "<br>";
					echo "<br>";
					echo "<table width='600' height='28' border='1' align='center'>";
          			echo "<tr>";
					echo "<td width='200'><strong><div align='center'>Articulo</div></strong></td>";
           			echo "<td width='200'><strong><div align='center'>Descripcion</div></strong></td>";
           			echo "<td width='200'><strong><div align='center'>Fecha de entrega</div></strong></td>";
          			echo "</tr>";
					while($dbdatos_1->next_row()){ 	
					echo "<tr>";
					echo "<td width='200'><div align='center'>$dbdatos_1->consecutivo_equipo</div></td>";
					if ($dbdatos_1->cod_clase == 5){
           			echo "<td width='200'><div align='center'>$dbdatos_1->nom_clase $dbdatos_1->nom_equipo $dbdatos_1->desc_tipo_equipos</div></td>";
					}
					else {
					echo "<td width='200'><div align='center'>$dbdatos_1->nom_clase $dbdatos_1->desc_tipo_equipos</div></td>";
					}
           			echo "<td width='200'><div align='center'>$dbv->fecha_entrega</div></td>";
          			echo "</tr>";	
					}
					echo "</table>";
				?>
      </p>
      <p align="center">Con un saldo total de 
        
        (
        <?=num2letras($dbv->saldo_deuda)?>
      pesos) $  
      <?=number_format($dbv->saldo_deuda,0,".",".")?>
      </p></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center" class="titulosup04">
        <p align="left"><strong>Recib&iacute; de conformidad :</strong></p>
      </div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="left">______________________________</div></td>
      <td colspan="2"><div align="left">______________________________</div></td>
    </tr>
    <tr>
      <td width="63"><div align="left"><span class="titulosup04">
        <? if ($dbv->tipo_persona == 1 ) {?>
        C.C. :
  <? } else {?>
        NIT :
  <? } ?>
      </span></div></td>
      <td width="315"><div align="left"><span class="titulosup04">
        <? if ($dbv->tipo_persona == 1 ) {?>
        <?=convertir_cedula($dbv->cedula_cli)?>
        <? } else {?>
        <?=convertir_nit($dbv->cedula_cli)?>
        <? } ?>
      </span></div></td>
      <td colspan="2"><div align="left">
        <?=$dbdatosee->nom_jmc?>
      </div></td>
    </tr>
    <tr>
      <td class="subfongris1"><div align="left"><span class="titulosup04">De:</span></div></td>
      <td class="subfongris1"><div align="left"><span class="titulosup04">
        <?=$cuidad?>
      </span></div></td>
      <td width="74" class="subfongris1"><div align="left"><span class="titulosup04">NIT : </span></div></td>
      <td width="310" class="subfongris1"><div align="left"><span class="titulosup04">
        <?=$nit=convertir_nit($dbdatosee->nit_jmc);?>
      </span></div></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><strong><em>Carrera 13A # 79 - 64 / Tel&eacute;fonos: 2185100/ 6351666 </em></strong></div></td>
    </tr>
    
  </table>
        </table>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
</tr>
   
</body>
</html>
