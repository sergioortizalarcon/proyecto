<script>
	/**
* bbCode control by subBlue design [ www.subBlue.com ]
* Includes unixsafe colour palette selector by SHS`
*/

// Startup variables
var imageTag = false;
var theSelection = false;
var bbcodeEnabled = true;

// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion, 10); // Get browser version

var is_ie = ((clientPC.indexOf('msie') !== -1) && (clientPC.indexOf('opera') === -1));
var is_win = ((clientPC.indexOf('win') !== -1) || (clientPC.indexOf('16bit') !== -1));
var baseHeight;

/**
* Shows the help messages in the helpline window
*/
function helpline(help) {
	document.forms[form_name].helpbox.value = help_line[help];
}

/**
* Fix a bug involving the TextRange object. From
* http://www.frostjedi.com/terra/scripts/demo/caretBug.html
*/ 
function initInsertions() {
	var doc;

	if (document.forms[form_name]) {
		doc = document;
	} else {
		doc = opener.document;
	}

	var textarea = doc.forms[form_name].elements[text_name];

	if (is_ie && typeof(baseHeight) !== 'number') {
		textarea.focus();
		baseHeight = doc.selection.createRange().duplicate().boundingHeight;

		if (!document.forms[form_name]) {
			document.body.focus();
		}
	}
}

/**
* bbstyle
*/
function bbstyle(bbnumber) {
	if (bbnumber !== -1) {
		bbfontstyle(bbtags[bbnumber], bbtags[bbnumber+1]);
	} else {
		insert_text('[*]');
		document.forms[form_name].elements[text_name].focus();
	}
}

/**
* Apply bbcodes
*/
function bbfontstyle(bbopen, bbclose) {
	theSelection = false;

	var textarea = document.forms[form_name].elements[text_name];

	textarea.focus();

	if ((clientVer >= 4) && is_ie && is_win) {
		// Get text selection
		theSelection = document.selection.createRange().text;

		if (theSelection) {
			// Add tags around selection
			document.selection.createRange().text = bbopen + theSelection + bbclose;
			textarea.focus();
			theSelection = '';
			return;
		}
	} else if (textarea.selectionEnd && (textarea.selectionEnd - textarea.selectionStart > 0)) {
		mozWrap(textarea, bbopen, bbclose);
		textarea.focus();
		theSelection = '';
		return;
	}

	//The new position for the cursor after adding the bbcode
	var caret_pos = getCaretPosition(textarea).start;
	var new_pos = caret_pos + bbopen.length;

	// Open tag
	insert_text(bbopen + bbclose);

	// Center the cursor when we don't have a selection
	// Gecko and proper browsers
	if (!isNaN(textarea.selectionStart)) {
		textarea.selectionStart = new_pos;
		textarea.selectionEnd = new_pos;
	}
	// IE
	else if (document.selection) {
		var range = textarea.createTextRange(); 
		range.move("character", new_pos); 
		range.select();
		storeCaret(textarea);
	}

	textarea.focus();
	return;
}

/**
* Insert text at position
*/
function insert_text(text, spaces, popup) {
	var textarea;

	if (!popup) {
		textarea = document.forms[form_name].elements[text_name];
	} else {
		textarea = opener.document.forms[form_name].elements[text_name];
	}

	if (spaces) {
		text = ' ' + text + ' ';
	}

	// Since IE9, IE also has textarea.selectionStart, but it still needs to be treated the old way.
	// Therefore we simply add a !is_ie here until IE fixes the text-selection completely.
	if (!isNaN(textarea.selectionStart) && !is_ie) {
		var sel_start = textarea.selectionStart;
		var sel_end = textarea.selectionEnd;

		mozWrap(textarea, text, '');
		textarea.selectionStart = sel_start + text.length;
		textarea.selectionEnd = sel_end + text.length;
	} else if (textarea.createTextRange && textarea.caretPos) {
		if (baseHeight !== textarea.caretPos.boundingHeight) {
			textarea.focus();
			storeCaret(textarea);
		}

		var caret_pos = textarea.caretPos;
		caret_pos.text = caret_pos.text.charAt(caret_pos.text.length - 1) === ' ' ? caret_pos.text + text + ' ' : caret_pos.text + text;
	} else {
		textarea.value = textarea.value + text;
	}

	if (!popup) {
		textarea.focus();
	}
}

