<div class="content-wrapper">
	<section class="content-header">
	<h1>
        <i class="fas fa-user-tie"></i>&nbsp;&nbsp;Listado de directores
        <small>Add, Edit, Delete</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?=base_url()?>director/crear"><i class="fa fa-plus"></i>
                    &nbsp;&nbsp;Agregar más...
                	</a>
                </div>
            </div>
        </div>
		<div class="table-responsive">
			<table id="efectoTabla" class="display table table-bordered ">
				<thead>
					<tr>
						<th>Foto</th>
						<th>Nombre director</th>
						<th>Primer apellido</th>
						<th>Segundo apellido</th>
						<th>Fecha de nacimiento</th>
						<th>Pais de nacimiento</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body['directores'] as $director): ?>
						<tr id="<?= $director->id ?>"onclick="mostrarFicha(this.id);" >
							<td><img src="<?=base_url()?><?= $director->rutaFoto ?>" height="60" width="50"></td>
							<td><?= $director->nombre ?></td>
							<td><?= $director->apellido1 ?></td>
							<td><?= $director->apellido2 ?></td>
							<td><?= $director->fecha_nacimiento ?></td>
							<td><?= $director->paises['nombre'] ?></td>
							<td>
								<form class="listado" id="idFormedit<?= $director->id ?>" action="<?=base_url()?>director/editar" method="post">
									<input type="hidden" name="id_director" value="<?= $director -> id?>">
									<button onclick="function f() {document.getElementById('Borrar<?= $director->id ?>').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
								</form>
								<form class="listado" id="idFormRemove<?= $director->id ?>" action="<?=base_url()?>director/borrarPost" method="post">
									<input type="hidden" name="id_director" value="<?= $director -> id?>">
									<input type="hidden" name="v" value="listarTodos">
									<button onclick="function f() {document.getElementById('Editar<?= $director->id ?>').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
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
</div>

<script type="text/javascript">
	function mostrarFicha(id) {
		window.location="<?= base_url() ?>director/abrirFicha?id_director="+id;
	}
</script>
