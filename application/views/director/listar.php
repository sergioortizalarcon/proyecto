<div class="container">
	<form action="<?= base_url() ?>director/listarPost" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>

	<table class="table table-striped">
		<tr>
			<th>Nombre director</th>
			<th>Primer apellido</th>
			<th>Segundo apellido</th>
			<th>Fecha de nacimiento</th>
			<th>Nacionalidad</th>
		</tr>
		
		<?php foreach ($body['directores'] as $director): ?>
			<tr>
				<td><?= $director->nombre ?></td>
				<td><?= $director->apellido1 ?></td>
				<td><?= $director->apellido2 ?></td>
				<td><?= $director->fecha_nac ?></td>
				<td><?= $director->nacionalidad ?></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>