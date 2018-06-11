<div class="container content-wrapper">
	<section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#pricipal"><i class="far fa-id-card"></i></a></li>
				<li><a href="#reparto"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#sinopsis"> <i class="fas fa-film"></i> Filmografía </a></li>
				<li><a href="#noticias"> <i class="far fa-newspaper"></i> Noticia </a></li>
				<li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>
			</ul>
		
			<div id="principal">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['peliculas']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
        				<h5>Fecha de estreno: <?=$body['peliculas']->anioEstreno ?></h5>
        				<h5>País de creación: <?= $body['peliculas']->paises['nombre'] ?></h5>
    				</div>
				</div>
			</div>
			
			<div id="reparto">
			    <!-- TODO 
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					Meter todas las personas que han trabajado en la pelicula
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['peliculas']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    					<?= $body['repartos']->biografia ?>
    				</div>
				</div>
				-->
			</div>
			
			<div id="sinopsis">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['peliculas']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    					<?= $body['peliculas']->sinopsis ?>
    				</div>
				</div>
			</div>
			
			<div id="noticias">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['peliculas']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    					Lorem ipsum.
    				</div>
				</div>
			</div>
			
			<div id="galeria">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= base_url() ?><?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
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
    			<div class="col-md-9">
    				<form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
    					<div class="rowd" id="galeriaFotografica">
    					
    					</div>
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