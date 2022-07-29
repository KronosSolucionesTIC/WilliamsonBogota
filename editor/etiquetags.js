// etiquetags v.1.1
// Copyright (c) 2006 Marta Garabatos
// http://sisifodichoso.org
//
// Copyright (c) 2006 Ricardo lago
// http://www.xenealoxia.org/cruzul/
//
// Licensed under the LGPL license
// http://www.gnu.org/copyleft/lesser.html
//
// Based on JS QuickTags version 1.2
//
// Copyright (c) 2002-2005 Alex King
// http://www.alexking.org/
//
// Licensed under the LGPL license
// http://www.gnu.org/copyleft/lesser.html
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************
//
// This JavaScript will insert the tags below at the cursor position in IE and 
// Gecko-based browsers (Mozilla, Camino, Firefox, Netscape). For browsers that 
// do not support inserting at the cursor position (Safari, OmniWeb) it appends
// the tags to the end of the content.
//
// The variable 'edCanvas' must be defined as the <textarea> element you want 
// to be editing in. See the accompanying 'demo.html' page for an example.
// ***********************************************************************
//  Etiquetags
// ***********************************************************************
// * 	Traslation into Spanish of dialogs from original JS QuickTags file.
// * 	The DICT button ha been replaced with a RAE button, Spanish dictionary.
// * 	This is a copy of the work from http://www.webstudio.cl/blog/diccionario-rae-en-wordpress/
// * 	More tags has been added: cite, q, abbr, acronym ...
// * 	More attributes for the tags have beeb added. ... and more ...
// *********************************************************
// * 	Traducción al español de los diálogos del programa original JS Quicktags.
// * 	El botón DICT del diccionario en inglés se ha reemplazado por el botón RAE para consultas con el dccionario de la RAE. 
// * 	Esto es una copia del trabajo de http://www.webstudio.cl/blog/diccionario-rae-en-wordpress/
// * 	Se han añadido más botones y etiquetas: cite, q, abbr, acronym ...
// * 	Se han añadido más atributos para las etiquetas ... y más ...
//*************
//Etiquetags 1.1
//*************
// Corregido un bug por el que que no se podían insertar imágenes en IExplorer y Opera
// Fixed the bug: "We cannot insert images in IExplorer and Opera" 
// *************** OPTIONS *************//

var IconDir = 'iconos/';  //Icons Directory. 
var FormDir = 'forms/'; //Forms Directory


// *************** END OPTIONS *************//

// ***** CREATING BUTTONS *****//

var edButtons = new Array();
var edLinks = new Array();
var edOpenTags = new Array();

function edButton(id, display, ico, tagStart, tagEnd, access, onClick, title, open) {
	this.id = id;			// used to name the toolbar button
	this.display = display;		// label on button
	this.ico = ico;			// button icon source
	this.tagStart = tagStart; 	// open tag
	this.tagEnd = tagEnd;		// close tag
	this.access = access;	// accesskey
	this.onClick = onClick; //onclick button
	this.title = title;		// button title 
	this.open = open;		// set to -1 if tag does not need to be closed
}

function zeroise(number, threshold) {
	// FIXME: or we could use an implementation of printf in js here
	var str = number.toString();
	if (number < 0) { str = str.substr(1, str.length) }
	while (str.length < threshold) { str = "0" + str }
	if (number < 0) { str = '-' + str }
	return str;
}

// *This is a copy from the Wordpress original quicktags file 

var now = new Date();
var datetime = now.getUTCFullYear() + '-' + 
zeroise(now.getUTCMonth() + 1, 2) + '-' +
zeroise(now.getUTCDate(), 2) + ' T' + 
zeroise(now.getUTCHours(), 2) + ':' + 
zeroise(now.getUTCMinutes(), 2) + ':' + 
zeroise(now.getUTCSeconds() ,2) +
'+00:00';

// *Added. Show date in Spanish format.
var spdate = zeroise(now.getUTCDate(), 2)+ '-' + 
zeroise(now.getUTCMonth() + 1, 2) + '-' +
now.getUTCFullYear();


//**************************** BUTTONS *************************//
//* Los botones se mostrarán en la barra en el mismo orden en el que aparecen aquí.
//* Si borras o comentas un botón éste no se mostrará en la barra
//* Siéntete libre de quitar, añadir y reordenar los botones a voluntad.

