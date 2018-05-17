<div class="container">
	<div class="row">
		<div class="col-md-3" style="border:1px solid black;">
			<img src="<?= base_url() ?><?= $body['actores']->rutaFoto ?>">
		</div>
		<div class="col-md-9" style="border:1px solid blue;">
			<h2 style="margin-top:-6px;"><?= $body['actores']->nombre ?> <?= $body['actores']->apellido1 ?> <?= $body['actores']->apellido2 ?></h2>
			
		</div>
	</div>
</div>