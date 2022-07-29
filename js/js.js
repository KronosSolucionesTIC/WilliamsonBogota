

//ADICION DE RECOBRO
function agregar_html_recobro(cod_ides,des_recobro,valor,iva_var,val_inicial){
	
	var num = val_inicial;
	var lastRow = document.getElementById('fila_vehiculo_' + num.value);  
	
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_vehiculo_' + num.value;				

						
		//marca 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_vehiculo_" + num.value + "\" value=\""+cod_ides+"\"><INPUT type=\"hidden\"  name=\"des_recobro_" + num.value + "\" value=\""+des_recobro+"\"><span  class=\"textfield01\">" + des_recobro + "</span> ";	
		newRow.appendChild(td);
		
		
		//modelo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"valor_" + num.value + "\" value=\""+valor+"\"><span  class=\"textfield01\">" + valor + "</span> ";	
		newRow.appendChild(td); 
		
		
		
		//discapacidad
		if(iva_var==true){
			var opc= "checked=checked";
			var opc_valor= "1";
		} else {
				opc= "";
			var opc_valor= "0";
		}
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"discapaci_caja_benefi_" + num.value + "\" id=\"discapaci_caja_benefi_" + num.value + "\"  value=\"" + opc_valor + "\" ><INPUT type=\"checkbox\"  name=\"discapaci_benefi_" + num.value + "\" id=\"discapaci_benefi_" + num.value + "\"  value=\"1\" "+ opc +">";	
		newRow.appendChild(td);
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_vehiculo','fila_vehiculo_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}

//FIN INMOBILIARIA VEHICULO