edButtons.push(
	new edButton(
		'ed_p'
		,'p'
		,IconDir + 'parrafo.png' 
		,'<p>'
		,'</p>\n\n'
		,'p'
		,'edInsertTag'
		,'párrafo: <p>'
	)
);

edButtons.push(
	new edButton(
		'ed_br'
		,'br'
		,IconDir + 'salto_linea.png' 
		,'<br />'
		,''
		,''
		,'edInsertTag'
		,'salto de línea: <br />'
		,-1
	)
);

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_strong'
		,'str'
		,IconDir + 'enfasis_mucho.png' 
		,'<strong>'
		,'</strong>'
		,'b'
		,'edInsertTag' 
		,'resaltado: <strong>'
	)
);

edButtons.push(
	new edButton(
		'ed_em'
		,'em'
		,IconDir + 'enfasis.png' 
		,'<em>'
		,'</em>'
		,'i'
		,'edInsertTag'
		,'énfasis: <em>'
	)
);

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_ul'
		,'ul'
		,IconDir + 'lista_no_numerada.png' 
		,'<ul>\n'
		,'</ul>\n\n'
		,'u'
		,'edInsertList'
		,'lista no numerada: <ul>'
	)
);

edButtons.push(
	new edButton(
		'ed_ol'
		,'ol'
		,IconDir + 'lista_numerada.png' 
		,'<ol>\n'
		,'</ol>\n\n'
		,'o'
		,'edInsertList'
		,'lista numerada: <ol>'
	)
);

edButtons.push(
	new edButton(
		'ed_li'
		,'li'
		,IconDir + 'lista_item.png' 
		,'\t<li>'
		,'</li>\n'
		,'l'
		,'edInsertTag'
		,'elemento de lista: <li>'
	)
);


edButtons.push(
	new edButton(
		'ed_prev'
		,'preview'
		,IconDir + 'vista_previa.png' 
		,''
		,''
		,'f'
		,'edPrev'
		,'vista previa'
	)
);


var extendedStart = edButtons.length;

// below here are the extended buttons

edButtons.push(
	new edButton(
		'ed_h1'
		,'h1'
		,IconDir + 'h1.png' 
		,'<h1>'
		,'</h1>\n\n'
		,'1'
		,'edInsertTag'
		,'título h1: <h1>'
	)
);

edButtons.push(
	new edButton(
		'ed_h2'
		,'h2'
		,IconDir + 'h2.png' 
		,'<h2>'
		,'</h2>\n\n'
		,'2'
		,'edInsertTag'
		,'título h2: <h2>'
	)
);

edButtons.push(
	new edButton(
		'ed_h3'
		,'h3'
		,IconDir + 'h3.png' 
		,'<h3>'
		,'</h3>\n\n'
		,'3'
		,'edInsertTag'
		,'título h3: <h3>'
	)
);

edButtons.push(
	new edButton(
		'ed_h4'
		,'h4'
		,IconDir + 'h4.png' 
		,'<h4>'
		,'</h4>\n\n'
		,'4'
		,'edInsertTag'
		,'título h4: <h4>'
	)
);


edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);
edButtons.push(
	new edButton(
		'ed_sub'
		,'sub'
		,IconDir + 'subindice.png' 
		,'<sub>'
		,'</sub>'
		,''
		,'edInsertTag'
		,'subíndice: <sub>'
	)
);

edButtons.push(
	new edButton(
		'ed_sup'
		,'sup'
		,IconDir + 'superindice.png' 
		,'<sup>'
		,'</sup>'
		,''
		,'edInsertTag'
		,'superíndice: <sup>'
	)
);

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_del'
		,'del'
		,IconDir + 'borrar.png' 
		,'<del datetime="' + datetime + '">' + '<strong>(Corrección: ' + spdate + ')</strong> '
		,'</del>'
		,'d'
		,'edInsertTag'
		,'corregir texto: <del>'
	)
); // *Modified. Show date in Spanish format.

