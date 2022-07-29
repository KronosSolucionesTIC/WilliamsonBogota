<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

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

$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 


// RUTINA PARA  INSERTAR REGISTROS NUEVOS

	
	 $campos="(apel1_cli,apel2_cli,nom1_cli,nom2_cli,cedula_cli,ciudad_exp_ced_cli,estado_civil_cli,profesion_cli,tipo_empleo_cli,
direccion_cli,telefono_cli,celular_cli,ciudad_cli,dpto_cli,email_cli,direc_ofice,tel_oficina,ciudad_oficine,repre_legal,cedula_representante,ciudad_exp_ced_repre,direccion_repre,ciudad_repre,dpto_repre,tel_repre,celu_repre,email_repres,objeto_social,nro_escritura,notaria,ciudad_notaria,fech_notaria,registro_mercan,fech_registr_mer,direccion_juridica,telefono_juridica,email_juridica, tipo_persona,fecha_ingreso)";
	
	 $valores="('".$apellido1."','".$apellido2."','".$nombre1."','".$nombre2."','".$identificacion."','".$lugar_expedicion."','".$estado_civil."','".$profesion."','".$tipo_empleado."','".$dir_cli."','".$telefono_cli."','".$celular_cli."','".$ciudad_domici."','".$dpto_cli."','".$email_cli."','".$direc_ofice."','".$tel_oficina."','".$ciudad_oficine."','".$representante_legal."','".$cedula."','".$lugar_expe_repre."',
	 '".$direccion_repre."','".$ciudad_repre."','".$dpto_repre."','".$tel_repre."','".$celu_repre."','".$email_repres."','".$objeto_social."','".$nro_escritura."','".$notaria."','".$ciudad_nota."','".$fecha_notaria."','".$registro_mercan."','".$fecha_registro_mer."','".$direccion."','".$telefono_juridica."','".$email_juridica."','".$tipo_cliente."','".date("Y-m-d")."')";
	 	 	
	$error=insertar("cliente",$campos,$valores);
	// $ins_id=insertar_maestro("cliente",$campos,$valores); 
	 
	 
	if ($error==1) {
		header("Location: con_cliente_arrend.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
		
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente aqui ') </script>" ; 
}

if($guardar==1 and $codigo!=0) { 


// RUTINA PARA  editar REGISTROS 
	$codigo_usuario=$_SESSION["global"][2];
	
	
	
 $campos="apel1_cli='".$apellido1."',apel2_cli='".$apellido2."',nom1_cli='".$nombre1."',nom2_cli='".$nombre2."',cedula_cli='".$identificacion."',ciudad_exp_ced_cli='".$lugar_expedicion."',estado_civil_cli='".$estado_civil."',profesion_cli='".$profesion."',tipo_empleo_cli='".$tipo_empleado."',direccion_cli='".$dir_cli."',telefono_cli='".$telefono_cli."',celular_cli='".$celular_cli."',ciudad_cli='".$ciudad_domici."',dpto_cli='".$dpto_cli."',email_cli='".$email_cli."',direc_ofice='".$direc_ofice."',tel_oficina='".$tel_oficina."',ciudad_oficine='".$ciudad_oficine."',repre_legal='".$representante_legal."',cedula_representante='".$cedula."',ciudad_exp_ced_repre='".$lugar_expe_repre."',direccion_repre='".$direccion_repre."',ciudad_repre='".$ciudad_repre."',dpto_repre='".$dpto_repre."',tel_repre='".$tel_repre."',celu_repre='".$celu_repre."',email_repres='".$email_repres."',objeto_social='".$objeto_social."',nro_escritura='".$nro_escritura."',notaria='".$notaria."', ciudad_notaria='".$ciudad_nota."',fech_notaria='".$fecha_notaria."',registro_mercan='".$registro_mercan."',fech_registr_mer='".$fecha_registro_mer."',direccion_juridica='".$direccion."',telefono_juridica='".$telefono_juridica."',email_juridica='".$email_juridica."', tipo_persona='".$tipo_cliente."'";

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

if (document.getElementById('apellido1').value == "" || document.getElementById('apellido2').value == "" || document.getElementById('nombre1').value == "" || document.getElementById('identificacion').value =="")

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
          <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />
		  <input type="hidden" name="tipo_cliente" id="tipo_cliente" value="<?=$tipo_cliente?>" />	  
		  
        </label></td>
        <td width="95" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1">CLIENTE ARRENDATARIO:</td>
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
        <td height="28" class="textotabla1">1er Apellido:</td>
        <td width="163"><input name="apellido1" id="apellido1" type="text" class="textfield2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel1_cli?>" />
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td width="115" class="textotabla1">2do Apellido:</td>
        <td width="144"><input name="apellido2" type="text" class="textfield2" id="apellido2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel2_cli?>" size="15" />
          <span class="textorojo">*</span></td>
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
        <td class="textotabla1">Lugar Expedici&oacute;n: </td>
        <td><? combo("lugar_expedicion","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_exp_ced_cli); ?></td>
        </tr>
      <tr>
        <td class="textotabla1">Estado Civil : </td>
        <td><? combo("estado_civil","tipo_estado_civil ","cod_estado_civil","nom_estado_civil",$dbdatos->estado_civil_cli); ?></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Profesi&oacute;n u oficio</td>
        <td><input name="profesion" type="text" class="textfield2" id="profesion" onkeypress="return alpha(event)" value="<?=$dbdatos->profesion_cli?>" /></td>
        </tr>
      
      <tr>
        <td class="textotabla1">Empleado</td>
        <td><label>
          <? combo("tipo_empleado","tipo_empleado ","cod_tipo_empleado","nom_tipo_empleado",$dbdatos->tipo_empleo_cli); ?>
        </label></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Direcci&oacute;n  domicilio actual: </td>
        <td><label>
          <input name="dir_cli" id="dir_cli" type="text" class="textfield2"  value="<?=$dbdatos->direccion_cli?>" />
        </label></td>
        </tr>
      <tr>
        <td class="textotabla1">Ciudad domicilio:</td>
        <td><? 
		combo_evento("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli,"onchange='buscar_dpto(\"dpto_cli\",\"ciudad_domici\")'", "nom_ciu");
		
		//combo("ciudad_domici","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_cli); ?></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Departamento Domicilio: </td>
        <td><? if($codigo!=0) { ?>
            <select name="dpto_cli" id="dpto_cli" class="SELECT" >
              <option value="<?=$dbdatose->dpto_cli?>">
              <?=$dbdatose->nom_dpto?>
              </option>
            </select>
            <? }  else  { ?>
            <select name="dpto_cli" id="dpto_cli" class="SELECT" >
              <option value="<?=$db->cod_dpto?>">
              <?=$db->nom_dpto?>
              </option>
            </select>
            <? } ?></td>
      </tr>
      <tr>
        <td class="textotabla1">Tel&eacute;fono domicilio:</td>
        <td><input name="telefono_cli" type="text" class="textfield2" id="telefono_cli" value="<?=$dbdatos->telefono_cli?>" /></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Celular:</td>
        <td><input name="celular_cli" type="text" class="textfield2" id="celular_cli" value="<?=$dbdatos->celular_cli?>" /></td>
      </tr>
      <tr>
        <td class="textotabla1">Email:</td>
        <td><input name="email_cli" id="email_cli" type="text" class="textfield2"  value="<?=$dbdatos->email_cli?>" /></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="textotabla1">Direcci&oacute;n oficina:</td>
        <td><input name="direc_ofice" id="direc_ofice" type="text" class="textfield2"  value="<?=$dbdatos->direc_ofice?>" /></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Tel&eacute;fono oficina: </td>
        <td><input name="tel_oficina" id="tel_oficina" type="text" class="textfield2"  value="<?=$dbdatos->tel_oficina?>" /></td>
      </tr>
      <tr>
        <td class="textotabla1">Ciudad:</td>
        <td><? combo("ciudad_oficine","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_oficine); ?></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
	  	  <tr>
	  	    <td colspan="5" valign="bottom">&nbsp;</td>
  	      </tr>
    </table>
	<!-- DATOS PERSONA NATURAL-->
	<? } ?>
	<br />
		 <!-- DATOS PERSONA JURIDICA-->
	<? if($tipo_cliente=='2') {?>
      <table width="841" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr> 
          <td width="134" class="textotabla1">Razon Social: </td>
          <td width="218"><input name="nombre1" id="nombre1" type="text" class="textfield2" value="<?=$dbdatos->nom1_cli?>" />
            <span class="textorojo">*</span></td>
          <td width="18" align="left" class="textorojo">&nbsp;</td>
          <td width="144" class="textotabla1">Nit:</td>
          <td width="327"><input name="identificacion" type="text" class="textfield2" id="identificacion" value="<?=$dbdatos->cedula_cli?>" size="15" onkeypress="return validaInt_1()" onblur="<? if($codigo==0) { ?> buscar_cedula() <? } ?>" />
              <span class="textorojo">*</span></td>
        </tr>
        <tr>
          <td rowspan="8" class="textotabla1">Representante Legal:</td>
          <td rowspan="8"><input name="representante_legal" id="representante_legal" type="text" class="textfield2" value="<?=$dbdatos->repre_legal?>" /></td>
          <td rowspan="8" align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Identificaci&oacute;n:</td>
          <td class="textotabla1"><input name="cedula" id="cedula" type="text" class="textfield2" onkeypress="return validaInt_1()"  value="<?=$dbdatos->cedula_representante?>"/></td>
        </tr>
        <tr>
          <td class="textotabla1">Lugar Expedici&oacute;n: </td>
          <td class="textotabla1"><? combo("lugar_expe_repre","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_exp_ced_repre); ?></td>
        </tr>
        <tr>
          <td class="textotabla1">Direcci&oacute;n domicilio:</td>
          <td class="textotabla1"><input name="direccion_repre" id="direccion_repre" type="text" class="textfield2"value="<?=$dbdatos->direccion_repre?>"/></td>
        </tr>
        <tr>
          <td class="textotabla1">Ciudad domicilio: </td>
          <td class="textotabla1"><? 
		  combo_evento("ciudad_repre","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_repre,"onchange='buscar_dpto(\"dpto_repre\",\"ciudad_repre\")'", "nom_ciu");
		  
		  //combo("ciudad_repre","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_repre); ?></td>
        </tr>
        <tr>
          <td class="textotabla1">Departamento domicilio: </td>
          <td class="textotabla1"><? if($codigo!=0) { ?>
            <select name="dpto_repre" id="dpto_repre" class="SELECT" >
              <option value="<?=$dbda->dpto_repre?>">
              <?=$dbda->nom_dpto?>
              </option>
            </select>
            <? }  else  { ?>
            <select name="dpto_repre" id="dpto_repre" class="SELECT" >
              <option value="<?=$db->cod_dpto?>">
              <?=$db->nom_dpto?>
              </option>
            </select>
            <? } ?></td>
        </tr>
        <tr>
          <td class="textotabla1">Tel&eacute;fono domicilio:</td>
          <td class="textotabla1"><input name="tel_repre" id="tel_repre" type="text" class="textfield2" value="<?=$dbdatos->tel_repre?>"/></td>
        </tr>
        <tr>
          <td class="textotabla1">Celular:</td>
          <td class="textotabla1"><input name="celu_repre" id="celu_repre" type="text" class="textfield2" value="<?=$dbdatos->celu_repre?>"/></td>
        </tr>
        <tr>
          <td class="textotabla1">E-mail:</td>
          <td class="textotabla1"><input name="email_repres" id="email_repres" type="text" class="textfield2"  value="<?=$dbdatos->email_repres?>"/></td>
        </tr>
        <tr>
          <td class="textotabla1">Objeto Social: </td>
          <td><input name="objeto_social" id="objeto_social" type="text" class="textfield2" value="<?=$dbdatos->objeto_social?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="textotabla1">Escritura:</td>
          <td><input name="nro_escritura" id="nro_escritura" type="text" class="textfield2" value="<?=$dbdatos->nro_escritura?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Notaria:</td>
          <td><input name="notaria" id="notaria" type="text" class="textfield2" value="<?=$dbdatos->notaria?>" /></td>
        </tr>
        <tr>
          <td class="textotabla1">Ciudad:</td>
          <td><span class="textotabla1">
            <? combo("ciudad_nota","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_notaria); ?>
          </span></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Fecha:</td>
          <td><span class="textorojo">
            <input name="fecha_notaria" type="text" class="textfield2" id="fecha_notaria" 
		value="<?=$dbdatos->fech_notaria?>"/>
            <img src="imagenes/date.png" alt="Calendario" name="calendario" width="18" height="18" id="calendario" style="cursor:pointer"/></span></td>
        </tr>
        <tr>
          <td class="textotabla1">Registro Mercantil: </td>
          <td><input name="registro_mercan" id="registro_mercan" type="text" class="textfield2" value="<?=$dbdatos->registro_mercan?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Fecha de registro: </td>
          <td><span class="textorojo">
            <input name="fecha_registro_mer" type="text" class="textfield2" id="fecha_registro_mer" 
		value="<?=$dbdatos->fech_registr_mer?>"/>
            <img src="imagenes/date.png" alt="Calendario" name="calendario1" width="18" height="18" id="calendario1" style="cursor:pointer"/></span></td>
        </tr>
        <tr>
          <td class="textotabla1">Direcci&oacute;n  domicilio actual: </td>
          <td><label>
            <input name="direccion" id="direccion" type="text" class="textfield2"  value="<?=$dbdatos->direccion_juridica?>" />
          </label></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">Tel&eacute;fono:</td>
          <td><input name="telefono_juridica" type="text" class="textfield2" id="telefono_juridica" value="<?=$dbdatos->telefono_juridica?>" /></td>
        </tr>
        <tr>
          <td class="textotabla1">Email:</td>
          <td><input name="email_juridica" id="email_juridica" type="text" class="textfield2"  value="<?=$dbdatos->email_juridica?>" /></td>
          <td align="left" class="textorojo">&nbsp;</td>
          <td class="textotabla1">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td colspan="5" valign="bottom">&nbsp;</td>
        </tr>
      </table>
	  <? } ?>
	 <!-- FIN DATOS PERSONA JURIDICA-->
	  
	  </td>
  </tr>
  
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td height="30"  > <input type="hidden" name="guardar" id="guardar" />	</td>
  </tr>
</table>
</form> 
<?  if($tipo_cliente=='2') { ?>
<script type="text/javascript">	
			Calendar.setup(
				{
					inputField  : "fecha_notaria",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario" ,  
					align       :"T3",
					singleClick :true
				}
			);	
		
			Calendar.setup(
				{
					inputField  : "fecha_registro_mer",      
					ifFormat    : "%Y-%m-%d",    
					button      : "calendario1" ,  
					align       :"T3",
					singleClick :true
				}
			);		
</script>
<? } ?>
</body>
</html>

