<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?
if ($codigo!=0) {

	$sqle="SELECT * FROM equipos
	where cod_equipo = $codigo";
	$dbe= new  Database();
	$dbe->query($sqle);
	$dbe->next_row();
	$clase_equipo = $dbe->clase_equipo;
	
	$sqlg="SELECT * FROM garantias
	where cod_equipo_garantia = $codigo";
	$dbg= new  Database();
	$dbg->query($sqlg);
	$dbg->next_row();
	
	$sqlm ="SELECT * FROM garantia_motor
	WHERE cod_equipo = $codigo";
	$dbm= new  Database();
	$dbm->query($sqlm);
	$dbm->next_row();
	
}

else {

$sql ="SELECT cod_equipo FROM equipos ORDER BY cod_equipo DESC";
$dbhz= new  Database();
$dbhz->query($sql);
$dbhz->next_row();
$cons_equipo = $dbhz->cod_equipo + 1;

$sqlt ="SELECT cod_garantia FROM garantias ORDER BY cod_garantia DESC";
$dbt= new  Database();
$dbt->query($sqlt);
$dbt->next_row();
$cons_garantia = $dbt->cod_garantia + 1;

}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 


	if($logo != NULL)
	{ 
		$file_imagen = renombrar_archivo($logo_name);
		copy("$logo","img_usu/$file_imagen");
	}
	
	if($logo2 != NULL)
	{ 
		$file_imagen2 = renombrar_archivo($logo2_name);
		copy("$logo2","img_usu/$file_imagen2");
	}
	