edButtons.push( 
	new edButton(
		'ed_ins'
		,'ins'
		,IconDir + 'insertar_texto.png' 
		,'<ins datetime="' + datetime + '">' + '<strong>(Actualización: ' + spdate + ')</strong> '
		,'</ins>'
		,'s'
		,'edInsertTag'
		,'insertar texto: <ins>'
	)
); // *Modified. Show date in Spanish format.

edButtons.push(
	new edButton(
		'ed_sep'
		,''
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_code'
		,'code'
		,IconDir + 'codigo.png' 
		,'<code>'
		,'</code>'
		,'c'
		,'edInsertTag'
		,'código: <code>'
	)
);

edButtons.push(
	new edButton(
		'ed_pre'
		,'pre'
		,IconDir + 'preformateado.png' 
		,'<pre>'
		,'</pre>'
		,''
		,'edInsertTag'
		,'texto preformateado: <pre>'
	)
);

edButtons.push(
	new edButton(
		'ed_samp'
		,'pre'
		,IconDir + 'muestra.png' 
		,'<samp>'
		,'</samp>'
		,''
		,'edInsertTag'
		,'muestra de la salida de un programa: <samp>'
	)
);

edButtons.push(
	new edButton(
		'ed_kbd'
		,'kbd'
		,IconDir + 'entrada_teclado.png' 
		,'<kbd>'
		,'</kbd>'
		,''
		,'edInsertTag'
		,'entrada de teclado: <kbd>'
	)
);

edButtons.push(
	new edButton(
		'ed_var'
		,'var'
		,IconDir + 'variable.png' 
		,'<var>'
		,'</var>'
		,''
		,'edInsertTag'
		,'variable de un programa: <var>'
	)
);


edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);
edButtons.push(
	new edButton(
		'ed_abbr'
		,'abbr'
		,IconDir + 'abreviatura.png' 
		,'<abbr>'
		,'</abbr>'
		,''
		,'edInsertAbbr'
		,'abreviación: <abbr>'
	)
); // *Added. Special case 3

edButtons.push(
	new edButton(
		'ed_acronym'
		,'acron'
		,IconDir + 'acronimo.png' 
		,'<acronym>'
		,'</acronym>'
		,''
		,'edInsertAbbr'
		,'acrónimo: <acronym>'
	)
); // *Added. Special case 3

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);
edButtons.push(
	new edButton(
		'ed_dl'
		,'dl'
		,IconDir + 'lista_definicion.png' 
		,'<dl>\n'
		,'</dl>\n\n'
		,''
		,'edInsertTag'
		,'lista de definición: <dl>'
	)
);

edButtons.push(
	new edButton(
		'ed_dt'
		,'dt'
		,IconDir + 'definicion_termino.png' 
		,'\t<dt>'
		,'</dt>\n'
		,''
		,'edInsertTag'
		,'término de definición: <dt>'
	)
);

edButtons.push(
	new edButton(
		'ed_dd'
		,'dd'
		,IconDir + 'definicion_texto.png' 
		,'\t<dd>'
		,'</dd>\n'
		,''
		,'edInsertTag'
		,'texto de definición: <dd>'
	)
);

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_table'
		,'table'
		,IconDir + 'tabla.png' 
		,'<table>\n<tbody>'
		,'</tbody>\n</table>\n'
		,''
		,'edInsertTag'
		,'tabla: <table>'
	)
);

edButtons.push(
	new edButton(
		'ed_tr'
		,'tr'
		,IconDir + 'fila.png' 
		,'\t<tr>\n'
		,'\n\t</tr>\n'
		,''
		,'edInsertTag'
		,'fila: <tr>'
	)
);

edButtons.push(
	new edButton(
		'ed_td'
		,'td'
		,IconDir + 'celda.png' 
		,'\t\t<td>'
		,'</td>\n'
		,''
		,'edInsertTag'
		,'celda: <td>'
	)
);

edButtons.push(
	new edButton(
		'ed_sep'
		,'sep'
		,IconDir + 'separador.png' 
		,''
		,''
		,''
		,''	
		,'separador'
	)
);

edButtons.push(
	new edButton(
		'ed_addr'
		,'address'
		,IconDir + 'direccion.png' 
		,'<address>'
		,'</address>'
		,''
		,'edInsertTag'
		,'direccion: <address>'
	)
);


