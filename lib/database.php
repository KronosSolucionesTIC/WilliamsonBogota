<?php

if (file_exists("conf/clave.php")){ 
	include("conf/clave.php");
}

if (file_exists("../conf/clave.php")){ 
	include("../conf/clave.php");
}


$db= new  Database();

class Database
{
//conexion a la base de datos en internet

    /*var $Host = "www.kaome.com";
    var $Database = "kaomeco_williamson";
    var $User     = "kaomeco";
    var $Password = "EQwP8Ngq4kR3";
    var $R = array();
    var $Row;
    var $Errno    = 0;
    var $Error    = "";
    var $Link_ID  = 0;
    var $Query_ID = 0;*/
	
	
//conexion a base de datos local 
    var $Host = "localhost";
    var $Database = "williamson";
    var $User     = "root";
    var $Password = "root";
    var $R = array();
    var $Row;
    var $Errno    = 0;
    var $Error    = "";
    var $Link_ID  = 0;
    var $Query_ID = 0;

	
	function servidor()
	{
		return $_SERVER['SERVER_NAME']."/".strtok ( dirname( $_SERVER['PHP_SELF'] ), '/' );
	}

    function Database($query = "")
    {
       @$this->query($query);
    }

    function connect($Database = "", $Host = "", $User = "", $Password = "")
    {
        if ("" == $Database)
            $Database = $this->Database;
        if ("" == $Host)
            $Host     = $this->Host;
        if ("" == $User)
            $User     = $this->User;
        if ("" == $Password)
            $Password = $this->Password;
        if ( 0 == $this->Link_ID )
        {
            $this->Link_ID=mysql_connect($Host, $User, $Password);
            if (!$this->Link_ID)
            {
                $this->halt("Database connect($Host, $User, \$Password) failed.");
                return 0;
            }
            if (!@mysql_select_db($Database,$this->Link_ID))
            {
                $this->halt("Cannot use database ".$this->Database);
                return 0;
            }
        }
        return $this->Link_ID;
    }

    function free()
    {
        @mysql_free_result($this->Query_ID);
        $this->Query_ID = 0;
    }
	
	
	
    function html_codigo($String)
    {
		$String=str_replace("�","&Aacute;",$String);
		$String=str_replace("�","&Agrave;",$String);
		$String=str_replace("�","&Eacute;",$String);
		$String=str_replace("�","&Egrave;",$String);
		$String=str_replace("�","&Iacute;",$String);
		$String=str_replace("�","&Igrave;",$String);
		$String=str_replace("�","&Oacute;",$String);
		$String=str_replace("�","&Ograve;",$String);
		$String=str_replace("�","&Uacute;",$String);
		$String=str_replace("�","&Ugrave;",$String);
		$String=str_replace("�","&aacute;",$String);
		$String=str_replace("�","&agrave;",$String);
		$String=str_replace("�","&eacute;",$String);
		$String=str_replace("�","&egrave;",$String);
		$String=str_replace("�","&iacute;",$String);
		$String=str_replace("�","&igrave;",$String);
		$String=str_replace("�","&oacute;",$String);
		$String=str_replace("�","&ograve;",$String);
		$String=str_replace("�","&uacute;",$String);
		$String=str_replace("�","&ugrave;",$String);
		$String=str_replace("�","&Auml;",$String);
		$String=str_replace("�","&Acirc;",$String);
		$String=str_replace("�","&Euml;",$String);
		$String=str_replace("�","&Ecirc;",$String);
		$String=str_replace("�","&Iuml;",$String);
		$String=str_replace("�","&Ouml;",$String);
		$String=str_replace("�","&Ocirc;",$String);
		$String=str_replace("�","&Uuml;",$String);
		$String=str_replace("�","&Ucirc;",$String);
		$String=str_replace("�","&auml;",$String);
		$String=str_replace("�","&acirc;",$String);
		$String=str_replace("�","&euml;",$String);
		$String=str_replace("�","&ecirc;",$String);
		$String=str_replace("�","&iuml;",$String);
		$String=str_replace("�","&icirc;",$String);
		$String=str_replace("�","&ouml;",$String);
		$String=str_replace("�","&uuml;",$String);
		$String=str_replace("�","&ucirc;",$String);
		$String=str_replace("�","&aring;",$String);
		$String=str_replace("�","&Ntilde;",$String);
		$String=str_replace("�","&Otilde;",$String);
		$String=str_replace("�","&atilde;",$String);
		$String=str_replace("ñ","&ntilde;",$String);
		$String=str_replace("�","&Yacute;",$String);
		$String=str_replace("�","&otilde;",$String);
		$String=str_replace("�","&yacute;",$String);
        return ($String);
    }


