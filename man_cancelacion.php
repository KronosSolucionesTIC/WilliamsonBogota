<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?	

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 
		//VERIFICA SI EL CONTRATO ESTA AL DIA
		

		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1 MODIFICACION DEL ESTADO DEL CONTRATO Y FECHA DE CANCELACION		
		$campos="estado_contrato='2'";
		$error = editar("contrato_alquiler",$campos,'cod_calc',$contrato_alquiler);
		
		if ($error==1) {
				header("Location: con_cancelacion.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
        }

if($guardar==1 and $codigo!=0) { 

	// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN ENTREGA	
	$campos="fecha_entrega='".$fecha_entrega."',observaciones='".$observaciones."'";
	$error=editar("entregas",$campos,'cod_entrega',$codigo);		
	if ($error==1) {
		header("Location: con_cancelacion.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
    {
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
    }

}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-size: 12px}
</style> 

<? inicio() ?>

<script language="javascript">
		
function datos_completos(){  
if (document.getElementById('contrato_alquiler').value == 0){
    alert("Seleccione el contrato");
	return false;}
else {
	return true;}
}

function buscar_contrato(con,cli) {
var combo=document.getElementById(con);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione...','0'); 
cant++;

<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT * FROM contrato_alquiler';

	$db->query($sql);
	while($db->next_row()){ 			
		echo "if(document.getElementById(cli).value==$db->cod_cliente && $db->estado_contrato == 1) {";	
		echo "combo.options[cant] = new Option('$db->consecutivo','$db->cod_calc'); ";	
		echo  "cant++; } ";
		
	}
	

?>

}
</script>


<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_cancelacion.php"  method="post" enctype="multipart/form-data">
<table width="830" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td width="830" bgcolor="#E9E9E9"><table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
        <td valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
         <td width="5" height="19">&nbsp;</td>
        <td width="20" ><img src="imagenes/icoguardar.png" alt="Nuevo Registro" width="16" height="16" border="0"  onclick="cambio_guardar()" style="cursor:pointer"/></td>
        <td width="61" class="ctablaform">Guardar</td>
        <td width="21" class="ctablaform"><a href="con_alquiler.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_alquiler.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo"   id="codigo"   value="<?=$codigo?>" />
		  <input type="hidden" name="clientes" id="clientes" value="<?=$clientes?>" />
		  <input type="hidden" name="contrato" id="contrato" value="<?=$contrato?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="26" class="textotabla1 Estilo1">CANCELACION DE CONTRATOS:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top"><table width="830" border="0">
      <tr>
        <td width="824"><table width="824" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td width="104" class="textotabla1">Cliente :</td>
            <td width="300" class="textotabla1"><? combo_evento1("cliente","cliente","cod_cli","nom1_cli","","onchange='buscar_contrato(\"contrato_alquiler\",\"cliente\")'",    
							"apel1_cli"); ?></td>
            <td width="178" class="textotabla1">Contrato:</td>
            <td width="242" class="textotabla1"><? combo_evento("contrato_alquiler","contrato_alquiler","cod_calc","consecutivo","","","cod_calc"); ?></td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><!--SOLAPA GARANTIA-->
              <!--FIN SOLAPA GARANTIA--></td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><!--SOLAPA GARANTIA--><!--FIN SOLAPA GARANTIA--></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center"><img src="imagenes/spacer.gif"  width="624" height="4" /></div></td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>
</form> 
</body>
</html>