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
FROM  empresa";
$dbdatosee= new  Database();
$dbdatosee->query($sqli);
$dbdatosee->next_row();

	$sqlv ="select * from contrato_alquiler
	inner join cliente on (cliente.cod_cli = contrato_alquiler.cod_cliente)
	inner join paciente on (paciente.cod_pac = contrato_alquiler.cod_paciente)
	WHERE cod_calc = $codigo";
	$dbv= new  Database();
	$dbv->query($sqlv);
	$dbv->next_row();
	if ($dbv->tipo_persona == 1 ) {
	$codigo_cuidad = $dbv->ciudad_exp_ced_cli;
	} else {
	$codigo_cuidad = $dbv->ciudad_cli;
	}

		$sqlf ="select * from ciudad
		WHERE cod_ciu = $codigo_cuidad";
		$dbf= new  Database();
		$dbf->query($sqlf);
		$dbf->next_row(); 
		$cuidad = $dbf->nom_ciu;
	
			$sqlr ="select * from contrato_alquiler
			inner join responsable on (responsable.cod_cli = contrato_alquiler.cod_responsable)
			inner join paciente on (paciente.cod_pac = contrato_alquiler.cod_paciente)
			WHERE cod_calc = $codigo";
			$dbr= new  Database();
			$dbr->query($sqlr);
			$dbr->next_row();
	
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
      <td colspan="6"><table width="71%" border="0" align="center">
        <tr>
          <td height="62"><div align="center"><strong>
            <?=$dbdatosee->nom_jmc?>
          </strong></div>
            <div align="center"></div></td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="6"><table width="100%" border="0" align="center">
        <tr >
          <td height="37"><div align="center"><strong>HOJA DE ENTREGA (ANEXO 1)
          <? if ($dbv->tipo_contrato == 2) { ?>
          CONVENIO
      <?=$dbv->nom1_cli?>
      <?=$dbv->nom2_cli?>
      <?=$dbv->apel1_cli?>
      <?=$dbv->apel2_cli?>
      <? } ?>
      <br />
            &nbsp;NUMERO
            <?=$dbv->consecutivo?>
            </strong>          
          </div></td>
        </tr>
      </table></td>
    </tr>    
    <tr>
      <td colspan="3">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <div class="titulosup04">
    <tr>
      <td width="94">&nbsp;</td>
      <td width="95">Cliente:</td>
      <?php if ($dbv->tipo_contrato == 2) {?>
      <td width="197">
      <?=$dbr->nom1_cli?>
      <?=$dbr->nom2_cli?>
      <?=$dbr->apel1_cli?>
      <?=$dbr->apel2_cli?>
      </td>
      <?php } ?>
      <?php if ($dbv->tipo_contrato == 1) {?>
      <td width="197">
      <?=$dbv->nom1_cli?>
      <?=$dbv->nom2_cli?>
      <?=$dbv->apel1_cli?>
      <?=$dbv->apel2_cli?>
      </td>
      <?php } ?>
      <td width="86">Paciente:</td>
      <td width="178"><?=$dbv->nom1_pac?>
        <?=$dbv->nom2_pac?>
        <?=$dbv->apel1_pac?>
      <?=$dbv->apel2_pac?></td>
      <td width="102">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>C.C:</td>
      <td><?=$dbv->cedula_cli?></td>
      <td>C.C:</td>
      <td><?=$dbv->cedula_pac?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Direccion:</td>
      <td><?=$dbv->direccion_cli?></td>
      <td>Direccion:</td>
      <td><?=$dbv->direccion_pac?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Telefono</td>
      <td><?=$dbv->telefono_cli?></td>
      <td>Telefono</td>
      <td><?=$dbv->telefono_pac?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Celular:</td>
      <td><?=$dbv->celular_cli?></td>
      <td>Celular:</td>
      <td><?=$dbv->celular_pac?></td>
      <td>&nbsp;</td>
    </tr>
    </div>
    <tr>
      <td colspan="3">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">
          <?
		  			
					$sqlle ="SELECT * FROM `listado_equipos`
					INNER JOIN equipos ON (equipos.cod_equipo=listado_equipos.cod_equipo)
                    INNER JOIN clase_equipos ON (clase_equipos.cod_clase=equipos.clase_equipo)
                    INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos=equipos.tipo_equipo)
					WHERE cod_contrato = $codigo";
					$dble= new  Database();
					$dble->query($sqlle);
					while ($dble->next_row()){
					$cod_equipo = $dble->cod_equipo;
					echo "<div align='center'>";
        			echo "<table width='82%' border='1' cellpadding='1' cellspacing='1' bordercolor='#333333' id='select_tablas' >";
          			echo "<tr>";
					echo "<td colspan='4' class='subfongris1'>$dble->nom_clase $dble->desc_tipo_equipos No $dble->consecutivo_equipo</td>";
					echo "</tr>";
					echo "<tr>";
            		echo "<td width='118' class='subfongris1'><div align='center'>PARTE</div></td>";
           			echo "<td width='144' class='subfongris1'><div align='center'>ENTREGA</div></td>";
            		echo "<td width='133' class='subfongris1'><div align='center'>RECIBE</div></td>";
					echo "<td width='133' class='subfongris1'><div align='center'>OBSERVACIONES</div></td>";
          			echo "</tr>";
					
					$sqllp ="SELECT * FROM partes
					INNER JOIN equipos ON (equipos.clase_equipo = partes.clase_parte)
					WHERE cod_equipo = $cod_equipo and chequeo_inv=1";
					$dblp= new  Database();
					$dblp->query($sqllp);
					while($dblp->next_row()){
					echo "<tr>"; 
//PARTE
					echo "<td>$dblp->desc_partes</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
					echo "</tr>";
					}
					
					echo "<br>";
					echo "</table>";
					}
                ?>
          <tr>
            <td colspan="6" class="subfongris1">&nbsp;</td>
          </tr>
           <tr>
      <td colspan="6"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="27%" class="titulosup04">&nbsp;</td>
          <td width="52%" class="titulosup04">&nbsp;</td>
          <td width="18%" class="titulosup04">&nbsp;</td>
          <td width="6%" colspan="2" class="titulosup04"></td>
        </tr>
        <tr>
          <td class="titulosup04">&nbsp;</td>
          <td class="titulosup04">&nbsp;</td>
          <td class="titulosup04">&nbsp;</td>
          <td colspan="2" class="titulosup04"></td>
        </tr>
        </table></td>

    </tr>
    <tr>
      <td colspan="6"><table width="52%" border="0" align="left">
        <tr>
          <td colspan="2"><div align="center" class="titulosup04">
              <p align="left"><strong>Recib&iacute; de conformidad :</strong> </p>
          </div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">______________________________</td>
        </tr>
        <tr>
          <td width="31"><span class="titulosup04">
            C.C. :</span></td>
          <td width="360">&nbsp;</td>
        </tr>
        <tr>
          <td class="titulosup04">De:</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    
	<tr>
	  <td colspan="6" align="center">&nbsp;</td>
    </tr>
	<tr>
	  <td colspan="6" align="center"><p align="center"><span class="titulosup07"><font size=5>Carrera 13A # 79 - 64 / Tel&eacute;fonos: 2185100/ 6351666 </font></em><em><span class="Estilo20"></span></em></span> </p></td>
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
