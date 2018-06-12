<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
<div class="content-wrapper">
<?php else: ?>
<div class="container content-wrapper">
<?php endif;?>

	<section class="content-header">
		<h1>
        	<i class="fas fa-address-card"></i>&nbsp;&nbsp;Listado de Reparto
        	<small>Add, Edit, Delete</small>
		</h1>
	</section>
	
	<section class="content">
		<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?=base_url()?>reparto/crear">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar más...</a>
                </div>
            </div>
        </div>
        <?php if($body['repartos'] != null):?>
            <?php if  ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")): ?>
                <div class="table-responsive">
                    <table id="efectoTabla" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Primer apellido</th>
                                <th>Fecha de nacimiento</th>
                                <th>País de nacimiento</th>
                                <th>Profesion/es</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($body['repartos'] as $reparto): ?>
            					<?php if($reparto -> estado != 'Inactivo'):?>
            						<tr id="<?= $reparto->id ?>"onclick="mostrarFicha(this.id);" >
            							<td><img src="<?= $reparto->ruta_foto ?>" style="margin:5px;" height="60" width="50"></td>
            							<td><?= $reparto->nombre ?></td>
            							<td><?= $reparto->apellido1 ?></td>
            							<td><?= $reparto->fecha_nacimiento ?></td>
            							<td><?= $reparto->paises['nombre'] ?></td>
                                        <td>
                                            <?php foreach ($reparto->sharedProfesionesList as $prof): ?>
                                                <?= $prof->nombre ?> ||
                                            <?php endforeach; ?>
                                        </td>
            							<td><?= $reparto->estado ?></td>
            							<td>
            								<form class="listado" id="idFormEdit<?= $reparto->id ?>" action="<?=base_url()?>reparto/editar" method="post">
            									<input type="hidden" name="id_reparto" value="<?= $reparto -> id?>">
            									<button class="btn btn-info btn-sm" onclick="function f() {document.getElementById('Borrar<?= $reparto->id ?>').submit();}">
            										<i class="fas fa-edit"></i>
            									</button>
            								</form>
            								<form class="listado" id="idFormRemove<?= $reparto->id ?>" action="<?=base_url()?>reparto/borrarPost" method="post">
            									<input type="hidden" name="id_reparto" value="<?= $reparto -> id?>">
            									<input type="hidden" name="v" value="listarTodos">
            									<button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('Editar<?= $reparto->id ?>').submit();}">
            										<i class="fas fa-trash"></i>
            									</button>
            								</form>
            							</td>
            						</tr>
            					<?php else: ?>
            						<tr id="<?= $reparto->id ?>"onclick="mostrarFicha(this.id);" >
            							<td><img src="<?= $reparto->ruta_foto ?>" style="margin:5px;" height="60" width="50"></td>
            							<td><?= $reparto->nombre ?></td>
            							<td><?= $reparto->apellido1 ?></td>
            							<td><?= $reparto->fecha_nacimiento ?></td>
            							<td><?= $reparto->paises['nombre'] ?></td>
            							<td>
                                            <?php foreach ($reparto->sharedProfesionesList as $prof): ?>
                                                <?= $prof->nombre ?> ||
                                            <?php endforeach; ?>
                                        </td>
            							<td><?= $reparto->estado ?></td>
            							<td>
            								<form class="listado" id="idFormActive<?= $reparto->id ?>" action="<?=base_url()?>reparto/activarPost" method="post">
            									<input type="hidden" name="id_reparto" value="<?= $reparto -> id?>">
            									<input type="hidden" name="v" value="listarTodos">
            									<button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('Activar<?= $reparto->id ?>').submit();}">
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
        						<th>Foto</th>
        						<th>Nombre</th>
        						<th>Primer apellido</th>
        						<th>Fecha de nacimiento</th>
        						<th>Pais de nacimiento</th>
        						<th>Profesion/es</th>
        						<th>Estado</th>
        						<th>Acciones</th>
        					</tr>
        				</tfoot>
        			</table>
        		</div>
        	<?php else: ?>
            	<div class="table-responsive">
        			<table id="efectoTabla" class="display table table-bordered ">
        				<thead>
        					<tr>
        						<th>Foto</th>
        						<th>Nombre</th>
        						<th>Primer apellido</th>
        						<th>Fecha de nacimiento</th>
        						<th>Pais de nacimiento</th>
        						<th>Profesión</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php foreach ($body['repartos'] as $reparto): ?>
            					<tr id="<?= $reparto->id ?>"onclick="mostrarFicha(this.id);" >
            						<td><img src="<?= $reparto->ruta_foto ?>" style="margin:5px;" height="60" width="50"></td>
            						<td><?= $reparto->nombre ?></td>
            						<td><?= $reparto->apellido1 ?></td>
            						<td><?= $reparto->fecha_nacimiento ?></td>
            						<td><?= $reparto->paises['nombre'] ?></td>
            						<td>
                                        <?php foreach ($reparto->sharedProfesionesList as $prof): ?>
                                            <?= $prof->nombre ?> ||
                                        <?php endforeach; ?>
                                    </td>
            				<?php endforeach; ?>
        				</tbody>
        				<tfoot>
        					<tr>
        						<th>Foto</th>
        						<th>Nombre</th>
        						<th>Primer apellido</th>
        						<th>Fecha de nacimiento</th>
        						<th>Pais de nacimiento</th>
        						<th>Profesión</th>
        					</tr>
        				</tfoot>
        			</table>
        		</div>
        	<?php endif; ?>
		<?php else:?>
            <div class="container" style="width:90%;">
                <h2 class="alert alert-info" style="font-size: x-large;">¡ATENCIÓN!</h2>
                <div class="well">
                    <div class="alert alert-warning">
                    	<strong>¡ADVERTENCIA!</strong> No hay nadie en la base de datos, o no se han podido cargar
                    </div>
                </div>
            </div>
        <?php endif; ?>
	</section>
</div>
</div>
<script type="text/javascript">
	function mostrarFicha(id) {
		window.location="<?= base_url() ?>reparto/abrirFicha?id_reparto="+id;
	}
</script>