edButtons.push(
	new edButton(
		'ed_nobr'
		,'nobr'
		,IconDir + 'no_saltos.png' 
		,'<nobr>'
		,'</nobr>'
		,''
		,'edInsertTag'
		,'sin saltos de línea: <nobr>'
	)
);

edButtons.push(
	new edButton(
		'ed_spell'
		,'spell'
		,IconDir + 'dicc_rae.png' 
		,''
		,''
		,''
		,'edSpell'
		,'consulta el diccionario de la RAE'
	)
);

edButtons.push(
   new edButton(
       'ed_spellac'
       ,'acronym'
       ,IconDir + 'acro_finder.png'
       ,''
       ,''
       ,''
       ,'edSpellac'
       ,'buscar acrónimo'
   )
); 

/*edButtons.push(
	new edButton(
		'ed_more'
		,'more'
		,IconDir + 'mas.png' 
		,'<!--more-->'
		,''
		,'t'
		,'edInsertTag'
		,'más (sigue leyendo): <!--more--> '
		,-1
	)
);*/

/*edButtons.push(
	new edButton(
		'ed_next'
		,'page'
		,IconDir + 'pagina.png'
		,'<!--nextpage-->'
		,''
		,'p'
		,'edInsertTag'
		,'siguiente página: <!--nextpage-->'
		,-1
	)
);*/


//*************************** END BUTTONS *****************//


//************************ QUICK LINKS *******************//

function edLink(display, URL, newWin) {
	this.display = display;
	this.URL = URL;
	if (!newWin) {
		newWin = 0;
	}
	this.newWin = newWin;
}


//*Añade, quita y reordena tus enlaces favoritos a voluntad 

edLinks[edLinks.length] = new edLink('alexking.org'
                                    ,'http://www.alexking.org/'
                                    );
edLinks[edLinks.length] = new edLink('cruzul'
                                    ,'http://www.xenealoxia.org/cruzul/index.php'
                                    );
edLinks[edLinks.length] = new edLink('sisifodichoso'
                                    ,'http://sisifodichoso.org/'
                                    );

//*************** START PROGRAM *****************//

//**** THE TOOLBAR ****//

function edShowButton(button, i) {
	if (button.access) {
		var accesskey = ' accesskey = "' + button.access + '"';
	}
	else {
		var accesskey = '';
	}	
	if ((button.onClick == 'edInsertImage') || (button.onClick == 'edInsertFastLink') || (button.onClick == 'edInsertFootnote') || (button.onClick == 'edPrev') || (button.onClick == 'edSpell') || (button.onClick == 'edSpellac')) {
		button.onClick += '(edCanvas);';
	}
	else if (button.onClick == 'edInsertTag' || (button.onClick == 'edInsertQuote') || (button.onClick == 'edInsertAbbr') || (button.onClick == 'edInsertList') || (button.onClick == 'edInsertLink')) {
		button.onClick += '(edCanvas, ' + i + ');';
 	}
 	//Separators have onClick=''
 	if (button.onClick == ''){
 	document.write('<img src="' +  button.ico  + '" class="ed_sep_button" '  + 'alt="' + button.title + '" />' ); 	
 	}	
 	else {
	document.write('<button type="button" id="' + button.id + '" ' + accesskey + ' class="ed_button" onmouseover="if(className==\'ed_button\'){className=\'ed_button_over\'};" onmouseout="if(className==\'ed_button_over\'){className=\'ed_button\'};" onclick="' + button.onClick +  '" title="' + button.title + '" >' + '<img src="' +  button.ico  + '" '  + 'alt="' + button.title + '" />'  + '</button>');	
	} 
}
function edAddTag(button) {
	if (edButtons[button].tagEnd != '') {
		edOpenTags[edOpenTags.length] = button;
		//document.getElementById(edButtons[button].id).value = document.getElementById(edButtons[button].id).value;    //no with icons
	}
}

function edRemoveTag(button) {
	for (i = 0; i < edOpenTags.length; i++) {
		if (edOpenTags[i] == button) {
			edOpenTags.splice(i, 1);
			//document.getElementById(edButtons[button].id).value = document.getElementById(edButtons[button].id).value.replace('/', '');  //no with icons
		}
	}
}