    function query($Query_String)
    {
		$Query_String=$this->html_codigo($Query_String);

        if ($Query_String == "")
            return 0;
        if (!$this->connect())
        {
            return 0;
        };
        if ($this->Query_ID)
        {
			for($f=0;$f<@mysql_num_fields($this->Query_ID);$f++)
			{
				eval("unset(\$this->".mysql_field_name($this->Query_ID,$f).");");
			}
            $this->free();
        }
        $this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
        $this->Row = 0;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        if (!$this->Query_ID)
        {
            $this->halt("Invalid SQL: ".$Query_String);
        }
        return $this->Query_ID;
    }
	
	function argumento($sql,$column){
		if(!$link=mysql_connect($Host, "root",  "")){
			echo "Error: Seleccionando el servidor";
			exit();
		}

		if(!mysql_select_db("sis_dis",$link)){
			echo "Error: Seleccionando la Base de Datos";
			exit();
		}
		$result = mysql_query($sql,$link);
		if($fila = mysql_fetch_assoc($result)){
			echo $fila[$column];
		}
		mysql_close($link);
		return $valor;
	}	
	
	
    function next_row()
    {
        if (!$this->Query_ID)
        {
            $this->halt("next_record called with no query pending.");
            return 0;
        }
        $this->R = @mysql_fetch_array($this->Query_ID);
		if(is_array($this->R))
			for($f=0;$f<mysql_num_fields($this->Query_ID);$f++)
				eval("\$this->".mysql_field_name($this->Query_ID,$f)."=stripslashes(\"".addslashes($this->R[$f])."\");");
		else
			for($f=0;$f<mysql_num_fields($this->Query_ID);$f++)
				eval("unset(\$this->".mysql_field_name($this->Query_ID,$f).");");
        $this->Row   += 1;
        $this->Errno  = mysql_errno();
        $this->Error  = mysql_error();
        return is_array($this->R);
    }
    
    function import_row($arr)
    {
        if (!$this->Query_ID)
        {
            $this->halt("import_record called with no query pending.");
            return 0;
        }
        $this->R = @mysql_fetch_array($this->Query_ID);
		if(is_array($this->R))
			for($f=0;$f<mysql_num_fields($this->Query_ID);$f++)
                if(isset($arr[mysql_field_name($this->Query_ID,$f)."_img"]))
                {
                    if($arr[mysql_field_name($this->Query_ID,$f)."_del"])
                        eval("\$this->".mysql_field_name($this->Query_ID,$f)."=\"\";");
                    elseif($arr[mysql_field_name($this->Query_ID,$f)]&&$arr[mysql_field_name($this->Query_ID,$f)]!="none")
                    {
                        $tmpname=tempnam("grafika/","tmp");
                        copy($arr[mysql_field_name($this->Query_ID,$f)],$tmpname);
                        eval("\$this->".mysql_field_name($this->Query_ID,$f)."=\$tmpname;");
                    }
                    else
                        eval("\$this->".mysql_field_name($this->Query_ID,$f)."=\$arr[\"".mysql_field_name($this->Query_ID,$f)."_img\"];");
                }
                else
                {
                    eval("\$this->".mysql_field_name($this->Query_ID,$f)."=stripslashes(\$arr[\"".mysql_field_name($this->Query_ID,$f)."\"]);");
                }
            
		else
			for($f=0;$f<mysql_num_fields($this->Query_ID);$f++)
				eval("unset(\$this->".mysql_field_name($this->Query_ID,$f).");");
        $this->Row   += 1;
        $this->Errno  = mysql_errno();
        $this->Error  = mysql_error();
        return is_array($this->R);
    }

    function seek($pos = 0)
    {
        $status = @mysql_data_seek($this->Query_ID, $pos);
        if ($status)
            $this->Row = $pos;
        else
        {
            $this->halt("seek($pos) failed: result has ".$this->num_rows()." rows");
            @mysql_data_seek($this->Query_ID, $this->num_rows());

            $this->Row = $this->num_rows;
            return 0;
        }
        return 1;
    }

