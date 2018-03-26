<div class="container">
	
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