function edToolbar() {
	document.write('<div id="ed_toolbar"><span>');
	for (i = 0; i < extendedStart; i++) {
		edShowButton(edButtons[i], i);
	}
	
	if (edShowExtraCookie()) {
		document.write(				
			'<button type="button" id="ed_extra_show" class="ed_button_plegar"  onclick="edShowExtra();"  title="mostrar más botones" style="display: none;">'  + '<img src="' + IconDir + 'desplegar.png" alt="mostrar más botones" />' + '</button>'

			+ '<button type="button" id="ed_extra_hide" class="ed_button_plegar" onclick="edHideExtra();" title="ocultar botones"  >' + '<img src="' + IconDir + 'recoger.png" alt="ocultar botones" />' + '</button>'

			+ '</span>'
			+ '<div id="ed_extra_buttons">'
			
		);
	}
	else {
		document.write(
			 '</span>'
			+ '<div id="ed_extra_buttons" style="display: none;">'
			
		);
		
	}
	for (i = extendedStart; i < edButtons.length; i++) {
	//	edShowButton(edButtons[i], i);
	}
	
	edShowLinks();
	document.write( '</div>');
	document.write('</div>');
	document.write ('<div id="ed_previo" style=\'display:none;\'></div>');
} 


//****************FUNCTIONS**************//

function edCheckOpenTags(button) {
	var tag = 0;
	for (i = 0; i < edOpenTags.length; i++) {
		if (edOpenTags[i] == button) {
			tag++;
		}
	}
	if (tag > 0) {
		return true; // tag found
	}
	else {
		return false; // tag not found
	}
}

function edCloseAllTags() {
	var count = edOpenTags.length;
	for (o = 0; o < count; o++) {
		edInsertTag(edCanvas, edOpenTags[edOpenTags.length - 1]);
	}
}

function edShowLinks() {
	var tempStr = '<select onchange="edQuickLink(this.options[this.selectedIndex].value, this);"><option value="-1" selected>(Enlaces frecuentes)</option>';
	for (i = 0; i < edLinks.length; i++) {
		tempStr += '<option value="' + i + '">' + edLinks[i].display + '</option>';
	}
	tempStr += '</select>';
	document.write(tempStr);
}

function edQuickLink(i, thisSelect) {
	if (i > -1) {
		var newWin = '';
		if (edLinks[i].newWin == 1) {
			newWin = ' target="_blank"';
		}
		var tempStr = '<a href="' + edLinks[i].URL + '"' + newWin + '>' 
		            + edLinks[i].display
		            + '</a>';
		thisSelect.selectedIndex = 0;
		edInsertContent(edCanvas, tempStr);
	}
	else {
		thisSelect.selectedIndex = 0;
	}
}

//Diccionarios

function edSpell(myField) {
	var word = '';
	if (document.selection) {
		myField.focus();
	    var sel = document.selection.createRange();
		if (sel.text.length > 0) {
			word = sel.text;
		}
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		if (startPos != endPos) {
			word = myField.value.substring(startPos, endPos);
		}
	}
	if (word == '') {
		word = prompt('Escribe una palabra: ', '');
	}
	if (word != '') {
		window.open('http://buscon.rae.es/draeI/SrvltGUIBusUsual?LEMA=' + escape(word)); 
	}
}

function edSpellac(myField) {
   var word = '';
   if (document.selection) {
       myField.focus();
       var sel = document.selection.createRange();
       if (sel.text.length > 0) {
           word = sel.text;
       }
   }
   else if (myField.selectionStart || myField.selectionStart == '0') {
       var startPos = myField.selectionStart;
       var endPos = myField.selectionEnd;
       if (startPos != endPos) {
           word = myField.value.substring(startPos, endPos);
       }
   }
   if (word == '') {
       word = prompt('Escriba un texto: ', '');
   }
   if (word != '') {
       window.open('http://www.acronymfinder.com/af-query.asp?Acronym=' + escape(word));
   }
}


/**** Preview functions ****/

//Preview in the same window
function edPrev(myField) {
var text = myField.value;
var prev = document.getElementById('ed_previo');
prev.innerHTML=text;
if (prev.style.display == 'none'){
edCanvas.style.display = 'none';
prev.style.display = 'block';
}
else{
edCanvas.style.display = 'block';;
prev.style.display = 'none';
}
}

