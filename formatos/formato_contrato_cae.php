<?include "../lib/database.php"?>
<?include "../js/funciones.php"?>

<?
function num2letras($num, $fem = true, $dec = true)
{
    $matuni[2]    = "dos";
    $matuni[3]    = "tres";
    $matuni[4]    = "cuatro";
    $matuni[5]    = "cinco";
    $matuni[6]    = "seis";
    $matuni[7]    = "siete";
    $matuni[8]    = "ocho";
    $matuni[9]    = "nueve";
    $matuni[10]   = "diez";
    $matuni[11]   = "once";
    $matuni[12]   = "doce";
    $matuni[13]   = "trece";
    $matuni[14]   = "catorce";
    $matuni[15]   = "quince";
    $matuni[16]   = "dieciseis";
    $matuni[17]   = "diecisiete";
    $matuni[18]   = "dieciocho";
    $matuni[19]   = "diecinueve";
    $matuni[20]   = "veinte";
    $matunisub[2] = "dos";
    $matunisub[3] = "tres";
    $matunisub[4] = "cuatro";
    $matunisub[5] = "quin";
    $matunisub[6] = "seis";
    $matunisub[7] = "sete";
    $matunisub[8] = "ocho";
    $matunisub[9] = "nove";

    $matdec[2]  = "veint";
    $matdec[3]  = "treinta";
    $matdec[4]  = "cuarenta";
    $matdec[5]  = "cincuenta";
    $matdec[6]  = "sesenta";
    $matdec[7]  = "setenta";
    $matdec[8]  = "ochenta";
    $matdec[9]  = "noventa";
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

    $num = trim((string) @$num);
    if ($num[0] == '-') {
        $neg = 'menos ';
        $num = substr($num, 1);
    } else {
        $neg = '';
    }

    while ($num[0] == '0') {
        $num = substr($num, 1);
    }

    if ($num[0] < '1' or $num[0] > 9) {
        $num = '0' . $num;
    }

    $zeros = true;
    $punt  = false;
    $ent   = '';
    $fra   = '';
    for ($c = 0; $c < strlen($num); $c++) {
        $n = $num[$c];
        if (!(strpos(".,'''", $n) === false)) {
            if ($punt) {
                break;
            } else {
                $punt = true;
                continue;
            }

        } elseif (!(strpos('0123456789', $n) === false)) {
            if ($punt) {
                if ($n != '0') {
                    $zeros = false;
                }

                $fra .= $n;
            } else {
                $ent .= $n;
            }

        } else {
            break;
        }

    }
    $ent = '     ' . $ent;
    if ($dec and $fra and !$zeros) {
        $fin = ' coma';
        for ($n = 0; $n < strlen($fra); $n++) {
            if (($s = $fra[$n]) == '0') {
                $fin .= ' cero';
            } elseif ($s == '1') {
                $fin .= $fem ? ' una' : ' un';
            } else {
                $fin .= ' ' . $matuni[$s];
            }

        }
    } else {
        $fin = '';
    }

    if ((int) $ent === 0) {
        return 'Cero ' . $fin;
    }

    $tex    = '';
    $sub    = 0;
    $mils   = 0;
    $neutro = false;
    while (($num = substr($ent, -3)) != '   ') {
        $ent = substr($ent, 0, -3);
        if (++$sub < 3 and $fem) {
            $matuni[1] = 'una';
            $subcent   = 'os';
        } else {
            $matuni[1] = $neutro ? 'un' : 'uno';
            $subcent   = 'os';
        }
        $t  = '';
        $n2 = substr($num, 1);
        if ($n2 == '00') {
        } elseif ($n2 < 21) {
            $t = ' ' . $matuni[(int) $n2];
        } elseif ($n2 < 30) {
            $n3 = $num[2];
            if ($n3 != 0) {
                $t = 'i' . $matuni[$n3];
            }

            $n2 = $num[1];
            $t  = ' ' . $matdec[$n2] . $t;
        } else {
            $n3 = $num[2];
            if ($n3 != 0) {
                $t = ' y ' . $matuni[$n3];
            }

            $n2 = $num[1];
            $t  = ' ' . $matdec[$n2] . $t;
        }
        $n = $num[0];
        if ($n == 1) {
            $t = ' ciento' . $t;
        } elseif ($n == 5) {
            $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
        } elseif ($n != 0) {
            $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
        }
        if ($sub == 1) {
        } elseif (!isset($matsub[$sub])) {
            if ($num == 1) {
                $t = ' mil';
            } elseif ($num > 1) {
                $t .= ' mil';
            }
        } elseif ($num == 1) {
            $t .= ' ' . $matsub[$sub] . 'ón';
        } elseif ($num > 1) {
            $t .= ' ' . $matsub[$sub] . 'ones';
        }
        if ($num == '000') {
            $mils++;
        } elseif ($mils != 0) {
            if (isset($matmil[$sub])) {
                $t .= ' ' . $matmil[$sub];
            }

            $mils = 0;
        }
        $neutro = true;
        $tex    = $t . $tex;
    }
    $tex = $neg . substr($tex, 1) . $fin;
    return ucfirst($tex);
}
function nombre_mes($a)
{
    switch ($a) {
        case 1:$a = "Enero";
            break;
        case 2:$a = "Febrero";
            break;
        case 3:$a = "Marzo";
            break;
        case 4:$a = "Abril";
            break;
        case 5:$a = "Mayo";
            break;
        case 6:$a = "Junio";
            break;
        case 7:$a = "Julio";
            break;
        case 8:$a = "Agosto";
            break;
        case 9:$a = "Septiembre";
            break;
        case 10:$a = "Octubre";
            break;
        case 11:$a = "Noviembre";
            break;
        case 12:$a = "Diciembre";
            break;
    }

    return $a;

}

