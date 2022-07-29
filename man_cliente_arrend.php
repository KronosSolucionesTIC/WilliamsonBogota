<?php include("lib/database.php");?>
<?php include("js/funciones.php");?>
<?php

if ($codigo!="0") {
$sql ="SELECT *
 FROM cliente  
 
 WHERE cod_cli = $codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();

$tipo_cliente=$dbdatos->tipo_persona;

$sqle ="SELECT  
   departamentos.cod_dpto,
  departamentos.nom_dpto
 FROM cliente  
 INNER JOIN departamentos ON (cliente.dpto_cli = departamentos.cod_dpto)
 WHERE cod_cli = $codigo";
$dbdatose= new  Database();
$dbdatose->query($sqle);
$dbdatose->next_row();

$sqlr ="SELECT  
   departamentos.cod_dpto,
  departamentos.nom_dpto
 FROM cliente  
 INNER JOIN departamentos ON (cliente.dpto_repre = departamentos.cod_dpto)
 WHERE cod_cli = $codigo";
$dbda= new  Database();
$dbda->query($sqlr);
$dbda->next_row();


}

else {
$sqlt ="SELECT cod_cli FROM cliente ORDER BY cod_cli DESC";
$dbt= new  Database();
$dbt->query($sqlt);
$dbt->next_row();
$codigo_cliente = $dbt->cod_cli + 1;

}

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 
 
