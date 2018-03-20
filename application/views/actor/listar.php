<div class="container">
	<form action="<?= base_url() ?>actor/listarPost" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>

	<table class="table table-striped">
		<tr>
			<th>Nombre actor</th>
			<th>Primer apellido</th>
			<th>Segundo apellido</th>
			<th>Fecha de nacimiento</th>
			<th>Nacionalidad</th>
		</tr>
		
		<?php foreach ($body['actores'] as $actor): ?>
			<tr>
				<td><?= $actor->nombre ?></td>
				<td><?= $actor->apellido1 ?></td>
				<td><?= $actor->apellido2 ?></td>
				<td><?= $actor->fecha_nacimiento ?></td>
				<td><?= $actor->nacionalidad ?></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>