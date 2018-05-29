<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>

<form id="idFormulario" name="idFormulario" action="<?= base_url()?>actor/crearDirectorPost">
	<fieldset>
		<legend>Crear Director/Directora: <?= $body['actores']->nombre ?> <?= $body['actores']->apellido1 ?> <?= $body['actores']->apellido2 ?></legend>
					
		<div class="form-group">
			<label>Nombre</label>
			<input readonly class="form-control" type="text" id="idNombre" name="nombre" value="<?= $body['actores']->nombre ?>">
		</div>
		
		<div class="form-group">
			<label>Primer apellido</label>
			<input readonly class="form-control" type="text" id="idApellido1" name="apellido1" value="<?= $body['actores']->apellido1 ?>" />
		</div>
		
		<div class="form-group">
			<label>Segundo apellido</label>
			<input readonly class="form-control" type="text" id="idApellido2" name="apellido2" value="<?= $body['actores']->apellido2 ?>" />
		</div>
				
		<input type="hidden" name="id_actor" value="<?= $body['actores']->id ?>" />
				
		<div class="form-group">
			<label>Fecha de nacimiento</label>
			<input readonly class="form-control" type="text" id="idFecha" value="<?= $body['actores']->fechaNacimiento ?>" name="fechaNacimiento" />
		</div>
					
		<div class="form-group">
			<label>Pais de nacimiento</label>
			<input readonly class="form-control" type="text" id="idPais" value="<?= $body['paises']->nombre ?>" />
		</div>
					
		<div class="form-group">
			<label>Biografía:</label>
			<textarea readonly class="form-control" name="biografia" id="idBiografia" placeholder="Biografía"></textarea>
		</div>
						
		<div class="form-group">
			<img src="<?= base_url() ?><?= $body['actores']->rutaFoto ?>">
		</div>	
					
		<label>¿Estas seguro de crear un director con estos datos?</label>
		<div class="nav navbar-form navbar-right">
			<input type="button" class="btn btn-default" id="idConfirmar" name ="confirmar" value="Confirmar" />
			<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar" />
		</div>
					
	</fieldset>
</form>