//Preview in a new window with styles
/*function edPrev(myField) {
var text = myField.value;
prev = window.open ('', 'previo', 'width=500,height=500');
prev.document.write(
		'<?xml version=\"1.0\" encoding=\"utf-8\"?>'  
		+ '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"'
        	+ '\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">' 
		+ '<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"es\" lang=\"es\">'
		+ '<head>' 
		+ '<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />'
		+ '<title>Vista previa</title>'
		+ '<style type=\"text/css\">@import \"preview.css\";</style>'
		+ '</head>'
		+ '<body>'
		+ text
		+ '</body>'
		+ '</html>'
	);
prev.document.close();
}*/

function edShowExtra() {
	document.getElementById('ed_extra_show').style.display = 'none';
	
	document.getElementById('ed_extra_hide').style.display = 'inline';

	document.getElementById('ed_extra_buttons').style.display = 'block';
	edSetCookie(
		'js_quicktags_extra'
		, 'show'
		, new Date("December 31, 2100")
	);
}

function edHideExtra() {
	document.getElementById('ed_extra_show').style.display = 'inline';
	document.getElementById('ed_extra_buttons').style.display = 'none';	
	document.getElementById('ed_extra_hide').style.display = 'none';	
	edSetCookie(
		'js_quicktags_extra'
		, 'hide'
		, new Date("December 31, 2100")
	);
}

/**** Insert Links with forms ****/

function edFormLink() {	
		var URL = document.forms[0].urllink.value;
		var lang = 'hreflang="' + document.forms[0].langlink.value + '"';
		var title = 'title="' + document.forms[0].titlelink.value + '"';	
		var rev = 'rev="' + document.forms[0].votelink.value + '"';
		var i=1
		while ((edButtons[i].id != 'ed_link') & (i < edButtons.length)) {
			i++;
		}
		edButtons[i].tagStart = '<a href="' + URL + '"';
		if (lang != 'hreflang=""') {
		edButtons[i].tagStart = edButtons[i].tagStart + ' ' + lang;
		}
		if (title != 'title=""') {
  		edButtons[i].tagStart = edButtons[i].tagStart + ' ' + title;
		}
		if (rev != 'rev=" "') {
  		edButtons[i].tagStart = edButtons[i].tagStart + ' ' + rev;
		}
		edButtons[i].tagStart = edButtons[i].tagStart + '>';
		edInsertTag(opener.edCanvas, i);
		if (edCheckOpenTags(i)){
		window.opener.edOpenTags[edOpenTags.length] = i;
		}
		window.close();
} 
function edInsertLink(myField, i) {
	if (!edCheckOpenTags(i)) {
		var formlink = window.open (FormDir + "formlink.html", "formlink", "width=400, height=350,top=300,left=570");			
	}
	else {
		edInsertTag(myField, i);
	}
} 

function edInsertFastLink(myField) {
	var selec;
	//IE support
	if (document.selection) {
		myField.focus();
		var ranselec = document.selection.createRange();	
		selec = ranselec.text;
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		selec =  myField.value.substring(myField.selectionStart,myField.selectionEnd);
	}
	if (selec=='') {
		alert ('Tiene que seleccionar una URI en el textarea');
	}
	else {
		var myValue = '<a href="' + selec + '">' + selec + '</a>';
		edInsertContent(myField, myValue);
		myField.focus();
	}
}

/********** end links ********/
function edFormImg() {
	var URL = document.forms[0].urlimg.value;
	var alt = 'alt="' + document.forms[0].altimg.value + '"';
	var title = 'title="' + document.forms[0].titleimg.value + '"';	
	var style = 'class="' + document.forms[0].styleimg.value + '"';
	var myValue = '<img src="' + URL + '"'; 
	if (alt != 'alt=""') {
		myValue = myValue  + ' ' + alt;  
		}
	if (title != 'title=""') {
		 myValue = myValue  + ' ' +  title; 	
		}
	if (style != 'class=""') {
		 myValue = myValue  + ' ' +  style; 	
		}	
	myValue = myValue + ' ' + '/>'; 
	if (opener.document.selection) {
	opener.edCanvas.focus();
	sel = opener.document.selection.createRange();
	sel.text = myValue;
	opener.edCanvas.focus();
	}
	else{	
	edInsertContent(opener.edCanvas, myValue);
	}
	window.close();	
}
function edInsertImage(myField) {
	var formimg = window.open (FormDir + "formimg.html", "formimg", "width = 400, height=350,top=300,left=570");
	}


