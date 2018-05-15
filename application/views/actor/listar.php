

<div class="container">
	<h1>Listado de actores</h1>
	<br/>
	<form action="<?= base_url() ?>actor/listar" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>
	<br/>
	<table id="efectoTabla" class="display table table-bordered ">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Nombre actor</th>
				<th>Primer apellido</th>
				<th>Segundo apellido</th>
				<th>Fecha de nacimiento</th>
				<th>Pais de nacimiento</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($body['actores'] as $actor): ?>
				<tr id="<?= $actor->id ?>"onclick="mostrarFicha(this.id);" >
					<td><img src="<?=base_url()?><?= $actor->rutaFoto ?>" height="60" width="50"></td>
					<td><?= $actor->nombre ?></td>
					<td><?= $actor->apellido1 ?></td>
					<td><?= $actor->apellido2 ?></td>
					<td><?= $actor->fecha_nacimiento ?></td>
					<td><?= $actor->paises['nombre'] ?></td>
					<td>
						<form class="listado" id="Borrar<?= $actor->id ?>" action="<?=base_url()?>actor/editar" method="post">
							<input type="hidden" name="id_actor" value="<?= $actor -> id?>">
							<button onclick="function f() {document.getElementById('Borrar<?= $actor->id ?>').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
						</form>
						<form class="listado" id="Editar<?= $actor->id ?>" action="<?=base_url()?>actor/borrarPost" method="post">
							<input type="hidden" name="id_actor" value="<?= $actor -> id?>">
							<input type="hidden" name="v" value="listarTodos">
							<button onclick="function f() {document.getElementById('Editar<?= $actor->id ?>').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
						</form>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<th>Foto</th>
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

<script type="text/javascript">
	function mostrarFicha(id) {
		window.location="<?= base_url() ?>actor/abrirFicha?id_actor="+id;
	}
</script>