<div class="container">
	<table class="table table-striped">
		<tr>
			<th>Nombre director</th>
			<th></th>
			<th></th>
		</tr>
<?php foreach ($body['directores']as $director):?>
<tr>
			<td><?php $director['nombre']?></td>
			<td>
				<form action="<?php base_url()?>director/editar" id="idFormedit"
					method="post">
					<input type="hidden" name="id_director" value="<?php $director->id?>">
				</form>
			</td>
		</tr>
<?php endforeach;?>
	</table>
</div>