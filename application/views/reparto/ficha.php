<div class="container content-wrapper">
	<section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#perfil"><i class="far fa-id-card"></i></a></li>
				<li><a href="#bio"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#filmog"> <i class="fas fa-film"></i> Filmografía </a></li>
				<li><a href="#noticias"> <i class="far fa-newspaper"></i> Noticia </a></li>
				<li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>
			</ul>
		
			<div id="perfil">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12">
						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>">
					</div>
					<div class="col-md-12">
						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
					</div>
				</div>
				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
					<h5><?= $body['repartos']->cadProfesiones ?></h5>
    				<h5>Fecha de nacimiento: <?=$body['repartos']->fechaNacimiento ?></h5>
    				<h5>País de nacimiento: <?= $body['repartos']->paises['nombre'] ?></h5>
				</div>
			</div>
			
			<div id="bio">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12">
						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>">
					</div>
					<div class="col-md-12">
						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
					</div>
				</div>
				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
					<?= $body['repartos']->biografia ?>
				</div>
			</div>
			
			<div id="filmog">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12">
						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>">
					</div>
					<div class="col-md-12">
						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
					</div>
				</div>
				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
					Lorem ipsum dolor sit amet.Lorem ipsum dolor.
				</div>
			</div>
			
			<div id="noticias">
				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
					<div class="col-md-12">
						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>">
					</div>
					<div class="col-md-12">
						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
					</div>
				</div>
				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
					Lorem ipsum.
				</div>
			</div>
			
			<div id="galeria">
				<div class="col-md-2">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;border:1px solid red;">
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>">
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    					<!-- Cuando se pase el rol del usuario, si es admin, puede ver el botón, si no, solo las fotos -->
    					<?php //if($body['usuarios']->rol == 3): ?>
    					<div class="col-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    						<input class="btn btn-default" type="button" onclick="insertarFotos();" value="Añadir fotos" />
    					</div>
    					<?php //endif; ?>
    				</div>
				</div>
				<!-- TEMPORAL añadir imagenes a la galería de cada persona -->
    			<div class="col-md-10">
    				<form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
    					<div class="rowd" id="galeriaFotografica" style="height:100%; width:100%; border:1px solid black;"></div>
    				</form>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
	function insertarFotos() {
		//Abrir un popup que permita insertar una foto, que la valide, si es correcta la pone mediante
		//AJAX en la pestaña de galería, si es incorrecta, muestra un mensaje y te permite poner otra,
		//hasta que no se pulse n el botón cerrar, no se cierra el popup
		/*alert("insertarFotos");
		document.getElementById("galeriaFotografica").innerHTML += "Prueba";*/
		var opciones = "width=120,height=300,scrollbars=NO";

		window.open("","nombreventa na", opciones);
	}
</script>