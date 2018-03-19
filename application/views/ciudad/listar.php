<div class="container">
	<table class="table table-striped">
		<tr>
			<th>Nombre ciudad</th>
		</tr>
		
		<?php foreach ($body['ciudades'] as $ciudad): ?>
			<tr>
				<td><?= $ciudad->nombre ?></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>