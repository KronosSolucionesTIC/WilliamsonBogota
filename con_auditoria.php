<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? 

$cantidad_paginas=paginar("SELECT  fec_aud, nom_tab_aud,  nom_usu AS usuario ,CASE transaccion WHEN 1 THEN \"INSERCION\"  WHEN 2 THEN \"EDICION\" 	WHEN 3 THEN \"ELIMINACION\" END   AS transaccion  FROM auditoria INNER JOIN usuario ON auditoria.cod_usu_aud=usuario.cod_usu ORDER BY fec_aud DESC");
$cant_pag=ceil($cantidad_paginas/$cant_reg_pag);
if(!empty($act_pag)) 
	$inicio=($act_pag -1)*$cant_reg_pag  ;
else { 
	$inicio =0;
	$act_pag=1;
	}
 $paginar=" limit  $inicio, $cant_reg_pag";
 
 
 if(!empty($busquedas)) { #codigo para buscar 
	$busquedas=reemplazar_1($busquedas);
	$where=" where $busquedas ";
}#codigo para buscar 

 $sql="SELECT  fec_aud, nom_interfaz, nom_usu AS usuario ,CASE transaccion WHEN 1 THEN \"INSERCION\"  WHEN 2 THEN \"EDICION\" 	WHEN 3 THEN \"ELIMINACION\" END   AS transaccion  FROM auditoria INNER JOIN usuario ON auditoria.cod_usu_aud=usuario.cod_usu   
INNER JOIN admon_interfaz ON auditoria.nom_tab_aud=admon_interfaz.nom_tabla
$where ORDER BY fec_aud DESC $paginar ";

$busquedas=reemplazar($busquedas);

//$busquedas=reemplazar($busquedas);
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript">
var tWorkPath="menus/data.files/";
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body  <?=$sis?> onLoad="cambio_1(<?=$cant_pag?>,<?=$act_pag?>);">

<table align="center">
<tr>
<td valign="top" >
<form id="forma_total" name="forma_total" method="post" action="con_auditoria.php">
                  <table width="624" border="0" cellspacing="0" cellpadding="0" align="center" >
                     <tr>
                      <td bgcolor="#E9E9E9"><table width="624" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="8" height="33"> </td>
                          <td width="17"> 
						  <? if ($insertar==1) {?>
					  	  <!--<img src="imagenes/page.png" width="16" height="16"  alt="Nuevo Registro" style="cursor:pointer" onClick="location.href='man_empresa.php?codigo=0&editar=<$editar?>&insertar=<$insertar?>&eliminar=<$eliminar?>'"/>-->
					  	  <? } ?></td>
                          <td width="133"><span class="ctablaform">
                            <? if ($insertar==1) {?>
							<!--	Agregar-->
							<? } ?>
                          </span></td>
                          <td width="50" class="ctablaform">Buscar: </td>
                          <td width="103" class="ctablaform"><input name="text" type="text" class="textfield" size="12" id="texto" /></td>
                          <td width="20"><label> <span class="ctablaform">en</span></label></td>
                          <td width="160" class="ctablaform"><select name="campos" class="textfieldlista" id="campos" >
                            <option value="0">Seleccion</option>
							<option value="fec_aud">Fecha</option>
                            <option value="nom_usu">Usuario</option>
                            <option value="nom_interfaz">Interfaz</option>
                            <option value="-1">Lista Completa</option>
                          </select></td>
                          <td width="41" valign="middle"><img src="imagenes/ver.png" alt="Buscar" width="16" height="16" style="cursor:pointer"  onClick="buscar()"/></td>
                        
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="624" border="0"  cellpadding="0">
                        <tr>
                          
						  <td  class="ctablasup">FECHA </td>
						 
						  <td  class="ctablasup">USUARIO </td>
						  <td  class="ctablasup">INTERFAZ </td>
						  <td  class="ctablasup">TRANSACCION </td>
                        </tr>
						<? 
						
						echo "<tr style='display:none'><td ><form name='forma_0' action='man_alamce.php'>";
						echo "  </form> </td></tr>  ";						  
						$estilo="ctablablanc";
						$estilo="ctablagris";
						/*$sql="SELECT  fec_aud, nom_tab_aud, nom_usu AS usuario ,CASE transaccion WHEN 1 THEN \"INSERCION\"  WHEN 2 THEN \"EDICION\" 	WHEN 3 THEN \"ELIMINACION\" END   AS transaccion  FROM auditoria INNER JOIN usuario ON auditoria.cod_usu_aud=usuario.cod_usu   ORDER BY fec_aud DESC $paginar";*/
						$db->query($sql);  #consulta paginada
						while($db->next_row()) {
							if ($aux==0) { $estilo="ctablablanc"; $aux=1; $cambio_celda=$celda_blanca; }else { $estilo="ctablagris";  $cambio_celda=$celda_gris; $aux=0;}
							$nom_usuario = letra_capital($db->usuario);
							$transaccion = letra_capital($db->transaccion);
							$usuario=letra_capital($db->usuario);
							echo "<tr class='$estilo' $cambio_celda> <form name='forma_$db->cod_ter' action='man_tercero.php'>  ";
                          	echo "<td >$db->fec_aud </td>";
							echo "<td >$usuario</td>";
							echo "<td >$db->nom_interfaz</td>";
							echo "<td >$transaccion</td>";
                          	echo "  </tr>";
						
						} ?>
                    
                        
                      </table ></td>
                    </tr>
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="624" height="4" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="bottom"><table>
                        <tr>
                          <td> <span class="ctablaform" > <?  if ($cant_pag>0) echo "Pagina ".$act_pag." de ".$cant_pag ; else echo "No hay Resultados"  ?> </span>
                            <img src="imagenes/primero.png" alt="Inicio" width="16" height="16" id="primero" style="cursor:pointer; display:inline"  onClick="cambio(1)"/> <img src="imagenes/regresar.png" alt="Anterior" width="16" height="16" id="regresar" style="cursor:pointer; display:inline" onClick="cambio(2)"/> <img src="imagenes/siguiente.png" alt="Siguiente" width="16" height="16"  id="siguiente" style="cursor:pointer; display:inline" onClick="cambio(3)"/> <img src="imagenes/ultimo.png" alt="Ultimo" width="16" height="16" id="ultimo" style="cursor:pointer; display:inline" onClick="cambio(4)"/> </td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
      </form>
</td>
</tr>
</table>						
<form name="forma" method="post" action="con_auditoria.php">
  <input type="hidden" name="editar" id="editar" value="<?=$editar?>">
  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
  <input type="hidden" name="cant_pag"  id="cant_pag" value="<?=$cant_pag?>">
  <input type="hidden" name="act_pag"  id="act_pag" value="<? if(!empty($act_pag)) echo $act_pag; else echo $pagina;?>">
  <input type="hidden" name="busquedas" id="busquedas" value="<?=$busquedas?>">
  <input type="hidden" name="eliminacion" id="eliminacion" >
  <input type="hidden" name="eli_codigo" id="eli_codigo" >
</form>
</body>
</html>
