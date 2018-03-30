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

	function change_palette()
	{
		phpbb.toggleDisplay('colour_palette');
		e = document.getElementById('colour_palette');

		if (e.style.display == 'block')
		{
			//document.getElementById('bbpalette').value = 'Ocultar color de fuente';
		}
		else
		{
			//document.getElementById('bbpalette').value = 'Color de fuente';
		}
	}

// ]]>
</script>

<div class="container">
	<form action="" method="post">
		<fieldset>
			<legend>Publicar comentario</legend>
			<label for="idNickname">NickName</label>
			<input type="text" id="idNickname" name="idNickname"/>
			<br/>
			<label for="idComentario">comentario</label>
			<textarea id="idComentario" name="idComentario"/>

			</textarea>
			<br/>
			<label for="idFecha">Fecha</label>
			<input type="text" id="idFecha" name="idFecha"/>
			value="<?php date_default_timezone_set("Europe/Madrid");
echo date("Y-m-d H:i:s");?>" />
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

	<!--
/**
*
* @package Ultimate SEO URL phpBB SEO
* @version $$
* @copyright (c) 2014 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
-->




<div id="colour_palette" style="display: none;">
	<dl style="clear: left;">
		<dt><label>Color de fuente:</label></dt>
		<dd id="color_palette_placeholder" data-orientation="h" data-height="12" data-width="15" data-bbcode="true"><table class="not-responsive colour-palette horizontal-palette" style="width: auto;"><tbody><tr><td style="background-color: #000000; width: 15px; height: 12px;"><a href="#" data-color="000000" style="display: block; width: 15px; height: 12px; " alt="#000000" title="#000000"></a></td><td style="background-color: #000040; width: 15px; height: 12px;"><a href="#" data-color="000040" style="display: block; width: 15px; height: 12px; " alt="#000040" title="#000040"></a></td><td style="background-color: #000080; width: 15px; height: 12px;"><a href="#" data-color="000080" style="display: block; width: 15px; height: 12px; " alt="#000080" title="#000080"></a></td><td style="background-color: #0000BF; width: 15px; height: 12px;"><a href="#" data-color="0000BF" style="display: block; width: 15px; height: 12px; " alt="#0000BF" title="#0000BF"></a></td><td style="background-color: #0000FF; width: 15px; height: 12px;"><a href="#" data-color="0000FF" style="display: block; width: 15px; height: 12px; " alt="#0000FF" title="#0000FF"></a></td><td style="background-color: #004000; width: 15px; height: 12px;"><a href="#" data-color="004000" style="display: block; width: 15px; height: 12px; " alt="#004000" title="#004000"></a></td><td style="background-color: #004040; width: 15px; height: 12px;"><a href="#" data-color="004040" style="display: block; width: 15px; height: 12px; " alt="#004040" title="#004040"></a></td><td style="background-color: #004080; width: 15px; height: 12px;"><a href="#" data-color="004080" style="display: block; width: 15px; height: 12px; " alt="#004080" title="#004080"></a></td><td style="background-color: #0040BF; width: 15px; height: 12px;"><a href="#" data-color="0040BF" style="display: block; width: 15px; height: 12px; " alt="#0040BF" title="#0040BF"></a></td><td style="background-color: #0040FF; width: 15px; height: 12px;"><a href="#" data-color="0040FF" style="display: block; width: 15px; height: 12px; " alt="#0040FF" title="#0040FF"></a></td><td style="background-color: #008000; width: 15px; height: 12px;"><a href="#" data-color="008000" style="display: block; width: 15px; height: 12px; " alt="#008000" title="#008000"></a></td><td style="background-color: #008040; width: 15px; height: 12px;"><a href="#" data-color="008040" style="display: block; width: 15px; height: 12px; " alt="#008040" title="#008040"></a></td><td style="background-color: #008080; width: 15px; height: 12px;"><a href="#" data-color="008080" style="display: block; width: 15px; height: 12px; " alt="#008080" title="#008080"></a></td><td style="background-color: #0080BF; width: 15px; height: 12px;"><a href="#" data-color="0080BF" style="display: block; width: 15px; height: 12px; " alt="#0080BF" title="#0080BF"></a></td><td style="background-color: #0080FF; width: 15px; height: 12px;"><a href="#" data-color="0080FF" style="display: block; width: 15px; height: 12px; " alt="#0080FF" title="#0080FF"></a></td><td style="background-color: #00BF00; width: 15px; height: 12px;"><a href="#" data-color="00BF00" style="display: block; width: 15px; height: 12px; " alt="#00BF00" title="#00BF00"></a></td><td style="background-color: #00BF40; width: 15px; height: 12px;"><a href="#" data-color="00BF40" style="display: block; width: 15px; height: 12px; " alt="#00BF40" title="#00BF40"></a></td><td style="background-color: #00BF80; width: 15px; height: 12px;"><a href="#" data-color="00BF80" style="display: block; width: 15px; height: 12px; " alt="#00BF80" title="#00BF80"></a></td><td style="background-color: #00BFBF; width: 15px; height: 12px;"><a href="#" data-color="00BFBF" style="display: block; width: 15px; height: 12px; " alt="#00BFBF" title="#00BFBF"></a></td><td style="background-color: #00BFFF; width: 15px; height: 12px;"><a href="#" data-color="00BFFF" style="display: block; width: 15px; height: 12px; " alt="#00BFFF" title="#00BFFF"></a></td><td style="background-color: #00FF00; width: 15px; height: 12px;"><a href="#" data-color="00FF00" style="display: block; width: 15px; height: 12px; " alt="#00FF00" title="#00FF00"></a></td><td style="background-color: #00FF40; width: 15px; height: 12px;"><a href="#" data-color="00FF40" style="display: block; width: 15px; height: 12px; " alt="#00FF40" title="#00FF40"></a></td><td style="background-color: #00FF80; width: 15px; height: 12px;"><a href="#" data-color="00FF80" style="display: block; width: 15px; height: 12px; " alt="#00FF80" title="#00FF80"></a></td><td style="background-color: #00FFBF; width: 15px; height: 12px;"><a href="#" data-color="00FFBF" style="display: block; width: 15px; height: 12px; " alt="#00FFBF" title="#00FFBF"></a></td><td style="background-color: #00FFFF; width: 15px; height: 12px;"><a href="#" data-color="00FFFF" style="display: block; width: 15px; height: 12px; " alt="#00FFFF" title="#00FFFF"></a></td></tr><tr><td style="background-color: #400000; width: 15px; height: 12px;"><a href="#" data-color="400000" style="display: block; width: 15px; height: 12px; " alt="#400000" title="#400000"></a></td><td style="background-color: #400040; width: 15px; height: 12px;"><a href="#" data-color="400040" style="display: block; width: 15px; height: 12px; " alt="#400040" title="#400040"></a></td><td style="background-color: #400080; width: 15px; height: 12px;"><a href="#" data-color="400080" style="display: block; width: 15px; height: 12px; " alt="#400080" title="#400080"></a></td><td style="background-color: #4000BF; width: 15px; height: 12px;"><a href="#" data-color="4000BF" style="display: block; width: 15px; height: 12px; " alt="#4000BF" title="#4000BF"></a></td><td style="background-color: #4000FF; width: 15px; height: 12px;"><a href="#" data-color="4000FF" style="display: block; width: 15px; height: 12px; " alt="#4000FF" title="#4000FF"></a></td><td style="background-color: #404000; width: 15px; height: 12px;"><a href="#" data-color="404000" style="display: block; width: 15px; height: 12px; " alt="#404000" title="#404000"></a></td><td style="background-color: #404040; width: 15px; height: 12px;"><a href="#" data-color="404040" style="display: block; width: 15px; height: 12px; " alt="#404040" title="#404040"></a></td><td style="background-color: #404080; width: 15px; height: 12px;"><a href="#" data-color="404080" style="display: block; width: 15px; height: 12px; " alt="#404080" title="#404080"></a></td><td style="background-color: #4040BF; width: 15px; height: 12px;"><a href="#" data-color="4040BF" style="display: block; width: 15px; height: 12px; " alt="#4040BF" title="#4040BF"></a></td><td style="background-color: #4040FF; width: 15px; height: 12px;"><a href="#" data-color="4040FF" style="display: block; width: 15px; height: 12px; " alt="#4040FF" title="#4040FF"></a></td><td style="background-color: #408000; width: 15px; height: 12px;"><a href="#" data-color="408000" style="display: block; width: 15px; height: 12px; " alt="#408000" title="#408000"></a></td><td style="background-color: #408040; width: 15px; height: 12px;"><a href="#" data-color="408040" style="display: block; width: 15px; height: 12px; " alt="#408040" title="#408040"></a></td><td style="background-color: #408080; width: 15px; height: 12px;"><a href="#" data-color="408080" style="display: block; width: 15px; height: 12px; " alt="#408080" title="#408080"></a></td><td style="background-color: #4080BF; width: 15px; height: 12px;"><a href="#" data-color="4080BF" style="display: block; width: 15px; height: 12px; " alt="#4080BF" title="#4080BF"></a></td><td style="background-color: #4080FF; width: 15px; height: 12px;"><a href="#" data-color="4080FF" style="display: block; width: 15px; height: 12px; " alt="#4080FF" title="#4080FF"></a></td><td style="background-color: #40BF00; width: 15px; height: 12px;"><a href="#" data-color="40BF00" style="display: block; width: 15px; height: 12px; " alt="#40BF00" title="#40BF00"></a></td><td style="background-color: #40BF40; width: 15px; height: 12px;"><a href="#" data-color="40BF40" style="display: block; width: 15px; height: 12px; " alt="#40BF40" title="#40BF40"></a></td><td style="background-color: #40BF80; width: 15px; height: 12px;"><a href="#" data-color="40BF80" style="display: block; width: 15px; height: 12px; " alt="#40BF80" title="#40BF80"></a></td><td style="background-color: #40BFBF; width: 15px; height: 12px;"><a href="#" data-color="40BFBF" style="display: block; width: 15px; height: 12px; " alt="#40BFBF" title="#40BFBF"></a></td><td style="background-color: #40BFFF; width: 15px; height: 12px;"><a href="#" data-color="40BFFF" style="display: block; width: 15px; height: 12px; " alt="#40BFFF" title="#40BFFF"></a></td><td style="background-color: #40FF00; width: 15px; height: 12px;"><a href="#" data-color="40FF00" style="display: block; width: 15px; height: 12px; " alt="#40FF00" title="#40FF00"></a></td><td style="background-color: #40FF40; width: 15px; height: 12px;"><a href="#" data-color="40FF40" style="display: block; width: 15px; height: 12px; " alt="#40FF40" title="#40FF40"></a></td><td style="background-color: #40FF80; width: 15px; height: 12px;"><a href="#" data-color="40FF80" style="display: block; width: 15px; height: 12px; " alt="#40FF80" title="#40FF80"></a></td><td style="background-color: #40FFBF; width: 15px; height: 12px;"><a href="#" data-color="40FFBF" style="display: block; width: 15px; height: 12px; " alt="#40FFBF" title="#40FFBF"></a></td><td style="background-color: #40FFFF; width: 15px; height: 12px;"><a href="#" data-color="40FFFF" style="display: block; width: 15px; height: 12px; " alt="#40FFFF" title="#40FFFF"></a></td></tr><tr><td style="background-color: #800000; width: 15px; height: 12px;"><a href="#" data-color="800000" style="display: block; width: 15px; height: 12px; " alt="#800000" title="#800000"></a></td><td style="background-color: #800040; width: 15px; height: 12px;"><a href="#" data-color="800040" style="display: block; width: 15px; height: 12px; " alt="#800040" title="#800040"></a></td><td style="background-color: #800080; width: 15px; height: 12px;"><a href="#" data-color="800080" style="display: block; width: 15px; height: 12px; " alt="#800080" title="#800080"></a></td><td style="background-color: #8000BF; width: 15px; height: 12px;"><a href="#" data-color="8000BF" style="display: block; width: 15px; height: 12px; " alt="#8000BF" title="#8000BF"></a></td><td style="background-color: #8000FF; width: 15px; height: 12px;"><a href="#" data-color="8000FF" style="display: block; width: 15px; height: 12px; " alt="#8000FF" title="#8000FF"></a></td><td style="background-color: #804000; width: 15px; height: 12px;"><a href="#" data-color="804000" style="display: block; width: 15px; height: 12px; " alt="#804000" title="#804000"></a></td><td style="background-color: #804040; width: 15px; height: 12px;"><a href="#" data-color="804040" style="display: block; width: 15px; height: 12px; " alt="#804040" title="#804040"></a></td><td style="background-color: #804080; width: 15px; height: 12px;"><a href="#" data-color="804080" style="display: block; width: 15px; height: 12px; " alt="#804080" title="#804080"></a></td><td style="background-color: #8040BF; width: 15px; height: 12px;"><a href="#" data-color="8040BF" style="display: block; width: 15px; height: 12px; " alt="#8040BF" title="#8040BF"></a></td><td style="background-color: #8040FF; width: 15px; height: 12px;"><a href="#" data-color="8040FF" style="display: block; width: 15px; height: 12px; " alt="#8040FF" title="#8040FF"></a></td><td style="background-color: #808000; width: 15px; height: 12px;"><a href="#" data-color="808000" style="display: block; width: 15px; height: 12px; " alt="#808000" title="#808000"></a></td><td style="background-color: #808040; width: 15px; height: 12px;"><a href="#" data-color="808040" style="display: block; width: 15px; height: 12px; " alt="#808040" title="#808040"></a></td><td style="background-color: #808080; width: 15px; height: 12px;"><a href="#" data-color="808080" style="display: block; width: 15px; height: 12px; " alt="#808080" title="#808080"></a></td><td style="background-color: #8080BF; width: 15px; height: 12px;"><a href="#" data-color="8080BF" style="display: block; width: 15px; height: 12px; " alt="#8080BF" title="#8080BF"></a></td><td style="background-color: #8080FF; width: 15px; height: 12px;"><a href="#" data-color="8080FF" style="display: block; width: 15px; height: 12px; " alt="#8080FF" title="#8080FF"></a></td><td style="background-color: #80BF00; width: 15px; height: 12px;"><a href="#" data-color="80BF00" style="display: block; width: 15px; height: 12px; " alt="#80BF00" title="#80BF00"></a></td><td style="background-color: #80BF40; width: 15px; height: 12px;"><a href="#" data-color="80BF40" style="display: block; width: 15px; height: 12px; " alt="#80BF40" title="#80BF40"></a></td><td style="background-color: #80BF80; width: 15px; height: 12px;"><a href="#" data-color="80BF80" style="display: block; width: 15px; height: 12px; " alt="#80BF80" title="#80BF80"></a></td><td style="background-color: #80BFBF; width: 15px; height: 12px;"><a href="#" data-color="80BFBF" style="display: block; width: 15px; height: 12px; " alt="#80BFBF" title="#80BFBF"></a></td><td style="background-color: #80BFFF; width: 15px; height: 12px;"><a href="#" data-color="80BFFF" style="display: block; width: 15px; height: 12px; " alt="#80BFFF" title="#80BFFF"></a></td><td style="background-color: #80FF00; width: 15px; height: 12px;"><a href="#" data-color="80FF00" style="display: block; width: 15px; height: 12px; " alt="#80FF00" title="#80FF00"></a></td><td style="background-color: #80FF40; width: 15px; height: 12px;"><a href="#" data-color="80FF40" style="display: block; width: 15px; height: 12px; " alt="#80FF40" title="#80FF40"></a></td><td style="background-color: #80FF80; width: 15px; height: 12px;"><a href="#" data-color="80FF80" style="display: block; width: 15px; height: 12px; " alt="#80FF80" title="#80FF80"></a></td><td style="background-color: #80FFBF; width: 15px; height: 12px;"><a href="#" data-color="80FFBF" style="display: block; width: 15px; height: 12px; " alt="#80FFBF" title="#80FFBF"></a></td><td style="background-color: #80FFFF; width: 15px; height: 12px;"><a href="#" data-color="80FFFF" style="display: block; width: 15px; height: 12px; " alt="#80FFFF" title="#80FFFF"></a></td></tr><tr><td style="background-color: #BF0000; width: 15px; height: 12px;"><a href="#" data-color="BF0000" style="display: block; width: 15px; height: 12px; " alt="#BF0000" title="#BF0000"></a></td><td style="background-color: #BF0040; width: 15px; height: 12px;"><a href="#" data-color="BF0040" style="display: block; width: 15px; height: 12px; " alt="#BF0040" title="#BF0040"></a></td><td style="background-color: #BF0080; width: 15px; height: 12px;"><a href="#" data-color="BF0080" style="display: block; width: 15px; height: 12px; " alt="#BF0080" title="#BF0080"></a></td><td style="background-color: #BF00BF; width: 15px; height: 12px;"><a href="#" data-color="BF00BF" style="display: block; width: 15px; height: 12px; " alt="#BF00BF" title="#BF00BF"></a></td><td style="background-color: #BF00FF; width: 15px; height: 12px;"><a href="#" data-color="BF00FF" style="display: block; width: 15px; height: 12px; " alt="#BF00FF" title="#BF00FF"></a></td><td style="background-color: #BF4000; width: 15px; height: 12px;"><a href="#" data-color="BF4000" style="display: block; width: 15px; height: 12px; " alt="#BF4000" title="#BF4000"></a></td><td style="background-color: #BF4040; width: 15px; height: 12px;"><a href="#" data-color="BF4040" style="display: block; width: 15px; height: 12px; " alt="#BF4040" title="#BF4040"></a></td><td style="background-color: #BF4080; width: 15px; height: 12px;"><a href="#" data-color="BF4080" style="display: block; width: 15px; height: 12px; " alt="#BF4080" title="#BF4080"></a></td><td style="background-color: #BF40BF; width: 15px; height: 12px;"><a href="#" data-color="BF40BF" style="display: block; width: 15px; height: 12px; " alt="#BF40BF" title="#BF40BF"></a></td><td style="background-color: #BF40FF; width: 15px; height: 12px;"><a href="#" data-color="BF40FF" style="display: block; width: 15px; height: 12px; " alt="#BF40FF" title="#BF40FF"></a></td><td style="background-color: #BF8000; width: 15px; height: 12px;"><a href="#" data-color="BF8000" style="display: block; width: 15px; height: 12px; " alt="#BF8000" title="#BF8000"></a></td><td style="background-color: #BF8040; width: 15px; height: 12px;"><a href="#" data-color="BF8040" style="display: block; width: 15px; height: 12px; " alt="#BF8040" title="#BF8040"></a></td><td style="background-color: #BF8080; width: 15px; height: 12px;"><a href="#" data-color="BF8080" style="display: block; width: 15px; height: 12px; " alt="#BF8080" title="#BF8080"></a></td><td style="background-color: #BF80BF; width: 15px; height: 12px;"><a href="#" data-color="BF80BF" style="display: block; width: 15px; height: 12px; " alt="#BF80BF" title="#BF80BF"></a></td><td style="background-color: #BF80FF; width: 15px; height: 12px;"><a href="#" data-color="BF80FF" style="display: block; width: 15px; height: 12px; " alt="#BF80FF" title="#BF80FF"></a></td><td style="background-color: #BFBF00; width: 15px; height: 12px;"><a href="#" data-color="BFBF00" style="display: block; width: 15px; height: 12px; " alt="#BFBF00" title="#BFBF00"></a></td><td style="background-color: #BFBF40; width: 15px; height: 12px;"><a href="#" data-color="BFBF40" style="display: block; width: 15px; height: 12px; " alt="#BFBF40" title="#BFBF40"></a></td><td style="background-color: #BFBF80; width: 15px; height: 12px;"><a href="#" data-color="BFBF80" style="display: block; width: 15px; height: 12px; " alt="#BFBF80" title="#BFBF80"></a></td><td style="background-color: #BFBFBF; width: 15px; height: 12px;"><a href="#" data-color="BFBFBF" style="display: block; width: 15px; height: 12px; " alt="#BFBFBF" title="#BFBFBF"></a></td><td style="background-color: #BFBFFF; width: 15px; height: 12px;"><a href="#" data-color="BFBFFF" style="display: block; width: 15px; height: 12px; " alt="#BFBFFF" title="#BFBFFF"></a></td><td style="background-color: #BFFF00; width: 15px; height: 12px;"><a href="#" data-color="BFFF00" style="display: block; width: 15px; height: 12px; " alt="#BFFF00" title="#BFFF00"></a></td><td style="background-color: #BFFF40; width: 15px; height: 12px;"><a href="#" data-color="BFFF40" style="display: block; width: 15px; height: 12px; " alt="#BFFF40" title="#BFFF40"></a></td><td style="background-color: #BFFF80; width: 15px; height: 12px;"><a href="#" data-color="BFFF80" style="display: block; width: 15px; height: 12px; " alt="#BFFF80" title="#BFFF80"></a></td><td style="background-color: #BFFFBF; width: 15px; height: 12px;"><a href="#" data-color="BFFFBF" style="display: block; width: 15px; height: 12px; " alt="#BFFFBF" title="#BFFFBF"></a></td><td style="background-color: #BFFFFF; width: 15px; height: 12px;"><a href="#" data-color="BFFFFF" style="display: block; width: 15px; height: 12px; " alt="#BFFFFF" title="#BFFFFF"></a></td></tr><tr><td style="background-color: #FF0000; width: 15px; height: 12px;"><a href="#" data-color="FF0000" style="display: block; width: 15px; height: 12px; " alt="#FF0000" title="#FF0000"></a></td><td style="background-color: #FF0040; width: 15px; height: 12px;"><a href="#" data-color="FF0040" style="display: block; width: 15px; height: 12px; " alt="#FF0040" title="#FF0040"></a></td><td style="background-color: #FF0080; width: 15px; height: 12px;"><a href="#" data-color="FF0080" style="display: block; width: 15px; height: 12px; " alt="#FF0080" title="#FF0080"></a></td><td style="background-color: #FF00BF; width: 15px; height: 12px;"><a href="#" data-color="FF00BF" style="display: block; width: 15px; height: 12px; " alt="#FF00BF" title="#FF00BF"></a></td><td style="background-color: #FF00FF; width: 15px; height: 12px;"><a href="#" data-color="FF00FF" style="display: block; width: 15px; height: 12px; " alt="#FF00FF" title="#FF00FF"></a></td><td style="background-color: #FF4000; width: 15px; height: 12px;"><a href="#" data-color="FF4000" style="display: block; width: 15px; height: 12px; " alt="#FF4000" title="#FF4000"></a></td><td style="background-color: #FF4040; width: 15px; height: 12px;"><a href="#" data-color="FF4040" style="display: block; width: 15px; height: 12px; " alt="#FF4040" title="#FF4040"></a></td><td style="background-color: #FF4080; width: 15px; height: 12px;"><a href="#" data-color="FF4080" style="display: block; width: 15px; height: 12px; " alt="#FF4080" title="#FF4080"></a></td><td style="background-color: #FF40BF; width: 15px; height: 12px;"><a href="#" data-color="FF40BF" style="display: block; width: 15px; height: 12px; " alt="#FF40BF" title="#FF40BF"></a></td><td style="background-color: #FF40FF; width: 15px; height: 12px;"><a href="#" data-color="FF40FF" style="display: block; width: 15px; height: 12px; " alt="#FF40FF" title="#FF40FF"></a></td><td style="background-color: #FF8000; width: 15px; height: 12px;"><a href="#" data-color="FF8000" style="display: block; width: 15px; height: 12px; " alt="#FF8000" title="#FF8000"></a></td><td style="background-color: #FF8040; width: 15px; height: 12px;"><a href="#" data-color="FF8040" style="display: block; width: 15px; height: 12px; " alt="#FF8040" title="#FF8040"></a></td><td style="background-color: #FF8080; width: 15px; height: 12px;"><a href="#" data-color="FF8080" style="display: block; width: 15px; height: 12px; " alt="#FF8080" title="#FF8080"></a></td><td style="background-color: #FF80BF; width: 15px; height: 12px;"><a href="#" data-color="FF80BF" style="display: block; width: 15px; height: 12px; " alt="#FF80BF" title="#FF80BF"></a></td><td style="background-color: #FF80FF; width: 15px; height: 12px;"><a href="#" data-color="FF80FF" style="display: block; width: 15px; height: 12px; " alt="#FF80FF" title="#FF80FF"></a></td><td style="background-color: #FFBF00; width: 15px; height: 12px;"><a href="#" data-color="FFBF00" style="display: block; width: 15px; height: 12px; " alt="#FFBF00" title="#FFBF00"></a></td><td style="background-color: #FFBF40; width: 15px; height: 12px;"><a href="#" data-color="FFBF40" style="display: block; width: 15px; height: 12px; " alt="#FFBF40" title="#FFBF40"></a></td><td style="background-color: #FFBF80; width: 15px; height: 12px;"><a href="#" data-color="FFBF80" style="display: block; width: 15px; height: 12px; " alt="#FFBF80" title="#FFBF80"></a></td><td style="background-color: #FFBFBF; width: 15px; height: 12px;"><a href="#" data-color="FFBFBF" style="display: block; width: 15px; height: 12px; " alt="#FFBFBF" title="#FFBFBF"></a></td><td style="background-color: #FFBFFF; width: 15px; height: 12px;"><a href="#" data-color="FFBFFF" style="display: block; width: 15px; height: 12px; " alt="#FFBFFF" title="#FFBFFF"></a></td><td style="background-color: #FFFF00; width: 15px; height: 12px;"><a href="#" data-color="FFFF00" style="display: block; width: 15px; height: 12px; " alt="#FFFF00" title="#FFFF00"></a></td><td style="background-color: #FFFF40; width: 15px; height: 12px;"><a href="#" data-color="FFFF40" style="display: block; width: 15px; height: 12px; " alt="#FFFF40" title="#FFFF40"></a></td><td style="background-color: #FFFF80; width: 15px; height: 12px;"><a href="#" data-color="FFFF80" style="display: block; width: 15px; height: 12px; " alt="#FFFF80" title="#FFFF80"></a></td><td style="background-color: #FFFFBF; width: 15px; height: 12px;"><a href="#" data-color="FFFFBF" style="display: block; width: 15px; height: 12px; " alt="#FFFFBF" title="#FFFFBF"></a></td><td style="background-color: #FFFFFF; width: 15px; height: 12px;"><a href="#" data-color="FFFFFF" style="display: block; width: 15px; height: 12px; " alt="#FFFFFF" title="#FFFFFF"></a></td></tr></tbody></table></dd>
	</dl>
</div>

<div id="format-buttons">
	<button type="button" class="button2 bbcode-b" accesskey="b" name="addbbcode0" onclick="bbstyle(0)" title="Texto en negrita: [b]texto[/b]"></button>
	<button type="button" class="button2 bbcode-i" accesskey="i" name="addbbcode2" onclick="bbstyle(2)" title="Texto Itálica: [i]texto[/i]"></button>
	<button type="button" class="button2 bbcode-u" accesskey="u" name="addbbcode4" onclick="bbstyle(4)" title="Texto subrayado: [u]texto[/u]"></button>
			<button type="button" class="button2 bbcode-quote" accesskey="q" name="addbbcode6" onclick="bbstyle(6)" title="Citar texto: [quote]texto[/quote]"></button>
		<button type="button" class="button2 bbcode-code" accesskey="c" name="addbbcode8" onclick="bbstyle(8)" title="Mostrar código: [code]código[/code]"></button>
	<button type="button" class="button2 bbcode-list" accesskey="l" name="addbbcode10" onclick="bbstyle(10)" title="Lista: [list][*]texto[/list]"></button>
	<button type="button" class="button2 bbcode-list-" accesskey="o" name="addbbcode12" onclick="bbstyle(12)" title="Lista ordenada: Por ejemplo, [list=1][*]Primer punto[/list] o [list=a][*]Punto a[/list]"></button>
	<button type="button" class="button2 bbcode-asterisk" accesskey="y" name="addlistitem" onclick="bbstyle(-1)" title="Listar ítem: [*]texto"></button>
			<button type="button" class="button2 bbcode-img" accesskey="p" name="addbbcode14" onclick="bbstyle(14)" title="Inserta imagen: [img]http://imagen_url[/img]"></button>
				<button type="button" class="button2 bbcode-url" accesskey="w" name="addbbcode16" onclick="bbstyle(16)" title="Insertar URL: [url]http://url[/url] ó [url=http://url]URL texto[/url]"></button>
				<button type="button" class="button2 bbcode-flash" accesskey="d" name="addbbcode18" onclick="bbstyle(18)" title="Flash: [flash=width,height]http://url[/flash]"></button>
		<select name="addbbcode20" class="bbcode-size" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;" title="Tamaño de fuente: [size=x-small]texto pequeño[/size]">
		<option value="50">Diminuta</option>
		<option value="85">Pequeña</option>
		<option value="100" selected="selected">Normal</option>
					<option value="150">Grande</option>
							<option value="200">Enorme</option>
						</select>
	<button type="button" class="button2 bbcode-color" name="bbpalette" id="bbpalette" onclick="change_palette();" title="Color de fuente: [color=red]texto[/color] o [color=#FF0000]text[/color]"></button>



    	     	<button type="button" class="button2 bbcode-center" name="addbbcode22" onclick="bbstyle(22)" title="Centrar: [center]texto[/center]"></button>


    	      	<button type="button" class="button2 bbcode-s" name="addbbcode24" onclick="bbstyle(24)" title="Texto tachado: [s]texto[/s]"></button>


    	      	<button type="button" class="button2 bbcode-spoiler" name="addbbcode26" onclick="bbstyle(26)" title="Ocultar: [spoiler]texto[/spoiler]"></button>


    	      	<button type="button" class="button2 bbcode-youtube" name="addbbcode28" onclick="bbstyle(28)" title="Youtube: [youtube]https://youtu.be/video_url[/youtube]"></button>

	</div>

	<div id="smiley-box">
					<strong>Emoticonos</strong><br>
							<a href="#" onclick="insert_text(':D', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_biggrin.gif" width="25" height="22" alt=":D" title="Feliz"></a>
							<a href="#" onclick="insert_text(':)', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_smile.gif" width="25" height="22" alt=":)" title="Sonrisa"></a>
							<a href="#" onclick="insert_text(':(', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_sad.gif" width="21" height="20" alt=":(" title="Triste"></a>
							<a href="#" onclick="insert_text(':o', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_surprised.gif" width="25" height="23" alt=":o" title="Sorprendido"></a>
							<a href="#" onclick="insert_text(':shock:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_eek.gif" width="23" height="27" alt=":shock:" title="Impresionado"></a>
							<a href="#" onclick="insert_text(':?', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_confused.gif" width="23" height="20" alt=":?" title="Confundido"></a>
							<a href="#" onclick="insert_text('8)', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_cool.gif" width="21" height="32" alt="8)" title="Cool"></a>
							<a href="#" onclick="insert_text(':lol:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_lol.gif" width="25" height="22" alt=":lol:" title="Risas"></a>
							<a href="#" onclick="insert_text(':x', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_mad.gif" width="21" height="25" alt=":x" title="Cabreado"></a>
							<a href="#" onclick="insert_text(':P', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_razz.gif" width="21" height="20" alt=":P" title="Lengua"></a>
							<a href="#" onclick="insert_text(':oops:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_redface.gif" width="33" height="25" alt=":oops:" title="Avergonzado"></a>
							<a href="#" onclick="insert_text(':cry:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_cry.gif" width="33" height="25" alt=":cry:" title="Llorar"></a>
							<a href="#" onclick="insert_text(':evil:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_evil.gif" width="21" height="22" alt=":evil:" title="Demonio"></a>
							<a href="#" onclick="insert_text(':roll:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_rolleyes.gif" width="19" height="21" alt=":roll:" title="Sarcastico"></a>
							<a href="#" onclick="insert_text(':twisted:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_twisted.gif" width="21" height="25" alt=":twisted:" title="Bronca"></a>
							<a href="#" onclick="insert_text(':wink:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_wink.gif" width="21" height="25" alt=":wink:" title="Guiño"></a>
							<a href="#" onclick="insert_text(':|', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_neutral.gif" width="18" height="19" alt=":|" title="Neutral"></a>
							<a href="#" onclick="insert_text(':aplausos:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_aplauso.gif" width="24" height="23" alt=":aplausos:" title="Aplausos"></a>
							<a href="#" onclick="insert_text(':gota:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_gota.gif" width="19" height="21" alt=":gota:" title="Gota"></a>
							<a href="#" onclick="insert_text(':neko:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_neko.gif" width="19" height="22" alt=":neko:" title="Neko"></a>
							<a href="#" onclick="insert_text(':mrgreen:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_mrgreen.gif" width="25" height="22" alt=":mrgreen:" title="Dientes"></a>
							<a href="#" onclick="insert_text(':ok:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_ok.gif" width="27" height="22" alt=":ok:" title="Ok"></a>
							<a href="#" onclick="insert_text(':love:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_love2.gif" width="26" height="26" alt=":love:" title="Enamorado"></a>
							<a href="#" onclick="insert_text(':joint:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_smokin.gif" width="23" height="20" alt=":joint:" title="Fumando"></a>
							<a href="#" onclick="insert_text(':wave:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_saludo.gif" width="30" height="21" alt=":wave:" title="Saludo"></a>
							<a href="#" onclick="insert_text(':zzz:', true); return false;"><img src="http://www.pirateking.es/foro/images/smilies/icon_snore.gif" width="27" height="23" alt=":zzz:" title="Sueño"></a>
										<br><a href="http://www.pirateking.es/foro/posting.php?mode=smilies&amp;f=3" onclick="popup(this.href, 750, 350, '_phpbbsmilies'); return false;">Ver más emoticonos</a>
					</div>


	<div id="message-box">
		<textarea name="message" id="message" rows="15" cols="76" tabindex="4" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onfocus="initInsertions();" class="inputbox"></textarea>
	</div>

		</fieldset>


			</div>
	</div>

		<div class="panel bg2">
		<div class="inner">
		<fieldset class="submit-buttons">

			<input type="hidden" name="lastclick" value="1522169451">
						<input type="submit" accesskey="k" tabindex="7" name="save" value="Guardar borrador" class="button2">&nbsp; 			<input type="submit" tabindex="5" name="preview" value="Vista previa" class="button1" onclick="document.getElementById('postform').action += '#preview';">&nbsp;
			<input type="submit" accesskey="s" tabindex="6" name="post" value="Enviar" class="button1 default-submit-action">&nbsp;

		</fieldset>

		</div>
	</div>


</form>

			</div>
</div>