$sqli = "SELECT *,
  empresa.logo_jmc,
  empresa.cod_jmc
FROM
  empresa";
$dbdatosee = new Database();
$dbdatosee->query($sqli);
$dbdatosee->next_row();

$sqlv = "select * from contrato_alquiler
inner join cliente on (cliente.cod_cli = contrato_alquiler.cod_cliente)
inner join paciente on (paciente.cod_pac = contrato_alquiler.cod_paciente)

WHERE cod_calc = $codigo";
$dbv = new Database();
$dbv->query($sqlv);
$dbv->next_row();
if ($dbv->tipo_persona == 1) {
    $codigo_cuidad = $dbv->ciudad_exp_ced_cli;
} else {
    $codigo_cuidad = $dbv->ciudad_cli;
}

$sqlr = "select * from contrato_alquiler
  inner join responsable on (responsable.cod_cli = contrato_alquiler.cod_responsable)
  WHERE cod_calc = $codigo";
$dbr = new Database();
$dbr->query($sqlr);
$dbr->next_row();

$sqlf = "select * from ciudad
WHERE cod_ciu = $codigo_cuidad";
$dbf = new Database();
$dbf->query($sqlf);
$dbf->next_row();
$cuidad = $dbf->nom_ciu;

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
      <td><table width="100%" border="0" align="center">
        <tr >
          <td height="37"><div align="center"><strong>
            <?=$dbdatosee->nom_jmc?>
            <br />
          CONTRATO ALQUILER EQUIPOS
            <?if ($dbv->tipo_contrato == 2) {?>
            (CONVENIO
            <?=$dbv->nom1_cli?>
            <?=$dbv->nom2_cli?>
            <?=$dbv->apel1_cli?>
            <?=$dbv->apel2_cli?>)
            <?}?>
            <br />
            &nbsp;NUMERO
            <?=$dbv->consecutivo?>
          </strong></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="justify" class="titulosup04">
        <p>Entre quienes suscriben  este documento, por una parte<strong>
          <?=$dbdatosee->nom_jmc?>
        </strong>con NIT. <strong>
        <?=$nit = convertir_nit($dbdatosee->nit_jmc);?>
        </strong>,   representada legalmente por <strong>Pilar Uricoechea</strong>,  mayor de edad, vecina del Bogot&aacute;, identificada con c&eacute;dula de ciudadan&iacute;a No. 51764210  expedida en Bogot&aacute;, por una parte y para los efectos del presente contrato se  denominar&aacute; - <strong>EL ARRENDADOR </strong>y por la otra parte
      <?if ($dbv->tipo_contrato == 1) {?>
            <strong>
      <?=$dbv->nom1_cli?>
            <?=$dbv->nom2_cli?>
            <?=$dbv->apel1_cli?>
            <?=$dbv->apel2_cli?>
            </strong>
            <?}?>
            <?if ($dbv->tipo_contrato == 2) {?>
            <strong>
      <?=$dbr->nom1_cli?>
            <?=$dbr->nom2_cli?>
            <?=$dbr->apel1_cli?>
            <?=$dbr->apel2_cli?>
            </strong>
            <?}?>
          <?if ($dbv->tipo_contrato == 1) {?>
      <?if ($dbv->tipo_persona == 1) {?>
            con c&eacute;dula de ciudadan&iacute;a No.
      <?} else {?>
      con  NIT
      <?}?>
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
      <?if ($dbr->tipo_persona == 1) {?>
            con  c&eacute;dula de ciudadan&iacute;a No.
      <?} else {?>
      con NIT
      <?}?>
          <?}?>
          <?if ($dbv->tipo_contrato == 1) {?>
      <?if ($dbv->tipo_persona == 1) {?>
          <?=convertir_cedula($dbv->cedula_cli)?>
      <?} else {?>
      <?=convertir_nit($dbv->cedula_cli)?>
      <?}?>
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
      <?if ($dbr->tipo_persona == 1) {?>
          <?=convertir_cedula($dbr->cedula_cli)?>
      <?} else {?>
      <?=convertir_nit($dbr->cedula_cli)?>
      <?}?>
          <?}?>
          </span></strong>, quien para todos los efectos del presente contrato obra en  nombre propio y se denominar&aacute; <strong>EL<strong> ARRENDATARIO</strong></strong> manifestamos que hemos convenido celebrar un <strong>CONTRATO DE ARRENDAMIENTO DE EQUIPOS  ORTOP&Eacute;DICOS, </strong>en adelante <strong>EL  CONTRATO</strong>, el cual se rige por las siguientes cl&aacute;usulas: <br />
          <strong>PRIMERA:  EL ARRENDATARIO</strong> se obliga en este contrato en  forma solidaria, con relaci&oacute;n a los derechos y obligaciones derivadas del  contrato y para todos los efectos legales del mismo<strong>. </strong><br />
          <strong>SEGUNDA: </strong>En virtud del presente contrato <strong>EL ARRENDADOR</strong> entrega a t&iacute;tulo de  arrendamiento al <strong>ARRENDATARIO</strong>, concedi&eacute;ndoles su uso y goce, del (los)  equipo(s) ortop&eacute;dico(s).
          <?if ($dbv->tipo_contrato == 1) {

    $sql_1 = "SELECT * FROM listado_equipos

          INNER JOIN equipos ON (equipos.cod_equipo = listado_equipos.cod_equipo)
                    INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
          INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
          INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = listado_equipos.cod_contrato)
          where cod_calc  = $codigo";
    $dbdatos_1 = new Database();
    $dbdatos_1->query($sql_1);
    $jj          = 0;
    $valor_total = 0;
    $canon       = 0;
    echo "<br>";
    echo "<br>";
    echo "<table width='771' height='28' border='1' class='titulosup04'>";
    echo "<tr>";
    echo "<td width='150'><strong><div align='center'>Articulo</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Fecha de entrega</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Fecha devolucion</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Valor Canon</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Valor deposito</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Valor total</div></strong></td>";
    echo "</tr>";
    while ($dbdatos_1->next_row()) {
        $canon_total    = $canon_total + $dbdatos_1->canon_equipo;
        $deposito_total = $deposito + $dbdatos_1->deposito_equipo;
        $valor          = $dbdatos_1->canon_equipo;
        $valor_total    = ($valor_total + $valor);
        $jj++;
        echo "<tr>";
        echo "<td width='150'><div align='center'>$dbdatos_1->nom_clase $dbdatos_1->desc_tipo_equipos</div></td>";
        echo "<td width='150'><div align='center'>$dbdatos_1->fecha_ini_contrato</div></td>";
        echo "<td width='150'><div align='center'>$dbdatos_1->fecha_fin_contrato</div></td>";
        echo "<td width='150'><div align='center'>$dbdatos_1->canon_equipo</div></td>";
        echo "<td width='150'><div align='center'>$dbdatos_1->deposito_equipo</div></td>";
        echo "<td width='150'><div align='center'>$valor</div></td>";
        echo "</tr>";

    }
    echo "<tr>";
    echo "<td width='150'><div align='center'>&nbsp;</div></td>";
    echo "<td width='150'><div align='center'>&nbsp;</div></td>";
    echo "<td width='150'><div align='center'>&nbsp;</div></td>";
    echo "<td width='150'><div align='center'>&nbsp;</div></td>";
    echo "<td width='150'><div align='center'>Valor total alquiler</div></td>";
    echo "<td width='150'><div align='center'>$valor_total</div></td>";
    echo "</tr>";
    echo "</table>";
}?>

          <?if ($dbv->tipo_contrato == 2) {

    $sql_1 = "SELECT * FROM listado_equipos

          INNER JOIN equipos ON (equipos.cod_equipo = listado_equipos.cod_equipo)
                    INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
          INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
          INNER JOIN contrato_alquiler ON (contrato_alquiler.cod_calc = listado_equipos.cod_contrato)
          where cod_calc  = $codigo";
    $dbdatos_1 = new Database();
    $dbdatos_1->query($sql_1);
    $jj          = 0;
    $valor_total = 0;
    $canon       = 0;
    echo "<br>";
    echo "<br>";
    echo "<table width='771' height='28' border='1' class='titulosup04'>";
    echo "<tr>";
    echo "<td width='150'><strong><div align='center'>Articulo</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Fecha de entrega</div></strong></td>";
    echo "<td width='150'><strong><div align='center'>Fecha devolucion</div></strong></td>";
    echo "</tr>";
    while ($dbdatos_1->next_row()) {
        $canon_total    = $canon_total + $dbdatos_1->canon_arrend_equipo;
        $deposito_total = $deposito + $dbdatos_1->valor_deposito;
        $valor          = $dbdatos_1->canon_arrend_equipo;
        $valor_total    = ($valor_total + $valor);
        $jj++;
        echo "<tr>";
        if ($dbdatos_1->clase_equipo == 5) {
            echo "<td width='150'><div align='center'>$dbdatos_1->nom_equipo $dbdatos_1->desc_tipo_equipos</div></td>";
        } else {
            echo "<td width='150'><div align='center'>$dbdatos_1->nom_clase $dbdatos_1->desc_tipo_equipos</div></td>";
        }
        echo "<td width='150'><div align='center'>$dbdatos_1->fecha_ini_contrato</div></td>";
        echo "<td width='150'><div align='center'>$dbdatos_1->fecha_fin_contrato</div></td>";
        echo "</tr>";

    }
    echo "</table>";
}?>
        <br />
          <strong>TERCERA:  ESTADO DEL BIEN INMUEBLE.- </strong><strong>EL ARRENDATARIO</strong> har&aacute; entrega de (los)  equipo(s) ortop&eacute;dico(s) en perfectas condiciones de operaci&oacute;n y funcionamiento,  en virtud de lo cual El ARRENDATARIO en la fecha de suscripci&oacute;n de este  documento declara recibir  de conformidad con el  inventario elaborado por las partes (ANEXO 1).
          <?if ($dbv->tipo_contrato == 1) {?>
          <br />
          <strong>CUARTA:  CANON DE ARRENDAMIENTO.-</strong>
          El canon de arrendamiento mensual estipulado en el presente contrato es la suma  de
          <?=num2letras($canon_total)?>
          <strong>
          ($
          <?=number_format($canon_total, 0, ".", ".")?>
          )
          </strong>
          , que
          <strong>EL ARRENDATARIO</strong>
          pagar&aacute; a
          <strong>EL ARRENDADOR</strong> de forma anticipada
          </strong>.
          <strong>PAR&Aacute;GRAFO:</strong>
          DEP&Oacute;SITO:
          <?=num2letras($deposito_total)?>
          <strong>
          ($
          <?=number_format($deposito_total, 0, ".", ".")?>
          </span>
          )
          </strong>
          .  El cual ser&aacute; reembolsado a la terminaci&oacute;n del presente contrato.
      <?}?>
          <br />
      <?if ($dbv->tipo_contrato == 2) {?>
          <strong> CUARTA:</strong><strong> - EL ARRENDATARIO</strong> se compromete a entregar las ordenes m&eacute;dicas correspondientes de los art&iacute;culos arrendados en las oficinas de <strong>
          <?=$dbdatosee->nom_jmc?>, </strong>si los art&iacute;culos  NO se devuelven en la fecha indicada el valor del alquiler a partir de dicha fecha correr&aacute; por cuenta del arrendador.
          <br>
          <?}?>
          <?if ($dbv->tipo_contrato == 1) {?>
          <strong>QUINTA:  LUGAR PARA EL PAGO.- EL ARRENDATARIO </strong> puede pagar el canon de arrendamiento: En nuestra oficina
          <strong>
          <?=$dbdatosee->nom_jmc?>
          </strong>  a traves de nuestra pagina web: www.ortopedicoswyw.com o consignar&aacute; en  la cuenta corriente No. 288 07464-4 mediante formulario de recaudo en l&iacute;nea en cualquier oficina del  BANCO DE OCCIDENTE a nombre de ortop&eacute;dicos  W y W con c&oacute;digo de recaudo # 13888 indicando el nombre del arrendador y su n&uacute;mero de identificaci&oacute;n.
          <br>
      <?}?>
          <?if ($dbv->tipo_contrato == 1) {?>
          <strong>SEXTA:</strong>
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
          <strong>QUINTA:</strong>
          <?}?>
          </strong>El arrendatario se compromete a entregar los art&iacute;culos alquilados al finalizar el contrato en el mismo estado como fueron recibidos, el transporte correra por cuenta del arrendatario, tanto para llevar, como para devolverlo.<br />
          <strong>
          <?if ($dbv->tipo_contrato == 1) {?>
          S&Eacute;PTIMA:
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
          SEXTA:
          <?}?>
          GARANTIA- </strong>El arrendatario firmar&aacute; una letra por el valor comercial de los art&iacute;culos, con esta el arrendatario autoriza al representante legal para que llene y liquide los intereses de mora que se causen en caso de incumplimiento.<br />
          <strong>
          <?if ($dbv->tipo_contrato == 1) {?>
          OCTAVA:
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
          S&Eacute;PTIMA:
          <?}?>
        REPARACIONES</strong> <strong>EL ARRENDATARIO</strong> - no podrá hacer modificaciones a los bienes alquilados. El mantenimiento y servicio técnico será suministrado por el arrendador. Los daños que se ocasionen serán pagados por <strong>EL ARRENDATARIO.</strong>

         <?if ($dbv->tipo_contrato == 1) {?>
         <br>
         <strong>NOVENA:</strong> Ortop&eacute;dicos W y W no asume responsabilidad alguna por los perjuicios que el mal uso del art&iacute;culo arrendado pueda causar.<br />
        <?}?>
         <?if ($dbv->tipo_contrato == 2) {?><br>
         <strong>OCTAVA:</strong> Ortop&eacute;dicos W y W no asume responsabilidad alguna por los perjuicios que el mal uso del art&iacute;culo arrendado pueda causar.<br />
        <?}?>
