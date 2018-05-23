<div class="container">
	<div class="row">
		<div class="col-md-3">
			<img src="<?= base_url() ?><?= $body['directores']->rutaFoto ?>">
		</div>
		<div class="col-md-9">
			<h2 style="margin-top:-6px;"><?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></h2>
			<u><strong>Biografía:</strong></u><br/>
			<textarea cols="100" rows="12" readonly style="border:0; background-color:transparent; resize:none;"><?= $body['directores']->biografia ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>PELÍCULAS EN LAS QUE ACTÚA / DIRIGE</h2>
			<!-- TODO -->
		</div>
	</div>
</div>