<? include("lib/sesion.php")?>

<? include("lib/database.php")?>
  <?  $sql ="SELECT *
			FROM empresa
			WHERE cod_jmc = 1";
	$dbdatos= new  Database();
	$dbdatos->query($sql);
	$dbdatos->next_row(); 
  ?>

 <?
 if ($verifica_seg!=1){
	header ("location:error.html");
	exit;
}

 
$db= new  Database();
$sql="SELECT * FROM usuario WHERE log_usu='$txt_usuario'  AND pas_usu='$txt_clave' ";
$db->query($sql);
	if($db->next_row()) {
			$global[3]=$db->nom_usu; 			
			$global[4]=$db->log_pro;
		    $global[2]=$db->cod_usu;
			//setcookie("global[2]", $db->cod_usu, time() + 86400); 
			//setcookie("global[3]", $db->nom_usu, time() + 86400); 
			//setcookie("global[4]", $db->log_pro, time() + 86400); 

			//$global[3]=$db->nom_usu; 
			//$global[4]=$db->log_pro;  
		}

	if( $db->num_rows()>0 ){
		//header ("location: aplicacion.php");
		/*echo "<script language='javascript'> location.href='aplicacion.php' </script>";*/
		$usu_atu=1;
		
	}
	else {
		/*echo "<script  language='javascript'> alert('Usuario No Autorizado, Rectifique sus Datos , test 2'); window.close();  opener.document.getElementById('val').value=1 </script>";*/
		$usu_atu=0;
	}
	$db->close();
?>


