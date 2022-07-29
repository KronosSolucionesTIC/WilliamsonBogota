<? include("lib/database.php")?>
<? include("js/funciones.php")?>
<?

if ($codigo!="0") {

$sql ="SELECT *
 FROM paciente  
 
 
 WHERE cod_pac = $codigo";
$dbdatos= new  Database();
$dbdatos->query($sql);
$dbdatos->next_row();

$tipo_codeudor=$dbdatos->tipo_deud;

$sqle ="SELECT  
   departamentos.cod_dpto,
  departamentos.nom_dpto
 FROM cliente  
 INNER JOIN departamentos ON (cliente.dpto_cli = departamentos.cod_dpto)
 WHERE cod_pac = $codigo";
$dbdatose= new  Database();
$dbdatose->query($sqle);
$dbdatose->next_row();

$sqlr ="SELECT  
   departamentos.cod_dpto,
  departamentos.nom_dpto
 FROM cliente  
 INNER JOIN departamentos ON (cliente.dpto_repre = departamentos.cod_dpto)
 WHERE cod_pac = $codigo";
$dbda= new  Database();
$dbda->query($sqlr);
$dbda->next_row();

}



$codigo_usuario=$_SESSION["global"][2];
if($guardar==1 and $codigo==0) { 


// RUTINA PARA  INSERTAR REGISTROS NUEVOS

  
       if($adjunto != NULL)
	{ 
		$file_adjunto = $adjunto_name;
		copy("$adjunto","adjuntos/$file_adjunto");
	}
		
	 $campos="(apel1_pac,apel2_pac,nom1_pac,nom2_pac,cedula_pac,tipo_empleo_pac,
direccion_pac,telefono_pac,celular_pac,ciudad_pac,edad_pac,cod_tipo_edad,tipo_deud,fecha_ingreso,cod_cliente,cod_parentesco)";
	
	 $valores="('".$apellido1."','".$apellido2."','".$nombre1."','".$nombre2."','".$identificacion."','".$tipo_empleado."','".$dir_pac."','".$telefono_pac."','".$celular_pac."','".$ciud_pac."','".$edad_pac."','".$cod_tipo_edad."','".$tipo_codeudor."','".date("Y-m-d")."','".$cod_cliente."','".$parentesco."')";
	 	 	
	$error=insertar("paciente",$campos,$valores);
	// $ins_id=insertar_maestro("pacente",$campos,$valores); 
	 
	 
	if ($error==1) {
		header("Location: con_paciente.php?confirmacion=1&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
		
	}
	else
		echo "<script language='javascript'> alert('Hay un error en los Datos, Intente Nuevamente aqui ') </script>" ; 

}
if($guardar==1 and $codigo!=0) { 


// RUTINA PARA  editar REGISTROS 
	$codigo_usuario=$_SESSION["global"][2];
	
	if($adjunto != NULL)
	{ 
		$file_adjunto = renombrar_archivo($adjunto_name);
		copy("$adjunto","adjuntos/$file_adjunto");
		$campos="adjunto='".$file_adjunto."'";
		$error=editar("paciente",$campos,'cod_pac',$codigo); 
	}
	
 $campos="apel1_pac='".$apellido1."',apel2_pac='".$apellido2."',nom1_pac='".$nombre1."',nom2_pac='".$nombre2."',cedula_pac='".$identificacion."',tipo_empleo_pac='".$tipo_empleado."',direccion_pac='".$dir_pac."',telefono_pac='".$telefono_pac."',celular_pac='".$celular_pac."',ciudad_pac='".$ciud_pac."',edad_pac='".$edad_pac."',cod_tipo_edad='".$cod_tipo_edad."', cod_parentesco='".$parentesco."', cod_cliente='".$cod_cliente."'";

	$error=editar("paciente",$campos,'cod_pac',$codigo); 
	
	if ($error==1) {
		header("Location: con_paciente.php?confirmacion=2&editar=$editar&insertar=$insertar&eliminar=$eliminar"); 
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


if (document.getElementById('cod_cliente').value == 0 || document.getElementById('parentesco').value == 0 || document.getElementById('apellido1').value == "" ||document.getElementById('nombre1').value == "" || document.getElementById('telefono_pac').value == "" || document.getElementById('dir_pac').value == "" )

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
$sql ="SELECT cedula_pac FROM cliente  ";
$dbdatos111->query($sql);
$i = 0;
echo "vec_cedula[$i] = new Array('0');  \n";
$i++;
while($dbdatos111->next_row()){
echo "vec_cedula[$i] = new Array('$dbdatos111->cedula_pac');  \n";
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

</script>
</head>
<body <?=$sis?>>
<form  name="forma" id="forma" action="man_paciente.php"  method="post">
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
        <td width="28" class="ctablaform"><a href="con_paciente.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/cancel.png" alt="Cancelar" width="16" height="16" border="0" /></a></td>
        <td width="87" class="ctablaform">Cancelar </td>
        <td width="29" class="ctablaform"><a href="con_paciente.php?confirmacion=0&editar=<?=$editar?>&insertar=<?=$insertar?>&eliminar=<?=$eliminar?>"><img src="imagenes/iconolupa.gif" alt="Buscar" width="16" height="16" border="0" /></a></td>
        <td width="94" class="ctablaform">Consultar</td>
        <td width="28" class="ctablaform"></td>
        <td width="80" class="ctablaform">&nbsp;</td>
        <td width="32" valign="middle" class="ctablaform">&nbsp;</td>
        <td width="259" valign="middle"><label>
          <input type="hidden" name="editar"   id="editar"   value="<?=$editar?>">
		  <input type="hidden" name="insertar" id="insertar" value="<?=$insertar?>">
		  <input type="hidden" name="eliminar" id="eliminar" value="<?=$eliminar?>">
          <input type="hidden" name="codigo" id="codigo" value="<?=$codigo?>" />	
		  		  <input type="hidden" name="tipo_codeudor" id="tipo_codeudor" value="<?=$tipo_codeudor?>" />	  
  
		  
        </label></td>
        <td width="95" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="4" valign="bottom"><img src="imagenes/lineasup2.gif" alt="." width="100%" height="4" /></td>
  </tr>
  <tr>
    <td class="textotabla1 Estilo1">PACIENTE :</td>
  </tr>
  
  <tr>
    <td><img src="imagenes/lineasup2.gif"  width="100%" height="4" /></td>
  </tr>
  <tr>
    <td bgcolor="#E9E9E9" valign="top">
	<!-- DATOS CODEUDOR-->
	<table width="668" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="28" colspan="5" class="textotabla1"><div align="center"> PACIENTE </div></td>
        </tr>
      <tr>
        <td height="28" class="textotabla1">Cliente:</td>
        <td><? combo_evento1("cod_cliente","cliente","cod_cli","nom1_cli",""," ",    
							"apel1_cli"); ?>
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Parentesco:</td>
        <td><? combo("parentesco","parentesco","cod_parent","desc_parent",$dbdatos->cod_parentesco); ?>
          <span class="textorojo">*</span></td>
      </tr>
      <tr>
        <td height="28" class="textotabla1">1er Apellido:</td>
        <td width="204"><input name="apellido1" id="apellido1" type="text" class="textfield2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel1_pac?>" />
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td width="177" class="textotabla1">2do Apellido:</td>
        <td width="160"><input name="apellido2" type="text" class="textfield2" id="apellido2" onkeypress="return alpha(event)" value="<?=$dbdatos->apel2_pac?>" size="15" /></td>
        </tr>
      <tr>
        <td width="115" class="textotabla1">1er Nombre:</td>
        <td>
          <input name="nombre1" id="nombre1" type="text" class="textfield2" onkeypress="return alpha(event)" value="<?=$dbdatos->nom1_pac?>" />
          <span class="textorojo">*</span></td>
        <td width="12" align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">2do Nombre:</td>
        <td>
          <input name="nombre2" id="nombre2" type="text" class="textfield2"  onkeypress="return alpha(event)"value="<?=$dbdatos->nom2_pac?>"  size="15" />
        </span></td>
        </tr>
      <tr>
        <td class="textotabla1">No identificaci&oacute;n:</td>
        <td><input name="identificacion" id="identificacion" type="text" class="textfield2" onkeypress="return validaInt_1()"  value="<?=$dbdatos->cedula_pac?>" onblur="<? if($codigo==0) { ?> buscar_cedula() <? } ?>" /></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Empleado</td>
        <td><label>
          <? combo("tipo_empleado","tipo_empleado ","cod_tipo_empleado","nom_tipo_empleado",$dbdatos->tipo_empleo_pac); ?>
        </label></td>
        </tr>
      <tr>
        <td class="textotabla1">Direcci&oacute;n  domicilio actual: </td>
        <td><label>
          <input name="dir_pac" id="dir_pac" type="text" class="textfield2"  value="<?=$dbdatos->direccion_pac?>" />
          <span class="textorojo">*</span></label></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Ciudad domicilio:</td>
        <td><? combo_evento("ciud_pac","ciudad","cod_ciu","nom_ciu",$dbdatos->ciudad_pac,"onchange='buscar_dpto(\"dpto_pac\",\"ciud_pac\")'", "nom_ciu");
 				?></td>
        </tr>
      
      <tr>
        <td class="textotabla1">Tel&eacute;fono domicilio:</td>
        <td><input name="telefono_pac" type="text" class="textfield2" id="telefono_pac" value="<?=$dbdatos->telefono_pac?>" />
          <span class="textorojo">*</span></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">Celular:</td>
        <td><input name="celular_pac" type="text" class="textfield2" id="celular_pac" value="<?=$dbdatos->celular_pac?>" /></td>
        </tr>
      <tr>
        <td class="textotabla1">Edad:</td>
        <td><input name="edad_pac" type="text" id="edad_pac"  value="<?=$dbdatos->edad_pac?>" size="4" />
          <? combo("cod_tipo_edad","tipo_edad","cod_tipo_edad","desc_tipo_edad",$dbdatos->cod_tipo_edad); ?></td>
        <td align="left" class="textorojo">&nbsp;</td>
        <td class="textotabla1">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<!-- DATOS CODEUDOR-->
	<br />  
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

</body>
</html>