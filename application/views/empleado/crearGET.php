<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
	var conexion;

	function accionAJAX() {
		document.getElementById("idMensaje").innerHTML = conexion.responseText;
	}

	function peticionAJAX() {
		conexion = new XMLHttpRequest();
		
		var datosSerializados = serialize(document.getElementById("idFormulario"));
		conexion.open('POST', '<?=base_url()?>Empleado/crearPost', true);
		conexion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		conexion.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		conexion.send(datosSerializados);
		
		conexion.onreadystatechange = function() {
			if (conexion.readyState==4 && conexion.status==200) {
				accionAJAX();
			}
		}
	}
</script>


<div class="container ">
	<form id="idFormulario" class="form col-sm-4">
		<fieldset>
			<legend>Datos del empleado</legend>
			
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="nombre" />
			
			<label for="idApe1">Apellido1</label>
			<input class="form-control" type="text" id="idApe1" name="ape1" />
			
			<label for="idApe2">Apellido2</label>
			<input class="form-control" type="text" id="idApe2" name="ape2" />
			
			<label for="idPwd">Contraseña</label>
			<input class="form-control" type="password" id="idPwd" name="pwd" />

			<label for="idTlf">Teléfono</label>
			<input class="form-control" type="text" id="idTlf" name="tlf" />
			
			<label for="idCiudad">Ciudad de nacimiento</label>
			<select id="idCiudad" name="idCiudad">
				<?php foreach ($ciudades as $ciudad): ?>
				<option value="<?= $ciudad->id ?>"><?= $ciudad->nombre ?></option>
				<?php endforeach;?>
			</select>
			
			<fieldset class="form-group">
			<legend>Lenguajes de programación que conoce</legend>
				<?php foreach ($lps as $lp): ?>
					<input type="checkbox" id="idLP<?= $lp->id ?>" name="idLP[]" value="<?= $lp->id ?>">
					<label for="idLP<?= $lp->id ?>"><?= $lp->nombre ?></label>
				<?php endforeach;?>
			</fieldset>
			
			<div id="idMensaje" class="row"></div>			
			
			<input type="button" class="btn btn-default" onclick="peticionAJAX()" value="Enviar"/>

		</fieldset>
	</form>
</div>