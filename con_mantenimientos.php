<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? 

if($eliminacion==1) {//confirmacion de eliminacio 
	$error=eliminar("mantenimientos",$eli_codigo,"cod_mantenimientos");
	if ($error >=1)
	echo "<script language='javascript'> alert('Se Elimino el registro Correctamente..') </script>" ;
	
}

if($confirmacion==1) //confirmacion de insercion 
	echo "<script language='javascript'> alert('Se Inserto el registro Correctamente..') </script>" ;

if($confirmacion==2) //confirmacion de edicion
	echo "<script language='javascript'> alert('Se Edito el registro Correctamente..') </script>" ;


	
if(!empty($busquedas)) { #codigo para buscar 
	$busquedas=reemplazar_1($busquedas);
	$where=" where $busquedas ";
}#codigo para buscar 

$sql="SELECT * FROM `mantenimientos`

INNER JOIN equipos ON (equipos.cod_equipo = mantenimientos.equipo_mantenimientos)
INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo)
INNER JOIN estado_arrend_equipo ON (estado_arrend_equipo.cod_est_arrend_equipo  = equipos.estado_arrend_equipo )

$where

ORDER BY fecha_mantenimientos DESC";

$cantidad_paginas=paginar($sql);
$cant_pag=ceil($cantidad_paginas/$cant_reg_pag);
if(!empty($act_pag)) 
	$inicio=($act_pag -1)*$cant_reg_pag  ;
else { 
	$inicio =0;
	$act_pag=1;
	}
$paginar=" limit  $inicio, $cant_reg_pag";
$sql.=$paginar;
$busquedas=reemplazar($busquedas);
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

function abrir(dato){

var url="formatos/formato_mantenimientos.php?codigo="+dato;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")

}
</script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body  <?=$sis?> onLoad="cambio_1(<?=$cant_pag?>,<?=$act_pag?>);">

<table align="center">
<tr>
<td valign="top" >
<form id="forma_total" name="forma_total" method="post" action="man_mantenimientos.php">
                  <table width="624" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td bgcolor="#E9E9E9"><table width="624" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="8" height="33"> </td>
                          <td width="17"> 
						  <? if ($insertar==1) {?>
					  	  <img src="imagenes/page.png" width="16" height="16"  alt="Nuevo Registro" style="cursor:pointer" onClick="location.href='con_mantenimientos2.php?codigo=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>'"/>
					  	  <? } ?></td>
                          <td width="133"><span class="ctablaform">
                            <? if ($insertar==1) {?>
								Agregar
							<? } ?>
                          </span></td>
                          <td width="50" class="ctablaform">Buscar: </td>
                          <td width="103" class="ctablaform"><input name="text" type="text" class="textfield" size="12" id="texto" /></td>
                          <td width="20"><label> <span class="ctablaform">en</span></label></td>
                          <td width="160" class="ctablaform"><select name="campos" class="textfieldlista" id="campos" >
                            <option value="0">Seleccion</option>
                            <option value="consecutivo_equipo">Plano</option>
							<option value="fecha_mantenimientos">Fecha</option>
							<option value="desc_estado_mant">Estado</option>
                            <option value="-1">Lista Completa</option>
                          </select></td>
                          <td width="41" valign="middle"><img src="imagenes/ver.png" alt="Buscar" width="16" height="16" style="cursor:pointer"  onClick="buscar()"/></td>
                        
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="843" border="0"  cellpadding="0">
                        <tr>
                          <td width="129"  class="ctablasup">CONSECUTIVO</td>
                          <td width="217"  class="ctablasup">EQUIPO</td>
						  <td width="217"  class="ctablasup">FECHA MANTENIMIENTO </td>
						  <td width="139"  class="ctablasup">ESTADO</td>
						  <td  class="ctablasup"  width="129">OPCIONES</td>
                        </tr>
						<? 
						
						echo "<tr style='display:none'><td ><form name='forma_0' action='man_cargo.php'>";
						echo "  </form> </td></tr>  ";						  
						$estilo="ctablablanc";
						$estilo="ctablagris";
						
						//echo $sql;
						$db->query($sql);  #consulta paginada
						while($db->next_row()) {
							if ($aux==0) { $estilo="ctablablanc"; $aux=1; $cambio_celda=$celda_blanca; }else { $estilo="ctablagris";  $cambio_celda=$celda_gris; $aux=0;}
							echo "<tr class='$estilo' $cambio_celda> <form name='forma_$db->cod_mantenimientos' action='man_mantenimientos.php'>  ";
							echo "<td><div align='center'>$db->consecutivo_equipo</div></td>";
							if ($db->clase_equipo == 5) {
							echo "<td><div align='center'>$db->nom_clase - $db->nom_equipo - $db->desc_tipo_equipos</div></td>";
							}
							else {
							echo "<td><div align='center'>$db->nom_clase - $db->desc_tipo_equipos</div></td>";
							}
							echo "<td><div align='center'>$db->fecha_mantenimientos</div></td>";
							echo "<td><div align='center'>$db->desc_est_arrend_equipo</div></td>";
							echo "<td aling='center' >"; 
							
							echo 	"<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
                            echo 	" <tr>  <td align='center'> <input type='hidden' name='codigo' value='$db->cod_mantenimientos'>";
							if ($editar==1)
							 	echo "<img src='imagenes/icoeditar.gif' alt='Editar Registro' width='16' height='16' style='cursor:pointer'  onclick='document.forma_$db->cod_mantenimientos.submit()'/></td>";
							else 
								echo "<img src='imagenes/e_icoeditar.gif' width='16' height='16'  /></td>";
                            echo 	"<td align='center'>";
							echo "<td align='center'><img src='imagenes/mirar.png' width='16' height='16'  style=\"cursor:pointer\"  onclick=\"abrir($db->cod_mantenimientos,'$tipo')\" /></td>";
                            echo "  </tr> </table>  </td>  ";
							echo "<input type='hidden' name='editar' value=".$editar."> <input type='hidden' name='insertar' value=".$insertar."> <input type='hidden' name='eliminar' value=".$eliminar.">";
							
							echo "  </form></tr>  ";
						
						} ?>
                    
                        
                      </table ></td>
                    </tr>
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="842" height="5" /></td>
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
<form name="forma" method="post" action="con_mantenimientos.php">
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
