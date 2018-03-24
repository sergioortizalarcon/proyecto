<div class="container">
	<h1>Listado de directores</h1>
	<br/>
	<form action="<?= base_url() ?>director/listarPost" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>
	<br/>
	<table id="efectoTabla" class="display table table-bordered ">
		<thead>
			<tr>
				<th>Nombre director</th>
				<th>Primer apellido</th>
				<th>Segundo apellido</th>
				<th>Fecha de nacimiento</th>
				<th>Pais de nacimiento</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($body['directores'] as $director): ?>
				<tr>
					<td><?= $director->nombre ?></td>
					<td><?= $director->apellido1 ?></td>
					<td><?= $director->apellido2 ?></td>
					<td><?= $director->fecha_nacimiento ?></td>
					<td><?= $director->paises['nombre'] ?></td>
					<td>
						<form class="listado" id="idFormedit" action="<?=base_url()?>director/editar" method="post">
							<input type="hidden" name="id_director" value="<?= $director -> id?>">
							<button onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
						</form>
						<form class="listado" id="idFormRemove" action="<?=base_url()?>director/borrarPost" method="post">
							<input type="hidden" name="id_director" value="<?= $director -> id?>">
							<input type="hidden" name="v" value="listarTodos">
							<button onclick="function f() {document.getElementById('idFormRemove').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
						</form>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<th>Nombre actor</th>
				<th>Primer apellido</th>
				<th>Segundo apellido</th>
				<th>Fecha de nacimiento</th>
				<th>Pais de nacimiento</th>
				<th>Acciones</th>
			</tr>
		</tfoot>
	</table>
</div>