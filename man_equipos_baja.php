<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?
if ($codigo == 0) {

	$sqle="SELECT * FROM `equipos` 
	WHERE cod_equipo = $equipos";
	$dbe= new  Database();
	$dbe->query($sqle);
	$dbe->next_row();
	$clase = $dbe->clase_equipo;
	$tipo = $dbe->tipo_equipo;
	$tamano = $dbe->tamano_equipo;
	$estado_equi = $dbe->estado_arrend_equipo;
	
		$sqlc="SELECT * FROM `clase_equipos` 
		WHERE cod_clase = $clase";
		$dbc= new  Database();
		$dbc->query($sqlc);
		$dbc->next_row();
		
			$sqlt="SELECT * FROM `tipo_equipos` 
			WHERE cod_tipo_equipos = $tipo";
			$dbt= new  Database();
			$dbt->query($sqlt);
			$dbt->next_row();
			
				$sqltam="SELECT * FROM `tamano_equipos` 
				WHERE cod_tam_equipos = $tamano";
				$dbtam= new  Database();
				$dbtam->query($sqltam);
				$dbtam->next_row();
	
}

else {

	$sqlm="SELECT * FROM `bajas` 
	WHERE cod_baja = $codigo";
	$dbm= new  Database();
	$dbm->query($sqlm);
	$dbm->next_row();
	$equipos = $dbm->equipo_bajas;
	
		$sqle="SELECT * FROM `equipos` 
		WHERE cod_equipo = $equipos";
		$dbe= new  Database();
		$dbe->query($sqle);
		$dbe->next_row();
		$clase = $dbe->clase_equipo;
		$tipo = $dbe->tipo_equipo;
		$tamano = $dbe->tamano_equipo;
		
			$sqlc="SELECT * FROM `clase_equipos` 
			WHERE cod_clase = $clase";
			$dbc= new  Database();
			$dbc->query($sqlc);
			$dbc->next_row();
		
				$sqlt="SELECT * FROM `tipo_equipos` 
				WHERE cod_tipo_equipos = $tipo";
				$dbt= new  Database();
				$dbt->query($sqlt);
				$dbt->next_row();
			
					$sqltam="SELECT * FROM `tamano_equipos` 
					WHERE cod_tam_equipos = $tamano";
					$dbtam= new  Database();
					$dbtam->query($sqltam);
					$dbtam->next_row();
}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 

		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.INGRESO EN BAJAS
		$campos="(equipo_baja,fecha_baja,tipo_baja,observaciones_baja)";
		$valores="('".$equipos."','".$fecha_baja."','".$tipo_baja."','".$observaciones_baja."')" ;
		$error=insertar("bajas",$campos,$valores);
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2 MODIFICACION DEL ESTADO DEL EQUIPO		
		if ($estado_equi != 1) {
		$estado_equi = 4;
		}
		$campos="estado_arrend_equipo='".$estado_equi."'";
		$error=editar("equipos",$campos,'cod_equipo',$equipos); 
		
		
		if ($error==1) {
				header("Location: con_equipos_baja.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
                      
        }

if($guardar==1 and $codigo!=0) { 

		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.INGRESO EN bajas
		$campos="fecha_bajaenimientos='".$fecha_baja."',valor_bajas='".$tipo_baja."'";
		$error=editar("bajas",$campos,'cod_baja',$codigo);
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.1 MODIFICACION DEL ESTADO DEL EQUIPO		
		if ($estado_equi == 1) {
		$tipo_baja = $estado_equi;
		}
		$campos="estado_arrend_equipo='".$tipo_baja."'";
		$error=editar("equipos",$campos,'cod_equipo',$equipos); 
		
		
		if ($error==1) {
				header("Location: con_bajas.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
                      
        }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
if (document.getElementById('fecha_baja').value =='' || document.getElementById('tipo_baja').value == 0 || document.getElementById('descripcion').value ==''){
    alert("Seleccione los campos obligatorios");
	return false;}
else {
	return true;}
}

</script>

<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_equipos_baja.php"  method="post" enctype="multipart/form-data">
<table width="624" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td bgcolor="#E9E9E9"><table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
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
        <td width="21" class="ctablaform"><a href="con_equipos_baja.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_equipos_baja.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo"   id="codigo"   value="<?=$codigo?>" />
		  <input type="hidden" name="equipos"   id="equipos"   value="<?=$equipos?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1"> DAR DE BAJA EQUIPO ORTOPEDICO:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top"><table width="486" border="0">
      <tr>
        <td><table width="629" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="7" class="botonforms"><div align="center">DATOS GENERALES EQUIPO </div></td>
          </tr>
          <tr>
            <td class="textotabla1">Consecutivo:</td>
            <td><span class="ctablaform">
              <?=$dbe->consecutivo_equipo?>
            </span></td>
            <td>&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td width="203" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="146" class="textotabla1" align="left">Clase:</td>
            <td><span class="ctablaform">
              <?=$dbc->nom_clase?>
            </span></td>
            <td width="8">&nbsp;</td>
            <td width="128" class="textotabla1" align="left">Tipo:</td>
            <td class="ctablaform"><?=$dbt->desc_tipo_equipos?></td>
          </tr>
          <tr>
            <td class="textotabla1" align="left">Nombre:</td>
            <td><span class="ctablaform">
              <?=$dbe->nom_equipo?>
              </span></td>
            <td>&nbsp;</td>
            <td class="textotabla1" align="left">Tama&ntilde;o:</td>
            <td colspan="2"><span class="ctablaform">
              <?=$dbtam->desc_tam_equipos?>
              </span></td>
          </tr>
          <tr>
            <td class="textotabla1" align="left">Descripci&oacute;n:</td>
            <td colspan="5"><span class="ctablaform">
              <?=$dbe->desc_equipo?>
              </span></td>
          </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7" class="botonforms"><div align="center"> PARTES DEL EQUIPO </div></td>
          </tr>
          
          <tr>
            <td colspan="6" class="textotabla1" ><div id="trae" align="center">
                <table  width="73%" height="27" border="1">
                  <tr >
                    <td width="34%"  class="ctablasup"><div align="center">Parte: </div></td>
                    <td width="34%"  class="ctablasup"><div align="center">Tipo parte: </div></td>
                    </tr>
				  <?
					$sql_1 ="SELECT * FROM listado_partes
						INNER JOIN partes ON (partes.cod_partes=listado_partes.cod_parte)
						INNER JOIN tipo_partes ON (tipo_partes.cod_tipo_partes=listado_partes.cod_tipo_parte)
						where cod_equipo_parte  = $equipos";	
					$dbdatos_1= new  Database();
					$dbdatos_1->query($sql_1);
					$jj=1;
					while($dbdatos_1->next_row()){ 
						echo "<tr>";

//PARTE
						echo "<td>$dbdatos_1->desc_partes</td>";

//TIPO PARTE
						echo "<td>$dbdatos_1->desc_tipo_partes</td>";
											
						echo "</tr>";
						
						$jj++;	
					}
			
				?>
                  </table>
                <div align="center"></div>
				  </div>				  </td>
          </tr>
        </table></td>
      </tr>
         
          <tr>
            <td colspan="3" class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" class="textotabla1"><strong>DAR DE BAJA</strong></td>
          </tr>
          <tr>
            <td colspan="7" class="textotabla1"><table width="628" border="0">
              <tr>
                <td width="82" height="37" class="textotabla1">Fecha de baja:</td>
                <td width="221"><input name="fecha_baja" id="fecha_baja" type="text" class="textfield2" value="<?=$dbm->fecha_bajaenimientos?>" />
                  <span class="textorojo"><img src="imagenes/date.png" alt="Calendario" name="calendario" width="18" height="18" id="calendario" style="cursor:pointer"/>*</span></td>
                <td width="90" class="textotabla1">Observaciones:</td>
                <td width="202" class="textotabla1"><a href="#">
                  <textarea name="descripcion" id="descripcion" cols="45" rows="4" class="textfield02"><?=$dbe->desc_equipo?>
                  </textarea>
                </a></td>
                <td width="11"><span class="textorojo">*</span></td>
              </tr>
              <tr>
                <td height="22" class="textotabla1">Tipo de baja: </td>
                <td><? combo_evento("tipo_baja","tipo_baja","cod_tipo_baja","desc_tipo_baja","","", "cod_tipo_baja"); ?></td>
                <td class="textotabla1">&nbsp;</td>
                <td class="textotabla1">&nbsp;</td>
                <td width="11">&nbsp;</td>
              </tr>
            </table></td>

            </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
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
<script type="text/javascript">	
	Calendar.setup(
				{
					inputField  : "fecha_baja",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario" ,  
					align       :"T3",
					singleClick :true
				}
				
			);				
			
</script>
</form> 
</body>
</html>