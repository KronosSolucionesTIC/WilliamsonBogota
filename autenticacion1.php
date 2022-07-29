<? include("js/funciones.php")?>
<? include("lib/database.php");?>
<?
	$dbdatos= new  Database();
	$url=sacar_url($netkargo);
	$url_1=explode('/',$url);
	$url_2=explode('?',$url_1[1]);
	$action=$url_1[0].'/'.$url_2[0];
	$campo_variable=str_replace('&','|@',$url_2[1]);
	$campo_variable=explode('|@',$campo_variable);
	$campo1=explode('=',$campo_variable[0]);
	$campo2=explode('=',$campo_variable[1]);
	$nombre_caja_1=$campo1[0];
	$nombre_caja_2=$campo2[0];
	$variable_1=$campo1[1];
	$variable_2=$campo2[1];
?>
<tbody align="center">
<table align="center">
<tr>
<td>
<img src="imagenes/loading.gif" width="184" height="65" align="middle" />
<div align="center" style="display:none">
<form action="<?=$action?>" enctype="multipart/form-data" id="forma" name="forma" method="post">
	<input type="hidden" name="<?=$nombre_caja_1?>" id="<?=$nombre_caja_1?>" value="<?=$variable_1?>" />
	<input type="hidden" name="<?=$nombre_caja_2?>" id="<?=$nombre_caja_2?>" value="<?=$variable_2?>" />
</form>
</div>
</td>
</tr>
<script language="javascript">
document.forma.submit();
</script>
</table>
</tbody>