// *special case 2: quotes. 
// *Added Function. It's a modified copy from original js_quictags functions

function edInsertQuote(myField, i, defaultValue) {
	if (!edCheckOpenTags(i)) {
		if (edButtons[i].id == 'ed_cite'){
			tag = 'cite';
			edButtons[i].tagStart = '<' + tag;           
			var lang = prompt('Introduzca el código de idioma' , 'xml:lang="es"'); // *cite only with lang
			if (lang) {
				edButtons[i].tagStart = edButtons[i].tagStart + ' ' + lang;
			}
			
		}
		else {                          
			switch (edButtons[i].id){
				case 'ed_block':
					tag = 'blockquote';
					break;
				case 'ed_q':
					tag = 'q';
					break;
				default:
					tag = edButtons[i].id;
			}
			edButtons[i].tagStart = '<' + tag;           
			var lang = prompt('Introduzca el código de idioma' , 'xml:lang="es"'); 
			if (lang) {
				edButtons[i].tagStart = edButtons[i].tagStart + ' ' + lang;
			}
			var URL = prompt('Introduzca la URL de origen', 'http://'); 
			if (URL) {
				edButtons[i].tagStart = edButtons[i].tagStart + ' ' +'cite="' + URL + '"';
			}
		}	

		edButtons[i].tagStart = edButtons[i].tagStart + '>';
		edInsertTag(myField, i);
		
	}
	else {
		edInsertTag(myField, i);
	}
}

// *special case 3: acronym & abbr. 
// *Added Function. It's a modified copy from original js_quictags fucntions

function edInsertAbbr(myField, i) {
	if (!edCheckOpenTags(i)) {
		if (edButtons[i].id == 'ed_abbr'){
			tag = 'abbr';
		}
		else {
			tag = 'acronym';
		}
		edButtons[i].tagStart = '<' + tag;
		var lang = prompt('Introduzca el código de idioma' ,'lang=""');
		if (lang) {
			edButtons[i].tagStart = edButtons[i].tagStart + ' ' + lang;
		}
		var title = prompt('Introduzca una descripción de la abreviatura' ,'title=""');
		if (title) {
			edButtons[i].tagStart = edButtons[i].tagStart + ' ' + title;
		}	
			
		edButtons[i].tagStart = edButtons[i].tagStart + '>';	
		edInsertTag(myField, i);
				
	}
	
	else {
		edInsertTag(myField, i);
	}
}

//*Making lists

function edInsertList(myField, i) {
	var selec;
	//IE support
	if (document.selection) {
		myField.focus();
		var ranselec = document.selection.createRange();	
		selec = ranselec.text;
		var nlinea = '\u000D\u000A'; //salto de linea
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		selec =  myField.value.substring(myField.selectionStart,myField.selectionEnd);
		var nlinea = '\u000A'; //salto de linea
	}
	var elista = selec.split(nlinea);	
	var myValue = edButtons[i].tagStart;
	for (n=0; n < elista.length; n++) {
      		myValue += '\t<li>' + (elista[n]) + '</li>\n';
	}
	myValue += edButtons[i].tagEnd;
	edInsertContent(myField, myValue);
	myField.focus();
}

//footnotes

