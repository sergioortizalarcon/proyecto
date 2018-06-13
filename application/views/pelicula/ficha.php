<div class="container content-wrapper">
	<section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#principal"><i class="far fa-id-card"></i></a></li>
				<li><a href="#sinopsis"> <i class="fas fa-book"></i> Sinopsis </a></li>
				<li><a href="#reparto"> <i class="fas fa-film"></i> Reparto </a></li>
				<li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>
			</ul>
		
			<div id="principal">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" style="width:150px; heigth:200px"/>
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div> 
				<div class="col-md-9" style="padding-top:20px;">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
        				<h5>Título original: <?=$body['peliculas']->titulo_original ?></h5>
        				<h5>Fecha de estreno: <?=$body['peliculas']->fecha_lanzamiento ?></h5>
        				<h5>Idioma original: <?= $body['peliculas']->original_language ?></h5>
    				</div>
				</div>
			</div>
			
			<div id="sinopsis">
				<div class="col-md-3">
    				<div class="rowd" style="float:left; display:inline-grid; height:100%; margin:1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
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
			
			<div id="reparto">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    					<?php foreach($body['repartos'] as $reparto): ?>
    						<div class="row-md-12" style="border:1px solid black;">
    							<div class="row-md-3" style="display:inline">
	    							<img src="<?= $reparto->ruta_foto ?>" style="width:100px; height:150px;" />
	    						</div>
	    						<div class="row-md-8" style="display:inline">
		    						<?= $reparto->titulo ?><br/>
		    						<?= $reparto->titulo_original ?>
	    						</div>
    						</div>
    					<?php endforeach; ?>
    				</div>
				</div>
			</div>
			
			<div id="galeria">
				<div class="col-md-3">
    				<div class="rowd" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
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
    					<div class="rowd" id="galeriaFotografica"></div>
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