//ADICION DE APROBADORES
function html_adicion_items_aprobadores(usuario_nombre,codigo_usuario){
	var num = document.getElementById('val_inicial_items_aprobacion');
	var lastRow = document.getElementById('fila_items_aprobacion_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_items_aprobacion_' + num.value;				
		
		//nombre del usuario
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_aprobador_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_aprobador_" + num.value + "\" value=\"" + codigo_usuario + "\"> <span  class=\"textfield01\">" + usuario_nombre + "</span> ";	
		newRow.appendChild(td);
						
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_items_aprobacion','fila_items_aprobacion_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}


//ADICION DE ELEMENTOS ENTREGA

function agregar_html_elementos(cod_ides,estado,observaciones,cod_elementos,elementos,val_inicial) {
	
	var num = val_inicial;
	var lastRow = document.getElementById('fila_elementos_' + num.value);  
	
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_elementos_' + num.value;				

		//nombre del elemento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_elemento_" + num.value + "\" value=\""+cod_ides+"\"><span  class=\"textfield01\">" + cod_ides + "</span><INPUT type=\"hidden\"  name=\"elementos_" + num.value + "\" value=\""+elementos+"\"><span  class=\"textfield01\">" + cod_elementos + "</span> ";	
		newRow.appendChild(td);
		
		//estado 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"estado_" + num.value + "\" value=\""+estado+"\"><span  class=\"textfield01\">" + estado + "</span> ";	
		newRow.appendChild(td);
		
		
		//observaciones 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"observaciones_" + num.value + "\" value=\""+observaciones+"\"><span  class=\"textfield01\">" + observaciones + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_elementos','fila_elementos_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}

//FIN ADICION DE ELEMENTOS ENTREGA



//ADICION DE ELEMENTOS RECIBIDO

function agregar_html_elementoss(cod_idess,estados,observacioness,cod_elementoss,elementoss,val_inicial) {
	
	var num = val_inicial;
	var lastRow = document.getElementById('fila_elementoss_' + num.value);  
	
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_elementoss_' + num.value;				

		//nombre del elemento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_elementos_" + num.value + "\" value=\""+cod_idess+"\"><span  class=\"textfield01\">" + cod_idess + "</span><INPUT type=\"hidden\"  name=\"elementoss_" + num.value + "\" value=\""+elementoss+"\"><span  class=\"textfield01\">" + cod_elementoss + "</span> ";	
		newRow.appendChild(td);
		
		//estado 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"estados_" + num.value + "\" value=\""+estados+"\"><span  class=\"textfield01\">" + estados + "</span> ";	
		newRow.appendChild(td);
		
		
		//observaciones 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"observacioness_" + num.value + "\" value=\""+observacioness+"\"><span  class=\"textfield01\">" + observacioness + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_elementoss','fila_elementoss_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}

//FIN ADICION DE ELEMENTOS RECIBIDO




//agregar factura
function Agregar_html_factura ()
{

	var num = document.getElementById('val_inicial');
	var lastRow = document.getElementById('fila_' + num.value);
	
	var soloLectura = "readonly";
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_' + num.value;				

		//tipo de prodcuto
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_insumo_" + num.value + "\" value=\"" + document.getElementById("codigo_insumo").value + "\" > <INPUT type=\"hidden\"  name=\"c_insumo_" + num.value + "\" value=\"" + document.getElementById("c_insumo").value + "\" > <span  class=\"textfield01\">" + document.getElementById("c_insumo").options[document.getElementById("c_insumo").selectedIndex].text +  "</span> ";	
		newRow.appendChild(td);
	
		

		//cantidad referencias
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cantidad_" + num.value + "\" value=\"" + document.getElementById("cantidad").value + "\" ><div align=\"right\">  <span  class=\"textfield01\" align='right'>" + document.getElementById("cantidad").value +  "</span> </div>";	
		newRow.appendChild(td);
		
		var des=parseInt(document.getElementById("cantidad").value);
			
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila_venta('" + newRow.id +"','val_inicial','fila_','" + des + "');\"></div>";
		newRow.appendChild(td);
			
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
		
   //document.getElementById("todocompra").value = parseInt(document.getElementById("todocompra").value)  + parseInt(valor_total_producto);
	//document.getElementById("valor_iva").value = parseInt(document.getElementById("valor_iva").value)  + parseInt(valor_iva_neto);
	//document.getElementById("subtotal").value = parseInt(document.getElementById("todocompra").value) - parseInt(document.getElementById("valor_iva").value);
	document.getElementById("tot_cant_pro").value = parseInt(document.getElementById("tot_cant_pro").value)  + parseInt(des);
	//document.getElementById("supertotal").value = parseInt(document.getElementById("todocompra").value) - parseInt(document.getElementById("descuento").value);

		
	}
}




function removerFila_venta(id,val_inicial,filaName,descuento)
{
	
	
	//resta total neto  compra
	
	document.getElementById("tot_cant_pro").value =parseInt(document.getElementById("tot_cant_pro").value) - parseInt(descuento);
	var num = document.getElementById(val_inicial);
	//REMUEVE EL NODO
	var fila = document.getElementById(id);
	fila.parentNode.removeChild(fila);
	//VALIDA CUAL ES EL ULTIMO ID;
	for(i = 0; i <= num.value; i++){
		var idFila = document.getElementById(filaName + i); 
		if (idFila != null) lastRow = i;
	}
	num.value = lastRow;
}



//FIN  factura



//FIN ADICION DE APROBADORES
//ADICION DE INMUEBLE ARRIENDO
function html_adicion_items_arriendo(consecutivo,codigo_inmueble){
	var num = document.getElementById('val_inicial_items_arriendo');
	var lastRow = document.getElementById('fila_items_arriendo_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_items_arriendo_' + num.value;				
		
		//nombre del usuario
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_inm_arriendo_" + num.value + "\" value=\"" + codigo_inmueble + "\"><INPUT type=\"hidden\"  name=\"consecutivo_" + num.value + "\" value=\"" + consecutivo + "\"> <span  class=\"textfield01\">" + consecutivo + "</span> ";	
		newRow.appendChild(td);
						
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_items_arriendo','fila_items_arriendo_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
	//FIN ADICION INMUEBLE ARRIENDO



//ADICION DE INSUMO NUEVO 


function html_adicion_items_insumo(cod_ides,nonbre_t_insumo,codigo_t_insumo,cant_insumo,costo_und,costo_insumo){
	
	
	var num = document.getElementById('val_inicial_items_insumo');
	var lastRow = document.getElementById('fila_items_insumo_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_items_insumo_' + num.value;				
		
	
		
		//nombre del usuario
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_insumo_" + num.value + "\" value=\"" + cod_ides + "\"><INPUT type=\"hidden\"  name=\"c_insumo_" + num.value + "\" value=\"" + codigo_t_insumo + "\"> <span  class=\"textfield01\">" + nonbre_t_insumo + "</span> ";	
		newRow.appendChild(td);
		
		
		//cantidad
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cantidad_" + num.value + "\" value=\""+cant_insumo+"\"><span  class=\"textfield01\">" + cant_insumo + "</span> ";	
		newRow.appendChild(td); 
		
				
		//costo unidad referencias
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"costo_und_" + num.value + "\" value=\"" + costo_und + "\" > <span  class=\"textfield01\" align='right'>" + costo_und +  "</span>";	
		newRow.appendChild(td);
		
		//costo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"costo_" + num.value + "\" value=\""+costo_insumo+"\"><span  class=\"textfield01\">" + costo_insumo + "</span> ";	
		newRow.appendChild(td); 
		
		
		// boton q quita la fila
		var total_compra_item=parseInt(costo_insumo);
		
		
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila_entrada1('" + newRow.id +"','val_inicial_items_insumo','fila_items_insumo_',"+total_compra_item +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
		
		
		document.getElementById("todocompra").value = parseInt(document.getElementById("todocompra").value) + parseInt(costo_insumo);
		
	}
}
	//FIN ADICION isumo nuevo


function removerFila_entrada1(id,val_inicial_items_insumo,filaName,total_compra)
{
	
	
	//resta total neto  compra
	
	document.getElementById("todocompra").value =parseInt(document.getElementById("todocompra").value) - parseInt(total_compra);
	var num = document.getElementById(val_inicial_items_insumo);
	//REMUEVE EL NODO
	var fila = document.getElementById(id);
	fila.parentNode.removeChild(fila);
	//VALIDA CUAL ES EL ULTIMO ID;
	for(i = 0; i <= num.value; i++){
		var idFila = document.getElementById(filaName + i); 
		if (idFila != null) lastRow = i;
	}
	num.value = lastRow;
}




//ADICION DE INMUEBLE VENTA
function html_adicion_items_venta(consecutivo,codigo_inmueble){
	var num = document.getElementById('val_inicial_items_venta');
	var lastRow = document.getElementById('fila_items_venta_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_items_venta_' + num.value;				
		
		//nombre del usuario
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_inm_venta_" + num.value + "\" value=\"" + codigo_inmueble + "\"><INPUT type=\"hidden\"  name=\"consecutivo_" + num.value + "\" value=\"" + consecutivo + "\"> <span  class=\"textfield01\">" + consecutivo + "</span> ";	
		newRow.appendChild(td);
						
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_items_venta','fila_items_venta_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
	//FIN ADICION INMUEBLE VENTA


//ADICION DE INMUEBLE
function agregar_html_inmueble(cod_ides,direccion,escritura,notaria,fecha,ciudad,ciudadese,matricula,valor,val_inicial){
	
	var num = val_inicial;
	var lastRow = document.getElementById('fila_inmueble_' + num.value);  
	
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_inmueble_' + num.value;				

		//codigo y direccion
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_inmueble_" + num.value + "\" value=\""+cod_ides+"\"><span  class=\"textfield01\">" + cod_ides + "</span> <INPUT type=\"hidden\"  name=\"direccion_" + num.value + "\" value=\""+direccion+"\"><span  class=\"textfield01\">" + direccion + "</span>";	
		newRow.appendChild(td);
		
		//ciudades
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"ciudad_" + num.value + "\" value=\""+ciudadese+"\"><span  class=\"textfield01\">" + ciudad + "</span> ";	
		newRow.appendChild(td); 
		
		
		//matricula
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"matri_inmo_" + num.value + "\" value=\""+matricula+"\"><span  class=\"textfield01\">" + matricula + "</span> ";	
		newRow.appendChild(td); 
	
		
		//escritura
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"escritura_" + num.value + "\" value=\""+escritura+"\"><span  class=\"textfield01\">" + escritura + "</span> ";	
		newRow.appendChild(td);
		
		//notaria 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"notaria_" + num.value + "\" value=\""+notaria+"\"><span  class=\"textfield01\">" + notaria + "</span> ";	
		newRow.appendChild(td);
				
		//fecha
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"fecha_escri_" + num.value + "\" value=\""+fecha+"\"><span  class=\"textfield01\">" + fecha + "</span> ";	
		newRow.appendChild(td); 		
		
		
		//valor hipoteca
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"valor_hipoteca_" + num.value + "\" value=\""+valor+"\"><span  class=\"textfield01\">" + valor + "</span> ";	
		newRow.appendChild(td); 
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_inmueble','fila_inmueble_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
//FIN ADICION DE INMUEBLE

//ADICION DE VEHICULO
function agregar_html_vehiculo(cod_ides,marca,modelo,placa,reserva,reserva_si,val_inicial){
	
	var num = val_inicial;
	var lastRow = document.getElementById('fila_vehiculo_' + num.value);  
	
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_vehiculo_' + num.value;				

						
		//marca 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_vehiculo_" + num.value + "\" value=\""+cod_ides+"\"><INPUT type=\"hidden\"  name=\"marca_" + num.value + "\" value=\""+marca+"\"><span  class=\"textfield01\">" + marca + "</span> ";	
		newRow.appendChild(td);
		
		
		//modelo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"modelo_" + num.value + "\" value=\""+modelo+"\"><span  class=\"textfield01\">" + modelo + "</span> ";	
		newRow.appendChild(td); 
		
		//placa
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"placa_" + num.value + "\" value=\""+placa+"\"><span  class=\"textfield01\">" + placa + "</span> ";	
		newRow.appendChild(td); 		
		
		//reserva dominio
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"reserva_" + num.value + "\" value=\""+reserva_si+"\"><span  class=\"textfield01\">" + reserva + "</span> ";	
		newRow.appendChild(td); 
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_vehiculo','fila_vehiculo_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}

//FIN INMOBILIARIA VEHICULO





//ADICION OFICINA DEL EXTERIOR
function Agregar_html_agente_exterior(nombre,correo, obs)
{

	var num = document.getElementById('val_inicial_contacto');
	var lastRow = document.getElementById('fila_contacto_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_contacto_' + num.value;				
		
		//nombre
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_contacto_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_contacto_" + num.value + "\" value=\"" + nombre + "\"> <span  class=\"textfield01\">" + nombre + "</span> ";	
		newRow.appendChild(td);
		
		//Email
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"mail_contacto_" + num.value + "\" value=\"" + correo + "\"><span  class=\"textfield01\">" + correo + "</span> ";	
		newRow.appendChild(td);
		
		//Observacion
		var td = document.createElement('td');
		td.innerHTML  = "<div style=\"display:none\"><TEXTAREA id=\"descripcion_contacto_" + num.value + "\" name=\"descripcion_contacto_" + num.value + "\" >"+obs+"</TEXTAREA></div><span  class=\"textfield01\">" + obs+ "</span> ";	
		newRow.appendChild(td);
						
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_contacto','fila_contacto_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
//FIN ADICION DE OFICINA DEL EXTERIOR

//ADICION DE CONTACTOS FICHA
function Agregar_html_item_ficha(nombre_servicio,codigo_servicio,pais_origen,codigo_pais_origen,ciudad_origen,codigo_ciudad_origen,pais_destino,codigo_pais_destino,ciudad_destino,codigo_ciudad_destino,via_transporte, cant,frecuencia,tipo_negocio,mercancia,obs)
{

	var num = document.getElementById('val_inicial_item_ficha');
	var lastRow = document.getElementById('fila_item_ficha_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_ficha_' + num.value;				
		
		//servicio
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_ficha_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\" size=\"2\"  name=\"insertar_ficha_" + num.value + "\" value=\"nuevo\"><INPUT type=\"hidden\"  name=\"servicio_ficha_" + num.value + "\" value=\"" + codigo_servicio + "\"> <span  class=\"textfield01\">" + nombre_servicio + "</span> ";	
		newRow.appendChild(td);
		
		//Origen
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"origen_ficha_" + num.value + "\" value=\"" + codigo_ciudad_origen + "\"><span  class=\"textfield01\">" + pais_origen + '-' +ciudad_origen + "</span> ";	
		newRow.appendChild(td);
		
		//Destino
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"destino_ficha_" + num.value + "\" value=\"" + codigo_ciudad_destino + "\"><span  class=\"textfield01\">" + pais_destino + '-' +ciudad_destino + "</span> ";	
		newRow.appendChild(td);
		
		//via de transporte
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"vtransporte_ficha_" + num.value + "\" value=\"" + via_transporte + "\"> <span  class=\"textfield01\">" + via_transporte + "</span> ";	
		newRow.appendChild(td);
		
		//cantidad
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cantidad_ficha_" + num.value + "\" value=\"" + cant + "\"> <span  class=\"textfield01\">" + cant + "</span> ";	
		newRow.appendChild(td);
		
		//frecuencia
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"frecuencia_ficha_" + num.value + "\" value=\"" + frecuencia + "\"> <span  class=\"textfield01\">" + frecuencia + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de negociacion
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tnegociacion_ficha_" + num.value + "\" value=\"" + tipo_negocio + "\"> <span  class=\"textfield01\">" + tipo_negocio + "</span> ";	
		newRow.appendChild(td);
		
		//mercancia
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"mercancia_ficha_" + num.value + "\" value=\"" + mercancia + "\"> <span  class=\"textfield01\">" + mercancia + "</span> ";	
		newRow.appendChild(td);

		
		//observacion
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"observacion_ficha_" + num.value + "\" value=\"" + obs + "\"> <span  class=\"textfield01\">" + obs + "</span> ";	
		newRow.appendChild(td);
		
						
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_ficha','fila_item_ficha_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
// FIN ADICION DE CONTACTOS FICHA

//ADICION FICHA RESULTADOS VISITA
function Agregar_html_item_ficha_resultado(nombre_contacto,codigo_contacto,fecha_visita,nombre_resultado,codigo_resultado,fecha_compromiso,trabajo,nombre_tipo_cliente,codigo_tipo_cliente,seguimiento)
{

	var num = document.getElementById('val_inicial_item_rv');
	var lastRow = document.getElementById('fila_item_rv_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_rv_' + num.value;				

		//contacto
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"insertar_rev_" + num.value + "\" value=\"nuevo\"><INPUT type=\"hidden\" size=\"2\"  name=\"codigo_rev_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"contacto_rev_" + num.value + "\" value=\"" + codigo_contacto + "\"> <span  class=\"textfield01\">" + nombre_contacto + "</span> ";	
		newRow.appendChild(td);
		
		//fecha visita
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"fechavisita_rev_" + num.value + "\" value=\"" + fecha_visita + "\"> <span  class=\"textfield01\">" + fecha_visita + "</span> ";	
		newRow.appendChild(td);
		
		//resultados visita
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"resultado_rev_" + num.value + "\" value=\"" + codigo_resultado + "\"> <span  class=\"textfield01\">" + nombre_resultado + "</span> ";	
		newRow.appendChild(td);
		
		//fecha compromiso
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"fecha_rev_" + num.value + "\" value=\"" + fecha_compromiso + "\"> <span  class=\"textfield01\">" + fecha_compromiso + "</span> ";	
		newRow.appendChild(td);
		
		//trabaja actualmente
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"trabaja_rev_" + num.value + "\" value=\"" + trabajo + "\"> <span  class=\"textfield01\">" + trabajo + "</span> ";	
		newRow.appendChild(td);
		
		//tipo cliente
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tcliente_rev_" + num.value + "\" value=\"" + codigo_tipo_cliente + "\"> <span  class=\"textfield01\">" + nombre_tipo_cliente + "</span> ";	
		newRow.appendChild(td);
		
		//seguimiento comercial
		var td = document.createElement('td');
		td.innerHTML  = "<div style=\"display:none\"><TEXTAREA id=\"seguimiento_rev_" + num.value + "\" name=\"seguimiento_rev_" + num.value + "\" >"+seguimiento+"</TEXTAREA></div><span  class=\"textfield01\">" + seguimiento + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_rv','fila_item_rv_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}

//FIN ADICION FICHA RESULTADOS VISITA
//ADICION DE CONTACTOS
function Agregar_html_item_contactos(nombre,cargo,fecha,ciud_contacto_nombre,ciud_contacto_valor,direccion,telefono,fax,celular,email,carta)
{
	var num = document.getElementById('val_inicial_item_contac');
	var lastRow = document.getElementById('fila_item_contac_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_contac_' + num.value;				

		//nombre
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_contac_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_contacto_" + num.value + "\" value=\"" + nombre + "\"> <span  class=\"textfield01\">" + nombre + "</span> ";	
		newRow.appendChild(td);
		
		//cargo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cargo_contacto_" + num.value + "\" value=\"" + cargo + "\"> <span  class=\"textfield01\">" + cargo + "</span> ";	
		newRow.appendChild(td);

		//Fecha de cumpleaños
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"fecha_contacto_" + num.value + "\" value=\"" + fecha + "\"> <span  class=\"textfield01\">" + fecha + "</span> ";	
		newRow.appendChild(td);

		//nombre de la ciudad y pais de contacto
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"ciudad_contac_" + num.value + "\" value=\"" + ciud_contacto_valor + "\"><span  class=\"textfield01\">" + ciud_contacto_nombre + "</span> ";	
		newRow.appendChild(td);
		
		//direccion
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"direccion_contacto_" + num.value + "\" value=\"" + direccion + "\"> <span  class=\"textfield01\">" + direccion + "</span> ";	
		newRow.appendChild(td);
		
		//telefono
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"telefono_contacto_" + num.value + "\" value=\"" + telefono + "\"> <span  class=\"textfield01\">" + telefono + "</span> ";	
		newRow.appendChild(td);
		
		//fax
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"fax_contacto_" + num.value + "\" value=\"" + fax + "\"> <span  class=\"textfield01\">" + fax + "</span> ";	
		newRow.appendChild(td);
		
		//celular
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cel_contacto_" + num.value + "\" value=\"" + celular + "\"> <span  class=\"textfield01\">" + celular + "</span> ";	
		newRow.appendChild(td);
		
		//email
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"email_contacto_" + num.value + "\" value=\"" + email + "\"> <span  class=\"textfield01\">" + email + "</span> ";	
		newRow.appendChild(td);
		
		//carta
		if(carta==true){
			var opc= "checked=checked";
			var opc_valor= "1";
		} else {
			var opc_valor= "0";
		}
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"carta_caja_estado_" + num.value + "\" value=\"nuevo\"> <INPUT type=\"hidden\"  name=\"carta_caja_" + num.value + "\" id=\"carta_caja_" + num.value + "\"  value=\"" + opc_valor + "\" ><INPUT type=\"checkbox\"  name=\"carta_" + num.value + "\" id=\"carta_" + num.value + "\"  value=\"1\" "+ opc +">";	
		newRow.appendChild(td);
	
		
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_iod','fila_item_iod_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
// FIN ADICION DE CONTACTOS

///ITEM DE COSTO PARA PROVEEDOR Y CONTRATISTA
function  Agregar_html_itemcosto_fcl_tra(nombre_icosto_fcl,tipo_calculo_costo_fcl, costo_icosto_fcl, nombre_moneda_costo_fcl,moneda_costo_fcl, nombre_escala_costo_fcl,escala_costo_fcl )
{
	var num = document.getElementById('val_inicial_icosto_fcl');
	var lastRow = document.getElementById('fila_icosto_fcl_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_icosto_fcl_' + num.value;				
		
		//nombre del item costo fcl
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"5\"  name=\"codigo_icostofcl_" + num.value + "\" id=\"codigo_icostofcl_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_icostofcl_" + num.value + "\" value=\"" + nombre_icosto_fcl + "\"> <span  class=\"textfield01\">" + nombre_icosto_fcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de calculo costo fcl
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tcal_icostofcl_" + num.value + "\" value=\"" + tipo_calculo_costo_fcl + "\"> <span  class=\"textfield01\">" + tipo_calculo_costo_fcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de costo costo fcl
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"costo_icostofcl_" + num.value + "\" value=\"" + costo_icosto_fcl + "\"> <span  class=\"textfield01\">" + costo_icosto_fcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo moneda costo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tmoneda_icostofcl_" + num.value + "\" value=\"" + moneda_costo_fcl + "\"> <span  class=\"textfield01\">" + nombre_moneda_costo_fcl + "</span> ";	
		newRow.appendChild(td);
		
		
		//tipo de escala segun el servicio costo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tescala_icostofcl_" + num.value + "\" value=\"" + escala_costo_fcl + "\"> <span  class=\"textfield01\">" + nombre_escala_costo_fcl + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_icosto_fcl','fila_icosto_fcl_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
/// FIN ITEM DE COSTO PARA PROVEEDOR Y CONTRATISTA

//GRILLA DE PARAMETROS DE CIERRE
function  Agregar_html_opc_serv_cierre(nombre_servicio)
{
	var num = document.getElementById('val_inicial_opc');
	var lastRow = document.getElementById('fila_opc_servicio_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_opc_servicio_' + num.value;				
		
		//nombre 
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"5\"  name=\"codigo_dcierre_" + num.value + "\" id=\"codigo_dcierre_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_dcierre_" + num.value + "\" value=\"" + nombre_servicio + "\"> <span  class=\"textfield01\">" + nombre_servicio + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_opc','fila_opc_servicio_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
// FIN GRILLA DE PARAMETROS DE CIERRE


///ITEM DE VENTA PARA PROVEEDOR Y CONTRATISTA
function  Agregar_html_itemventa_lcl_tra(nombre_iventa_lcl,tipo_calculo_venta_lcl, costo_iventa_lcl, nombre_moneda_venta_lcl,moneda_venta_lcl, nombre_escala_venta_lcl,escala_venta_lcl)
{
	var num = document.getElementById('val_inicial_iventa_lcl');
	var lastRow = document.getElementById('fila_iventa_lcl_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_iventa_lcl_' + num.value;		
		//nombre del item venta
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"5\"  name=\"codigo_iventalcl_" + num.value + "\" id=\"codigo_iventalcl_" + num.value + "\" value=\"Null\"><INPUT type=\"hidden\"  name=\"nombre_iventalcl_" + num.value + "\" value=\"" + nombre_iventa_lcl + "\"> <span  class=\"textfield01\">" + nombre_iventa_lcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de calculo venta
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tcal_iventalcl_" + num.value + "\" value=\"" + tipo_calculo_venta_lcl + "\"> <span  class=\"textfield01\">" + tipo_calculo_venta_lcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de costo venta
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"costo_iventalcl_" + num.value + "\" value=\"" +  costo_iventa_lcl + "\"> <span  class=\"textfield01\">" +  costo_iventa_lcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo moneda venta
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tmoneda_iventalcl_" + num.value + "\" value=\"" + moneda_venta_lcl + "\"> <span  class=\"textfield01\">" + nombre_moneda_venta_lcl + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de escala segun el servicio venta
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tescala_iventalcl_" + num.value + "\" value=\"" + escala_venta_lcl + "\"> <span  class=\"textfield01\">" + nombre_escala_venta_lcl + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_iventa_lcl','fila_iventa_lcl_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
/// FIN ITEM DE VENTA PARA PROVEEDOR Y CONTRATISTA

//RUTAS DEL TRANSPORTISTA O CONTRATISTA
function Agregar_html_item_iod_rutas(pais_origen,ciud_origen_nombre,ciud_origen_valor, pais_dest, ciud_dest_nombre, ciud_dest_valor, valor_item_iod, nombre_frecuencia_item_iod,valor_frecuencia_item_iod )
{

	var num = document.getElementById('val_inicial_item_iod');
	var lastRow = document.getElementById('fila_item_iod_' + num.value); 
	var soloLectura = "readonly";
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_iod_' + num.value;				

		//codigo del trafico
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"2\"  name=\"codigo_ciu_des_" + num.value + "\" value=\"Null\">";	
		newRow.appendChild(td);
		
		//nombre de la ciudad y pais de origen
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cod_ciu_ori_" + num.value + "\" value=\"" + ciud_origen_valor + "\"><span  class=\"textfield01\">" + pais_origen + " - " + ciud_origen_nombre + "</span> ";	
		newRow.appendChild(td);
		
		//nombre  de la ciudad y pais de destino
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"cod_ciu_des_" + num.value + "\" value=\"" + ciud_dest_valor + "\"><span  class=\"textfield01\">" + pais_dest + " - " + ciud_dest_nombre + "</span> ";		
		newRow.appendChild(td);
		
			//nombre de los dias
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"num_dias_" + num.value + "\" value=\"" + valor_item_iod + "\"> <span  class=\"textfield01\">" + valor_item_iod + "</span> ";	
		newRow.appendChild(td);
		
		
			//frecuencia
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"frecuencia_" + num.value + "\" value=\"" + valor_frecuencia_item_iod + "\"> <span  class=\"textfield01\">" + nombre_frecuencia_item_iod + "</span> ";	
		newRow.appendChild(td);
			
		// boton q quita la fila jmc
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_iod','fila_item_iod_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	}
}
// FIN RUTAS DEL TRANSPORTISTA O CONTRATISTA

//FUNCION PARA SUBIR Y BAJAR
var newNodo;
function subir (codigo)
{
tab = document.getElementById('cuerpo');
var j=0;
var aux=0;
var cod_caja=0;
var conte=document.getElementById('caja_temp').value;
var vector=conte.split('|');

for(j=0;j<=vector.length-1;j++){
	if(codigo==vector[j]) {	
		cod_caja=j;
		aux=vector[j];
	}
}

var total_num_vector=vector.length-1;
var valor=parseInt(total_num_vector)-cod_caja;
if(valor < total_num_vector)
{
	
	var masaux=parseInt(cod_caja)-1;
	var td_inicial=document.getElementById('fila_items_venta_'+vector[cod_caja]);
	var td_final=document.getElementById('fila_items_venta_'+vector[masaux]);
	copia = td_inicial.cloneNode(true);
	tab.removeChild(td_inicial);
	tab.insertBefore(copia,td_final);
	vector[cod_caja]=0;
	var bandera=0;
	document.getElementById('caja_temp').value="";
	var otroaux=0;
	for(i=0;i< vector.length-1;i++)
	{	
		if(vector[i]==0 && bandera==0) 
		{	
			otroaux=vector[i-1];
			vector[i-1]=aux;
			vector[i]=otroaux;
			bandera=1;
		}		
	}
	
	for(i=0;i< vector.length-1;i++)
		document.getElementById('caja_temp').value=document.getElementById('caja_temp').value+vector[i]+'|';
}
}


function bajar (codigo)
{
tab = document.getElementById('cuerpo');
var j=0;
var aux=0;
var cod_caja=0;
var conte=document.getElementById('caja_temp').value;
var vector=conte.split('|');

for(j=0;j<=vector.length-1;j++){
	if(codigo==vector[j]) {	
		cod_caja=j;
		aux=vector[j];
	}
}

var total_num_vector=vector.length-1;
var valor=parseInt(total_num_vector)-cod_caja;
if(valor > 1)
{
	
	var masaux=parseInt(cod_caja)+2;
	var td_inicial=document.getElementById('fila_items_venta_'+vector[cod_caja]);
	var td_final=document.getElementById('fila_items_venta_'+vector[masaux]);
	copia = td_inicial.cloneNode(true);
	tab.removeChild(td_inicial);
	tab.insertBefore(copia,td_final);
	vector[cod_caja]=0;
	var bandera=0;
	document.getElementById('caja_temp').value="";
	var otroaux=0;
	for(i=0;i< vector.length-1;i++)
	{
		if(vector[i]==0 && bandera==0) 
		{	otroaux=vector[i+1];
			vector[i+1]=aux;
			vector[i]=otroaux;
			bandera=1;
		}
		document.getElementById('caja_temp').value=document.getElementById('caja_temp').value+vector[i]+'|';		
	}
	
}
}
// FIN FUNCION PARA SUBIR Y BAJAR

// COTIZACION
function html_adicion_items_cotizacion(cod_item,nombre_item,tipo_calculo,valor_item)
{	
	var num = document.getElementById('val_inicial_items_venta');
	var lastRow = document.getElementById('fila_items_venta_' + num.value); 
	var soloLectura = "readonly";
	var calculado_dato_en=document.getElementById("calcular_en").options[document.getElementById("calcular_en").selectedIndex].text;
	
//alert(lastRow)
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_items_venta_' + num.value;
		
		
		//nombre y codigo del item
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"codigo_item_venta_" + num.value + "\" value=\"" + cod_item + "\"> <span  class=\"textfield01\">" + nombre_item + "</span> ";	
		newRow.appendChild(td);
	
		//columna de tarifas
		

		var td = document.createElement('td');
		td.innerHTML  = "<span class=\"fecha\"> <INPUT type=\"hidden\" size=\"7\" name=\"tarifa_usd_" +num.value+ "\" value=\"0\"><INPUT type=\"text\" size=\"7\" class=\"textfield01\"  name=\"codigo_item_calculo_" + num.value + "\" value=\"" + calculado_dato_en + "\"></span>";	
		newRow.appendChild(td);
		
		var td = document.createElement('td');
		td.innerHTML  = " <span  class=\"fecha\"> <INPUT type=\"text\" size=\"7\"  name=\"tarifa_usd_kg_" + num.value + "\" value=\"" + valor_item + "\">"+ tipo_calculo +"</span> ";	
		newRow.appendChild(td);

		//columna de minima
		/*var td = document.createElement('td');
		td.innerHTML  = " <span  class=\"fecha\"> <INPUT type=\"text\" size=\"7\"  name=\"minia_usd_kg_" + num.value + "\" value=\"\"></span> ";	
		newRow.appendChild(td);

		var td = document.createElement('td');
		td.innerHTML  = "<span class=\"fecha\"> <INPUT type=\"text\" size=\"7\" name=\"minia_usd_" +num.value+ "\" value=\"\"></span>";	
		newRow.appendChild(td);*/

		//columna de liquidacion
		var td = document.createElement('td');
		td.innerHTML  = " <span  class=\"fecha\"> <INPUT type=\"text\" size=\"7\"  name=\"liquidacion_usd_kg_" + num.value + "\" id=\"liquidacion_usd_kg_" + num.value + "\" value=\" 0\"></span> ";	
		newRow.appendChild(td);

		var td = document.createElement('td');
		td.innerHTML  = "<span class=\"fecha\"> <INPUT type=\"text\" size=\"7\" name=\"liquidacion_usd_" +num.value+ "\" id=\"liquidacion_usd_" + num.value + "\" value=\" 0 \"></span>";	
		newRow.appendChild(td);

		//BOTONES DE SUBIR Y BAJAR
		var td = document.createElement('td');
		td.innerHTML = "<IMG src=\"imagenes/abajo.png\" style=\"cursor:pointer\" alt=\"desplazar hacia abajo\" title=\"desplazar hacia abajo\" onclick=\"bajar('"+ num.value +"');\"><IMG src=\"imagenes/arriba.png\" alt=\"desplazar hacia arriba\" title=\"desplazar hacia arriba\" style=\"cursor:pointer\" onclick=\"subir('"+ num.value +"','-1');\">";
		newRow.appendChild(td);
		/*var td = document.createElement('td');
		td.innerHTML = "<INPUT type=\"button\" class=\"botones\" value=\"abajo\" onclick=\"bajar('"+ num.value +"');\"><INPUT type=\"button\" class=\"botones\" value=\"arriba\" onclick=\"subir('"+ num.value +"','-1');\">";
		newRow.appendChild(td);*/
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila_cotizacion('" + newRow.id +"','val_inicial_items_venta','fila_items_venta_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
			//orden de los items
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\" size=\"7\"  name=\"items_orden_" + num.value + "\" id=\"items_orden_" + num.value + "\" value=\"" + num.value + "\">";	
		newRow.appendChild(td);
			document.getElementById('num_item').value=num.value;
			document.getElementById('caja_temp').value=document.getElementById('caja_temp').value+num.value+'|';
	lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
	//previousSibling
	
	var cod=document.getElementById('itemvalores').value;
	document.getElementById('cod_item').value=cod;
	//Busca si es numero o porcentaje;
	buscar_valor();
	buscar_costo();
	buscar_moneda();
	
	
	
	//DATOS DE FORMULA
	
		var item_calculo='val_item';	
		var resultado_dolar=document.getElementById('liquidacion_usd_kg_'+ num.value).value;
		var dolar='liquidacion_usd_kg_'+ num.value;
		var pesos='liquidacion_usd_'+ num.value;
		var resultado_pesos=document.getElementById('liquidacion_usd_'+ num.value).value;
		var piezas=document.getElementById('piezas').value;
		var dimmensiones=document.getElementById('cant_dimenciones').value;
		var tasa_cambio=document.getElementById('taza_cambio').value;
		var mayor_valor=document.getElementById('comparar').value;
		var cod_moneda =document.getElementById('cod_moneda').value;
		var costo =document.getElementById('costo').value;
		var val_item =document.getElementById('porcentaje').value;
		var calcular_item_en =document.getElementById('tipo_calculo_item').value;
		var valor_segurado =document.getElementById('valor_seguro').value;
		var valor_aduana =document.getElementById('valortermino').value;
		var bandera_tasa =document.getElementById('bandera_tasa').value;
		var factor_tasa=document.getElementById('otra_tasa').value;
		
			
	//MONEDA		
	if(val_item=='#' && costo=='variable' && cod_moneda==1 && calcular_item_en=='piezas'){
		calcular_pieza_pesos(item_calculo, piezas, dolar, pesos,tasa_cambio);

	} else
	if(val_item=='#' && costo=='variable' && cod_moneda >1 && calcular_item_en=='piezas'){			
		calcular_pieza_dolar(item_calculo, piezas, dolar, pesos, tasa_cambio,bandera_tasa,factor_tasa);
	} else
	if(val_item=='#' && costo=='fijo' && cod_moneda==1 && calcular_item_en=='piezas'){
		calcular_pieza_costofijo_pesos(item_calculo,dolar, pesos,tasa_cambio);
	} else
	if(val_item=='#' && costo=='fijo' && cod_moneda >1 && calcular_item_en=='piezas'){
		
		calcular_pieza_costofijo_dolar(item_calculo,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);
	}else
	//PIEZA
	if(val_item=='#' && costo=='variable' && cod_moneda >1 && calcular_item_en=='container'){
	
		calcular_pieza_dolar_container(item_calculo, piezas, dolar, pesos, tasa_cambio,bandera_tasa,factor_tasa);
	} else
	if(val_item=='#' && costo=='fijo' && cod_moneda >1 && calcular_item_en=='container'){
		
		calcular_pieza_costofijo_dolar_container(item_calculo,piezas,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);
	}else
	if(val_item=='#' && costo=='variable' && cod_moneda ==1 && calcular_item_en=='container'){
		
		calcular_pieza_costo_pesos_container(item_calculo,piezas,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);
	}else
	if(val_item=='#' && costo=='fijo' && cod_moneda ==1 && calcular_item_en=='container'){
		
		calcular_pieza_costo_pesos_container(item_calculo,piezas,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);
	}else
	//POR DIMENSION
	if(val_item=='#' && costo=='variable' && cod_moneda >1 && calcular_item_en=='dimension'){
	
		calcular_dolar_dimension(item_calculo, dimmensiones, dolar, pesos, tasa_cambio,bandera_tasa,factor_tasa);
	} else
	if(val_item=='#' && costo=='fijo' && cod_moneda >1 && calcular_item_en=='dimension'){
		
		calcular_costofijo_dolar_dimension(item_calculo,dimmensiones,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);
	}else
	if(val_item=='#' && costo=='variable' && cod_moneda ==1 && calcular_item_en=='dimension'){
		
		calcular_costo_pesos_dimension(item_calculo,dimmensiones,dolar, pesos,tasa_cambio);
	}else
	if(val_item=='#' && costo=='fijo' && cod_moneda ==1 && calcular_item_en=='dimension'){
		
		calcular_costo_pesos_dimension(item_calculo,dimmensiones,dolar, pesos,tasa_cambio);
	}else
//NO APLICA
	
	if(val_item=='#' && costo=='fijo' && cod_moneda==1 && calcular_item_en=='no_aplica'){
		calcular_pieza_costofijo_noaplica(item_calculo,dolar, pesos,tasa_cambio);
		

	}else
	if(val_item=='#' && costo=='fijo' && cod_moneda>1 && calcular_item_en=='no_aplica'){
		calcular_pieza_costofijo_noaplica(item_calculo,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa);

	}else
	
	//KILO
	if(val_item=='#' && costo=='variable' && cod_moneda==1 && calcular_item_en=='kilo'){
		calcular_kilo_volumen_pesos(item_calculo,dolar, pesos,tasa_cambio,mayor_valor);

	}else
	if(val_item=='#' && costo=='variable' && cod_moneda >1 && calcular_item_en=='kilo'){
			calcular_kilo_volumen_dolar(item_calculo,dolar, pesos,tasa_cambio,mayor_valor,bandera_tasa,factor_tasa);
	}else
	if(val_item=='#' && costo=='variable' && cod_moneda==1 && calcular_item_en=='peso'){
			calcular_peso_pesos(item_calculo,dolar, pesos,tasa_cambio,mayor_valor);

	}else
	if(val_item=='#' && costo=='variable' && cod_moneda >1 && calcular_item_en=='peso'){
			calcular_peso_dolar(item_calculo,dolar, pesos,tasa_cambio,mayor_valor,bandera_tasa,factor_tasa);

	}else
	if(val_item=='#' && costo=='fijo' && cod_moneda==1 && calcular_item_en=='peso'){
			calcular_peso_pesos(item_calculo,dolar, pesos,tasa_cambio,mayor_valor);

	}else
	if(val_item=='#' && costo=='fijo' && cod_moneda >1 && calcular_item_en=='peso'){
			calcular_peso_dolar(item_calculo,dolar, pesos,tasa_cambio,mayor_valor,bandera_tasa,factor_tasa);
	}else 
		if( costo=='fijo' &&  cod_moneda >1 && calcular_item_en=='valor_seguro' ){
			if(val_item!='%') {
				alert("Debe Seleccionar un Valor Tipo Porcentaje, No se Puede Calcular");
			}
			else {
					calcular_seg_seguro(item_calculo,dolar, pesos,tasa_cambio,valor_segurado);
				 }
			
	}
	else
	if( costo=='fijo' &&  cod_moneda >1 && calcular_item_en=='valor_aduana' ){
			if(val_item!='%') {
				alert("Debe Seleccionar un Valor Tipo Porcentaje, No se Puede Calcular");
			}
			else {
						calcular_valor_aduana(item_calculo,dolar, pesos,tasa_cambio,valor_aduana);
				 }
			
	}
	
	
	//por Item
	
	if(document.getElementById("calcular_en").value=='0')
	{
		alert('Por favor seleccione un item de calculo');
		return false;
	} 

	if(costo=='fijo' && cod_moneda>1  && calcular_item_en=='flete_internacional' ){
		if(val_item!='%') {
				alert("Debe Seleccionar un Valor Tipo Porcentaje, No se Puede Calcular");
			}
			else {
						calcular_valor_flete_internacional(item_calculo,dolar, pesos,tasa_cambio);
				 }
			
	}
	}

	
}

function calcular_pieza_dolar(items, pieza, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	
	if(bandera_tasa!='activo'){
		var resultado=(document.getElementById(items).value)*1;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
	    var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var resultado=conversion_dolar*1;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_pieza_dolar_container(items, pieza, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		var resultado=(document.getElementById(items).value)*pieza;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var resultado=conversion_dolar*pieza;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_pieza_costofijo_dolar_container(items, pieza, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		var resultado=(document.getElementById(items).value)*pieza;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var resultado=conversion_dolar*pieza;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_pieza_costo_pesos_container(items, pieza, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
		var resultado=(document.getElementById(items).value)*pieza;
		document.getElementById(pesos).value=Math.round(resultado*100)/100 ;
		var conversion_dolar=resultado/tasa_cambio;
		document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
		suma();
}



function calcular_pieza_pesos(items, pieza, dolar, pesos,tasa_cambio){
	var resultado=(document.getElementById(items).value)*pieza;
	document.getElementById(pesos).value=Math.round(resultado*100)/100 ;
	var conversion_dolar=resultado/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}

function calcular_pieza_costofijo_pesos(items,dolar, pesos,tasa_cambio){
	document.getElementById(pesos).value=document.getElementById(items).value;
	var conversion_dolar=(document.getElementById(items).value)/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}

function calcular_pieza_costofijo_dolar(items,dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		document.getElementById(dolar).value=document.getElementById(items).value;
		var conversion_pesos=(document.getElementById(items).value)*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		document.getElementById(dolar).value=conversion_dolar;
		var conversion_pesos=conversion_dolar*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_pieza_costofijo_noaplica(items,dolar, pesos,tasa_cambio){
	document.getElementById(dolar).value=0
	document.getElementById(pesos).value=0;
	suma();
}


//DIMENSIONES
function calcular_dolar_dimension(items, dimension, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		var resultado=(document.getElementById(items).value)*dimension;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var resultado=conversion_dolar*dimension;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_costofijo_dolar_dimension(items, dimension, dolar, pesos,tasa_cambio,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		var resultado=(document.getElementById(items).value)*dimension;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var resultado=conversion_dolar*dimension;
		document.getElementById(dolar).value=resultado;
		document.getElementById(dolar).value=Math.round(resultado*100)/100 ;
		var conversion_pesos=resultado*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}

function calcular_costo_pesos_dimension(items, dimension, dolar, pesos,tasa_cambio){
	var resultado=(document.getElementById(items).value)*dimension;
	document.getElementById(pesos).value=Math.round(resultado*100)/100 ;
	var conversion_dolar=resultado/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}

function calcular_costo_pesos_dimension(items, dimension, dolar, pesos,tasa_cambio){
	var resultado=(document.getElementById(items).value)*dimension;
	document.getElementById(pesos).value=Math.round(resultado*100)/100 ;
	var conversion_dolar=resultado/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}
//FIN DIMENSIONES
function calcular_kilo_volumen_pesos(items,dolar, pesos,tasa_cambio,mayor_valor){
	var total=(document.getElementById(items).value)*mayor_valor;
	document.getElementById(pesos).value=total;
	var conversion_dolar=total/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}

function calcular_kilo_volumen_dolar(items,dolar, pesos,tasa_cambio,mayor_valor,bandera_tasa,factor_tasa){
		if(bandera_tasa!='activo'){
			
			var total=(document.getElementById(items).value)*mayor_valor;
			document.getElementById(dolar).value=total;
			var conversion_pesos=total*tasa_cambio;
			document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
			suma();
		} else if(bandera_tasa=='activo'){
			var conversion_dolar=factor_tasa*(document.getElementById(items).value);
			var total=conversion_dolar*mayor_valor;
			document.getElementById(dolar).value=total;
			var conversion_pesos=total*tasa_cambio;
			document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
			suma();
		}
}
function calcular_peso_pesos(items,dolar, pesos,tasa_cambio,mayor_valor){
	var peso_bruto=document.getElementById('pesobruto').value;
	var total=(document.getElementById(items).value)*peso_bruto;
	document.getElementById(pesos).value=total;
	var conversion_dolar=total/tasa_cambio;
	document.getElementById(dolar).value=Math.round(conversion_dolar*100)/100 ;
	suma();
}

function calcular_peso_dolar(items,dolar, pesos,tasa_cambio,mayor_valor,bandera_tasa,factor_tasa){
	if(bandera_tasa!='activo'){
		var peso_bruto=document.getElementById('pesobruto').value;
		var total=(document.getElementById(items).value)*peso_bruto;
		document.getElementById(dolar).value=total;
		var conversion_pesos=total*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	} else if(bandera_tasa=='activo'){
		var conversion_dolar=factor_tasa*(document.getElementById(items).value);
		var peso_bruto=document.getElementById('pesobruto').value;
		var total=conversion_dolar*peso_bruto;
		document.getElementById(dolar).value=total;
		var conversion_pesos=total*tasa_cambio;
		document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
		suma();
	}
}
function calcular_valor_flete_internacional(items,dolar, pesos,tasa_cambio){
	var resul_flete=((document.getElementById('liquidacion_usd_kg_1').value)*(document.getElementById(items).value))/100;;
	document.getElementById(dolar).value=resul_flete;
	var conversion_pesos=resul_flete*tasa_cambio;
	document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
	suma();
}

function calcular_seg_seguro(items,dolar, pesos,tasa_cambio,valor_asegurado){
	var resultado=((document.getElementById(items).value)*valor_asegurado)/100;
	document.getElementById(dolar).value=resultado;
	var conversion_pesos=resultado*tasa_cambio;
	document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
	suma();
}

function calcular_valor_aduana(items,dolar, pesos,tasa_cambio,valor_aduana){
	var resultado=((document.getElementById(items).value)*valor_aduana)/100;
	document.getElementById(dolar).value=resultado;
	var conversion_pesos=resultado*tasa_cambio;
	document.getElementById(pesos).value=Math.round(conversion_pesos*100)/100 ;
	suma();
	
}


function suma(){
var i;
var suma=0;
var suma_dolar=0;
var num =document.getElementById('num_item').value;


for (i=1; i<=num+1; i++)
	{   

		 suma=suma + parseInt(document.getElementById('liquidacion_usd_'+i).value);
		 document.getElementById('tel12').value=Math.round(suma*100)/100 ;	
		 
		  suma_dolar=suma_dolar + parseInt(document.getElementById('liquidacion_usd_kg_'+i).value);
		 document.getElementById('tel1').value=Math.round(suma_dolar*100)/100;	
		}
}

function restar(){
var i;
var restar=0;
var restar_dolar=0;
var num =document.getElementById('num_item').value;
for (i=1; i<=num; i++)
	{
		 restar=parseInt(document.getElementById('tel12').value)-parseInt(document.getElementById('liquidacion_usd_'+i).value);
		 document.getElementById('tel12').value=Math.round(restar*100)/100 ;	
		 
		  restar_dolar=parseInt(document.getElementById('tel1').value) - parseInt(document.getElementById('liquidacion_usd_kg_'+i).value);
		  document.getElementById('tel1').value=Math.round(restar_dolar*100)/100 ;	
		}
}
//FIN COTIZACION

//CALCULOS DE LA COTIZACION

function Agregar_html_itemsoperacion_cotizacion(numero_piezas,peso_bruto, dimenciones)
{	
	var i;
	var num = document.getElementById('val_inicial');
	var lastRow = document.getElementById('fila_' + num.value); 
	var soloLectura = "readonly";
	for (i=1; i<=dimenciones; i++){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_' + i;

		//Dimension de la pieza
		var td = document.createElement('td');
		td.innerHTML  = "<span  class=\"ctablasup1\">" + 'Dimension Pieza '+i + "</span> ";	
		newRow.appendChild(td);

		//Caja 1 posicion 1 n
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"text\" onkeypress=\"return validaFloat(this)\" onchange=\"return validaValue(this)\" size=\"5\"  name=\"fil_1_" + num.value + "\" id=\"fil_1_" + num.value + "\" ><span  class=\"textfield01\">" + 'm' + "</span> ";	
		newRow.appendChild(td);
		
		//Caja 2 posicion 1 n
		var td = document.createElement('td');
		td.innerHTML  = "<span  class=\"textfield01\">" + ' X ' + "</span><INPUT type=\"text\" size=\"5\" onkeypress=\"return validaFloat(this)\" onchange=\"return validaValue(this)\"  name=\"fil_2_" + num.value + "\" id=\"fil_2_" + num.value + "\" ><span  class=\"textfield01\">" + 'm' + "</span> ";	
		newRow.appendChild(td);
		
		//Caja 3 posicion 1 n
		var td = document.createElement('td');
		td.innerHTML  = "<span  class=\"textfield01\">" + ' X ' + "</span><INPUT type=\"text\" size=\"5\" onkeypress=\"return validaFloat(this)\" onchange=\"return validaValue(this)\"  name=\"fil_3_" + num.value + "\" id=\"fil_3_" + num.value + "\" ><span  class=\"textfield01\">" + 'm' + "</span> ";	
		newRow.appendChild(td);
		
		//Caja 4 posicion 1 n
		var td = document.createElement('td');
		td.innerHTML  = "<span  class=\"textfield01\">" + 'cant: ' + "</span><INPUT type=\"text\" size=\"5\" onkeypress=\"return validaInt('%d', this,event)\"  name=\"fil_4_" + num.value + "\" id=\"fil_4_" + num.value + "\" > ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_items_venta','fila_items_venta_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
		
	lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling); 	
	}

}

function cal() {
 validar_piezas();
 buscar_factor();
 var i;
 var suma=0;
 var dato=0;
 var num = document.getElementById('dimenciones').value; 
	for (i=1; i<=num; i++){
	  caja_1 = document.getElementById('fil_1_'+i).value; 
	  caja_2 = document.getElementById('fil_2_'+i).value;
	  caja_3 = document.getElementById('fil_3_'+i).value; 
	  caja_4 = document.getElementById('fil_4_'+i).value; 
	  resultado = caja_1*caja_2*caja_3*caja_4;	
	  suma =suma+resultado;  		
	  document.getElementById('cant_dimenciones').value=suma; 
	  var total =document.getElementById('factor').value*suma;
	  
	  document.getElementById('kilovlolumen').value=(Math.round(total*100)/100)*100 ;
	  document.getElementById('calcular').value=(Math.round(total*100)/100)*100 ;
	  var pesobruto=parseFloat(document.getElementById('pesobruto').value);
	  var kilo_v=parseFloat(document.getElementById('calcular').value);
	  
	  if(pesobruto < kilo_v) {
		var mayor=document.getElementById('calcular').value;
	  	document.getElementById('comparar').value=mayor
	  }
	  else {
		var mayor_1=document.getElementById('pesobruto').value;
	  	document.getElementById('comparar').value=mayor_1
	  }
	  
	}
	
	
}
function  validar_piezas(){

 var i;
 var suma=0;
 var dato=0;
 var num = document.getElementById('dimenciones').value; 
	for (i=1; i<=num; i++){
	 suma=suma + parseInt(document.getElementById('fil_4_'+i).value);
	 document.getElementById('total_pieza').value=suma;	
	 }

	 
	 if(document.getElementById('total_pieza').value != document.getElementById('piezas').value){
	 	alert('El Numero de piezas no coinciden');
		borrar_cajas();
		return false;
	 
	}
	
}

function borrar_cajas()
{
	 var i;
 var suma=0;
 var dato=0;
 document.getElementById('comparar').value=0;
 document.getElementById('calcular').value=0;
 document.getElementById('factor').value=0;
 var num = document.getElementById('dimenciones').value; 
	for (i=1; i<=num; i++){
	   document.getElementById('fil_1_'+i).value=0; 
	   document.getElementById('fil_2_'+i).value=0;
	   document.getElementById('fil_3_'+i).value=0; 
	   document.getElementById('fil_4_'+i).value=0;
	 }
}


// FIN DE CALCULOS DE LA COTIZACION


//REMOVER FILA

function removerFila(id,val_inicial,filaName,id_borrar)
{	
	var num = document.getElementById(val_inicial);
	//alert(num)
	//REMUEVE EL NODO
	var fila = document.getElementById(id);
	fila.parentNode.removeChild(fila);
	//VALIDA CUAL ES EL ULTIMO ID;
		for(i = 0; i <= num.value; i++){
		var idFila = document.getElementById(filaName + i); 
		if (idFila != null) lastRow = i;
	}
	num.value = lastRow;
}
function borrar_ordenamiento(cod_borrar){
var j=0;
var conte=document.getElementById('caja_temp').value;
var vector=conte.split('|');
for(j=0;j<=vector.length-1;j++){

if(cod_borrar==vector[j]) 
	{	vector[j]=0;
	}
}
document.getElementById('caja_temp').value="";
for(j=0;j<=vector.length-1;j++){

if(vector[j]!=0) 
	{	
		document.getElementById('caja_temp').value=document.getElementById('caja_temp').value+vector[j]+'|';
	}
}

}

//FIN DE REMOVER FILA

//REMOVER FILA COTIZACION

function removerFila_cotizacion(id,val_inicial,filaName,valor_total){
borrar_ordenamiento(valor_total);
	document.getElementById('tel12').value=parseInt(document.getElementById('tel12').value)- parseInt(document.getElementById('liquidacion_usd_'+valor_total).value);
	document.getElementById('tel1').value=parseInt(document.getElementById('tel1').value)- parseInt(document.getElementById('liquidacion_usd_kg_'+valor_total).value);
	
	var num = document.getElementById(val_inicial);

	//REMUEVE EL NODO
	var fila = document.getElementById(id);
	
	fila.parentNode.removeChild(fila);

	//VALIDA CUAL ES EL ULTIMO ID;
	for(i = 0; i <= num.value; i++){
		var idFila = document.getElementById(filaName + i); 
		if (idFila != null) lastRow = i;
	}num.value = lastRow;
}
//FIN DE REMOVER FILA COTIZACION
function ocultar_div(pestana)
{
	
	if(document.getElementById(pestana).style.display == "none")
		document.getElementById(pestana).style.display = "inline";
	else 
		document.getElementById(pestana).style.display = "none";

}
//ITEM DE TARIFAS EN ESCALAS
function  Agregar_html_item_esc(valor_item_esc,tescala_item_esc,nombre_escala_item_esc)
{
	var num = document.getElementById('val_inicial_item_esc');
	var lastRow = document.getElementById('fila_item_esc_' + num.value); 
	var soloLectura = "readonly";
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_esc_' + num.value;				

		//valor de la escala
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"valor_item_esc_" + num.value + "\" value=\"" + valor_item_esc + "\"> <span  class=\"textfield01\">" + valor_item_esc + "</span> ";	
		newRow.appendChild(td);
		
		//tipo de escala segun el servicio costo
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"tescala_item_esc_" + num.value + "\" value=\"" + tescala_item_esc + "\"> <span  class=\"textfield01\">" + nombre_escala_item_esc + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_esc','fila_item_esc_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
// FIN ITEM DE TARIFAS EN ESCALAS

//ADICION ITEM PAGOS PROVEEDORS

function  Agregar_html_item_pagos_proveedores(num_documento,valor_abonado,comentario)
{
	var num = document.getElementById('val_inicial_item_proveedor');
	var lastRow = document.getElementById('fila_item_pproveedor_' + num.value); 
	var soloLectura = "readonly";
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id = 'fila_item_pproveedor_' + num.value;				

		//numero del documento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"numero_documento_" + num.value + "\" value=\"" + num_documento + "\"> <span  class=\"textfield01\">" + num_documento + "</span> ";	
		newRow.appendChild(td);
		
		//valor abonado
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"valor_documento_" + num.value + "\" value=\"" + valor_abonado + "\"> <span  class=\"textfield01\">" + valor_abonado + "</span> ";	
		newRow.appendChild(td);
		
	    //comentario del documento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"comentarios_doc_" + num.value + "\" value=\"" + comentario + "\"> <span  class=\"textfield01\">" + comentario + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_proveedor','fila_item_pproveedor_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
//FIN ADICION ITEM PAGOS PROVEEDOR

//ADICION ITEM PAGOS CLIENTES

function Agregar_html_item_pago_cliente(num_documento,valor_abonado,comentario)
{
	var num = document.getElementById('val_inicial_item_cliente');
	var lastRow = document.getElementById('fila_item_cliente_' + num.value); 
	var soloLectura = "readonly";
	if(lastRow){
		num.value = parseInt(num.value) + 1;
		var newRow = document.createElement('tr');
		newRow.id ='fila_item_cliente_' + num.value;				

		//numero del documento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"numero_documento_" + num.value + "\" value=\"" + num_documento + "\"> <span  class=\"textfield01\">" + num_documento + "</span> ";	
		newRow.appendChild(td);
		
		//valor abonado
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"valor_documento_" + num.value + "\" value=\"" + valor_abonado + "\"> <span  class=\"textfield01\">" + valor_abonado + "</span> ";	
		newRow.appendChild(td);
		
	    //comentario del documento
		var td = document.createElement('td');
		td.innerHTML  = "<INPUT type=\"hidden\"  name=\"comentarios_doc_" + num.value + "\" value=\"" + comentario + "\"> <span  class=\"textfield01\">" + comentario + "</span> ";	
		newRow.appendChild(td);
		
		// boton q quita la fila
		var td = document.createElement('td');
		td.innerHTML = "<div align=\"center\"><INPUT type=\"button\" class=\"botones\" value=\"  -  \" onclick=\"removerFila('" + newRow.id +"','val_inicial_item_cliente','fila_item_cliente_',"+ num.value +");\"></div>";
		newRow.appendChild(td);
	
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);

	}
}
//FIN ADICION ITEM PAGOS CLIENTES
