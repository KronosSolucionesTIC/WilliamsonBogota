<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<? 
if($enviar==1)
{
$db1= new  Database();
$sql="DELETE FROM permisos WHERE cod_usu_per=".$codigo;
$db1->query($sql);  
$db1->close();
//$sql="";
$db1= new  Database();
$db2= new  Database();
$sql="SELECT  cod_int  from interfaz ";
$db1->query($sql);  
while($db1->next_row()) {
	for ($a=1; $a<5; $a++) {
		if ( $_POST["check_".$db1->cod_int."_$a"]=="checkbox") 
			$valor[$a]=1;
		else 
			$valor[$a]=0;
	}
	
	$sql="INSERT INTO permisos (cod_usu_per, cod_int_per, con_per, ins_per,edi_per, eli_per)  VALUES($codigo,$db1->cod_int,$valor[1],$valor[2],$valor[3], $valor[4])";
	$db2->query($sql);  
	//$db2->close();
}
$db1->close();

$e=1;
if($e==1) {
	/*echo "<script language='javascript'> alert('Se Edito el registro Correctamente..') </script>" ;*/
	header("Location: con_permisos.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	
}
}

?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript">
var tWorkPath="menus/data.files/";
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value + "'");
  if (restore) selObj.selectedIndex=0;
}

function  guardar() {
	document.getElementById('enviar').value=1
	document.forma_total.submit()
}
</script>
<script type="text/javascript" src="js/funciones.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body  <?=$sis?> >

<table align="center" width="98%">
<tr>
<td width=""="100%" valign="top" >
<form id="forma_total" name="forma_total" method="post" action="man_permisos.php">                 
                  <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" >
                    
                    <tr>
                      <td bgcolor="#E9E9E9"><table width="100%" border="0"  cellpadding="0">
                        <tr>
                          <td colspan="6"  ><table width="100%" height="19" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td width="5" height="19">&nbsp;</td>
        <td width="20" ><img src="imagenes/icoguardar.png" alt="Nuevo Registro" width="16" height="16" border="0"  onclick="guardar()" style="cursor:pointer"/></td>
        <td width="61" class="ctablaform">Guardar</td>
        <td width="21" class="ctablaform"><a href="con_permisos.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_permisos.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
                        </tr>
                        <tr> 
						  <td  class="ctablasup">MODULO  	</td>
						  <td  class="ctablasup">INTERFAZ </td>
						  <td  class="ctablasup">CONSULTA </td> 
						  <td  class="ctablasup">INSERCION </td> 
						  <td  class="ctablasup">EDICION </td> 
						  <td  class="ctablasup">ELIMINACION </td> 
                        </tr>
						<tr> 
						  <td  class="ctablasup">&nbsp;</td>
						  <td  class="ctablasup"></td>
						  <td  class="ctablasup">
						                         <input type="button" class='botones' name="a" value="Marcar"  id="btn_con" onClick="checks('btn_con','consul_')" /></td> 
						  <td  class="ctablasup"><input type="button" class='botones' name="b" value="Marcar"  id="btn_ins" onClick="checks('btn_ins','enserc_')" /></td> 
						  <td  class="ctablasup"><input type="button" class='botones' name="c" value="Marcar"  id="btn_edi" onClick="checks('btn_edi','edicio_')" /></td> 
						  <td  class="ctablasup"><input type="button" class='botones' name="d" value="Marcar"  id="btn_eli" onClick="checks('btn_eli','elimin_')" /></td> 
                        </tr>	
						<? 
						
						echo "<tr style='display:none'><td >";
						echo "   </td></tr>  ";						  
						$estilo="ctablablanc";
						$estilo="ctablagris"; $ult_id = 0;
						$sql="SELECT nom_mod ,  cod_int, nom_int FROM interfaz INNER JOIN modulos ON  modulos.cod_mod=interfaz.cod_mod_int ORDER BY cod_mod , nom_int ";
						$db->query($sql);  #consulta paginada
						
						$db1= new  Database();
						$sql="SELECT cod_int_per,con_per, edi_per, ins_per,eli_per ,nom_int ,cod_mod FROM permisos INNER JOIN interfaz ON interfaz.cod_int=permisos.cod_int_per
								INNER JOIN modulos ON modulos.cod_mod=interfaz.cod_mod_int WHERE cod_usu_per=".$codigo." ORDER BY cod_mod , nom_int ";
						$db1->query($sql);  
						$hh=1;
						while($db->next_row()) {
							$db1->next_row();
							if ($aux==0) { $estilo="ctablablanc"; $aux=1; $cambio_celda=$celda_blanca; }else { $estilo="ctablagris";  $cambio_celda=$celda_gris; $aux=0;}
							echo "<tr class='$estilo' $cambio_celda >";
                          	echo "<td >$db->nom_mod</td>";
							echo "<td >$db->nom_int </td> \n";
							/*echo "<td  align='center'> <input type='checkbox' id='consul_".$db->cod_int."' name='check_".$db->cod_int."_1' value='checkbox'"; if($db->cod_int==$db1->cod_int_per & $db1->con_per==1 ) echo "  checked='checked'"; echo "></td>"."\n";*/
							
							echo "<td  align='center'> <input type='checkbox' id='consul_".$hh."' name='check_".$db->cod_int."_1' value='checkbox'"; if($db->cod_int==$db1->cod_int_per & $db1->con_per==1 ) echo "  checked='checked'"; echo "></td>"."\n";
							echo "<td  align='center'> <input type='checkbox' id='enserc_".$hh."' name='check_".$db->cod_int."_2' value='checkbox'"; if($db->cod_int==$db1->cod_int_per & $db1->ins_per==1 ) echo "  checked='checked'"; echo "></td>"."\n";
							echo "<td  align='center'> <input type='checkbox' id='edicio_".$hh."' name='check_".$db->cod_int."_3' value='checkbox'"; if($db->cod_int==$db1->cod_int_per & $db1->edi_per==1 ) echo "  checked='checked'"; echo "></td>"."\n";
							echo "<td  align='center'> <input type='checkbox' id='elimin_".$hh."' name='check_".$db->cod_int."_4' value='checkbox'"; if($db->cod_int==$db1->cod_int_per & $db1->eli_per==1 ) echo "  checked='checked'"; echo "></td>"."\n";
                          	echo "  </tr> ";
							if($ult_id < $db->cod_int) $ult_id = $db->cod_int;
						
						$hh++;
						} ?>
				
			
                        <? 
						
						//checked="checked"
							/*for($i=1;$i<=$ult_id;$i++){
								if($_POST["check_".$i."_1"] != NULL)
									echo $_POST["check_".$i."_1"];
							}*/
						 ?>
						
                      </table ></td>
                    </tr>
                    <tr>
                      <td  align="center"> 
                        <input type="hidden" name="textfield" id="cantidad_checks" value="<?=$ult_id?>">
                      
                        <input type="hidden" name="codigo" value="<?=$codigo?>">
                        <input type="hidden" name="enviar" id="enviar" > <input type='button'  class='botones' value='Guardar Permisos' onClick='guardar()'>
                   	  <img src="imagenes/lineasup2.gif" width="100%" height="4" /></td>
                    </tr>
                    <tr>
                      <td height="6" align="center" valign="bottom"><table>
                        <tr>
                          <td>  </td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
				 
      </form>
</td>
</tr>
</table>						
</body>
</html>