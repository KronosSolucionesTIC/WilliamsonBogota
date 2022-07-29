<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? 

if($eliminacion==1) {//confirmacion de eliminacio 
	$error=eliminar("cliente",$eli_codigo,"cod_cli");

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

 $sql="SELECT * FROM cliente 
 INNER JOIN tipo_persona ON(tipo_persona.cod_tipo_persona = cliente.tipo_persona)
 $where order by nom1_cli";

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


function abrir(dato,tipo_cliente){
if(tipo_cliente=='1')
{
var url="formatos/formato_pnatural_arrend.php?codigo="+dato;
window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
} 

else { 
     if(tipo_cliente=='2')
	  {
        var url="formatos/formato_pjuridica_arrend.php?codigo="+dato;
        window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
	  }
	  
	  }
}



</script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body  <?=$sis?> onLoad="cambio_1(<?=$cant_pag?>,<?=$act_pag?>);">

<table align="center">
<tr>
<td width="666" valign="top" >
<form id="forma_total" name="forma_total" method="post" action="man_cliente_arrend.php">
                  <table width="666" border="0" cellspacing="0" cellpadding="0" align="center" >
                    <tr>
                      <td width="666" bgcolor="#E9E9E9"><table width="659" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="9" height="33"> </td>
                          <td width="19"> 
						  <? if ($insertar==1) {?>
					  	  <img src="imagenes/page.png" width="16" height="16"  alt="Nuevo Registro" style="cursor:pointer" onClick="location.href='con_cliente_arrends.php?codigo=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>'"/>
					  	  <? } ?></td>
                          <td width="156"><span class="ctablaform">
                            <? if ($insertar==1) {?>
								Agregar
							    <? } ?>
                          </span></td>
                          <td width="58" class="ctablaform">Buscar: </td>
                          <td width="120" class="ctablaform"><input name="text" type="text" class="textfield" size="12" id="texto" /></td>
                          <td width="23"><label> <span class="ctablaform">en</span></label></td>
                          <td width="187" class="ctablaform"><select name="campos" class="textfieldlista" id="campos" >
                            <option value="0">Seleccion</option>
                            <option value="nom1_cli">Nombre</option>
							<option value="cedula_cli">Cedula</option>
                            <option value="direccion_cli">Direccion</option>
							<option value="telefono_cli">Telefono</option>
							<option value="celular_cli">Celular</option>
                            <option value="-1">Lista Completa</option>
                          </select></td>
                          <td width="87" valign="middle"><img src="imagenes/ver.png" alt="Buscar" width="16" height="16" style="cursor:pointer"  onClick="buscar()"/></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="665" border="0"  cellpadding="0">
                        <tr>
						  <td width="100"  class="ctablasup">NOMBRE </td>
						  <td width="90"  class="ctablasup">CEDULA</td>
						  <td width="119"  class="ctablasup">DIRECCION</td>
						  <td width="115"  class="ctablasup">TELEFONO</td>
						   <td width="65"  class="ctablasup">CELULAR</td>
                           <td width="65"  class="ctablasup">PERSONA</td>
                          <td  class="ctablasup"  width="95">OPCIONES</td>
                        </tr>
						<? 
						
						echo "<tr style='display:none'><td ><form name='forma_0' action='man_cliente_arrend.php'>";
						echo "  </form> </td></tr>  ";						  
						$estilo="ctablablanc";
						$estilo="ctablagris";
						
						//echo $sql;
						$db->query($sql);  #consulta paginada
						while($db->next_row()) {
							if ($aux==0) { $estilo="ctablablanc"; $aux=1; $cambio_celda=$celda_blanca; }else { $estilo="ctablagris";  $cambio_celda=$celda_gris; $aux=0;}
							echo "<tr class='$estilo' $cambio_celda> <form name='forma_$db->cod_cli' action='man_cliente_arrend.php'>  ";
							
							echo "<td >$db->nom1_cli $db->nom2_cli $db->apel1_cli $db->apel2_cli</td>";
							if ($db->tipo_persona == 1 ) { 
							$cedula = convertir_cedula($db->cedula_cli);
							echo "<td >$cedula</td>";
							} else { 
							$cedula = convertir_nit($db->cedula_cli);
							echo "<td >$cedula</td>";							
							}
							$tipo_cliente = $db->tipo_persona;
							
							echo "<td >$db->direccion_cli</td>";
							echo "<td >$db->telefono_cli</td>";
							echo "<td >$db->celular_cli</td>";
							echo "<td >$db->desc_tipo_persona</td>";
							
                            echo "<td aling='center' >"; 
							
							echo 	"<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
                            echo 	" <tr>  <td align='center'> <input type='hidden' name='codigo' value='$db->cod_cli'>";
							if ($editar==1)
							 	echo "<img src='imagenes/icoeditar.gif' alt='Editar Registro' width='16' height='16' style='cursor:pointer'  onclick='document.forma_$db->cod_cli.submit()'/></td>";
							else 
								echo "<img src='imagenes/e_icoeditar.gif' width='16' height='16'  /></td>";
                            echo 	"<td align='center'>";
							echo "  </tr> </table>  </td>  ";
							echo "<input type='hidden' name='editar' value=".$editar."> <input type='hidden' name='insertar' value=".$insertar."> <input type='hidden' name='eliminar' value=".$eliminar.">";
							echo "  </form></tr>  ";
						
						} ?>
                    
                        
                      </table ></td>
                    </tr>
                    
                    <tr>
                      <td height="6"><img src="imagenes/lineasup2.gif" width="662" height="3" /></td>
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
<form name="forma" method="post" action="con_cliente_arrend.php">
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

