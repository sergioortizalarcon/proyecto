<div class="container">
	<h1>Listado de usuarios</h1>
	<br/>
	<h3> Filtrar por email:</h3>
	<form action="<?=base_url()?>usuario/listar" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?=$filtro?>"/>
		<input type="submit" value="Filtrar"/>
	</form>

	<br/>
	<hr/>
<script type="text/javascript">
		$(document).ready( function () {
    $('#evd').DataTable();
} );
	</script>
<table id="evd" class="display table table-bordered ">
	<thead>
	<tr>
		<th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>
	</tr>
	</thead>
    <tbody>
<tr><td>Ashton Cox</td><td>Junior Technical Author</td><td>San Francisco</td><td>66</td><td>2009/01/12</td><td>$86,000</td><td>$86were</td></tr>
	<?php foreach ($usuarios as $key): ?>
		<tr>
			<td> <?=$key->nombre?> </td>
			<td> <?=$key->apellido_uno?> </td>
			<td> <?=$key->apellido_dos?> </td>
			<td> <?=$key->alias?> </td>
			<td> <?=$key->email?> </td>
			<td> <?=$key->fecha_nacimiento?></td>

			<td>
				<form action="/usuario/update" method="post" class="listado">
					<input type="hidden" name="idEmp" value="<?=$key->id?>"/>
					<button class="glyphicon glyphicon-pencil" type="submit"></button>
				</form>

				<form action="/usuario/borrar" method="post" class="listado">
					<input type="hidden" name="idEmp" value="<?=$key->id?>"/>
					<button class="glyphicon glyphicon-remove" type="submit"></button>
				</form>
			</td>
		</tr>
	<?php endforeach;?>
	 <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
                <td>$86,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
               <th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>
            </tr>
        </tfoot>
</table>
<br/><hr/>
</div>