if($archivo_adjunto != NULL)
	{ 
		$file_adjunto = $adjunto_name;
		copy("$archivo_adjunto","adjuntos/$file_adjunto");
	}
	
	// RUTINA PARA  INSERTAR REGISTROS NUEVOS 1. REGISTRO EN TABLA CLIENTE
	 $campos="(cod_cli,apel1_cli,apel2_cli,nom1_cli,nom2_cli,cedula_cli,tipo_empleo_cli,direccion_cli,telefono_cli,ciudad_cli,barrio_cli,celular_cli,email_cli,repre_legal,cedula_representante,direccion_repre,ciudad_repre,tel_repre,celu_repre,email_repres,tipo_persona,tipo_cliente,fecha_ingreso,cod_mismo_paciente)";
	
	 $valores="('".$codigo_cliente."','".$apellido1."','".$apellido2."','".$nombre1."','".$nombre2."','".$identificacion."','".$tipo_empleado."','".$dir_cli."','".$telefono_cli."','".$ciudad_domici."','".$barrio_cli."','".$celular_cli."','".$email_cli."','".$representante_legal."','".$cedula_repre."','".$dir_repre."','".$ciudad_repre."','".$telefono_repre."','".$celular_repre."','".$email_repres."','".$tipo_cliente."','','".date("Y-m-d")."','".$si_no."')";
	 	 	
	$error=insertar("cliente",$campos,$valores);

	 
	 // RUTINA PARA  INSERTAR REGISTROS NUEVOS 2. SI EL CLIENTE ES MISMO PACIENTE REGISTRO EN TABLA PACIENTE
	 if ($si_no == 1) {
	 $campos="(apel1_pac,apel2_pac,nom1_pac,nom2_pac,cedula_pac,tipo_empleo_pac,
direccion_pac,telefono_pac,celular_pac,ciudad_pac,edad_pac,cod_tipo_edad,tipo_deud,fecha_ingreso,cod_cliente,cod_parentesco)";
	
	 $valores="('".$apellido1."','".$apellido2."','".$nombre1."','".$nombre2."','".$identificacion."','".$tipo_empleado."','".$dir_cli."','".$telefono_cli."','".$celular_cli."','".$ciudad_domici."','".$edad_cli."','".$cod_tipo_edad."','".$tipo_codeudor."','".date("Y-m-d")."','".$codigo_cliente."','32')";
	 	 	
	$error=insertar("paciente",$campos,$valores);
	
	}
	
	
	if ($error==1) {
		header("Location: con_cliente_arrend.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
		
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente aqui ') </script>" ; 
	}
	

if($guardar==1 and $codigo!=0) { 


// RUTINA PARA  editar REGISTROS 
	$codigo_usuario=$_SESSION["global"][2];
		
 $campos="apel1_cli='".$apellido1."',apel2_cli='".$apellido2."',nom1_cli='".$nombre1."',nom2_cli='".$nombre2."',cedula_cli='".$identificacion."',tipo_empleo_cli='".$tipo_empleado."',direccion_cli='".$dir_cli."',barrio_cli='".$barrio_cli."',telefono_cli='".$telefono_cli."',celular_cli='".$celular_cli."',ciudad_cli='".$ciudad_domici."',email_cli='".$email_cli."',repre_legal='".$representante_legal."',cedula_representante='".$cedula_repre."',direccion_repre='".$dir_repre."',ciudad_repre='".$ciudad_repre."',tel_repre='".$telefono_repre."',celu_repre='".$celular_repre."',email_repres='".$email_repre."', tipo_persona='".$tipo_cliente."'";

	$error=editar("cliente",$campos,'cod_cli',$codigo); 
	
	if ($error==1) {
		header("Location: con_cliente_arrend.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente ') </script>" ; 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylesforms.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="js/js.js"></script>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FF823B}
.Estilo4 {font-family: Verdana, Arial, Helvetica, sans-serif}
</style> 

<? inicio() ?>
<script language="javascript">


function datos_completos(){  
<? if($tipo_cliente=='1') { ?>

if (document.getElementById('apellido1').value == "" || document.getElementById('nombre1').value == "" || document.getElementById('dir_cli').value =="" || document.getElementById('telefono_cli').value =="" || document.getElementById('email_cli').value =="")

<? } else { if($tipo_cliente=='2') { ?>
 
if (document.getElementById('nombre1').value == "" || document.getElementById('identificacion').value == "")
<? } }?>
	return false;
else
	return true;
}

function alpha(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z á-ú Á-Ú ñÑ\s]/;
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}			


function edad(Fecha){
fecha = new Date(Fecha)
hoy = new Date()
ed = parseInt((hoy-fecha)/365/23/60/60/1000)
document.getElementById('edad_deudor').value = ed 
}

function validar(obj) {
  patron = /^\d{4}\/\d{2}\/\d{2}$/
  if (!patron.test(obj.value)) {
    alert('Error');
    obj.focus();
  }
}
function buscar_dpto(ciud, dpto) {
var combo=document.getElementById(ciud);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;

<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT 
  ciudad.cod_ciu,
  ciudad.nom_ciu,
  ciudad.cod_dptos,
  departamentos.cod_dpto,
  departamentos.nom_dpto
FROM
  ciudad
  INNER JOIN departamentos ON (ciudad.cod_dptos = departamentos.cod_dpto) 
 WHERE cod_dptos=cod_dpto';
	$db->query($sql);
	while($db->next_row()){ 			
		echo "if(document.getElementById(dpto).value==$db->cod_ciu) {";	
		echo "combo.options[cant] = new Option('$db->nom_dpto','$db->cod_dpto'); ";		
		echo  "cant++; } ";
		
	}
?>
}

function buscar_dptos(ciud, dpto) {
var combo=document.getElementById(ciud);
combo.options.length=0;
var cant=0;
combo.options[cant] = new Option('Seleccione','0'); 
cant++;

<?
	$i=0;
	$db = new Database();	
	$sql ='SELECT 
  ciudad.cod_ciu,
  ciudad.nom_ciu,
  ciudad.cod_dptos,
  departamentos.cod_dpto,
  departamentos.nom_dpto

FROM
  ciudad
  INNER JOIN departamentos ON (ciudad.cod_dptos = departamentos.cod_dpto) 
 WHERE cod_dptos=cod_dpto';
	$db->query($sql);
	while($db->next_row()){ 			
		echo "if(document.getElementById(dpto).value==$db->cod_ciu) {";	
		echo "combo.options[cant] = new Option('$db->nom_dpto','$db->cod_dpto'); ";		
		echo  "cant++; } ";	
	}
?>
}

function buscar_cedula(){
var cant=0;
var cedulas =document.getElementById('identificacion').value;
var vec_cedula = new Array;
<?
$dbdatos111= new  Database();
$sql ="SELECT cedula_cli FROM cliente  ";
$dbdatos111->query($sql);
$i = 0;
echo "vec_cedula[$i] = new Array('0');  \n";
$i++;
while($dbdatos111->next_row()){
echo "vec_cedula[$i] = new Array('$dbdatos111->cedula_cli');  \n";
$i++;
}
?>
var encontre=0;
var j=0;
for (j=0; j<<?=$i?>;j++){

	if(cedulas==vec_cedula[j][0] ) 
	{
		encontre=1;
	}
}
	if(encontre==1){
	alert('La cedula o nit ya esta registrada')
	window.location = 'con_cliente_arrend.php?editar=1&insertar=1&eliminar=1';
}
else
	return true;
}


function validaInt_1(){
	if (event.keyCode>47 & event.keyCode<58) {
		return true;
		}
	else{
		return false;
		}
}

function validaInt_evento(a,obj){
	var vandera=0;
	if(event.keyCode ==13 && vandera==0 ) {
		document.getElementById(obj).focus();
	}
	else {
		if (event.keyCode>47 & event.keyCode<58) {
			return true;
			}
		else{
			return false;
			}
	}
}

function showMe (it, box) {
var vis = (box.checked) ? "block" : "none";
document.getElementById(it).style.display = vis;
}
function solapa(objeto,pes) {

	document.getElementById('solapa1').style.display = "none";
	document.getElementById('l_solapa1').className="pestana";
 	
	document.getElementById('solapa2').style.display = "none";
	document.getElementById('l_solapa2').className="pestana";
		
	document.getElementById(objeto).style.display = "inline";
	document.getElementById(pes).className="ctablaform";

}
function ocultar()
{
    document.getElementById('solapa1').style.display = "none";
	 document.getElementById('solapa2').style.display = "none";
}

function  adicion_item_inmobi() 
{

if(document.getElementById("direccion").value=="") {
	alert("Escriba la direccion")
	return false;
}

if(document.getElementById("ciudades").value=="0") {
	alert("Seleccione una ciudad")
	return false;
}

if(document.getElementById("matri_inmo").value=="") {
	alert("Escriba la matricula")
	return false;
}

if(document.getElementById("escritura").value=="") {
	alert("Escriba la escritura")
	return false;
}

if(document.getElementById("notaria").value=="") {
	alert("Escriba la notaria")
	return false;
}

if(document.getElementById("fecha_escri").value=="") {
	alert("Seleccione una feha")
	return false;
}

if(document.getElementById("valor_hipoteca").value=="") {
	alert("Escriba el valor hipoteca")
	return false;
}


	var cod_ides = document.getElementById("codigo_inmueble").value;
	var direccion = document.getElementById("direccion").value;
   	var escritura = document.getElementById("escritura").value;
	var notaria = document.getElementById("notaria").value;
	var fecha = document.getElementById("fecha_escri").value;	
	var ciudad = document.getElementById("ciudades").options[document.getElementById("ciudades").selectedIndex].text;
	var ciudadese= document.getElementById("ciudades").value;
	var matricula = document.getElementById("matri_inmo").value;
	var valor = document.getElementById("valor_hipoteca").value;
	var val_inicial= document.getElementById("val_inicial_inmueble"); 

document.getElementById("direccion").value="";
document.getElementById("escritura").value="";
document.getElementById("notaria").value="";	
document.getElementById("fecha_escri").value="";
document.getElementById("ciudades").value="0";	
document.getElementById("matri_inmo").value="";
document.getElementById("valor_hipoteca").value="";


agregar_html_inmueble(cod_ides,direccion,escritura,notaria,fecha,ciudad,ciudadese,matricula,valor,val_inicial);	
}

function  adicion_item_vehi() 
{

if(document.getElementById("marca").value=="") {
	alert("Escriba la marca")
	return false;
}

if(document.getElementById("modelo").value=="") {
	alert("Escriba el modelo")
	return false;
}

if(document.getElementById("placa").value=="") {
	alert("Escriba la placa")
	return false;
}

if(document.getElementById("reserva").value=="0") {
	alert("seleccione Reserva")
	return false;
}


	var cod_ides = document.getElementById("codigo_vehiculo").value;
	var marca = document.getElementById("marca").value;
	var modelo = document.getElementById("modelo").value;	
	var placa = document.getElementById("placa").value;
	var reserva = document.getElementById("reserva").options[document.getElementById("reserva").selectedIndex].text;
	var reserva_si= document.getElementById("reserva").value;
	var val_inicial= document.getElementById("val_inicial_vehiculo"); 

document.getElementById("marca").value="";	
document.getElementById("modelo").value="";
document.getElementById("placa").value="";	


agregar_html_vehiculo(cod_ides,marca,modelo,placa,reserva,reserva_si,val_inicial);	
}
</script>
<link href="css/styles1.css" rel="stylesheet" type="text/css" />
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_cliente_arrend.php"  method="post">
<table width="896" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td width="896" bgcolor="#E9E9E9"><table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
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
         <td width="6" height="19">&nbsp;</td>
        <td width="26" ><img src="imagenes/icoguardar.png" alt="Nuevo Registro" width="16" height="16" border="0" onclick="cambio_guardar()" style="cursor:pointer"/></td>
        <td width="82" class="ctablaform">Guardar</td>
        <td width="28" class="ctablaform"><a href="con_cliente_arrend.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="87" class="ctablaform">Cancelar </td>
        <td width="29" class="ctablaform"><a href="con_cliente_arrend.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="94" class="ctablaform">Consultar</td>
        <td width="28" class="ctablaform"></td>
        <td width="80" class="ctablaform">&nbsp;</td>
        <td width="32" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="259" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
		  <input type="hidden" name="tipo_cliente" id="tipo_cliente" value="<?=$tipo_cliente?>" />	  	  
          <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />	
        </label></td>
        <td width="95" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1"><? if ($tipo_cliente=='1') { ?>
CLIENTE ARRENDATARIO PERSONA NATURAL:<strong>
<? } else { if ($tipo_cliente=='2') { ?>
</strong> CLIENTE ARRENDATARIO PERSONA JURIDICA:<strong>
<? }} ?>
</strong></td>
  </tr>
  
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<!-- DATOS PERSONA NATURAL-->
	<? if($tipo_cliente=='1') {?>
	<table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="8" class="botonforms"><div align="center">DATOS CLIENTE</div></td>
          </tr>
	  <tr>
        <td height="28" class="textotabla1">1er Apellido:</td>
        <td width="163"><input name="apellido1" id="apellido1" type="text" class="textfield2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel1_cli?>" />
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td width="115" class="textotabla1">2do Apellido:</td>
        <td width="144"><input name="apellido2" type="text" class="textfield2" id="apellido2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel2_cli?>" size="15" /></td>
        </tr>
      <tr>
        <td width="84" class="textotabla1">1er Nombre:</td>
        <td>
          <input name="nombre1" id="nombre1" type="text" class="textfield2" onkeypress="return alpha(event)" value="<?=$dbdatos->nom1_cli?>" />
          <span class="textorojo">*</span></td>
        <td width="14" align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">2do Nombre:</td>
        <td>
          <input name="nombre2" id="nombre2" type="text" class="textfield2"  onkeypress="return alpha(event)"value="<?=$dbdatos->nom2_cli?>"  size="15" />
        </span></td>
        </tr>
      <tr>
        <td class="textotabla1">Identificaci&oacute;n:</td>
        <td><input name="identificacion" id="identificacion" type="text" class="textfield2" onkeypress="return validaInt_1()"  value="<?=$dbdatos->cedula_cli?>" onblur="<? if($codigo==0) { ?> buscar_cedula() <? } ?>" />
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Direcci&oacute;n  domicilio actual: </td>
        <td><label>
          <input name="dir_cli" id="dir_cli" type="text" class="textfield2"  value="<?=$dbdatos->direccion_cli?>" />
          <span class="textorojo">*</span></label></td>
        </tr>
      <tr>
        <td class="textotabla1">Empleado</td>
        <td><label>
          <? combo("tipo_empleado","tipo_empleado ","cod_tipo_empleado","nom_tipo_empleado",$dbdatos->tipo_empleo_cli); ?>
        </label></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Ciudad domicilio:</td>
        <td><? 
		combo_evento("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli,"onchange='buscar_dpto(\"dpto_cli\",\"ciudad_domici\")'", "nom_ciu");
		
		//combo("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli); ?></td>
        </tr>
      
      <tr>
        <td class="textotabla1">Barrio domicilio: </td>
        <td><input name="barrio_cli" id="barrio_cli" type="text" class="textfield2"  value="<?=$dbdatos->barrio_cli?>" /></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Tel&eacute;fono domicilio:</td>
        <td><input name="telefono_cli" type="text" class="textfield2" id="telefono_cli" value="<?=$dbdatos->telefono_cli?>" />
          <span class="textorojo">*</span></td>
        </tr>
      <tr>
        <td class="textotabla1">Email:</td>
        <td><input name="email_cli" id="email_cli" type="text" class="textfield2"  value="<?=$dbdatos->email_cli?>" /></td>
        <td><span class="textorojo">*</span></td>
        <td class="textotabla1">Celular:</td>
        <td><input name="celular_cli" type="text" class="textfield2" id="celular_cli" value="<?=$dbdatos->celular_cli?>" /></td>
        </tr>
      <tr>
        <td class="textotabla1">&iquest;Cliente es el mismo paciente?: </td>
        <td><? combo_evento("si_no","si_no","cod_si_no","nom_si_no",$dbdatos->ciudad_oficine,"", "cod_si_no"); ?></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="5" class="textotabla1">&nbsp;</td>
      </tr>
    </table>
	<!-- DATOS PERSONA NATURAL-->
	<? } ?>
	<br />
		 <!-- DATOS PERSONA JURIDICA-->
	<? if($tipo_cliente=='2') {?>
      <table width="841" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="8" class="botonforms"><div align="center">DATOS CLIENTE </div></td>
          </tr>
        <tr>
          <td class="textotabla1">Nit:</td>
          <td><input name="identificacion" type="text" class="textfield2" id="identificacion" value="<?=$dbdatos->cedula_cli?>" size="15" onkeypress="return validaInt_1()" onblur="<? if($codigo==0) { ?> buscar_cedula() <? } ?>" />
              <span class="textorojo">*</span></td> 
          <td width="18" align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Razon Social: </td>
          <td><input name="nombre1" id="nombre1" type="text" class="textfield2" value="<?=$dbdatos->nom1_cli?>" />
              <span class="textorojo">*</span></td>
        </tr>
        <tr>
          <td class="textotabla1">Direcci&oacute;n:</td>
          <td class="textotabla1"><input name="dir_cli" id="dir_cli" type="text" class="textfield2"value="<?=$dbdatos->direccion_cli?>"/></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Ciudad: </td>
          <td class="textotabla1"><? 
		  combo_evento("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli,"onchange='buscar_dpto(\"dpto_cli\",\"ciudad_domici\")'", "nom_ciu");
		  
		  //combo("ciudad_repre","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_repre); ?></td>
        </tr>
        <tr>
          <td class="textotabla1">Barrio:</td>
          <td class="textotabla1"><input name="barrio_cli" id="barrio_cli" type="text" class="textfield2"value="<?=$dbdatos->barrio_cli?>"/></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Tel&eacute;fono:</td>
          <td><span class="textotabla1">
            <input name="telefono_cli" id="telefono_cli" type="text" class="textfield2" value="<?=$dbdatos->telefono_cli?>"/>
          </span></td>
          </tr>
        <tr>
          <td class="textotabla1">Celular:</td>
          <td class="textotabla1"><input name="celular_cli" id="celular_cli" type="text" class="textfield2" value="<?=$dbdatos->celular_cli?>"/></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">E-mail:</td>
          <td><span class="textotabla1">
            <input name="email_cli" id="email_cli" type="text" class="textfield2"  value="<?=$dbdatos->email_cli?>"/>
            </span></td>
        </tr>
        <tr>
          <td class="textotabla1">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">&nbsp;</td>
          <td class="textotabla1">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="8" class="botonforms"><div align="center">DATOS REPRESENTANTE LEGAL</div></td>
          </tr>
        
        
        <tr>
          <td class="textotabla1">Representante Legal:</td>
          <td><input name="representante_legal" id="representante_legal" type="text" class="textfield2" value="<?=$dbdatos->repre_legal?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Identidificacion:</td>
          <td><input name="cedula_repre" type="text" class="textfield2" id="cedula_repre" value="<?=$dbdatos->cedula_representante?>" size="15" />
              <span class="textorojo">*</span></td>
        </tr>
        <tr>
          <td class="textotabla1">Direcci&oacute;n  domicilio actual:</td>
          <td><input name="dir_repre" id="dir_repre" type="text" class="textfield2"  value="<?=$dbdatos->direccion_repre?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Ciudad domicilio:</td>
          <td><? 
		combo_evento("ciudad_repre","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_repre,"onchange='buscar_dpto(\"dpto_repre\",\"ciudad_repre\")'", "nom_ciu");
		
		//combo("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli); ?></td>
        </tr>
        <tr>
          <td class="textotabla1">Tel&eacute;fono domicilio:</td>
          <td><input name="telefono_repre" type="text" class="textfield2" id="telefono_repre" value="<?=$dbdatos->tel_repre?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Celular:</td>
          <td><input name="celular_repre" type="text" class="textfield2" id="celular_repre" value="<?=$dbdatos->celu_repre?>" /></td>
        </tr>
        <tr>
          <td class="textotabla1">E-mail:</td>
          <td><span class="textotabla1">
            <input name="email_repres" id="email_repres" type="text" class="textfield2"  value="<?=$dbdatos->email_repres?>"/>
          </span></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  <? } ?>
	 <!-- FIN DATOS PERSONA JURIDICA-->
      <p>&nbsp; </p></td>
  </tr>
  
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>
</form> 
</body>
</html>

