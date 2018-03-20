<div class="container">
	<h1>Listado de usuarios</h1>
	<br/>
	<h3> Filtrar por email:</h3>
	<form action="<?= base_url() ?>usuario/listar" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>"/>
		<input type="submit" value="Filtrar"/>
	</form>

	<br/>
	<hr/>
<table class="table table-bordered">
	<tr>
		<th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>
	</tr>

	<?php foreach ($usuarios as $key): ?>
		<tr>
			<td> <?=$key->nombre?> </td>
			<td> <?=$key->apellido_uno?> </td>
			<td> <?=$key->apellido_dos?> </td>
			<td> <?=$key->alias?> </td>
			<td> <?=$key-> email?> </td>
			<td> <?=$key-> fecha_nacimiento ?></td>
			</td>
			<td>
				<form action="/usuario/update" method="post" class="listado">
					<input type="hidden" name="idEmp" value="<?=$key -> id ?>"/>
					<button class="glyphicon glyphicon-pencil" type="submit"></button>
				</form>
						
				<form action="/usuario/borrar" method="post" class="listado">
					<input type="hidden" name="idEmp" value="<?=$key -> id ?>"/>
					<button class="glyphicon glyphicon-remove" type="submit"></button>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
</table>
</div>