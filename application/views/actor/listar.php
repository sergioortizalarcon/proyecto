<div class="content-wrapper">
	<section class="content-header">
		<h1>
        	<i class="fas fa-address-card"></i>&nbsp;&nbsp;Listado de Actores
        	<small>Add, Edit, Delete</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?=base_url()?>actor/crear"><i class="fa fa-plus"></i>
                    &nbsp;&nbsp;Agregar más...
                	</a>
                </div>
            </div>
        </div>
		<div class="table-responsive">
<div class="container">
	<h1>Listado de actores</h1>
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
						<form class="listado" id="idFormEdit<?= $actor->id ?>" action="<?=base_url()?>actor/editar" method="post">
							<input type="hidden" name="id_actor" value="<?= $actor -> id?>">
							<button onclick="function f() {document.getElementById('Borrar<?= $actor->id ?>').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
						</form>
						<form class="listado" id="Editar<?= $actor->id ?>" action="<?=base_url()?>actor/verInfo" method="post">
						<form class="listado" id="idFormRemove<?= $actor->id ?>" action="<?=base_url()?>actor/borrarPost" method="post">
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
</section>
</div>
<script type="text/javascript">
	function mostrarFicha(id) {
		window.location="<?= base_url() ?>actor/abrirFicha?id_actor="+id;
	}
</script>