$sql ="SELECT * FROM consecutivo WHERE cod_clase_equipo = $clase";
			$dbda= new  Database();
			$dbda->query($sql);
			$dbda->next_row(); 
			
				$letra=$dbda->letra_cons;
				$num=$dbda->codigo_actual_cons+1;
				if($num > 9) {
				$cadena = "00";
				}
				else {
				$cadena = "000";
				}
				$consecutivo_equipo= $letra.$cadena.$num;
				
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.INGRESO EN EQUIPOS
		$compos="(nom_equipo,tamano_equipo,estado_arrend_equipo,tipo_equipo,clase_equipo,desc_equipo,fecha_ingreso,canon_arrend_equipo,garantia_equipo,consecutivo_equipo,valor_deposito,img_equipo,img_equipo2)";
		$valores="('".$nombre_equipo."','".$tamano."','2','".$tipo."','".$clase."','".$descripcion."','".date("Y-m-d")."','".$canon."','".$cons_garantia."','".$consecutivo_equipo."','".$valor_deposito."','".$file_imagen."','".$file_imagen2."')" ;
		$error=insertar("equipos",$compos,$valores);
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1.1 MODIFICACION DEL CONSECUTIVO DEL EQUIPO		
		$campos="codigo_actual_cons='".$num."'";
		$error=editar("consecutivo",$campos,'cod_clase_equipo',$clase); 
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 2.INGRESO EN LISTADO PARTES
		$campos="(cod_equipo_parte,cod_parte,cod_tipo_parte,cod_caracteristica,valor_propiedad,cod_funcion)";
		 for ($ii=1 ;  $ii <= $val_inicial_item_contac + 1 ; $ii++) 
		{  		
			if($_POST["cod_partes_".$ii]!=NULL) 
			{
				$valores="('".$cons_equipo."','".$_POST["cod_partes_".$ii]."','".$_POST["cod_tipo_parte_".$ii]."','".$_POST["cod_caracteristica_".$ii]."','".$_POST["cod_propiedad_".$ii]."','".$_POST["cod_funcion_".$ii]."')";
			$error=insertar("listado_partes",$campos,$valores); 				
			}	
		
		}
		
			if ($error==1) {
				header("Location: con_equipos_arrien.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else {
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
                      
        }
		
			if ($error==1) {
				header("Location: con_equipos_arrien.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else {
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
                      
        }
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3.INGRESO EN GARANTIA
		$compos="(cod_equipo_garantia,fecha_ini_garantia,fecha_fin_garantia,cant_garantia,unid_garantia)";
		$valores="('".$cons_equipo."','".$fecha_compra."','".$fecha_fin_garantia."','".$meses."','6')" ;
		$error=insertar("garantias",$compos,$valores);
		
		// RUTINA PARA  INSERTAR REGISTROS NUEVOS 3.1 INGRESO EN GARANTIA MOTOR
		if ($clase == 2 ) {
		$compos="(marca_motor,numero_motor,fecha_motor,cod_equipo)";
		$valores="('".$marca_motor."','".$numero_motor."','".$fecha_motor."','".$cons_equipo."')" ;
		$error=insertar("garantia_motor",$compos,$valores);
		}
		
		if ($error==1) {
				header("Location: con_equipos_arrien.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
							}
			else
				echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
                      
        }

if($guardar==1 and $codigo!=0) { // RUTINA PARA  EDITAR REGISTROS 
$codigo_usuario=$_SESSION["global"][2];

	if($logo != NULL)
	{ 
		$file_imagen = renombrar_archivo($logo_name);
		copy("$logo","img_usu/$file_imagen");
		$compos="img_equipo='".$file_imagen."'";
		$error=editar("equipos",$compos,'cod_equipo',$codigo); 
	}
	
	if($logo2 != NULL)
	{ 
		$file_imagen2 = renombrar_archivo($logo2_name);
		copy("$logo2","img_usu/$file_imagen2");
		$compos="img_equipo2='".$file_imagen2."'";
		$error=editar("equipos",$compos,'cod_equipo',$codigo); 
	}
	// RUTINA PARA EDITAR REGISTROS 1.INGRESO EN EQUIPOS
	$compos="nom_equipo='".$nombre_equipo."',tamano_equipo='".$tamano."',tipo_equipo='".$tipo."',clase_equipo='".$clase."',desc_equipo='".$descripcion."', fecha_ingreso='".date("Y-m-d")."',canon_arrend_equipo='".$canon."',valor_deposito='".$valor_deposito."',img_equipo='".$file_imagen."',img_equipo2='".$file_imagen2."'";	
	
	$error=editar("equipos",$compos,'cod_equipo',$codigo); 
	
		// RUTINA PARA EDITAR REGISTROS 2.INGRESO EN LISTADO PARTES
		for ($ii=1 ;  $ii <= $val_inicial_item_contac + 1 ; $ii++) 
		{  		
			if($_POST["seleccion_".$ii]!= 1) 
			{
			eliminar("listado_partes", $_POST["cod_list_".$ii], 'cod_list_partes'); 				
			}	
		
		}
		
		$campos="(cod_equipo_parte,cod_parte,cod_tipo_parte,cod_caracteristica,valor_propiedad,cod_funcion)";		
		 for ($ii=1 ;  $ii <= $val_inicial_item_contac + 1 ; $ii++) 
		{  		
			if($_POST["cod_partes_".$ii]!=NULL) 
			{
				$valores="('".$codigo."','".$_POST["cod_partes_".$ii]."','".$_POST["cod_tipo_parte_".$ii]."','".$_POST["cod_caracteristica_".$ii]."','".$_POST["cod_propiedad_".$ii]."','".$_POST["cod_funcion_".$ii]."')";
			$error=insertar("listado_partes",$campos,$valores); 				
			}	
		
		}
	
			// RUTINA PARA EDITAR REGISTROS 3.INGRESO EN GARANTIAS
			$compos="fecha_ini_garantia='".$fecha_compra."',fecha_fin_garantia='".$fecha_fin_garantia."',cant_garantia='".$meses."'";
			$error=editar("garantias",$compos,'cod_equipo_garantia',$codigo);
			
			// RUTINA PARA EDITAR REGISTROS 3.1 INGRESO EN GARANTIA MOTOR
			$compos="marca_motor='".$marca_motor."',numero_motor='".$numero_motor."',fecha_motor='".$fecha_motor."'";
			$error=editar("garantia_motor",$compos,'cod_equipo',$codigo);
						
			if ($error==1) {
				header("Location: con_equipos_arrien.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
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
			
function calcular_fecha(){
function sumap (meses, y, m, d){
					var fechap = new Date();
					fechap.setFullYear(y);
					fechap.setMonth(m-1);
					fechap.setDate(d);
					
					fechap.setMonth(fechap.getMonth()+meses);
					var dia = fechap.getDate();
					var mes = fechap.getMonth()+1;
					var ano = fechap.getFullYear();
					return (ano + "-" + mes + "-" + dia);
				}
				var fini = document.getElementById('fecha_compra').value;
				var tmeses = parseInt(document.getElementById('meses').value);			
				
				var y =  parseInt(fini.substr(0, 4));
				var m =  parseInt(fini.substr(5,2));
				var d =  parseInt(fini.substr(8, 9));
				var d = (d-1)
				var x = sumap(tmeses, y, m, d);
				document.getElementById('fecha_fin_garantia').value = x;
}


function datos_completos(){  
if (document.getElementById('clase').value ==0 || document.getElementById('canon').value =='' || document.getElementById('tipo').value ==0 ||   document.getElementById('tamano').value ==0 || document.getElementById('meses').value =='' || document.getElementById('fecha_compra').value =='' ){
    alert("Seleccione los campos obligatorios");
	return false;}
else {
	return true;}
}

function cambiar_seleccion (selec){
if (document.getElementById(selec).value == 0){
document.getElementById(selec).value = 1 ;
}
else {
document.getElementById(selec).value = 0 ;
}
}



function cargar_tipos(parte,tamano,tipo,nombre,clase) {
if (document.getElementById(clase).value == 5 ) {
 	document.getElementById(nombre).disabled = false ;
}
else {
	document.getElementById(nombre).disabled = true;
}

var combo=document.getElementById(tipo);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
		$i=0;
		$sqlt ="SELECT * FROM `tipo_equipos` ";		
		$dbt= new  Database();
		$dbt->query($sqlt);
		while($dbt->next_row()){ 
		echo "if(document.getElementById(clase).value==$dbt->clase_equipo || $dbt->clase_equipo == 0) {";	
		echo "combo.options[cant] = new Option('$dbt->desc_tipo_equipos','$dbt->cod_tipo_equipos'); ";	
		echo "cant++; } ";
		}
?>

var combo=document.getElementById(tamano);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
		$i=0;
		$sqlt ="SELECT * FROM `tamano_equipos` ";		
		$dbt= new  Database();
		$dbt->query($sqlt);
		while($dbt->next_row()){ 
		echo "if(document.getElementById(clase).value==$dbt->cod_clase_equipos || $dbt->cod_clase_equipos  == 0) {";	
		echo "combo.options[cant] = new Option('$dbt->desc_tam_equipos','$dbt->cod_tam_equipos'); ";	
		echo "cant++; } ";
		}
?>

var combo=document.getElementById(parte);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
		$i=0;
		$sqlp ="SELECT * FROM `partes` ";		
		$dbp= new  Database();
		$dbp->query($sqlp);
		while($dbp->next_row()){ 
		echo "if(document.getElementById(clase).value==$dbp->clase_parte) {";	
		echo "combo.options[cant] = new Option('$dbp->desc_partes','$dbp->cod_partes'); ";	
		echo "cant++; } ";
		}
?>

}

function cargar_tipo_parte(tipo_parte,parte) {
var combo=document.getElementById(tipo_parte);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;
<?
		$i=0;
		$sqltp ="SELECT * FROM `tipo_partes` ";		
		$dbtp= new  Database();
		$dbtp->query($sqltp);
		while($dbtp->next_row()){ 
		echo "if(document.getElementById(parte).value==$dbtp->cod_parte || $dbtp->cod_parte == 0) {";	
		echo "combo.options[cant] = new Option('$dbtp->desc_tipo_partes','$dbtp->cod_tipo_partes'); ";	
		echo "cant++; } ";
		}
?>

}

var i=1;
function agregar() 
{ 
if (document.getElementById('cod_partes').value == 0 || document.getElementById('cod_tipo_parte').value == 0 ){
    alert("Seleccione los items para agregar");
	return false;}
else {
<!--1. SE ALMACENAN EL CODIGO DE CADA CAMPO Y EL TEXTO TAMBIEN-->
var partes = document.getElementById('cod_partes').options[document.getElementById("cod_partes").selectedIndex].text;
var cod_partes = document.getElementById('cod_partes').value;
var tipo_parte = document.getElementById('cod_tipo_parte').options[document.getElementById("cod_tipo_parte").selectedIndex].text;
var cod_tipo_parte = document.getElementById('cod_tipo_parte').value;
<!--2. SE CAMBIA EL VALOR DEL CONTADOR-->
document.getElementById('val_inicial_item_contac').value = i

<!--3. SE CREA EL ITEM CON LOS VALORES SELECCIONADOS-->
var t=document.getElementById('trae').innerHTML; 
t=t.substring(0,(t.length-8)); 
t+="<tr><td id='fila_item_"+i+"'><input name='partes_"+i+"' type='text' size='12' id='partes_"+i+"' disabled='disabled' value='"+partes+"' /><input name='cod_partes_"+i+"' type='hidden' id='cod_partes_"+i+"' value='"+cod_partes+"' /></td><td><input name='tipo_parte_"+i+"' type='text' size='12' disabled='disabled' id='tipo_parte_"+i+"' value='"+tipo_parte+"' /><input name='cod_tipo_parte_"+i+"'  type='hidden' id='cod_tipo_parte_"+i+"' value='"+cod_tipo_parte+"' /></td><td align='center'><input name='button"+i+"' type='button'  class='botones' id='menos"+i+"'  onclick='borrar_item()' value='  -  ' /></td></tr>"; 
document.getElementById('trae').innerHTML=t;
i++; 
} 	
}

function borrar_item() 
{ 
var t=document.getElementById('trae').innerHTML; 
var j=t.lastIndexOf("<TBODY>"); 
if(j>-1){ 
t=t.substring(0,j);
t+="</TABLE>"; 
document.getElementById('trae').innerHTML=t; 
} 
}

function borrar_item2(contador,val_item) 
{ 
var val_item = document.getElementById(val_item).value; 
var t=document.getElementById('trae').innerHTML; 
var j=t.lastIndexOf("<TR id=fila_item_contac_"+contador+">"); 
if(j>-1){ 
t=t.substring(0,j);

if(contador != val_item )
{
var t2=document.getElementById('trae').innerHTML;
contador = parseInt(contador);
contador = (contador + 1);
var j2=t2.lastIndexOf("<TR id=fila_item_contac_"+contador+">"); 
t2=t2.substring(j2);
t+=t2;
}

t+="</TABLE>"; 
document.getElementById('trae').innerHTML=t;
val_item = (val_item - 1);
document.getElementById('val_inicial_item_contac').value = val_item ;
} 
}

</script>

<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_equipos_arrien.php"  method="post" enctype="multipart/form-data">
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
        <td width="21" class="ctablaform"><a href="con_equipos_arrien.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="65" class="ctablaform">Cancelar </td>
        <td width="22" class="ctablaform"><a href="con_equipos_arrien.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="70" class="ctablaform">Consultar</td>
        <td width="21" class="ctablaform"></td>
        <td width="60" class="ctablaform">&nbsp;</td>
        <td width="24" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="193" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo"   id="codigo"   value="<?=$codigo?>" />
        </label></td>
        <td width="67" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1"> EQUIPOS ORTOPEDICOS ARRIENDO:</td>
  </tr>
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top"><table width="486" border="0">
      <tr>
        <td colspan="4"><table width="629" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="8" class="botonforms"><div align="center">DATOS GENERALES EQUIPO </div></td>
          </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td width="179" colspan="2">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td width="239" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="109" class="textotabla1">Clase :</td>
            <td colspan="2"><? combo_evento("clase","clase_equipos","cod_clase","nom_clase",$dbe->clase_equipo,"onchange='cargar_tipos(\"cod_partes\",\"tamano\",\"tipo\",\"nombre_equipo\",\"clase\")'", "nom_clase")?>
                <span class="textorojo"> * </span></td>
            <td width="8">&nbsp;</td>
            <td width="94" class="textotabla1">Descripci&oacute;n:</td>
            <td colspan="2"><a href="#">
              <textarea name="descripcion" id="descripcion" cols="45" rows="4" class="textfield02"><?=$dbe->desc_equipo?>
              </textarea>
            </a></td>
          </tr>
          <tr>
            <td class="textotabla1">Nombre:</td>
            <td colspan="2"><input name="nombre_equipo" id="nombre_equipo" type="text" class="textfield2" value="<?=$dbe->nom_equipo?>" /></td>
            <td>&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td class="textotabla1">Tipo: </td>
            <td colspan="2"><? combo_evento("tipo","tipo_equipos","cod_tipo_equipos","desc_tipo_equipos",$dbe->tipo_equipo,"","desc_tipo_equipos"); ?>
              <span class="textorojo">*</span></td>
            <td>&nbsp;</td>
            <td class="textotabla1">Tama&ntilde;o:</td>
            <td colspan="2"><span class="textotabla1">
              <? combo_evento("tamano","tamano_equipos","cod_tam_equipos","desc_tam_equipos",$dbe->tamano_equipo,"","desc_tam_equipos"); ?>
              <span class="textorojo">*</span></span></td>
          </tr>
          <tr>
            <td class="textotabla1">Canon de arrendamiento:</td>
            <td colspan="2"><input name="canon" id="canon" type="text" class="textfield2" value="<?=$dbe->canon_arrend_equipo?>" />
              <span class="textorojo">* </span></td>
            <td>&nbsp;</td>
            <td class="textotabla1">Valor deposito: </td>
            <td colspan="2"><input name="valor_deposito" id="valor_deposito" type="text" class="textfield2" value="<?=$dbe->valor_deposito?>" /></td>
          </tr>
          <tr>
            <td class="textotabla1">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
		   <tr>
		     <td class="textotabla1">Imagen 1:</td>
		     <td colspan="2"><input type="file" name="logo" class='botones'/>
		       </td>
		     <td>&nbsp;</td>
		     <td class="textotabla1"><? if($dbe->img_equipo != NULL) {?> <img src="img_usu/<?=$dbe->img_equipo?>" alt="Imagen" width="150" height="50" border="0" /><? } ?></td>
		     <td colspan="2">&nbsp;</td>
		     </tr>
		   <tr>

		     <td class="textotabla1">Imagen 2:</td>
		     <td colspan="2"><input type="file" name="logo2" class='botones'/>
              </td>
            <td>&nbsp;</td>
            <td class="textotabla1"><? if($dbe->img_equipo2 != NULL) {?> <img src="img_usu/<?=$dbe->img_equipo2?>" alt="Imagen" width="150" height="50" border="0" /><? } ?></td>
            <td colspan="2">&nbsp;</td>
		   </tr>
        </table></td>
      </tr>
         
          <tr>
            <td colspan="4" class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="textotabla1"><div id="trae">
              <table  width="100%" border="1">
                <tr >
                  <td width="35%"  class="ctablasup">Parte: </td>
                  <td width="40%"  class="ctablasup">Tipo parte: </td>
                  <td width="25%"    class="ctablasup">Agregar:</td>
                </tr>
                <tr >
                  <td ><div align="center">
                    <? combo_evento("cod_partes","partes","cod_partes","desc_partes",$dbdatos->cod_parte,"onChange = 'cargar_tipo_parte(\"cod_tipo_parte\",\"cod_partes\")'","desc_partes"); ?>
                  </div></td>
                  <td ><div align="center">
                    <? combo_evento("cod_tipo_parte","tipo_partes","cod_tipo_partes","desc_tipo_partes",$dbdatos->cod_tipo_parte,"","desc_tipo_partes"); ?>
                  </div></td>
                  <td align="center"><input name="button" type='button'  class='botones' id="mas"  onclick="agregar();" value='  +  ' /></td>
                </tr>
                <?
				if ($codigo!="") { // BUSCAR DATOS
				$sql_1 ="SELECT * FROM listado_partes
						INNER JOIN partes ON (partes.cod_partes=listado_partes.cod_parte)
						INNER JOIN tipo_partes ON (tipo_partes.cod_tipo_partes=listado_partes.cod_tipo_parte)
						where cod_equipo_parte  = $codigo";	
					$dbdatos_1= new  Database();
					$dbdatos_1->query($sql_1);
					$jj=1;
					while($dbdatos_1->next_row()){ 
						echo "<tr id='fila_item_contac_$jj'>";

//PARTE
						echo "<td><INPUT type='hidden' name='cod_list_$jj' id='cod_list_$jj' value='$dbdatos_1->cod_list_partes'><INPUT type='text' disabled='disabled' name='partes_edi_$jj' id='partes_edi_$jj' size='12' value='$dbdatos_1->desc_partes'></td>";

//TIPO PARTE
						echo "<td><INPUT type='text'  disabled='disabled' name='tipo_parte_$jj' id='tipo_parte_$jj' size='12' value='$dbdatos_1->desc_tipo_partes'></td>";
						
//BOTON SELECCIONAR				
						echo "<td  align='center'><input name='seleccion' type='checkbox' id='seleccion' value='' onclick='cambiar_seleccion(\"seleccion_$jj\");' /><input name='seleccion_$jj' type='hidden' id='seleccion_$jj' value='0' /></td>";
						
						echo "</tr>";
						
						$jj++;
						
					}
				}
				?>
              </table>
            </div></td>
          </tr>
          <tr>
            <td colspan="4" class="textotabla1"><input type="hidden" name="val_inicial_item_contac" id="val_inicial_item_contac" value="<? if($codigo!=0) echo $jj-1; else echo "0"; ?>" /></td>
          </tr>
          <tr>
            <td colspan="2" class="textotabla1"><strong>GARANTIA</strong></td>
            <td colspan="2" class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td width="58" class="textotabla1">Referencia</td>
            <td width="125" class="textotabla1"><?=$dbe->consecutivo_equipo?></td>
            <td width="43" class="textotabla1">Tiempo:</td>
            <td width="125" class="textotabla1"><input name="meses" type="text" class="textfield2" id="meses"  onkeypress="return validaInt_1()"value="<?=$dbg->cant_garantia?>"/>
            meses</td>
          </tr>
          <tr>
            <td class="textotabla1">Fecha compra:</td>
            <td class="textotabla1"><input name="fecha_compra" type="text" class="textfield2" id="fecha_compra" value="<?=$dbg->fecha_ini_garantia?>" />
            <img src="imagenes/date.png" alt="Calendario" name="calendario" width="18" height="18" id="calendario" style="cursor:pointer"/> <span class="textorojo">* </span></td>
            <td class="textotabla1">Fecha fin:</td>
            <td class="textotabla1"><input name="fecha_fin_garantia" class="textfield2" id="fecha_fin_garantia" value="<?=$dbg->fecha_fin_garantia?>" /></td>
          </tr>
          <tr>
            <td colspan="4" class="textotabla1"><strong>MOTOR</strong></td>
          </tr>
          <tr>
            <td class="textotabla1">Marca:</td>
            <td class="textotabla1"><input name="marca_motor" id="marca_motor" type="text" class="textfield2" value="<?=$dbm->marca_motor?>" /></td>
            <td class="textotabla1">Numero:</td>
            <td class="textotabla1"><input name="numero_motor" type="text" class="textfield2" id="numero_motor"  onkeypress="return validaInt_1()"value="<?=$dbm->numero_motor?>"/></td>
          </tr>
          <tr>
            <td class="textotabla1">Fecha:</td>
            <td class="textotabla1"><input name="fecha_motor" type="text" class="textfield2" id="fecha_motor" onchange="calcular_fecha()" onkeypress="calcular_fecha()" readonly="readonly" value="<?=$dbm->fecha_motor?>" />
            <img src="imagenes/date.png" alt="Calendario" name="calendario2" width="18" height="18" id="calendario2" style="cursor:pointer"/></td>
            <td class="textotabla1">&nbsp;</td>
            <td class="textotabla1">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="textotabla1">&nbsp;</td>
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
					inputField  : "fecha_compra",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario" ,  
					align       :"T3",
					singleClick :true
				}
				
			);	
				Calendar.setup(
				{
					inputField  : "fecha_motor",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario2" ,  
					align       :"T3",
					singleClick :true
				}
				
			);				
			
</script>
</form> 
</body>
</html>