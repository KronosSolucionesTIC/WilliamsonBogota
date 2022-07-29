<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="js/js.js"></script>
 <script language="javascript">
function datos_completos()
{  

if(document.getElementById("equipos").value==0){
alert("Seleccione un equipos");
	return false;
	}

else
	document.forma.submit();
	
}


function buscar_equipos(con,cli) {
var combo=document.getElementById(con);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
combo.options[cant] = new Option('Todos','todos'); 
cant++;

<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT * FROM equipos_alquiler';

	$db->query($sql);
	while($db->next_row()){ 
		echo "if(document.getElementById(cli).value==$db->cod_cliente && $db->estado_equipos == 1 ) {";	
		echo "combo.options[cant] = new Option('$db->consecutivo','$db->cod_calc'); ";	
		echo  "cant++; } ";
		
	}
	

?>

}

</script>



<? inicio() ?>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/stylesforms.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="508" align="center">
<tr>
<td width="510" valign="top" >
<form id="forma" name="forma" method="post" action="man_equipos_baja.php" enctype="multipart/form-data">
                  <table width="510" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td width="510" bgcolor="#E9E9E9"><table width="510" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td width="1"></td>
                          <td width="1" height="33"></td>
                          <td colspan="3" class="titulosupsub">SELECCIONE UN EQUIPO </td>
                        </tr>
                        
                        <tr>
                          <td></td>
                          <td height="33"></td>
                          <td width="80" class="ctablaform">Equipos:</td>
                          <td width="419"><input name="tipo_persona" id="tipo_persona" type="hidden" class=
						  "caja_resalte1" onKeyPress=" return valida_evento(this,'tipo_arrendamiento')" >
                          <? combo_evento3("equipos","equipos","cod_equipo","concat(`consecutivo_equipo`,' ',`nom_clase`,' ',`nom_equipo`,' ',`desc_tipo_equipos`)","","","estado_arrend_equipo != 1 and estado_arrend_equipo != 4","consecutivo_equipo"); ?></td>
                          <td width="206" align="center"><div align="left"></div></td>
                        </tr>
                          <tr>
                          <td></td>
                          <td height="33"></td>
                          <td colspan="3" class="ctablaform">
                            <div align="right"><span class="titulosup04">                            </span>
                              <input type="button" name="Siguiente" value="Siguiente" onClick="datos_completos()">
                              <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>" />
                              <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
                              <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
                              <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
                            </div></td>
                         </tr>
                      </table></td>
                    </tr>
                    
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="510" height="5" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="bottom">&nbsp;</td>
                    </tr>
        </table>
	  </form>
</td>
</tr>
</table>						
</body>
</html>