function edInsertFootnote(myField) {
	var note = prompt('Introduzca el texto de la nota a pie', '');
	if (!note || note == '') {
		return false;
	}
	var now = new Date;
	var fnId = 'fn' + now.getTime();
	var fnStart = edCanvas.value.indexOf('<ol class="footnotes">');
	if (fnStart != -1) {
		var fnStr1 = edCanvas.value.substring(0, fnStart)
		var fnStr2 = edCanvas.value.substring(fnStart, edCanvas.value.length)
		var count = countInstances(fnStr2, '<li id="') + 1;
	}
	else {
		var count = 1;
	}
	var count = '<sup><a href="#' + fnId + 'n" id="' + fnId + '" class="footnote">' + count + '</a></sup>';
	edInsertContent(edCanvas, count);
	if (fnStart != -1) {
		fnStr1 = edCanvas.value.substring(0, fnStart + count.length)
		fnStr2 = edCanvas.value.substring(fnStart + count.length, edCanvas.value.length)
	}
	else {
		var fnStr1 = edCanvas.value;
		var fnStr2 = "\n\n" + '<ol class="footnotes">' + "\n"
		           + '</ol>' + "\n";
	}
	var footnote = '	<li id="' + fnId + 'n">' + note + ' [<a href="#' + fnId + '">volver</a>]</li>' + "\n"
				 + '</ol>';
	edCanvas.value = fnStr1 + fnStr2.replace('</ol>', footnote);
}

function countInstances(string, substr) {
	var count = string.split(substr);
	return count.length - 1;
}

// **** INSERTION CODE ****//

function edInsertTag(myField, i) {
	var sel;
	//IE support
	if (document.selection) {
		myField.focus();
		if (edButtons[i].id=='ed_link' & (!edCheckOpenTags(i))){
		sel = opener.document.selection.createRange();
		}
		else {		
		sel = document.selection.createRange();
		}
		if (sel.text.length > 0) {
			sel.text = edButtons[i].tagStart + sel.text + edButtons[i].tagEnd;
		}
		else {
			if (!edCheckOpenTags(i) || edButtons[i].tagEnd == '') {
				sel.text = edButtons[i].tagStart;
				edAddTag(i);
			}
			else {
				sel.text = edButtons[i].tagEnd;
				edRemoveTag(i);
			}
		}
		myField.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var cursorPos = endPos;
		var scrollTop = myField.scrollTop;
		if (startPos != endPos) {
			myField.value = myField.value.substring(0, startPos)
			              + edButtons[i].tagStart
			              + myField.value.substring(startPos, endPos) 
			              + edButtons[i].tagEnd
			              + myField.value.substring(endPos, myField.value.length);
			cursorPos += edButtons[i].tagStart.length + edButtons[i].tagEnd.length;
		}
		else {
			if (!edCheckOpenTags(i) || edButtons[i].tagEnd == '') {
				myField.value = myField.value.substring(0, startPos) 
				              + edButtons[i].tagStart
				              + myField.value.substring(endPos, myField.value.length);
				edAddTag(i);
				cursorPos = startPos + edButtons[i].tagStart.length;
			}
			else {
				myField.value = myField.value.substring(0, startPos) 
				              + edButtons[i].tagEnd
				              + myField.value.substring(endPos, myField.value.length);
				edRemoveTag(i);
				cursorPos = startPos + edButtons[i].tagEnd.length;
			}
		}
		myField.focus();
		myField.selectionStart = cursorPos;
		myField.selectionEnd = cursorPos;
		myField.scrollTop = scrollTop;
	}
	else {
		if (!edCheckOpenTags(i) || edButtons[i].tagEnd == '') {
			myField.value += edButtons[i].tagStart;
			edAddTag(i);
		}
		else {
			myField.value += edButtons[i].tagEnd;
			edRemoveTag(i);
		}
		myField.focus();
	}
}

function edInsertContent(myField, myValue) {
	var sel;
	//IE support
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		myField.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		myField.value = myField.value.substring(0, startPos)
		              + myValue 
                      + myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		myField.value += myValue;
		myField.focus();
	}
}

//**** COOKIES ***//

function edSetCookie(name, value, expires, path, domain) {
	document.cookie= name + "=" + escape(value) +
		((expires) ? "; expires=" + expires.toGMTString() : "") +
		((path) ? "; path=" + path : "") +
		((domain) ? "; domain=" + domain : "");
}

function edShowExtraCookie() {
	var cookies = document.cookie.split(';');
	for (var i=0;i < cookies.length; i++) {
		var cookieData = cookies[i];
		while (cookieData.charAt(0) ==' ') {
			cookieData = cookieData.substring(1, cookieData.length);
		}
		if (cookieData.indexOf('js_quicktags_extra') == 0) {
			if (cookieData.substring(19, cookieData.length) == 'show') {
				return true;
			}
			else {
				return false;
			}
		}
	}
	return false;
}