/**
* Add inline attachment at position
*/
function attach_inline(index, filename) {
	insert_text('[attachment=' + index + ']' + filename + '[/attachment]');
	document.forms[form_name].elements[text_name].focus();
}

/**
* Add quote text to message
*/
function addquote(post_id, username, l_wrote) {
	var message_name = 'message_' + post_id;
	var theSelection = '';
	var divarea = false;
	var i;

	if (l_wrote === undefined) {
		// Backwards compatibility
		l_wrote = 'wrote';
	}

	if (document.all) {
		divarea = document.all[message_name];
	} else {
		divarea = document.getElementById(message_name);
	}

	// Get text selection - not only the post content :(
	// IE9 must use the document.selection method but has the *.getSelection so we just force no IE
	if (window.getSelection && !is_ie && !window.opera) {
		theSelection = window.getSelection().toString();
	} else if (document.getSelection && !is_ie) {
		theSelection = document.getSelection();
	} else if (document.selection) {
		theSelection = document.selection.createRange().text;
	}

	if (theSelection === '' || typeof theSelection === 'undefined' || theSelection === null) {
		if (divarea.innerHTML) {
			theSelection = divarea.innerHTML.replace(/<br>/ig, '\n');
			theSelection = theSelection.replace(/<br\/>/ig, '\n');
			theSelection = theSelection.replace(/&lt\;/ig, '<');
			theSelection = theSelection.replace(/&gt\;/ig, '>');
			theSelection = theSelection.replace(/&amp\;/ig, '&');
			theSelection = theSelection.replace(/&nbsp\;/ig, ' ');
		} else if (document.all) {
			theSelection = divarea.innerText;
		} else if (divarea.textContent) {
			theSelection = divarea.textContent;
		} else if (divarea.firstChild.nodeValue) {
			theSelection = divarea.firstChild.nodeValue;
		}
	}

	if (theSelection) {
		if (bbcodeEnabled) {
			insert_text('[quote="' + username + '"]' + theSelection + '[/quote]');
		} else {
			insert_text(username + ' ' + l_wrote + ':' + '\n');
			var lines = split_lines(theSelection);
			for (i = 0; i < lines.length; i++) {
				insert_text('> ' + lines[i] + '\n');
			}
		}
	}

	return;
}

function split_lines(text) {
	var lines = text.split('\n');
	var splitLines = new Array();
	var j = 0;
	var i;

	for(i = 0; i < lines.length; i++) {
		if (lines[i].length <= 80) {
			splitLines[j] = lines[i];
			j++;
		} else {
			var line = lines[i];
			var splitAt;
			do {
				splitAt = line.indexOf(' ', 80);

				if (splitAt === -1) {
					splitLines[j] = line;
					j++;
				} else {
					splitLines[j] = line.substring(0, splitAt);
					line = line.substring(splitAt);
					j++;
				}
			}
			while(splitAt !== -1);
		}
	}
	return splitLines;
}

/**
* From http://www.massless.org/mozedit/
*/
function mozWrap(txtarea, open, close) {
	var selLength = (typeof(txtarea.textLength) === 'undefined') ? txtarea.value.length : txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	var scrollTop = txtarea.scrollTop;

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd);
	var s3 = (txtarea.value).substring(selEnd, selLength);

	txtarea.value = s1 + open + s2 + close + s3;
	txtarea.selectionStart = selStart + open.length;
	txtarea.selectionEnd = selEnd + open.length;
	txtarea.focus();
	txtarea.scrollTop = scrollTop;

	return;
}

