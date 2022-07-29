<? 
include("lib/sesion.php");
include("lib/database.php");
?>

<script language="javascript">

function abrir(){

var url="documentos/manual_speed_version_1.pdf";

window.open(url,"ventana","menubar=0,resizable=1,width=800,height=600,toolbar=0,scrollbars=yes")
}

</script>
<BODY>
<table width="200" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><TABLE border="0" align="center" cellpadding="0" cellspacing="0" width="50%" height="50%">
	
	<TR>
		<TD height="214"><IMG src="interna/index/fondoindex.jpg" width="605" height="316" border="0"></TD>
	</TR>
		<TR>
		<TD><img src="imagenes/spacer.gif" width="100%" height="4" /></TD>
	</TR>
	
	<TR><TD align="center" class="index" style="cursor:default"><p><br>
	    <img src="interna/index/space2.jpg" border="0">
	     </p>
	    <p ><FONT color="blue" size="1" ><STRONG style="text-align:center" ><a onClick="abrir()" style='cursor:pointer'>Ir a Manual de Usuario </a> </strong> </font><br>
	      <FONT color="#666666" size="1" ><STRONG style="text-align:center">Copyright  
	      <?=date("Y");?>
	      , Dise&ntilde;o y Desarrollo 
	      Kaome Estudio</STRONG></FONT></p>
	    </p></TD>
		</TR>
</TABLE></td>
    <td>&nbsp;</td>
  </tr>
</table>



</BODY>
</HTML>