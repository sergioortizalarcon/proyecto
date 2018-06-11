<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
<div class="content-wrapper">
<?php else: ?>
<div class="container content-wrapper">
<?php endif;?>

	<section class="content-header">
			<h1>
				<i class="fas fa-language"></i>&nbsp;&nbsp;Listado de Idiomas <small>Add,
					Edit, Delete</small>
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-right">
					<div class="form-group">
						<a class="btn btn-primary" href="<?=base_url()?>idioma/crear"><i
							class="fa fa-plus"></i> &nbsp;&nbsp;Agregar más... </a>
					</div>
				</div>
			</div>
        <?php if($body['idiomas'] != null):?>
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
        					<?php foreach ($body['idiomas'] as $idioma): ?>
            					<?php if($idioma->activo != 'Inactivo'):?>
          			<tr>
							<td><?= $idioma->id ?></td>
							<td><?= $idioma->nombre ?></td>
							<td><?= $idioma->activo ?></td>
							<td>
								<form class="listado" id="idFormEdit<?= $idioma->id ?>"
									action="<?=base_url()?>idioma/editar" method="post">
									<input type="hidden" name="id_idioma"
										value="<?= $idioma-> id?>">
									<button class="btn btn-info btn-sm"
										onclick="function f() {document.getElementById('Borrar<?= $idioma->id ?>').submit();}">
										<i class="fas fa-edit"></i>
									</button>
								</form>
								<form class="listado" id="idFormRemove<?= $idioma->id ?>"
									action="<?=base_url()?>idioma/borrarPost" method="post">
									<input type="hidden" name="id_idioma"
										value="<?= $idioma-> id?>"> <input type="hidden" name="v"
										value="listarTodos">
									<button class="btn btn-warning btn-sm"
										onclick="function f() {document.getElementById('Editar<?= $idioma->id ?>').submit();}">
										<i class="fas fa-trash"></i>
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
        					<?php foreach ($body['idiomas'] as $idioma): ?>
            					<tr id="<?= $idioma->id ?>">
						<td><?= $idioma->nombre ?></td>
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
				<strong>¡ADVERTENCIA!</strong> No hay ningún idioma en la base de
				datos, o no se han podido cargar.
			</div>
		</div>
	</div>
        <?php endif; ?>
	</section>
</div>
</div>
