<div class="container content-wrapper">
	<section class="content-header">
		<h1>
        	<i class="fas fa-language"></i>&nbsp;&nbsp;Listado de idiomas
        	<small>Add, Edit, Delete</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?=base_url()?>idioma/crear"><i class="fa fa-plus"></i>
                    &nbsp;&nbsp;Agregar más...
                	</a>
                </div>
            </div>
        </div>
		<div class="table-responsive">
		<table id="efectoTabla" class="display table table-bordered ">
			<thead>
					<tr>
						<th>Id Idioma</th>
						<th>Idioma</th>
						<th>Acciones</th>
					</tr>
			</thead>
			<tbody>
				<?php foreach ($body['idiomas'] as $idioma): ?>
					<tr>
						<td><?= $idioma->id ?></td>
						<td><?= $idioma->nombre ?></td>
						<td>
							<form class="listado" action="<?=base_url()?>idioma/editarGet" method="post">
								<input type="hidden" name="idIdioma" value="<?= $idioma -> id?>"/>
								<button class="glyphicon glyphicon-pencil" type="submit"></button>
							</form>
							<form class="listado" action="<?=base_url()?>idioma/borrarPost" method="post">
								<input type="hidden" name="idIdioma" value="<?= $idioma -> id?>" />
								<button class="glyphicon glyphicon-remove" type="submit"></button>
							</form>

						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<th>Id Idioma</th>
					<th>Idioma</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
		</div>
	</section>
</div>