<script>
	function confirmarBorrado(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registo?");

	if (cancelarRegistro) {
		borrado.submit();
	}
}
</script>

<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
<div class="content-wrapper">
<?php else: ?>
<div class="container content-wrapper">
<?php endif;?>

	<section class="content-header">
			<h1>
				<i class="fas fa-globe"></i>&nbsp;&nbsp;Listado de países <small>Add,
					Edit, Delete</small>
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-right">
					<div class="form-group">
						<a class="btn btn-primary" href="<?=base_url()?>pais/crear"><i
							class="fa fa-plus"></i> &nbsp;&nbsp;Agregar más... </a>
					</div>
				</div>
			</div>
        <?php if($body['paises'] != null):?>
        	<?php if  ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")): ?>
        		<div class="table-responsive">
				<table id="efectoTabla" class="display table table-bordered ">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
        					<?php foreach ($body['paises'] as $pais): ?>
		                        <?php if($pais -> nombre != null): ?>
            					<?php if($pais-> activo != 'inactivo'):?>
            						<tr id="<?= $pais->id ?>">
							<td><?= $pais->id?></td>
							<td><?= $pais->nombre ?></td>
							<td><?= $pais->estado ?></td>
							<td>
								<form class="listado" id="idFormEdit<?= $pais->id ?>"
									action="<?=base_url()?>pais/editar" method="post">
									<input type="hidden" name="id_pais"
										value="<?= $pais-> id?>">
									<button class="btn btn-info btn-sm"
										onclick="function f() {document.getElementById('Borrar<?= $pais->id ?>').submit();}">
										<i class="fas fa-edit"></i>
									</button>
								</form>
								<form class="listado" name="borrado" id="idFormRemove<?= $pais->id ?>"
									action="<?=base_url()?>pais/borrarPost" method="post">
									<input type="hidden" name="id_pais"
										value="<?= $pais-> id?>"> <input type="hidden" name="v"
										value="listarTodos">
									<button class="btn btn-warning btn-sm"
										onclick="confirmarBorrado();">
										<i class="fas fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
            					<?php else: ?>
            						<tr id="<?= $pais->id ?>">
							<td><?= $pais->nombre ?></td>
							<td><?= $pais->estado ?></td>
							<td>
								<form class="listado" name="borrado" id="idFormActive<?= $pais->id ?>"
									action="<?=base_url()?>pais/activarPost" method="post">
									<input type="hidden" name="id_pais"
										value="<?= $pais-> id?>"> <input type="hidden" name="v"
										value="listarTodos">
									<button class="btn btn-warning btn-sm"
										onclick="confirmarBorrado();">
										<i class="fas fa-plus-circle"></i>
									</button>
								</form>
							</td>
						</tr>
            					<?php endif;?>
            					<?php endif; ?>
        					<?php endforeach;?>
        				</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
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
        					<?php foreach ($body['paises'] as $pais): ?>
            					<tr id="<?= $pais->id ?>">
						<td><?= $pais->nombre ?></td>
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
				<strong>¡ADVERTENCIA!</strong> No hay ningún país en la base de datos, o
				no se han podido cargar.
			</div>
		</div>
	</div>
        <?php endif; ?>
	</section>
</div>
</div>
