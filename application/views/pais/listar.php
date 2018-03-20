<div class="container">
	<form action="<?= base_url() ?>pais/listar" method="post">
		<label for="idFiltro">Filtro</label> <input id="idFiltro" type="text"
			name="filtro" value="<?= $filtro ?>"> <input type="submit"
			value="Filtrar">
	</form>

	<table class="table table-striped">
		<tr>
			<th>Nombre del país</th>
		</tr>
		
		<?php foreach ($body['paises'] as $pais): ?>
			<tr>
			<td><?= $pais->nombre ?></td>
			<td>
				<form id="idFormedit" action="<?=base_url()?>pais/editar" method="post">
					<input type="hidden" name="id_pais" value="<?= $pais -> id?>">
					<button onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
				</form>
			</td>
			<td>
				<form id="idFormRemove" action="<?=base_url()?>pais/borrarPost" method="post">
					<input type="hidden" name="id_pais" value="<?= $pais -> id?>">
					<input type="hidden" name="v" value="listarTodos">
					<button onclick="function f() {document.getElementById('idFormRemove').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
				</form>
				
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>