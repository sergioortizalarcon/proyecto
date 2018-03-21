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
			<th>Pais de nacimiento</th>
		</tr>
		
		<?php foreach ($body['actores'] as $actor): ?>
			<tr>
				<td><?= $actor->nombre ?></td>
				<td><?= $actor->apellido1 ?></td>
				<td><?= $actor->apellido2 ?></td>
				<td><?= $actor->fecha_nacimiento ?></td>
				<td><?= $actor->paises['nombre'] ?></td>
				<td>
					<form id="idFormedit" action="<?=base_url()?>actor/editar" method="post">
						<input type="hidden" name="id_actor" value="<?= $actor -> id?>">
						<button onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
					</form>
				</td>
				<td>
					<form id="idFormRemove" action="<?=base_url()?>actor/borrarPost" method="post">
						<input type="hidden" name="id_actor" value="<?= $actor -> id?>">
						<input type="hidden" name="v" value="listarTodos">
						<button onclick="function f() {document.getElementById('idFormRemove').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
					</form>
				</td>
			</tr>
		<?php endforeach;?>
	</table>
</div>