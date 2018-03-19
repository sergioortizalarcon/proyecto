<div class="container">
	<form action="<?= base_url() ?>ciudad/crearPost" method="post">
		<fieldset>
			<legend>Datos de la ciudad</legend>
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="ciudad" />
			
			<input class="btn btn-default" type="submit">
		</fieldset>
	</form>
</div>