<span><strong>DECIMA:</strong></span>
        <span>&nbsp;Este contrato tiene una duraci&oacute;n de Un (1) mes, prorrogable de forma autom&aacute;tica por&nbsp;&nbsp;solicitud del&nbsp;<strong>ARRENDATARIO</strong>&nbsp;y el&nbsp;&nbsp;&nbsp;pago del canon de arrendamiento correspondiente o por la no devoluci&oacute;n de los art&iacute;culos en la fecha&nbsp; de devoluci&oacute;n acordada inicialmente en&nbsp;este contrato.</span>
        <br /><strong>UNDECIMA : AUTORIZACION CONSULTA Y REPORTE EN CENTRALES DE RIESGO</strong>          Declaro que la informaci&oacute;n suministrada es ver&iacute;dica.&nbsp;Autorizo a Ortop&eacute;dicos Williamson y Williamson a consultar, reportar y suministrar informaci&oacute;n a Datacr&eacute;dito Experian sobre mi comportamiento comercial.<br>
          <?if ($dbv->tipo_contrato == 2) {?>
          Este contrato es de conocimiento de
          <?=$dbv->nom1_cli?>
          <?=$dbv->nom2_cli?>
          <?=$dbv->apel1_cli?>
          <?=$dbv->apel2_cli?>
          <?}?>
        .</p>
      </div></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="27%" class="titulosup04">&nbsp;</td>
          <td width="52%" class="titulosup04">&nbsp;</td>
          <td width="18%" class="titulosup04">&nbsp;</td>
          <td width="12%" colspan="2" class="titulosup04"></td>
        </tr>
        </table></td>

    </tr>
    <tr>
      <td><table width="52%" border="0" align="left">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
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
          <td colspan="2"><span class="titulosup04">
            <?if ($dbv->tipo_contrato == 1) {?>
      <?=$dbv->nom1_cli?>
            <?=$dbv->nom2_cli?>
            <?=$dbv->apel1_cli?>
            <?=$dbv->apel2_cli?>
            <?}?>
            <?if ($dbv->tipo_contrato == 2) {?>
      <?=$dbr->nom1_cli?>
            <?=$dbr->nom2_cli?>
            <?=$dbr->apel1_cli?>
            <?=$dbr->apel2_cli?>
            <?}?>
          </span></td>
        </tr>
        <tr>
          <td width="31"><span class="titulosup04">
            <?if ($dbv->tipo_persona == 1) {?>C.C. :<?} else {?>NIT :<?}?>
      </span></td>
          <td width="360"><span class="titulosup04">
          <?if ($dbv->tipo_contrato == 1) {?>
      <?if ($dbv->tipo_persona == 1) {?>
          <?=convertir_cedula($dbv->cedula_cli)?>
      <?} else {?>
      <?=convertir_nit($dbv->cedula_cli)?>
      <?}?>
          <?}?>
          <?if ($dbv->tipo_contrato == 2) {?>
      <?if ($dbr->tipo_persona == 1) {?>
          <?=convertir_cedula($dbr->cedula_cli)?>
      <?} else {?>
      <?=convertir_nit($dbr->cedula_cli)?>
      <?}?>
          <?}?>
          </span></td>
        </tr>
        <tr>
          <td class="titulosup04">De:</td>
          <td><span class="titulosup04">
            <?=$cuidad?>
          </span></td>
        </tr>
      </table>
    <table width="51%" border="0" align="left">
    <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><p><img src="../imagenes/firma.png" alt="" width="241" height="47" align="bottom" /></p></td>
        </tr>
        <tr>
          <td colspan="2"><?=$dbdatosee->nom_jmc?></td>
        </tr>
        <tr>
          <td width="32"><span class="titulosup04">NIT :</span></td>
          <td width="354"><span class="titulosup04">
            <?=$nit = convertir_nit($dbdatosee->nit_jmc);?>
          </span></td>
        </tr>
        <tr>
          <td class="titulosup04">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>

  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><p align="center"><strong><span><em>Carrera 13A # 79 - 64 / Tel&eacute;fonos: 2185100/ 6351666 </em></span></strong></p></td>
    </tr><tr>
        <td height="23" colspan="6" align="center"> <div id="imp"></div></td>
      </tr>
  </table>
</body>
</html>