    function affected_rows()
    {
        return @mysql_affected_rows($this->Link_ID);
    }

    function num_rows()
    {
        return @mysql_num_rows($this->Query_ID);
    }

    function insert_id()
    {
        return @mysql_insert_id($this->Link_ID);
    }

    function num_fields()
    {
        return @mysql_num_fields($this->Query_ID);
    }

    function get_field($Name)
    {
        return $this->R[$Name];
    }

    function halt($msg)
    {
        $this->Error = @mysql_error($this->Link_ID);
        $this->Errno = @mysql_errno($this->Link_ID);
    }
	
	function close()
	{
		$this->free();
		mysql_close($this->Link_ID);
	}

}
function mensaje_pie($mensaje)
{		
		$mensaje .="
		<br>
		<p style='border-top: 1px solid rgb(204, 204, 204); background-color: rgb(246, 246, 246); color: rgb(136, 136, 136); font-family: Arial,Sans-serif; font-size: 11px;'><strong>Si usted maneja Outlook por favor habilite los links emergentes</strong><br/>
		Copyright Sistema Net-Kargo  @".date("z0m0y0H0i0s")." || www.kaome.com"."
		</p>";
		return $mensaje;

}

 function buscar_configuracion($parametro){
	$archivo_conf = "conf.ini";
	$lines = file($archivo_conf); 
	foreach ($lines as $line_num => $line) {
		$datos = explode("=", $line); 
		
		if($datos[0]==$parametro) {
			
			$valor1 = explode("[", $line); 
			
			$valor1 = explode("];", $valor1[1]); 
			$valor= $valor1[0];
			
		}		
	}
	return $valor;
  }
  
 
function envios($mensaje,$correo,$asunto,$nombre_nombre) 
{   
	$correos_mas= split(",",$correo);
		for($i=0 ; $i<=count($correos_mas); $i++ )
		{
			 correo_windows($correos_mas[$i],$asunto,$mensaje);
		} 


}
function correo_windows($mails,$asunto,$body){
	//echo  "si llegoooo";
require_once('class.phpmailer.php');

$mail             = new PHPMailer();
$body             = $body;
$body             = eregi_replace("[\]",'',$body);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 25;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "ascomintcomercial@gmail.com"; // SMTP account username
$mail->Password   = "7895123ascomint";        // SMTP account password
$mail->SetFrom('ascomintcomercial@gmail.com', 'www.ascomint.com.co');
$mail->Subject    = $asunto;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
//$mail->SMTPSecure   = "ssl";
//http://forums.web2project.net/viewtopic.php?t=1650

$address ="ascomintcomercial@gmail.com";
$address =$mails;
//$mail->AddAddress($address,"");
$mail->AddAddress($address, $address);


//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {

  //echo "Mailer Error: " . $mail->ErrorInfo;
 
} else {
	//$a=1;
  //echo "Message sent!";
}


	
}


function buscar_firma(){
$dbemail->query("SELECT nom_usu,(select nom_car from cargo where cod_car=car_usu) AS cargo, nom_suc,email_suc, tel_suc, fax_suc,direccion_suc, nom_ciu, (select nom_pais from pais where cod_pais=cod_pais_ciu) AS pais FROM sucursal INNER JOIN usuario ON cod_ciud_suc=ciu_usu INNER JOIN ciudad ON cod_ciu=ciu_usu WHERE cod_usu=$cod_usu_pr");
$dbemail->next_row();
$mensaje.="<br><strong>$dbemail->nom_usu</strong><br>$dbemail->cargo<br>
<strong>$dbemail->nom_suc</strong><br>Mail: <a href='mailto:$dbemail->email_suc'>$dbemail->email_suc</a><br>
Web: <a href='http://".$_SERVdddER['SERVER_NAME']."/index.php' target='_blank'>".$_SERVER['SERVER_NAME']."</a><br>Tel: $dbemail->tel_suc ";
if($dbemail->fax_suc!="") $mensaje.="Fax: $dbemail->fax_suc";
$mensaje.="<br>$dbemail->direccion_suc<br>$dbemail->nom_ciu - $dbemail->pais<br>";

return $firma;

}

?>