/**
* Insert at Caret position. Code from
* http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
*/
function storeCaret(textEl) {
	if (textEl.createTextRange && document.selection) {
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}

/**
* Caret Position object
*/
function caretPosition() {
	var start = null;
	var end = null;
}

/**
* Get the caret position in an textarea
*/
function getCaretPosition(txtarea) {
	var caretPos = new caretPosition();

	// simple Gecko/Opera way
	if (txtarea.selectionStart || txtarea.selectionStart === 0) {
		caretPos.start = txtarea.selectionStart;
		caretPos.end = txtarea.selectionEnd;
	}
	// dirty and slow IE way
	else if (document.selection) {
		// get current selection
		var range = document.selection.createRange();

		// a new selection of the whole textarea
		var range_all = document.body.createTextRange();
		range_all.moveToElementText(txtarea);

		// calculate selection start point by moving beginning of range_all to beginning of range
		var sel_start;
		for (sel_start = 0; range_all.compareEndPoints('StartToStart', range) < 0; sel_start++) {
			range_all.moveStart('character', 1);
		}

		txtarea.sel_start = sel_start;

		// we ignore the end value for IE, this is already dirty enough and we don't need it
		caretPos.start = txtarea.sel_start;
		caretPos.end = txtarea.sel_start;
	}

	return caretPos;
}


</script>
<script type="text/javascript">
// <![CDATA[
	var form_name = 'postform';
	var text_name = 'message';
	var load_draft = false;
	var upload = false;

	// Define the bbCode tags
	var bbcode = new Array();
	var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]', '[center]', '[/center]', '[s]', '[/s]', '[spoiler]', '[/spoiler]', '[youtube]', '[/youtube]');
	var imageTag = false;

	// Helpline messages
	var help_line = {
		b: 'Texto en negrita: [b]texto[/b]',
		i: 'Texto Itálica: [i]texto[/i]',
		u: 'Texto subrayado: [u]texto[/u]',
		q: 'Citar texto: [quote]texto[/quote]',
		c: 'Mostrar código: [code]código[/code]',
		l: 'Lista: [list][*]texto[/list]',
		o: 'Lista ordenada: Por ejemplo, [list=1][*]Primer punto[/list] o [list=a][*]Punto a[/list]',
		p: 'Inserta imagen: [img]http://imagen_url[/img]',
		w: 'Insertar URL: [url]http://url[/url] ó [url=http://url]URL texto[/url]',
		a: 'Insertar adjunto: [attachment=]filename.ext[/attachment]',
		s: 'Color de fuente: [color=red]texto[/color] o [color=#FF0000]text[/color]',
		f: 'Tamaño de fuente: [size=x-small]texto pequeño[/size]',
		y: 'Lista: Añadir elemento a la lista',
		d: 'Flash: [flash=width,height]http://url[/flash]'
					,cb_22: 'Centrar: [center]texto[/center]'
					,cb_24: 'Texto tachado: [s]texto[/s]'
					,cb_26: 'Ocultar: [spoiler]texto[/spoiler]'
					,cb_28: 'Youtube: [youtube]https://youtu.be/video_url[/youtube]'
			}
</script>



<div class="container">
	<form action="" method="post">
		<fieldset>
			<legend>Publicar comentario</legend>
			<label for="idFecha">Fecha</label>
			<input type="text" id="idFecha" name="idFecha" readonly="readonly">
			value="<?php date_default_timezone_set("Europe/Madrid"); echo date("Y-m-d H:i:s");?>" />
			<br/>
			<label for="idNickname">NickName</label>
			<input type="text" id="idNickname" name="idNickname"/>
			<br/>
			<label for="idComentario">comentario</label><br/>
			<textarea id="idComentario" name="idComentario" rows="12" cols="70"/>

			</textarea>
			<br/>
			<input type="submit" name="insertar_comentario" value="Comentar artículo" />
		</fieldset>
	</form>


	<div id="page-body">
	<h2 class="posting-title"><a href="#/noticias/#">Apartado noticias</a></h2>
<form id="postform" method="post" action="http://www.pirateking.es/foro/posting.php?mode=post&amp;f=3">






<div class="panel" id="postingbox">
	<div class="inner">
	<h3>Publicar un nuevo tema</h3>
		<fieldset class="fields1">
		<dl style="clear: left;">
		<dt><label for="subject">Asunto:</label></dt>
		<dd><input type="text" name="subject" id="subject" size="45" maxlength="120" tabindex="2" value="" class="inputbox autowidth"></dd>
	</dl>
	
