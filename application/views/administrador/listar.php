<div class="content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fa fa-users"></i>&nbsp;&nbsp;Listado de usuarios
        <small>Apartado de usuarios</small>
      </h1>
    </section>
<section class="content">
	<div class="table-responsive">
		<table id="efectoTabla" class="display table table-bordered">
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
			<?php foreach ($usuarios as $key): ?>
				<tr>
					<td> <?=$key->id?> </td>
					<td> <?=$key->nombre?> </td>
					<td> <?=$key->apellido_uno?> </td>
					<td> <?=$key->apellido_dos?> </td>
					<td> <?=$key->alias?> </td>
					<td> <?=$key->email?> </td>
					<td> <?=$key->paises["nombre"]?> </td>
					<td> <?=$key->roles["rol"]?> </td>
					<td> <?=$key->fecha_nacimiento?></td>

					<td>
						<form action="<?=base_url()?>administrador/editarGet" method="post" class="listado">
							<input type="hidden" name="idUser" value="<?=$key->id?>"/>
							<button class="glyphicon glyphicon-pencil" type="submit"></button>
						</form>
					</td>
				</tr>
			<?php endforeach;?>
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
	</div>
<br/><hr/>
</section>
</div>