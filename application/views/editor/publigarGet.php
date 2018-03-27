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
			value="<?php date_default_timezone_set("Europe/Madrid");echo date("Y-m-d H:i:s");?>" />
			<br/>
			<input type="submit" name="insertar_comentario" value="Comentar artículo" />
		</fieldset>
	</form>
</div>