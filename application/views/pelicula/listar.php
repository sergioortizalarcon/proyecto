<div class="container">
	<form action="<?= base_url() ?>pelicula/listarPost" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>


	<table id="evd" class="table table-striped">
		<thead>
		<tr>
			<th>Nombre película</th>
			<th>Fecha de estreno</th>
			<th>Nacionalidad</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($body['peliculas'] as $pelicula): ?>
			<tr>
				<td><?= $pelicula->nombre ?></td>
				<td><?= $pelicula->fecha_nacimiento ?></td>
				<td><?= $pelicula->nacionalidad ?></td>
				<td>
					<form id="idFormedit" action="<?=base_url()?>director/editar" method="post">
						<input type="hidden" name="id_pais" value="<?= $director -> id?>">
						<button onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
					</form>
				</td>
				<td>
					<form id="idFormRemove" action="<?=base_url()?>director/borrarPost" method="post">
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
        	<th>Nombre película</th>
			<th>Fecha de estreno</th>
			<th>Nacionalidad</th>
		</tr>
        </tfoot>
	</table>
</div>