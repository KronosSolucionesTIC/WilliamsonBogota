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


$sql0 ="SELECT 

`cliente`.`cod_cli`,
`cliente`.`ciudad_exp_ced_cli`,
`ciudad`.`cod_ciu`,
`ciudad`.`nom_ciu`
FROM
  `cliente`
  INNER JOIN `ciudad` ON (`cliente`.`ciudad_exp_ced_cli` = `ciudad`.`cod_ciu`)WHERE cod_cli=$codigo

 ";
	$dbd0= new  Database();
	$dbd0->query($sql0);
	$dbd0->next_row();
	
	$sql2 ="SELECT 

`cliente`.`cod_cli`,
`cliente`.`ciudad_cli`,
`ciudad`.`cod_ciu`,
`ciudad`.`nom_ciu`
FROM
  `cliente`
  INNER JOIN `ciudad` ON (`cliente`.`ciudad_cli` = `ciudad`.`cod_ciu`)WHERE cod_cli=$codigo

 ";
	$dbd2= new  Database();
	$dbd2->query($sql2);
	$dbd2->next_row();
	
	$sql3 ="SELECT 

`cliente`.`cod_cli`,
`cliente`.`ciudad_oficine`,
`ciudad`.`cod_ciu`,
`ciudad`.`nom_ciu`
FROM
  `cliente`
  INNER JOIN `ciudad` ON (`cliente`.`ciudad_oficine` = `ciudad`.`cod_ciu`)WHERE cod_cli=$codigo

 ";
	$dbd3= new  Database();
	$dbd3->query($sql3);
	$dbd3->next_row();
	



$sql1="SELECT *
  
FROM
 cliente
  INNER JOIN `tipo_estado_civil` ON (`cliente`.`estado_civil_cli` = `tipo_estado_civil`.`cod_estado_civil`)
  INNER JOIN `tipo_empleado` ON (`cliente`.`tipo_empleo_cli` = `tipo_empleado`.`cod_tipo_empleado`)
 
   WHERE cod_cli=$codigo";


	$dbdatos1= new  Database();
	$dbdatos1->query($sql1);
	$dbdatos1->next_row();
	
	$sqle ="SELECT  
   departamentos.cod_dpto,
  departamentos.nom_dpto
 FROM cliente  
 INNER JOIN departamentos ON (cliente.dpto_cli = departamentos.cod_dpto)
 WHERE cod_cli = $codigo";
$dbdatose= new  Database();
$dbdatose->query($sqle);
$dbdatose->next_row();
	
	
	
	$sql ='SELECT 
  ciudad.cod_ciudad,
  ciudad.nom_ciudad,
  ciudad.cod_dptos,
  ciudad.cod_ciud,
  departamentos.cod_dpto,
  departamentos.nom_dpto,
  departamentos.codi_dpto

FROM
  ciudad
  INNER JOIN departamentos ON (ciudad.cod_dptos = departamentos.cod_dpto) 
 WHERE cod_dptos=cod_dpto';
	$db->query($sql);
	while($db->next_row()){ 			
		echo "if(document.getElementById(dpto).value==$db->cod_ciudad) {";	
		echo "combo.options[cant] = new Option('$db->nom_dpto','$db->cod_dpto'); ";		
		echo  "cant++; } ";
		
	}
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
                <td><strong class="Estilo10">CLIENTE  PERSONA JURIDICA </strong></td>
              </tr>
              <tr class="ctablasup">
                <td><strong class="Estilo10">INFORMACI&Oacute;N DEL CLIENTE </strong></td>
              </tr>
            </table>
            <table width="852" height="280" border="0">
               <tr>
                 <td height="276"><table width="100%" border="0" align="center">
                   <tr class="sectiontableheader">
                     <td class="ctablaform">Nombre: </td>
                     <td width="191" colspan="3" class="ctablaform"><?=$dbdatos1->nom1_cli?>
                       <?=$dbdatos1->nom2_cli?></td>
                     <td width="167" colspan="2" class="ctablaform">Apellido:</td>
                     <td colspan="2" class="ctablaform"><?=$dbdatos1->apel1_cli?>
                       <?=$dbdatos1->apel2_cli?></td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td width="164" class="ctablaform">Cedula:</td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->cedula_cli?></td>
                     <td colspan="2" class="ctablaform">De:</td>
                     <td colspan="2" class="ctablaform"><?=$dbd0->nom_ciu?></td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform">Estado:</td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->nom_estado_civil?></td>
                     <td colspan="2" class="ctablaform"><strong>Profesi&oacute;n u oficio: </strong></td>
                     <td colspan="2" class="ctablaform"><?=$dbdatos1->profesion_cli?></td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform">Empleado:</td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->nom_tipo_empleado?></td>
                     <td colspan="2" class="ctablaform"><strong>Direcci&oacute;n  domicilio actual: </strong></td>
                     <td colspan="2" class="ctablaform"><?=$dbdatos1->direccion_cli?></td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform"><strong>Ciudad domicilio:</strong></td>
                     <td colspan="3" class="ctablaform"><?=$dbd2->nom_ciu?></td>
                     <td colspan="2" class="ctablaform">Departamento domicilio: </td>
                     <td width="121" class="ctablaform"><?=$dbdatose->nom_dpto?></td>
                     <td width="140" class="ctablaform">&nbsp;</td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform"><strong>Tel&eacute;fono</strong> domicilio:</td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->telefono_cli?></td>
                     <td colspan="2" class="ctablaform">Celular:</td>
                     <td class="ctablaform"><?=$dbdatos1->celular_cli?></td>
                     <td class="ctablaform">&nbsp;</td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform"><strong>Email :</strong></td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->email_cli?></td>
                     <td colspan="2" class="ctablaform">Direccion de oficina: </td>
                     <td class="ctablaform"><?=$dbdatos1->direc_ofice?></td>
                     <td class="ctablaform">&nbsp;</td>
                   </tr>
                   <tr class="sectiontableheader">
                     <td class="ctablaform">Telefono de oficina: </td>
                     <td colspan="3" class="ctablaform"><?=$dbdatos1->tel_oficina?></td>
                     <td colspan="2" class="ctablaform">Ciudad oficina: </td>
                     <td class="ctablaform"><?=$dbd3->nom_ciu?></td>
                     <td class="ctablaform">&nbsp;</td>
                   </tr>
                   
                   
                 </table></td>
               </tr>
            </table>            </tr>
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

