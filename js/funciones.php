<?
session_start();
$codigo_usuario= $global[2];


function paginar($sql) {
	$db= new  Database();
	$db->query($sql);
return  $db->num_rows();
}


function reemplazar($busquedas) {
	$busquedas=str_replace(" like '%","|",$busquedas);
$busquedas=str_replace("%'","",$busquedas);
return $busquedas;
}


function combo_inm($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) 
{
$db= new  Database();
$sql="select * from ".$tabla." ORDER BY cod_inmuebles";
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'>";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value='".$db->$valor."' selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value='".$db->$valor."'>".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}
//funcion para listar la ciudad
function consultar($cedula) 
{
$db= new  Database();
$sql="select * from ".$tabla." ORDER BY cod_inmuebles";
$db->query($sql);
$db->close();
}


function reemplazar_1($busquedas) {
$busquedas=str_replace("|"," like '%",$busquedas);
$busquedas=$busquedas."%'";
return $busquedas;
}

function buscar_posicion_dato($vec_posicion,$dato)
{
	$posicion=0;
	for($i=0;$i<count($vec_posicion);$i++)
	{
		if($vec_posicion[$i]==$dato)
		{
			$posicion=$i;
		}
	}
return $posicion;
}

function  kardex($operador, $referencia,$cantidad,$costo){

	$kardex = new Database();
    $sql = "select count(*)  as existe from kardex where cod_t_insumo_kar=$referencia";
	$kardex->query($sql);
	if($kardex->next_row()){ 
    $existe=$kardex->existe;
	}
		
	
	
	if ($operador=="suma")
	{
		if ($existe==0){ // insertar y sumar
			$sql = "INSERT INTO kardex (cod_t_insumo_kar, cant_kar, costo_kar) VALUES('$referencia','$cantidad', '$costo')";
			$kardex->query($sql);
			//escribe_sql($sql);
			
		}
		else{ // actualizar y sumar
			$sql = "select cant_kar as saldo from kardex where cod_t_insumo_kar='$referencia'";
			$kardex->query($sql);
			if($kardex->next_row()){ 
				$saldo=$kardex->saldo;
			}
			$cantidad = $cantidad + $saldo;
			$sql = "UPDATE kardex SET cant_kar= $cantidad  WHERE  cod_t_insumo_kar='$referencia'";
			$kardex->query($sql);
			escribe_sql($sql);
			
		}
	}
	
	
	if ($operador=="resta")
	{
		$sql = "select cant_kar as saldo from kardex where cod_t_insumo_kar='$referencia'";
		$kardex->query($sql);
		if($kardex->next_row()){ 
			$saldo=$kardex->saldo;
		}
		
		$cantidad = $saldo - $cantidad ;
		$sql = "UPDATE kardex SET cant_kar= $cantidad  WHERE  cod_t_insumo_kar='$referencia'";
		$kardex->query($sql);
		escribe_sql($sql);
	}
}

function escribe_sql($sql){
 // $ar=fopen("sincronia/sql_$codigo_usuario.txt","a") or die("Problemas en la creacion");
 // $sql="@@@@@@@@".$sql;
  //fputs($ar,"$sql");
  //fclose($ar);
}


function combo($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) 
{
$db= new  Database();
$sql="select * from ".$tabla." order by  ".$nombre;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'>";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value='".$db->$valor."' selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value='".$db->$valor."'>".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_deudor($nombre_obj,$valor_edicion) 
{

$dbdatose= new  Database();
 $sqle="SELECT cod_cli , concat(nom1_cli,' ',nom2_cli,' ',apel1_cli ,' ',apel2_cli) AS nombre FROM codeudor";
$dbdatose->query($sqle);		
echo "<select name='$nombre_obj' id='$nombre_obj' class='SELECT'>";
while ($dbdatose->next_row()){
	if($valor_edicion==$dbdatose->cod_deudor) 
		echo "<option value='$dbdatose->cod_cli' selected='selected' >$dbdatose->nombre</option>"; 
	else
		echo "<option value='$dbdatose->cod_cli' >$dbdatose->nombre</option>"; 
} echo "<option value='0' selected='selected' >Seleccione..</option>";
echo "</select>";   

$dbdatose->close();
}




function comboculto($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) 
{
$db= new  Database();
$sql="select * from ".$tabla;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  disabled=' disabled' >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value='".$db->$valor."' selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value='".$db->$valor."'>".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}



//combo clientes






function combo_clientes($nombre_obj,$valor_edicion) 
{

$dbdatose= new  Database();
$sqle="SELECT cod_cli, concat(nom1_cli,' ',nom2_cli,' ',apel1_cli,' ',apel2_cli) AS nombre FROM cliente";
$dbdatose->query($sqle);		
echo "<select name='$nombre_obj' id='$nombre_obj' class='SELECT'>";
while ($dbdatose->next_row()){
	if($valor_edicion==$dbdatose->cod_cliente) 
		echo "<option value='$dbdatose->cod_cli' selected='selected' >$dbdatose->nombre</option>"; 
	else
		echo "<option value='$dbdatose->cod_cli' >$dbdatose->nombre</option>"; 
} echo "<option value='0' selected='selected' >Seleccione..</option>";
echo "</select>";   

$dbdatose->close();
}




function combo_ord($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$orden) 
{
$db= new  Database();
$sql="select * from ".$tabla. $orden;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value='".$db->$valor."' selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value='".$db->$valor."'>".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo_busqueda($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$where ) 
{
$db= new  Database();
$sql="select * from ".$tabla.$where;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT' >";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo_validacion($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) 
{
$db= new  Database();
$sql="select * from ".$tabla;
$db->query($sql);
echo " <select name='".$nombre_obj."' class='SELECT' >";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_almacen($nombre_obj,$valor,$nombre,$valor_edicion,$proyecto) {
	$db= new  Database();
$sql="select * from  almacen where  cod_pro_alm=".$proyecto;
$db->query($sql);
echo " <select name='".$nombre_obj."' class='SELECT'>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo11($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) {
	$db= new  Database();
$sql="select * from ".$tabla;
$db->query($sql);
echo " <select name='".$nombre_obj."' class='SELECT01'>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo_evento($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $orden) 
	{
	
$db= new  Database();
$sql="select ".$valor.", ".$nombre." as nombre  from ".$tabla. " order by ".$orden;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo_evento1($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $orden) 
	{
	
$db= new  Database();
$sql="select ".$valor.", concat(apel1_cli,' ',apel2_cli,' ',nom1_cli,' ',nom2_cli,' - ',cedula_cli) as nombre  from ".$tabla. " order by ".$orden;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}


function combo_evento2($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $orden) 
	{
	
$db= new  Database();
$sql="select ".$valor.", concat(nom1_pac,' ',nom2_pac,' ',apel1_pac,' ',apel2_pac,' - ',cedula_pac) as nombre  from ".$tabla. " order by ".$orden;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_evento3($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento,$where,$orden) 
	{
	
$db= new  Database();
$sql="select ".$valor.", ".$nombre." as nombre  from ".$tabla. "
INNER JOIN clase_equipos ON (clase_equipos.cod_clase = equipos.clase_equipo)
INNER JOIN tipo_equipos ON (tipo_equipos.cod_tipo_equipos = equipos.tipo_equipo) 
WHERE ".$where." order by ".$orden." ASC ";
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_evento_where($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $where) 
	{
$db= new  Database();
$sql="select ".$valor.", ".$nombre." as nombre  from ".$tabla." WHERE ".$where;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_evento_where1($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $where) 
	{
$db= new  Database();
$sql="select *, ".$valor.", ".$nombre." as nombre  from ".$tabla.$where;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
//echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor." >".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_evento_where2($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento,$where,$order) 
	{
$db= new  Database();
$sql="select ".$valor.", ".$nombre." as nombre  from ".$tabla." where ".$where." order by ".$order." desc ";
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_evento_parte($nombre_obj,$tabla,$valor,$nombre,$valor_edicion,$evento, $orden) 
	{
	
$db= new  Database();
$sql="select ".$valor.", concat(desc_partes,'-',nom_clase) as nombre  from ".$tabla." inner join clase_equipos on (clase_equipos.cod_clase = partes.clase_parte) order by ".$orden;
$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_inner($nombre_obj,$tabla,$valor,$nombre,$tabla_relacion,$codigo_relacion,$valor_edicion,$evento, $orden) 
	{
	
	$db= new  Database();
		$sql = "SELECT DISTINCT (".$valor."), ".$nombre." as nombre, ".$tabla_relacion.".".$codigo_relacion."
		FROM ".$tabla."
		INNER JOIN ".$tabla_relacion." ON ".$codigo_relacion." = ".$valor." 
		order by ".$orden."";

$db->query($sql);
echo " <select name='".$nombre_obj."' id='".$nombre_obj."' class='SELECT'  $evento  >";
echo "<option value='0' selected='selected'>Seleccione..</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->nombre."</option>";
}
echo "</select>";
$db->close();
}

function combo_polar($nombre_obj,$valor_edicion) {
	echo " <select name='".$nombre_obj."' class='SELECT'>";
	if($valor_edicion=="POSITIVO") 
		echo "<option value='POSITIVO' selected='selected'>POSITIVO</option>";
	else
		echo "<option value='POSITIVO'>POSITIVO</option>";
	if($valor_edicion=="NEGATIVO") 
		echo "<option value='NEGATIVO' selected='selected'>NEGATIVO</option>";	
	else
		echo "<option value='NEGATIVO'>NEGATIVO</option>";	
	if($valor_edicion=="NEUTRO") 
		echo "<option value='NEUTRO' selected='selected'>NEUTRO</option>";	
	else
		echo "<option value='NEUTRO'>NEUTRO</option>";	
	echo "</select>";
	}


function inicio() {
	echo '<script type="text/javascript" src="calendario/javascript/calendar.js"></script>
	<script type="text/javascript" src="calendario/javascript/calendar-es.js"></script>
	<script type="text/javascript" src="calendario/javascript/calendar-setup.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="calendario/styles/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link href="css/styles.css" rel="stylesheet" type="text/css" /> 
	<script type="text/javascript" src="js/funciones.js"></script> ';
}


function insertar($tabla,$compos,$valores) {
	$sql="insert into $tabla $compos values $valores ";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->affected_rows();
	$db->close();
	auditoria ($tabla,1);
	return $retorno;
}


function editar($tabla,$compos,$where_campo, $where_valor) {
	$sql="UPDATE  $tabla  set $compos where $where_campo=$where_valor ";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->Errno;
	if ($retorno==0)
		$retorno=1;
	$db->close();
	auditoria ($tabla,2);
	return $retorno;
}

function editar2($tabla,$campos,$where_campo, $where_valor,$where_campo2, $where_valor2) {
	$sql="UPDATE  $tabla  set $campos where $where_campo=$where_valor  and $where_campo2 = $where_valor2 ";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->Errno;
	if ($retorno==0)
		$retorno=1;
	$db->close();
	auditoria ($tabla,2);
	return $retorno;
}

function eliminar($tabla, $codigo, $campo) {
	$sql="DELETE FROM $tabla WHERE $campo=$codigo ";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->affected_rows();
	$db->close();
	auditoria ($tabla,3);
	return $retorno;
}

function eliminar2($tabla, $codigo1, $campo1,$codigo2, $campo2,$codigo3, $campo3) {
	$sql="DELETE FROM $tabla WHERE $campo1=$codigo1 AND $campo2=$codigo2 AND $campo3=$codigo3";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->affected_rows();
	$db->close();
	auditoria ($tabla,3);
	return $retorno;
}

function eliminar_dcampo($tabla, $codigo1,$codigo2, $campo1,$campo2) {
	$sql="DELETE FROM $tabla WHERE $campo1=$codigo1 and $campo2=$codigo2";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->affected_rows();
	$db->close();
	auditoria ($tabla,3);
	return $retorno;
}

function auditoria ($tabla, $codigo) {
	$codigo_usuario=$_SESSION["global"][2];
	if (empty($codigo_usuario))
		$codigo_usuario=0;
	$codigo_proyecto=1;
	$fecha= date("Y-m-d H:i:s");
	$sql="INSERT INTO auditoria VALUES (NULL,$codigo_usuario,'$tabla','$fecha',$codigo,$codigo_proyecto) ";
	$db= new  Database();
	$db->query($sql);
}


function completar($codigo,$tam) {
	$a=strlen($codigo);
for ($i=$a ; $i<$tam; $i++) {
	$codigo="0".$codigo;
}
return  $codigo;
}


function insertar_maestro($tabla,$compos,$valores) {
	 $sql="insert into $tabla $compos values $valores ";
	$db= new  Database();
	$db->query($sql);
	$retorno= $db->insert_id();
	$db->close();
	auditoria ($tabla,1);
	return $retorno;
}


function combo_ref($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) {
	$db= new  Database();
$sql="select * from ".$tabla;
$db->query($sql);
echo " <select name='".$nombre_obj."' class='SELECT01' onchange=\"cargar('0','$nombre_obj','0')\">";
echo" <option value=0>Seleccione</option>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}


function actual_insertar($referencia,$cantidad){
$sql=" SELECT act_ref + ".$cantidad."  as total FROM referencia WHERE  cod_ref=$referencia ";
$db= new  Database();
$db->query($sql);
$db->next_row();
$cant_actual=$db->total;
//$cant_actual=$db->argumento($sql,"total");
$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$referencia ;
$db->query($sql);
}


function actual_insertar_debitar($referencia,$cantidad){
$sql=" SELECT act_ref - ".$cantidad."  as total FROM referencia WHERE  cod_ref=$referencia ";
$db= new  Database();
$db->query($sql);
$db->next_row();
$cant_actual=$db->total;
//$cant_actual=$db->argumento($sql,"total");
$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$referencia ;
$db->query($sql);
}


function reverzar_referencias_compras ($movimineto) {
	$sql =" SELECT cod_ref_mae, cant_mae FROM maestro_movimiento  WHERE cod_mov_mae=$movimineto and cod_tip_mae=2";
	$dbdatos= new  Database();	
	$dbdatos->query($sql);
	$dbcos= new  Database();
	$dbcos1= new  Database();
	while($dbdatos->next_row())
	{	
		$sql_revertido = " SELECT act_ref -".$dbdatos->cant_mae." as total FROM referencia WHERE cod_ref=".$dbdatos->cod_ref_mae;
		$dbcos= new  Database();
		$dbcos->query($sql_revertido);
		$dbcos->next_row();
		$cant_actual=$dbcos->total;
		$dbcos1->query($sql);
		$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$dbdatos->cod_ref_mae ;
		$dbcos1->query($sql);	
	}
	$dbcos1->query($sql);
	$sql = "delete from maestro_movimiento WHERE cod_mov_mae=$movimineto  and cod_tip_mae=2" ;
	$dbcos1->query($sql);
}


function reverzar_referencias_salidas ($movimineto) {
	$sql =" SELECT cod_ref_mae, cant_mae * -1 as cant_mae FROM maestro_movimiento  WHERE cod_mov_mae=$movimineto and cod_tip_mae=7";
	$dbdatos= new  Database();	
	$dbdatos->query($sql);
	$dbcos= new  Database();
	$dbcos1= new  Database();
	while($dbdatos->next_row())
	{	
		$sql_revertido = " SELECT act_ref +".$dbdatos->cant_mae." as total FROM referencia WHERE cod_ref=".$dbdatos->cod_ref_mae;
		$dbcos= new  Database();
		$dbcos->query($sql_revertido);
		$dbcos->next_row();
		$cant_actual=$dbcos->total;
		$dbcos1->query($sql);
		$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$dbdatos->cod_ref_mae ;
		$dbcos1->query($sql);	
	}
	$dbcos1->query($sql);
	$sql = "delete from maestro_movimiento WHERE cod_mov_mae=$movimineto  and cod_tip_mae=7" ;
	$dbcos1->query($sql);
	
	//BORROA MAESTRO SERIALES
	$sql = "delete from maestro_serial WHERE cod_mov_ser=$movimineto and tip_mov_ser=7 " ;
	$dbcos1->query($sql);
}



function reverzar_referencias_ingresos ($movimineto) {
	$sql =" SELECT cod_ref_mae, cant_mae FROM maestro_movimiento  WHERE cod_mov_mae=$movimineto and cod_tip_mae=3";
	$dbdatos= new  Database();	
	$dbdatos->query($sql);
	$dbcos= new  Database();
	$dbcos1= new  Database();
	while($dbdatos->next_row())
	{	
		$sql_revertido = " SELECT act_ref -".$dbdatos->cant_mae." as total FROM referencia WHERE cod_ref=".$dbdatos->cod_ref_mae;
		$dbcos->query($sql_revertido);
		$dbcos->next_row();
		$cant_actual=$dbcos->total;
		$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$dbdatos->cod_ref_mae ;
		$dbcos1->query($sql);	
	}
	$dbcos1->query($sql);
	$sql = "delete from maestro_movimiento WHERE cod_mov_mae=$movimineto  and cod_tip_mae=3" ;
	$dbcos1->query($sql);
}

function reverzar_referencias_traslado ($movimineto) {
	$dbcos1= new  Database();
	//BORROA MAESTRO SERIALES
	$sql = "delete from maestro_serial WHERE cod_mov_ser=$movimineto and tip_mov_ser=5 " ;
	$dbcos1->query($sql);
	//BORROA MAESTRO MOVIMIENTOS
	$sql = "delete from maestro_movimiento WHERE cod_mov_mae=$movimineto and cod_tip_mae=5 " ;
	$dbcos1->query($sql);
	//BORROA TRASLADOS
	$sql = "delete from traslado WHERE cod_tras=$movimineto  " ;
	$dbcos1->query($sql);
}

function sumar_referencias ($referencia,$cantidad ) {
	$dbcos= new  Database();
	$sql = " SELECT act_ref +".$cantidad." as total FROM referencia WHERE cod_ref=".$referencia;

	$dbcos->query($sql);
	$dbcos->next_row();
	$cant_actual=$dbcos->total;
	
	$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$referencia ;
	$dbcos->query($sql);	

}


function restar_referencias ($referencia,$cantidad ) {
	$dbcos= new  Database();
	$sql = " SELECT act_ref -".$cantidad." as total FROM referencia WHERE cod_ref=".$referencia;
	$dbcos->query($sql);
	$dbcos->next_row();
	$cant_actual=$dbcos->total;
	$sql = "UPDATE referencia SET act_ref=".$cant_actual." WHERE  cod_ref=".$referencia ;
	$dbcos->query($sql);	

}


function combo_movil($nombre_obj,$valor,$nombre,$valor_edicion,$proyecto,$activo) {
	$db= new  Database();
	$sql="select * from  moviles ";
	$db->query($sql);
	
	if ($activo=="") { echo " <select name='".$nombre_obj."' class='SELECT'>"; }
	else { echo " <select name='".$nombre_obj."'  disabled='$activo'  class='SELECT'>"; }
	
	echo" <option value=0>Seleccione</option>";
	while($db->next_row()) {
		if($valor_edicion==$db->$valor) 
			echo" <option value=".$db->$valor." selected='selected'>".$db->$nombre."</option>";
		else
			 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
	}
	echo "</select>";
	$db->close();
}

function combo_tercero($nombre_obj,$tabla,$valor,$nombre,$valor_edicion) {
$db= new  Database();
$sql="select cod_ter , concat(nom_ter,concat(' ', ape_ter)) AS nombre  from ".$tabla;
$db->query($sql);
echo " <select name='".$nombre_obj."' class='SELECT'>";
while($db->next_row()) {
	if($valor_edicion==$db->$valor) 
		echo" <option value=".$db->$valor." selected='selected'>".$db->nombre."</option>";
	else
		 echo" <option value=".$db->$valor.">".$db->$nombre."</option>";
}
echo "</select>";
$db->close();
}

function letra_capital($palabra) {
	$palabra=ucwords(strtolower($palabra));
return  $palabra;
}

function convertir_nit($nit) {
	$nit=substr($nit,0,strlen($nit)-1)."-".substr($nit,-1,1);
	$rutTmp = explode( "-", $nit );
    return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];

}
function convertir_cedula($cc) {
	$rutTmp = explode( "-", $cc );
    return number_format( $rutTmp[0], 0, "", ".");

}

function encripta_url ( $string )
{ 
    $hex = '' ;   
	  for ( $i = 0 ; $i < strlen ( $string ) ; $i ++ )
    { 
        $hex .= dechex ( ord ( $string [ $i ] ) ) ;
    } 
    return "/autenticacion.php?netkargo=".$hex ; 
} 

function encripta_url_2 ( $string )
{ 
    $hex = '' ;   
	  for ( $i = 0 ; $i < strlen ( $string ) ; $i ++ )
    { 
        $hex .= dechex ( ord ( $string [ $i ] ) ) ;
    } 
    return "/autenticacion1.php?netkargo=".$hex ; 
} 
function encripta_archivo ( $string )
{ 
    $hex = '' ;   
	  for ( $i = 0 ; $i < strlen ( $string ) ; $i ++ )
    { 
        $hex .= dechex ( ord ( $string [ $i ] ) ) ;
    } 
    return "/archivo.php?netkargo=".$hex ; 
} 


function sacar_url($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

function renombrar_archivo($file){
	$fecha=date("Y-m-d").date("h").date("i").date("s");
	$nombre_archivo=$file;
	$archivo=explode('.',$nombre_archivo);
	$nuevo_archivo= $archivo[0].'_'.$fecha.'.'.$archivo[1];
	//rename($nombre_archivo,'../documentos/'.$nuevo_archivo);
	return $nuevo_archivo;
}

function actualizar_tarifa_costo($servicio,$proveedor,$transportista,$origen,$destino,$codigo_item)
{
	$sql="UPDATE  d_costo_tarifario  set estado_dct='INACTIVO' where cod_serv_dct=$servicio and cod_pro_dct=$proveedor and cod_cont_dct=$transportista and cod_origen_dct=$origen and cod_destino_dct=$destino and cod_item_dct=$codigo_item ";
	$db= new  Database();
	$db->query($sql);
	$db->close();
	
}

function consultar_maestra_costo($servicio,$proveedor,$transportista,$origen,$destino,$codigo_item)
{
	 
	$sql="SELECT count(cod_item_dct) as cantidad_1 FROM d_costo_tarifario where cod_serv_dct=$servicio and cod_pro_dct=$proveedor and cod_cont_dct=$transportista and cod_origen_dct=$origen and cod_destino_dct=$destino and cod_item_dct=$codigo_item and estado_dct='ACTIVO'";
	$db= new  Database();
	$db->query($sql);
	$db->next_row();
	if($db->cantidad_1 >0)
	{
		$existe='si';
	} else 
	{	
		$existe='no';
	}
	//$db->close();
	return $existe;
}

function consultar_maestra_venta($servicio,$proveedor,$transportista,$origen,$destino,$codigo_item)
{
	 
	 $sql="SELECT count(cod_item_dvt) as cantidad_1 FROM d_venta_tarifario where cod_serv_dvt=$servicio and cod_pro_dvt=$proveedor and cod_cont_dvt=$transportista and cod_origen_dvt=$origen and cod_destino_dvt=$destino and cod_item_dvt=$codigo_item and estado_dvt='ACTIVO'";
	
	$db= new  Database();
	$db->query($sql);
	$db->next_row();
	if($db->cantidad_1 >0)
	{
		$existe='si';
	} else 
	{	
		$existe='no';
	}
	//$db->close();
	return $existe;
}

function actualizar_tarifa_venta($servicio,$proveedor,$transportista,$origen,$destino,$codigo_item)
{
	$sql="UPDATE  d_venta_tarifario  set estado_dvt='INACTIVO' where cod_serv_dvt=$servicio and cod_pro_dvt=$proveedor and cod_cont_dvt=$transportista and cod_origen_dvt=$origen and cod_destino_dvt=$destino and cod_item_dvt=$codigo_item ";
	$db= new  Database();
	$db->query($sql);
	$db->close();
	
}

function actualizar_maestra_costo($codigo_maestra){
	$sql="UPDATE  d_costo_aux_tarifario set cod_act_dct=$codigo_maestra where cod_act_dct=-11";
	$db= new  Database();
	$db->query($sql);
	$db->close();
}

function actualizar_maestra_venta($codigo_maestra){
	$sql="UPDATE  d_venta_aux_tarifario set cod_act_dvt=$codigo_maestra where cod_act_dvt=-11";
	$db= new  Database();
	$db->query($sql);
	$db->close();
}

function insertar_masivamente_venta(){
	$sql="INSERT INTO d_venta_tarifario  (cod_item_dvt, cod_serv_dvt, cod_med_dvt, cod_pro_dvt, cod_cont_dvt, cod_origen_dvt, cod_destino_dvt, valor_dvt, cod_act_dvt, estado_dvt) (SELECT cod_item_dvt,cod_serv_dvt,cod_med_dvt,cod_pro_dvt, cod_cont_dvt, cod_origen_dvt, cod_destino_dvt, valor_dvt, cod_act_dvt, estado_dvt FROM d_venta_aux_tarifario );";
	$db= new  Database();
	$db->query($sql);
	$db->close();
}

function insertar_masivamente_costo(){
	$sql="INSERT INTO d_costo_tarifario (cod_item_dct, cod_serv_dct, cod_med_dct, cod_pro_dct, cod_cont_dct, cod_origen_dct, cod_destino_dct, valor_dct, cod_act_dct, estado_dct) (SELECT cod_item_dct,cod_serv_dct,cod_med_dct,cod_pro_dct, cod_cont_dct, cod_origen_dct, cod_destino_dct, valor_dct, cod_act_dct, estado_dct FROM d_costo_aux_tarifario );";
	
	$db= new  Database();
	$db->query($sql);
	$db->close();
}

function actualizar_maestro($servicio,$proveedor,$transportista,$origen,$destino)
{
	$sql="UPDATE  actualizacion_tarifas  set estado_at='INACTIVO' where cod_ser_at=$servicio and cod_prov_at=$proveedor and transport_at=$transportista and origen_at=$origen and destino_at=$destino";
	$db= new  Database();
	$db->query($sql);
	$db->close();
}





?>
