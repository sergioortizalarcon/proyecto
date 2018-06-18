<script>
    $(document).ready(function(){
        $( '.info-gen' ).tooltip();

        $("#tabs").tabs();
    });
</script>
<?php if( !(isset ( $_SESSION ['rol'])) || ((isset ( $_SESSION ['rol'])) && ($_SESSION ['rol']!="administrador"))): ?>
<div class="container content-wrapper">
	<section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#perfil"><i class="far fa-id-card"></i></a></li>
				<li><a href="#bio"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#filmog"> <i class="fas fa-film"></i> Filmografía </a></li>
				<!--<li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>-->
			</ul>
		
			<div id="perfil"> 
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9" style="float:left;padding-top:20px;">
    				<div class="row-md-12 datosDentro">
    					<h5>
							<?php foreach($body['profesiones'] as $profesion): ?>
    							<?= $profesion->nombre ?> ||
    						<?php endforeach; ?>
						</h5>
        				<h5>Fecha de nacimiento: <?=$body['repartos']->fechaNacimiento ?></h5>
        				<h5>País de nacimiento: <?= $body['repartos']->paises['nombre'] ?></h5>
    				</div>
				</div>
			</div>
			
			<div id="bio">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12" >
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
    			<div class="col-md-9 datosDentro">
    				<div class="row-md-12">
    					<?= $body['repartos']->biografia ?>
    				</div>
				</div>
			</div>
			
			<div id="filmog">
				<div class="col-md-3" style="padding-top:20px;">
					<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9 datosDentro">
    				<div class="col-md-12">
    					<h3>Películas en las que participa:</h3>
    					<?php foreach ($body['repartos']->sharedPeliculasList as $pel): ?>
							<div class="col-md-6" id="<?= $pel->id ?>"onclick="mostrarFicha(this.id);" style="margin-top:40px;">
    							<div class="row-md-3" style="display:inline">
	    							<img src="<?= $pel->ruta_cartel ?>" style="width:100px; height:150px;" />
	    						</div>
		    					<div class="col-md-8" style="display:inline">
				    				<?= $pel->titulo ?> 
		    					</div>
    						</div>
						<?php endforeach; ?>
    				</div>
				</div>
			</div>
			<!-- GALERÍA
			<div id="galeria">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    					<?php //if($body['usuarios']->rol == 3): ?>
    					<div class="col-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    						<input class="btn btn-default" type="button" onclick="insertarFotos();" value="Añadir fotos" />
    					</div>
    					<?php //endif; ?>
    				</div>
				</div>
    			<div class="col-md-9" style="padding-top:20px;">
    				<form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
    					<div class="rowd" id="galeriaFotografica"></div>
    				</form>
				</div>
			</div>-->
		</div>
	</section>
</div>




<!--


                VISTA DEL ADMINISTRADOR DESDE AQUI HACIA ABAJO


 -->
<?php else: ?>
<div class="content-wrapper">
    <section class="content">
		<div id="tabs" style="height:500px;">
			<ul>
				<li><a href="#perfil"><i class="far fa-id-card"></i></a></li>
				<li><a href="#bio"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#filmog"> <i class="fas fa-film"></i> Filmografía </a></li>
				<!--<li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>-->
			</ul>
		
			<div id="perfil"> 
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9" style="float:left;padding-top:20px;">
    				<div class="row-md-12 datosDentro">
    					<h5>
							<?php foreach($body['profesiones'] as $profesion): ?>
    							<?= $profesion->nombre ?> ||
    						<?php endforeach; ?>
						</h5>
        				<h5>Fecha de nacimiento: <?=$body['repartos']->fechaNacimiento ?></h5>
        				<h5>País de nacimiento: <?= $body['repartos']->paises['nombre'] ?></h5>
    				</div>
				</div>
			</div>
			
			<div id="bio">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12" >
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
    			<div class="col-md-9 datosDentro">
    				<div class="row-md-12">
    					<?= $body['repartos']->biografia ?>
    				</div>
				</div>
			</div>
			
			<div id="filmog">
				<div class="col-md-3" style="padding-top:20px;">
					<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9 datosDentro">
    				<div class="col-md-12">
    					<h3>Películas en las que participa:</h3>
    					<?php foreach ($body['repartos']->sharedPeliculasList as $pel): ?>
							<div class="col-md-6" id="<?= $pel->id ?>"onclick="mostrarFicha(this.id);" style="margin-top:40px;">
    							<div class="row-md-3" style="display:inline">
	    							<img src="<?= $pel->ruta_cartel ?>" style="width:100px; height:150px;" />
	    						</div>
		    					<div class="col-md-8" style="display:inline">
				    				<?= $pel->titulo ?> 
		    					</div>
    						</div>
						<?php endforeach; ?>
    				</div>
				</div>
			</div>
			<!-- GALERÍA
			<div id="galeria">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd datosReparto">
    					<div class="col-md-12">
    						<img src="<?= $body['repartos']->rutaFoto ?>" style="width:250px; height:300px;" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></h4>
    					</div>
    					<?php //if($body['usuarios']->rol == 3): ?>
    					<div class="col-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    						<input class="btn btn-default" type="button" onclick="insertarFotos();" value="Añadir fotos" />
    					</div>
    					<?php //endif; ?>
    				</div>
				</div>
    			<div class="col-md-9" style="padding-top:20px;">
    				<form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
    					<div class="rowd" id="galeriaFotografica"></div>
    				</form>
				</div>
			</div>-->
		</div>
	</section>
</div>

    <div class="modal fade" id="avisoCambio" tabindex="-1" role="dialog" aria-labelledby="avisoCambioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="avisoCambioModalLabel">Galería</h3>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" action="uploader.php" method="POST">
              <div class="form-group">
                <label for="cast" class="col-form-label">Imagenes de: </label><br/><br/>
                <input type="file" name="archivos" multiple="multiple">
              </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info" id="open">Subir fotos</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php endif; ?>




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

	function mostrarFicha(id) {
		window.location="<?= base_url() ?>pelicula/abrirFicha?id_pelicula="+id;
	}
	
</script>