<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
<div class="content-wrapper">
<?php else: ?>
<div class="container content-wrapper">
<?php endif;?>

	<section class="content-header">
			<h1>
				<i class="fas fa-folder-open"></i>&nbsp;&nbsp;Listado de géneros <small>Add,
					Edit, Delete</small>
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-right">
					<div class="form-group">
						<a class="btn btn-primary" href="<?=base_url()?>genero/crear"><i
							class="fa fa-plus"></i> &nbsp;&nbsp;Agregar más... </a>
					</div>
				</div>
			</div>
        <?php if($body['generos'] != null):?>
        	<?php if  ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")): ?>
        		<div class="table-responsive">
				<table id="efectoTabla" class="display table table-bordered ">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
        					<?php foreach ($body['generos'] as $genero): ?>
            					<?php if($genero-> estado != 'Inactivo'):?>
            						<tr id="<?= $genero->id ?>">
							<td><?= $genero->nombre ?></td>
							<td><?= $genero->estado ?></td>
							<td>
								<form class="listado" id="idFormEdit<?= $genero->id ?>"
									action="<?=base_url()?>Genero/editar" method="post">
									<input type="hidden" name="id_genero"
										value="<?= $genero-> id?>">
									<button type ="submit" class="btn btn-info btn-sm">
										<i class="fas fa-edit"></i>
									</button>
								</form>
								<form class="listado" id="idFormRemove<?= $genero->id ?>"
									action="<?=base_url()?>Genero/borrarPost" method="post">
									<input type="hidden" name="id_genero"
										value="<?= $genero-> id?>"> <input type="hidden" name="v"
										value="listarTodos">
									<button class="btn btn-warning btn-sm"
										onclick="function f() {document.getElementById('Editar<?= $genero->id ?>').submit();}">
										<i class="fas fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
            					<?php else: ?>
            						<tr id="<?= $genero->id ?>">
							<td><?= $genero->nombre ?></td>
							<td><?= $genero->estado ?></td>
							<td>
								<form class="listado" id="idFormActive<?= $genero->id ?>"
									action="<?=base_url()?>genero/activarPost" method="post">
									<input type="hidden" name="id_genero"
										value="<?= $genero-> id?>"> <input type="hidden" name="v"
										value="listarTodos">
									<button class="btn btn-warning btn-sm"
										onclick="function f() {document.getElementById('Activar<?= $genero->id ?>').submit();}">
										<i class="fas fa-plus-circle"></i>
									</button>
								</form>
							</td>
						</tr>
            					<?php endif;?>
        					<?php endforeach;?>
        				</tbody>
					<tfoot>
						<tr>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</tfoot>
				</table>
			</div>
        	<?php else: ?>
        		<table id="efectoTabla" class="display table table-bordered ">
				<thead>
					<tr>
						<th>Nombre</th>
					</tr>
				</thead>
				<tbody>
        					<?php foreach ($body['generos'] as $genero): ?>
            					<tr id="<?= $genero->id ?>">
						<td><?= $genero->nombre ?></td>
            				<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Nombre</th>
					</tr>
				</tfoot>
			</table>
	
	</div>
        	<?php endif; ?>
		<?php else:?>
            <div class="container" style="width: 90%;">
		<h2 class="alert alert-info" style="font-size: x-large;">¡ATENCIÓN!</h2>
		<div class="well">
			<div class="alert alert-warning">
				<strong>¡ADVERTENCIA!</strong> No hay ningún género en la base de datos, o
				no se han podido cargar.
			</div>
		</div>
	</div>
        <?php endif; ?>
	</section>
</div>
</div>
