<div class="content-wrapper">
<section class="content-header">
	 <h1>
        <i class="far fa-folder-open"></i>&nbsp;&nbsp;Listado de Géneros
        <small>Add, Edit, Delete</small>
      </h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12 text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="<?= base_url()?>genero/crear">
					<i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar más...</a>
			</div>
		</div>
	</div>
<div class="table-responsive">
	<table id="efectoTabla" class="display table table-bordered ">
	<thead>
			<tr>
				<th>Id del país</th>
				<th>Nombre del país</th>
				<th>Acciones</th>
			</tr>
	</thead>
	<tbody>
			<?php foreach ($body['generos'] as $genero): ?>
				<tr>
				<td><?= $genero->id ?></td>
				<td><?= $genero->nombre ?></td>
				<td>
					<form class="listado" id="idFormedit" action="<?=base_url()?>genero/editar" method="post">
						<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
						<button class="btn btn-info btn-sm" class="botones" onclick="function f() {document.getElementById('idFormEdit').submit();}">
							<i class="fas fa-edit"></i>
						</button>
					</form>
					<form class="listado" id="idFormRemove" action="<?=base_url()?>genero/borrarPost" method="post">
						<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
						<input type="hidden" name="v" value="listarTodos">
						<button class="btn btn-warning btn-sm" class="botones" onclick="function f() {document.getElementById('idFormRemove').submit();}">
							<i class="fas fa-trash"></i>
						</button>
					</form>
					
				</td>
			</tr>
			<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<th>Id del país</th>
			<th>Nombre del país</th>
			<th>Acciones</th>
		</tr>
	</tfoot>
	</table>
	</div>
</section>
</div>