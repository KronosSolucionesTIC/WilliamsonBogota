<? include("../lib/database.php")?>
<? include("../js/funciones.php")?>

<?
function num2letras($num, $fem = true, $dec = true) { 
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
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


	$sqle="SELECT * FROM equipos
	INNER JOIN clase_equipos ON (clase_equipos.cod_clase=equipos.clase_equipo)
	INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos=equipos.tipo_equipo)
	INNER JOIN tamano_equipos ON (tamano_equipos.cod_tam_equipos=equipos.tamano_equipo)
	where cod_equipo = $codigo";
	$dbe= new  Database();
	$dbe->query($sqle);
	$dbe->next_row();
	
		$sqlg="SELECT * FROM garantias
		where cod_equipo_garantia = $codigo";
		$dbg= new  Database();
		$dbg->query($sqlg);
		$dbg->next_row();
	
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
<title>:::...Inmueble Arriendo...:::</title>
<script type="text/javascript" src="../js/funciones.js"></script>
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
-->
 </style>
</head>
<body  onclick="imprimir()">
  <table width="680"  align="center" class="lineatablafinablue">
    <tr>
      <td width="674"><table width="693" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="6" class="subfongris1">HOJA DE INVENTARIO DE EQUIPOS ORTOPEDICOS</td>
        </tr>
        <tr>
          <td colspan="6" class="subfongris1"><div align="center">
            <p>DATOS GENERALES DEL EQUIPO</p>
          </div></td>
        </tr>
        <tr>
          <td width="88" class="titulosup04"><div align="center" class="subfongris1">
            <div align="left">EQUIPO No.
              
            </div>
          </div></td>
          <td width="170" class="titulosup04"><div align="left">
            <?=$dbe->consecutivo_equipo?>
          </div></td>
          <td width="76" class="titulosup04">&nbsp;</td>
          <td width="98">&nbsp;</td>
          <td width="172">&nbsp;</td>
          <td width="89">&nbsp;</td>
        </tr>
        <tr>
          <td class="titulosup04"><div align="left">Clase :</div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->nom_clase?>
          </span></div></td>
          <td>&nbsp;</td>
          <td class="titulosup04"><div align="left">Tipo:</div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->desc_tipo_equipos?>
          </span></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="titulosup04"><div align="left">Tama&ntilde;o:</div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->desc_tam_equipos?>
          </span></div></td>
          <td>&nbsp;</td>
          <td class="titulosup04"><div align="left">Canon:</div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->canon_arrend_equipo?>
          </span></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="titulosup04"><div align="left">Valor deposito: </div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->valor_deposito?>
          </span></div></td>
          <td>&nbsp;</td>
          <td class="titulosup04">Descripci&oacute;n:</td>
          <td class="titulosup04"><div align="right">
            <?=$dbe->desc_equipo?>
          </div></td>
          <td class="titulosup04">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" class="subfongris1">&nbsp;</td>
        </tr>
                <?
				$sql_1 ="SELECT * FROM listado_partes
						INNER JOIN partes ON (partes.cod_partes=listado_partes.cod_parte)
						INNER JOIN tipo_partes ON (tipo_partes.cod_tipo_partes=listado_partes.cod_tipo_parte)
						where cod_equipo_parte  = $codigo";	
					$dbdatos_1= new  Database();
					$dbdatos_1->query($sql_1);
					$jj=1;
					while($dbdatos_1->next_row()){ 
					    echo "<tr>";
          				echo "<td colspan='6' class='subfongris1'><div align='center'>PARTES DEL EQUIPO</div></td>";
						echo "</tr>";
						echo "<tr id='fila_item_contac_$jj'>";

//PARTE	
						echo "<td class = 'titulosup04'>Parte:</td>";
						echo "<td class = 'titulosup04'><div align='right'>$dbdatos_1->desc_partes</div></td>";
						echo "<td class = 'titulosup04'></td>";
//TIPO PARTE
						echo "<td class = 'titulosup04'>Tipo parte:</td>";
						echo "<td class = 'titulosup04'><div align='right'>$dbdatos_1->desc_tipo_partes</div></td>";	
						echo "<td class = 'titulosup04'></td>";				
						echo "</tr>";					
						$jj++;						
					}
				?>
        <tr>
          <td class="titulosup04"><div align="left"></div></td>
          <td colspan="2">&nbsp;</td>
          <td class="titulosup04">&nbsp;</td>
          <td colspan="2" class="titulosup04">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" class="subfongris1"><div align="center">GARANTIA DEL EQUIPO</div></td>
        </tr>
        <tr>
          <td class="titulosup04"><div align="left"><span class="titulosup04">Referencia:</span></div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbe->ref_equipo?>
          </span></div></td>
          <td>&nbsp;</td>
          <td><span class="titulosup04">Tiempo (meses):</span></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbg->cant_garantia?>
          </span></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="titulosup04"><div align="left"><span class="titulosup04">Fecha compra:</span></div></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbg->fecha_ini_garantia?>
          </span></div></td>
          <td>&nbsp;</td>
          <td><span class="titulosup04">Fecha fin:</span></td>
          <td><div align="right"><span class="titulosup04">
            <?=$dbg->fecha_fin_garantia?>
          </span></div></td>
          <td>&nbsp;</td>
        </tr>
        

      </table></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"><span class="titulosup04"><em>Carrera 13A # 79 - 64 / Tel&eacute;fonos: 2185100/ 6351666 </em><em><span class="Estilo15"></span></em></span></div></td>
    </tr>
    <tr>
      <td><div id="imp">
        <div align="center">
          <input name="imprimir" id="btnimp" value="imprimir" type="button" onClick="imprimir()" />
        </div>
      </div></td>
    </tr>
  </table>
  <table width="200" border="0" align="center">
    
  </table>
</body>
</html>

