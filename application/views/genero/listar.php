<div class="container">
	<form action="<?= base_url() ?>genero/listar" method="post">
		<label for="idFiltro">Filtro</label> <input id="idFiltro" type="text"
			name="filtro" value="<?= $filtro ?>"> <input type="submit"
			value="Filtrar">
	</form>

<table id="efectoTabla" class="display table table-bordered ">
<thead>
		<tr>
			<th>Id del país</th>
			<th>Nombre del país</th>
			<th>Acciones</th>
		</tr>
<thead>
<tbody>
		<?php foreach ($body['generos'] as $genero): ?>
			<tr>
			<td><?= $genero->id ?></td>
			<td><?= $genero->nombre ?></td>
			<td>
				<form class="listado" id="idFormedit" action="<?=base_url()?>genero/editar" method="post">
					<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
					<button onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
				</form>
				<form class="listado" id="idFormRemove" action="<?=base_url()?>genero/borrarPost" method="post">
					<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
					<input type="hidden" name="v" value="listarTodos">
					<button onclick="function f() {document.getElementById('idFormRemove').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
				</form>
				
			</td>
		</tr>
		<?php endforeach;?>
</tbody>
<tfoot>
<tr>
			<th>Id del país</th>
			<th>Nombre del país</th>
			<th>Acciones</th>
		</tr>
</tfoot>
	</table>
</div>