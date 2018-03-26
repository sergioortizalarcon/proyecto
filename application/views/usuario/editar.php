<div class="container">
	<h1>Editar de usuarios</h1>
	<br/>
	
<table class="display table table-bordered ">
	<thead>
	<tr>
		<th>Id usuario</th>
		<th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>País</th>
		<th>Rol</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>

	</tr>
	</thead>
    <tbody>
		<tr>
			<td> <?=$usuario->id?> </td>
			<td> <?=$usuario->nombre?> </td>
			<td> <?=$usuario->apellido_uno?> </td>
			<td> <?=$usuario->apellido_dos?> </td>
			<td> <?=$usuario->alias?> </td>
			<td> <?=$usuario->email?> </td>
			<td> <?=$usuario->paises["nombre"]?> </td>
			<td>
				<select name="" id="">
					<?php foreach ($roles as $rol_existentes): ?>
						<?php if($rol_existentes!=null): ?>
							<option value="<?=$rol_existentes->id?>"
								<?php echo ($usuario->roles["id"]==$rol_existentes->id)?'selected="selected"':"g";?> >
								<?=$rol_existentes['rol']?>
							</option>
						<?php else: ?>
							<td>solo debug--> <?=$usuario->rol_existentes?> </td>
						<?php endif;?>
					<?php endforeach; ?>
				</select>
			</td>
			<td> <?=$usuario->fecha_nacimiento?></td>
</table>
<br/><hr/>
</div>