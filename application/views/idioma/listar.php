<div class="container">
	<form action="<?= base_url() ?>idioma/listar" method="post">
		<label for="idFiltro">Filtro</label> <input id="idFiltro" type="text"
			name="filtro" value="<?= $filtro ?>"> <input type="submit"
			value="Filtrar">
	</form>

<table id="efectoTabla" class="display table table-bordered ">
		<thead>
			<tr>
				<th>Id Idioma</th>
				<th>Idioma</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
				<?php foreach ($body['idiomas'] as $idioma): ?>
			<tr>
				<td><?= $idioma->id ?></td>
				<td><?= $idioma->nombre ?></td>
				<td>
					<form class="listado" action="<?=base_url()?>idioma/editarGet" method="post">
						<input type="hidden" name="idIdioma" value="<?= $idioma -> id?>"/>
						<button class="glyphicon glyphicon-pencil" type="submit"></button>
					</form>
					<form class="listado" action="<?=base_url()?>idioma/borrarPost" method="post">
						<input type="hidden" name="idIdioma" value="<?= $idioma -> id?>" />
						<button class="glyphicon glyphicon-remove" type="submit"></button>
					</form>

				</td>
			</tr>
		<?php endforeach;?>
	  </tbody>
		<tfoot>
			<tr>
				<th>Id Idioma</th>
				<th>Idioma</th>
				<th>Acciones</th>
			</tr>
		</tfoot>
	</table>
</div>