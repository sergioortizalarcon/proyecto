<div class="container">
	<form class="form" action="<?=base_url() ?>lp/editarPost" method="post">
		<fieldset>
			<legend>Datos del lenguaje</legend>
			
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="nombre" value="<?= $lp->nombre ?>" />
			
			<input type="hidden" name="filtro" value="<?= $filtro ?>">
			<input type="hidden" name="idLP" value="<?= $lp->id ?>">
			
			<input type="submit" class="btn btn-default" value="Guardar"/>

		</fieldset>
	</form>
</div>