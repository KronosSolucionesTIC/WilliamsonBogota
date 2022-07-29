<? include("conf/clave.php")?>
<? 
if(!isset($verifica_seg)) {
	setcookie("verifica_seg", "1", time() + 86400); 
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$nombre_aplicacion?></title>
</head>
<script language="javascript">
<? 
if ($confirmacion==1){
	include ("validar.php");
} 
?>
<?
if ($usu_atu==1 && $confirmacion==1){
$usu_atu==0; 
$confirmacion==0;
?>
menu=window.open('aplicacion.php',"sis_dis","toolbar=no,scrollbars=no,fullscreen=no");
menu.focus();
<?
$refresca=1;
}
if($usu_atu==0 && $confirmacion==1){ 
	echo "alert('Usuario No Autorizado, Rectifique sus Datos ');";
}
?>
function DetectaBloqueoPops()
{
  var popup
  try
  {
    if(!(popup = window.open('about:blank','_blank','width=0,height=0')))
      throw "ErrPop"
    popup.close()
  }

  catch(err)
  {
    if(err=="ErrPop"){
      msj = "Esta Pagina funciona con ventanas emergentes recuerde habilitarlas"
   	   alert(msj);	
   }
    else
    {
      msj1="Hubo un erro en la página.nn"
      msj1+="Descripción del error: " + err.description + "nn"
     }
  }
}

function salta(e)
{
tecla = (document.all) ? e.keyCode : e.which
	if(tecla==13)
	{
	  //window.e.keyCode=0; 
	  document.getElementById("txt_clave").focus();
	}
}
function enviar(e,conf)
{
tecla = (document.all) ? e.keyCode : e.which
if(tecla==13 || conf==1)
{
  if (document.getElementById("txt_usuario").value !="" & document.getElementById("txt_clave").value != "") {
  	document.getElementById("confirmacion").value =1;
	document.forma.submit();
  }
  else 
  {
	  	alert("Datos Incompletos");
		document.getElementById("txt_usuario").focus();
  }
  return false;
}
}
DetectaBloqueoPops();
</script>
<script language="javascript">
function olvido_clave()
{
	var url="olvido_clave.php";
	window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")

}
</script>
<style type="text/css">
td img {display: block;}
</style>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<form  action="inicio.php"  name="forma" method="post" >
<table  border="0" align="center" cellpadding="0" cellspacing="0" >  
  <tr>
    <td colspan="3"  >
	<img src="imagenes/cabezotelog.jpg" width="892" height="380">	</td>
  </tr>
  <tr>
    <td width="544"  align="left"><img src="imagenes/logoparte1.jpg" ></td>
    <td width="216"   valign="bottom" >
      <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="6"><table width="80%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="5"><img name="registro" src="imagenes/registro.gif" width="212" height="42" border="0" id="registro" alt="" /></td>
              </tr>
            <tr>
              <td width="9%" rowspan="3" align="left" valign="top"><img src="imagenes/login_izq.png"></td>
			  <!--TABLA INTERNA DE USUARIO Y CLAVE-->
              <td colspan="3" align="left"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="53" class="textotabla1">Usuario</td>
                   <td width="97" class="textotabla1"><input name="txt_usuario" id="txt_usuario" type="text" class="textotabla01" size="10" onKeyDown="salta(event)"/></td>
                </tr>
                <tr>
                  <td class="textotabla1">Clave</td>
                    <td class="textotabla1"><input name="txt_clave" id="txt_clave" type="password" class="textotabla01" size="10" onKeyDown="enviar(event,0)" />
<input name="confirmacion" type="hidden" id="confirmacion" value="0" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><img src="imagenes/entrar_boton.png" width="116" height="29" onClick="enviar(event,1)" style="cursor:pointer"></td>
                  </tr>
              </table></td>
              <!--FIN TABLA INTERNA DE USUARIO Y CLAVE-->
			  <td width="13%" rowspan="3" valign="top" ><img src="imagenes/login_der.png" height="133"></td>
            </tr>
            
            <tr>
              <td colspan="3" valign="bottom" >&nbsp;</td>
              </tr>
            <tr>
              <td colspan="3" ><img src="imagenes/entrar_base.png" width="166"></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td width="7%">&nbsp;</td>
              <td width="71%" align="right"><img src="imagenes/olvido_clave.png" width="108" height="17" onClick="olvido_clave()" style="cursor:pointer"></td>
              <td colspan="2">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        
        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>
      </table></td>
    <td width="100"  ><img src="imagenes/logoparte2.jpg" width="100" height="213"></td>
  </tr>
  <tr>
  <td colspan="3" align="right">
        <FONT color="#BDBCBA" size="1" ><STRONG style="text-align:right; font-family:Verdana, Arial, Helvetica, sans-serif">Copyright  
        <?=date("Y");?>&nbsp;
Net-kargo        , Dise&ntilde;o y Desarrollo 
      Kaome</STRONG></FONT>          </div>  </td>
  <!--INFORMACION DE DESARROLLO-->
  <!--FIN INFORMACION DE DESARROLLO-->
  </tr>
</table>
</form>
<script language="javascript">
<?
if($refresca==1)
{
?>
document.forma.submit()
<?
}
?>
document.forma.txt_usuario.focus();
</script>