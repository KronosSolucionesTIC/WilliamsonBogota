<? include("js/funciones.php")?>
<? include("lib/database.php");?>
<?
	$dbdatos= new  Database();
	$url=sacar_url($netkargo);
	$url_1=explode('/',$url);
	$url_2=explode('?',$url_1[1]);
	$action=$url_1[0].'/'.$url_2[0];
	$url_3=explode('=',$url_2[1]);
	$nombre_caja=$url_3[0];
	$variable=$url_3[1];	
?>
<tbody align="center">
<table align="center">
<tr>
<td>
<img src="imagenes/loading.gif" width="184" height="65" align="middle" />
<div align="center" style="display:none">
<form action="<?=$action?>" enctype="multipart/form-data" id="forma" name="forma" method="post">
	<input type="hidden" name="<?=$nombre_caja?>" id="<?=$nombre_caja?>" value="<?=$variable?>" />
</form>
</div>
</td>
</tr>
<script language="javascript">
document.forma.submit();
</script>
</table>
</tbody>
