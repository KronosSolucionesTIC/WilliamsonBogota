<?
function envios_clave($codigo_usu,$correo_usu,$cedula_usu,$nombre_usu,$cargo_usu,$login, $clave)
{
//include('../lib/parametros.php');

 $mensaje =$cab_correo.$mensaje;
 
 $mensaje.="
	<table width='690' border='0' align='center' cellpadding='3' cellspacing='3'>
     ";
	 
$mensaje.="<tr>
        <td class='normal2'><p>Estimado(a):<br/>
          ".$nombre_usu."<br/>".$cargo_usu."<br/>
        </p></td>
      </tr>
	  <tr>
        <td class='normal2'>NET-KARGO le envia este correo para recordarle sus datos de ingreso al aplicativo<br/><br/>Nombre de usuario: ".$login."<br/><br/>Clave: ".$clave."</td>
      	</tr>
	  ";
	  
//Descripcion del correo
$mensaje.=" <tr>
        <td  class='normal2' >
		<div align='center'>";
		


		
$mensaje.="	<br/><br/></div><br/>Reciba un cordial saludo,<br/><br/>NET-KARGO";

//echo $mensaje;

//exit;
//fin de la tabla
"</td>
        </tr>
		</table>

";

 
 $mensaje =$mensaje.$pie_correo;
$asunto='Olvido su contraseña';
	
envios($mensaje,$correo_usu, $asunto,$nombre_usu);
}
?>