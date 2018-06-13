<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
<div class="content-wrapper">
<?php else: ?>
<div class="container content-wrapper">
<?php endif;?>	
	<section class="content-header">
			<h1>
				<i class="far fa-folder-open"></i>&nbsp;&nbsp;Listado de Profesiones
				<small>Add, Edit, Delete</small>
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-right">
					<div class="form-group">
						<a class="btn btn-primary" href="<?= base_url()?>profesion/crear">
							<i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar más...
						</a>
					</div>
				</div>
			</div> 
			<?php if($body['profesiones'] != null):?>
			 	<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
					<div class="table-responsive">
						<table id="efectoTabla" class="display table table-bordered ">
							<thead>
								<tr>
									<th>Id profesión</th>
									<th>Nombre</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body['profesiones'] as $profesion): ?>
									<?php if($profesion -> estado != 'Inactivo'):?>
										<tr>
											<td><?= $profesion->id ?></td>
											<td><?= $profesion->nombre ?></td>
											<td><?= $profesion->estado ?></td>
											<td>
												<form class="listado" id="idFormedit"
													action="<?=base_url()?>profesion/editar" method="post">
													<input type="hidden" name="id_profesion"
														value="<?= $profesion -> id?>">
													<button class="btn btn-info btn-sm" class="botones"
														onclick="function f() {document.getElementById('idFormEdit').submit();}">
														<i class="fas fa-edit"></i>
													</button>
												</form>
												<form class="listado" id="idFormRemove"
													action="<?=base_url()?>profesion/borrarPost" method="post">
													<input type="hidden" name="id_profesion"
														value="<?= $profesion -> id?>"> <input type="hidden" name="v"
														value="listarTodos">
													<button class="btn btn-warning btn-sm" class="botones"
														onclick="function f() {document.getElementById('idFormRemove').submit();}">
														<i class="fas fa-trash"></i>
													</button>
												</form>
											</td>
										</tr>
									<?php else: ?>
				    					<tr>
											<td><?= $profesion->id ?></td>
											<td><?= $profesion->nombre ?></td>
											<td><?= $profesion->estado ?></td>
											<td>
	            								<form class="listado" id="idFormActive<?= $profesion->id ?>" action="<?=base_url()?>profesion/activarPost" method="post">
	            									<input type="hidden" name="id_profesion" value="<?= $profesion -> id?>">
	            									<input type="hidden" name="v" value="listarTodos">
	            									<button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('Activar<?= $profesion->id ?>').submit();}">
	            										<i class="fas fa-plus-circle"></i>
	            									</button>
	            								</form>
            								</td>
										</tr>
									<?php endif; ?>
							<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<th>Id profesión</th>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</tfoot>
					</table>
				<?php endif; ?>
			<?php else: ?>
				<div class="container" style="width: 90%;">
					<h2 class="alert alert-info" style="font-size: x-large;">¡ATENCIÓN!</h2>
					<div class="well">
						<div class="alert alert-warning">
							<strong>¡ADVERTENCIA!</strong> No hay profesiones en la base de
							datos, o no se han podido cargar
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		</section>
	</div>