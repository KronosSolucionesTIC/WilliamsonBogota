<? include("lib/database.php")?>
<? include("js/funciones.php")?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="calendario/javascript/calendar.js"></script>
<script type="text/javascript" src="calendario/javascript/calendar-es.js"></script>
<script type="text/javascript" src="calendario/javascript/calendar-setup.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="calendario/styles/calendar-win2k-cold-1.css" title="win2k-cold-1" />  <script src="utilidades.js" type="text/javascript"> </script>
<title><?=$nombre_aplicacion?></title>
<script type="text/javascript">
var tWorkPath="menus/data.files/";
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function abrir() {		
	cod_estado= document.getElementById('estado').value;	
	imprimir_inf("inf_estado_equipos.php",'0&cod_estado='+cod_estado,'mediano');
}

</script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="informes/inf.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css">
 <style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
 </style>
</head>
<body  <?=$sis?> >

<table align="center">
<tr>
<td valign="top" >
<form id="forma_total" name="forma_total" method="post" action="formatos/ver_traza.php">
                  <table width="624" border="0" cellspacing="0" cellpadding="0" align="center" >
                    
                    <tr>
                      <td bgcolor="#999999"><div align="center" class="Estilo1">INFORME  EQUIPOS ORTOPEDICOS </div></td>
                    </tr>
                    <tr>
                      <td>
					  <table width="524" border="0"  cellpadding="0" align="center">
                        <tr>
						  <td colspan="2"  class="ctablasup" >OPCION POR ESTADO </td>
						  <td  class="ctablasup"  width="164">INFORME</td>
                        </tr>
					
							 
							      <tr>  <td width="60" class="textotabla01" >Estado:</td>
							          <td width="292" ><? combo_evento("estado","estado_arrend_equipo","cod_est_arrend_equipo","desc_est_arrend_equipo","","", "desc_est_arrend_equipo"); ?></td>
							          <td aling='center' >
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>  <td align='center'> <input type='hidden' name='codigo'></td>
                         
							<td align='center'><img src='imagenes/mirar.png' width='16' height='16'  style="cursor:pointer"  onclick="abrir()" /></td>
                            </tr> </table>  </td>
                      </table ></td>
                    </tr>
                    
                    <tr>
                      <td><img src="imagenes/lineasup2.gif" width="624" height="4" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="bottom"><table>
                        <tr>
                          <td> <span class="ctablaform" >  </span>
                           <!-- <img src="imagenes/primero.png" alt="Inicio" width="16" height="16" id="primero" style="cursor:pointer; display:inline"  onClick="cambio(1)"/> <img src="imagenes/regresar.png" alt="Anterior" width="16" height="16" id="regresar" style="cursor:pointer; display:inline" onClick="cambio(2)"/>--> <!--<img src="imagenes/siguiente.png" alt="Siguiente" width="16" height="16"  id="siguiente" style="cursor:pointer; display:inline" onClick="cambio(3)"/>--> <!--<img src="imagenes/ultimo.png" alt="Ultimo" width="16" height="16" id="ultimo" style="cursor:pointer; display:inline" onClick="cambio(4)"/>--> </td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
      </form>
</td>
</tr>
</table>	
				
<form name="forma" method="post" action="con_traza_general.php">
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