<div id="format-buttons">
	<button type="button" class="button2 bbcode-b" accesskey="b" name="addbbcode0" onclick="bbstyle(0)" title="Texto en negrita: [b]texto[/b]">
		<i class="fa fa-bold"></i>
	</button>
	<button type="button" class="button2 bbcode-i" accesskey="i" name="addbbcode2" onclick="bbstyle(2)" title="Texto Itálica: [i]texto[/i]">
		<i class="	fa fa-italic"></i>
	</button>
	<button type="button" class="button2 bbcode-u" accesskey="u" name="addbbcode4" onclick="bbstyle(4)" title="Texto subrayado: [u]texto[/u]">
		<i class="fa fa-underline"></i>
	</button>
	<button type="button" class="button2 bbcode-quote" accesskey="q" name="addbbcode6" onclick="bbstyle(6)" title="Citar texto: [quote]texto[/quote]">
		<i class="fas fa-quote-left"></i>
	</button>
	<button type="button" class="button2 bbcode-code" accesskey="c" name="addbbcode8" onclick="bbstyle(8)" title="Mostrar código: [code]código[/code]">
		<i class="fa fa-file-code"></i>
		</button>
	<button type="button" class="button2 bbcode-list" accesskey="l" name="addbbcode10" onclick="bbstyle(10)" title="Lista: [list][*]texto[/list]">
		<i class="fa fa-list-ul"></i>
	</button>
	<button type="button" class="button2 bbcode-list-" accesskey="o" name="addbbcode12" onclick="bbstyle(12)" title="Lista ordenada: Por ejemplo, [list=1][*]Primer punto[/list] o [list=a][*]Punto a[/list]">
		<i class="fa fa-list-ol"></i>
	</button>
	<button type="button" class="button2 bbcode-asterisk" accesskey="y" name="addlistitem" onclick="bbstyle(-1)" title="Listar ítem: [*]texto">
		<i class="fa fa-asterisk"></i>
	</button>
			<button type="button" class="button2 bbcode-img" accesskey="p" name="addbbcode14" onclick="bbstyle(14)" title="Inserta imagen: [img]http://imagen_url[/img]">
				<i class="fa fa-camera-retro"></i>
			</button>
			<button type="button" class="button2 bbcode-url" accesskey="w" name="addbbcode16" onclick="bbstyle(16)" title="Insertar URL: [url]http://url[/url] ó [url=http://url]URL texto[/url]">
				<i class="fa fa-location-arrow"></i>
			</button>
	<select name="addbbcode20" class="bbcode-size" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;" title="Tamaño de fuente: [size=x-small]texto pequeño[/size]">
		<option value="50">Diminuta</option>
		<option value="85">Pequeña</option>
		<option value="100" selected="selected">Normal</option>
		<option value="150">Grande</option>
		<option value="200">Enorme</option>
	</select>
	<button type="button" class="button2 bbcode-center" name="addbbcode22" onclick="bbstyle(22)" title="Centrar: [center]texto[/center]">
		<i class="fa fa-align-center"></i>
	</button>

	<button type="button" class="button2 bbcode-s" name="addbbcode24" onclick="bbstyle(24)" title="Texto tachado: [s]texto[/s]">
		<i class="fa fa-strikethrough"></i>
	</button>

	<button type="button" class="button2 bbcode-spoiler" name="addbbcode26" onclick="bbstyle(26)" title="Ocultar: [spoiler]texto[/spoiler]">
		<li class="fa fa-lock"></li>
	</button>

	<button type="button" class="button2 bbcode-youtube" name="addbbcode28" onclick="bbstyle(28)" title="Youtube: [youtube]https://youtu.be/video_url[/youtube]">
		<i class="fa fa-youtube-square"></i>
	</button>

	</div>

	<div id="message-box">
		<textarea name="message" id="message" rows="15" cols="76" tabindex="4" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onfocus="initInsertions();" class="inputbox"></textarea>
	</div>

	</fieldset>
	</div>
	</div>
</form>
</div>
</div>