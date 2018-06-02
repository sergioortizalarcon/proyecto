<div class="content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-globe"></i>&nbsp;&nbsp;Listado de paises
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
	<section class="content">
		<div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?=base_url()?>pais/crear"><i class="fa fa-plus"></i>
                    &nbsp;&nbsp;Agregar más...
                	</a>
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
				<?php foreach ($body['paises'] as $pais): ?>
					<tr>
						<td><?= $pais->id ?></td>
						<td valign="center"><?= $pais->nombre ?></td>
						<td class="botones">
							<form class="listado" id="idFormedit" action="<?=base_url()?>pais/editar" method="post">
								<input type="hidden" name="id_pais" value="<?= $pais -> id?>">
								<button class="btn btn-info btn-lg btn-block"onclick="function f() {document.getElementById('idFormEdit').submit();}">
									<i class="fas fa-edit"></i>
								</button>
							</form>
							<form class="listado" id="idFormRemove" action="<?=base_url()?>pais/borrarPost" method="post">
								<input type="hidden" name="id_pais" value="<?= $pais -> id?>">
								<input type="hidden" name="v" value="listarTodos">
								<button  class="btn btn-danger btn-lg btn-block" onclick="function f() {document.getElementById('idFormRemove').submit();}">
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