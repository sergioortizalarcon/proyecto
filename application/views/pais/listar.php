<div class="container">
		<table class="table table-striped">
		<tr>
			<td>Nombre del país</td>
		</tr>

<?php foreach ($body['paises'] as $pais): ?>
			<tr>
			<td><?= $pais['nombre'] ?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>