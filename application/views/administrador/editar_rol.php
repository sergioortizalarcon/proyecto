<div class="container">
	<h1>Editar de usuarios</h1>
	<br/>

<table id="efectoTabla" class="display table table-bordered ">
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
			<form action="<?=base_url()?>administrador/editarRolPost" method="post">
				<td>
					<select name="idRol" id="idRol">
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
				<td>
					<input type="hidden" name="idUser" value="<?=$usuario->id?>" />
					<button  class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i>  Cambiar rol</button>
				</td>
				</form>
		</tr>
	</tbody>
	<tfoot>
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
        </tfoot>
</table>
<br/><hr/>

</div>