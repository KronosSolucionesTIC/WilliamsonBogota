<? include("../lib/database.php")?>
<? include("../js/funciones.php")?>

<?


$sqli ="SELECT *,
  empresa.logo_jmc,
  empresa.cod_jmc
FROM
  empresa";
	$dbdatosee= new  Database();
	$dbdatosee->query($sqli);
	$dbdatosee->next_row();


	$sql0 ="SELECT * FROM `mantenimientos`
	INNER JOIN equipos ON (equipos.cod_equipo = mantenimientos.equipo_mantenimientos)
	INNER JOIN estado_arrend_equipo ON (estado_arrend_equipo.cod_est_arrend_equipo  = equipos.estado_arrend_equipo )
	$where ORDER BY fecha_mantenimientos DESC"
	;
	$dbd0= new  Database();
	$dbd0->query($sql0);
	$dbd0->next_row();
	
?>







<script language="javascript">

function descargar( informe){
window.open("../documentos/"+informe,"ventana_1","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
}

function imprimir(){
	document.getElementById('imp').style.display="none";
	document.getElementById('cer').style.display="none";
	window.print();
}


</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/print_static.css" rel="stylesheet" type="text/css" />
<title>:::...Formulario Persona Natural...:::</title>
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
.Estilo11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
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
</head>
<body  <?=$sis?> onLoad="cambio_1(<?=$cant_pag?>,<?=$act_pag?>);">
<form name="form1" method="post" action="">
  <table width="867" align="center">
    
    
    <tr>
      <td width="924" colspan="3"><table width="100%" border="0" align="center" class="lineatablafinablue">
        
        <tr>
          <td height="330"><table width="100%" border="0" align="center">
              <tr class="ctablasup">
                <td><strong class="Estilo10">MANTENIMIENTOS </strong></td>
              </tr>
              </table>
            <table width="851" height="100" border="0">
               <tr>
                 <td height="276"><table width="100%" border="0" align="center">
                   <tr class="sectiontableheader">
                     <td class="ctablaform">Equipo:</td>
                     <td width="191" class="ctablaform"><?=$dbd0->consecutivo_equipo?></td>
                     <td width="167" class="ctablaform">Estado:</td>
                     <td width="261" class="ctablaform"><?=$dbd0->desc_est_arrend_equipo?></td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td width="164" class="ctablaform">Fecha mantenimiento: </td>
                     <td class="ctablaform"><?=$dbd0->fecha_mantenimientos?></td>
                     <td class="ctablaform">Valor mantenimiento:</td>
                     <td class="ctablaform"><?=$dbd0->valor_mantenimientos?></td>
                   </tr>
                   
                   
                 </table></td>
               </tr>
            </table>            
            </tr>
      </table></td>
    </tr>
  </table>
  <table width="200" border="0" align="center">
    <tr>
      <td><div align="center" class="tituloproductos">
          <input type="hidden" name="mapa" value="<?=$mapa?>" />
          <input name="button3" type="button" class="botones"  onclick="window.print()" value="Imprimir" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

				
</body>
</html>

