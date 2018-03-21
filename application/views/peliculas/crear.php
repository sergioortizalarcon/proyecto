<div class="container">
	<form id="idFormulario">
		<fieldset>
			<legend>Agregar nueva película</legend>
			<label for="idNombre">Nombre </label>
			<input class="form-control" type="text" id="idNombre" name="nombre" />
					
			<label for="idFecha">Fecha de estreno</label>
			<input class="form-control" type="date" id="idFecha" name="fechaEstreno" />
		
			<input type="button" class="btn btn-default" onclick="comprobar()" value="Enviar"/>
		</fieldset>
	</form>
</div>