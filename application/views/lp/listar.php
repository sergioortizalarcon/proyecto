<div class="container">
	<form action="<?= base_url() ?>lp/listarPost" method="post">
		<label for="idFiltro">Filtro</label>
		<input id="idFiltro" type="text" name="filtro" value="<?= $filtro ?>">
		<input type="submit" value="Filtrar">
	</form>
	
	<table class="table table-bordered">
		<tr>
			<th>Nombre del L.P.</th>
			<th>Acción</th>
		</tr>
		
		<?php foreach ($lps as $lp): ?>
		<tr>
			<td><?=$lp->nombre ?></td>
			<td>
				<form action="<?=base_url()?>lp/editar" method="post">
					<input type="hidden" name="idLP" value="<?=$lp->id ?>" />
					<input type="hidden" name="filtro" value="<?=$filtro ?>" />
					<button class="glyphicon glyphicon-pencil" type="submit"></button>
				</form>
				
				<form action="<?=base_url()?>lp/borrar" method="post">
					<input type="hidden" name="idLP" value="<?=$lp->id ?>" />
					<input type="hidden" name="filtro" value="<?=$filtro ?>" />
					<button class="glyphicon glyphicon-remove" type="submit"></button>
				</form>
				
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>