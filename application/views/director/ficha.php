<div class="content-wrapper">
	<section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#perfil"><i class="far fa-id-card"></i></a></li>
				<li><a href="#bio"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#filmog"> <i class="fas fa-film"></i> Filmografía </a></li>
				<li><a href="#noticias"> <i class="far fa-newspaper"></i> Noticia </a></li>
			</ul>
		
			<div id="perfil">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12" style="border:1px solid black; float: ">
						<img src="<?= base_url() ?><?= $body['directores']->rutaFoto ?>">
					</div>
					<div class="col-md-12" style="border:1px solid blue;">
						<h4><?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></h4>
					</div>
				</div>
				<?php if($body['directores']->ambos == 'on'): ?>
					<h5>Actor / Director</h5>
				<?php else: ?>
			    	<h5>Actor</h5>
				<?php endif; ?>
				<h5>Fecha de nacimiento: <?=$body['directores']->fechaNacimiento ?></h5>
			</div>
			
			<div id="bio">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12" style="border:1px solid black; float: ">
						<img src="<?= base_url() ?><?= $body['directores']->rutaFoto ?>">
					</div>
					<div class="col-md-12" style="border:1px solid blue;">
						<h4><?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></h4>
					</div>
				</div>
				<?= $body['directores']->biografia ?>
			</div>
			
			<div id="filmog">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12" style="border:1px solid black; float: ">
						<img src="<?= base_url() ?><?= $body['directores']->rutaFoto ?>">
					</div>
					<div class="col-md-12" style="border:1px solid blue;">
						<h4><?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></h4>
					</div>
				</div>
				Lorem ipsum dolor sit amet.Lorem ipsum dolor.
			</div>
			
			<div id="noticias">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12" style="border:1px solid black; float: ">
						<img src="<?= base_url() ?><?= $body['directores']->rutaFoto ?>">
					</div>
					<div class="col-md-12" style="border:1px solid blue;">
						<h4><?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></h4>
					</div>
				</div>
				Lorem ipsum.
			</div>

		</div>
	</section>
</div>