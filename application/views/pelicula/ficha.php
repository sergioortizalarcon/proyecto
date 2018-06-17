<style>
 .estilo-img{
padding-right: 3%;
 }

 .posicion-div-info{
float:left;
 }
</style>
<script>
    $(document).ready(function(){
        $( '.info-gen' ).tooltip();

        $("#tabs").tabs();
    });
</script>
<?php if( !(isset ( $_SESSION ['rol'])) || ((isset ( $_SESSION ['rol'])) && ($_SESSION ['rol']!="administrador"))): ?>
<div class="container content-wrapper">
	<section class="content">
		<div id="tabs" class="divPestanas">
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
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    					<?php if(isset($_SESSION['idUser'])):?>
                        <div class="info-gen aviso-user" title="Has calificado con <?=isset($body['votos']['voto'])?$body['votos']['voto']:'0'?>/5 esta película">
							<input type="hidden" id="userId" value="<?=$_SESSION['idUser']?>" name="user"/>
							<input name="rating" value="<?=isset($body['votos']['voto'])?$body['votos']['voto']:' '?>" id="rating_star" type="hidden" postID="<?=$body['peliculas']['id']?>" />
                            </div>
						<?php else: ?>
                            <a class="info-gen" href="<?=base_url()?>Login/loginGet" title="Debes estar logueado para poder votar esta película">
							<input type="hidden" id="userId" value="0" name="user"/>
							<input name="rating" value="<?=$body['peliculas']['media_votos_totales']?>" id="rating_star" type="hidden" postID="<?=$body['peliculas']['id']?>" />
                            </a>
    					<?php endif; ?>
    					<div class="overall-rating">
						    <h6>(Calificación media <span id="avgrat"><?php echo $body['peliculas']['media_votos_totales']; ?>
						    </span>
                            <br/>basada en <span id="totalrat"><?php echo $body['peliculas']['votos_totales']; ?></span> votos totales)</h6>
						</div>
    				</div>
				</div> 
				<div class="col-md-9" style="padding-top:20px;">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
        				<h5>Título original: <?=$body['peliculas']->titulo_original ?></h5>
        				<h5>Fecha de estreno: <?=$body['peliculas']->fecha_lanzamiento ?></h5>
        				Géneros: 
    					<?php foreach ($body['peliculas']->sharedGenerosList as $gen): ?>
							 <?= $gen->nombre ?>
						<?php endforeach; ?>
						<h5>¿Todos los públicos? <?= $body['peliculas']->adulto ?></h5>
        				<h5>Idioma original: <?= $body['peliculas']->original_language ?></h5>
    				</div>
				</div>
			</div>
			
			<div id="sinopsis">
				<div class="col-md-3" style="padding-top:20px;">
    				<div class="rowd" style="float:left; display:inline-grid; height:100%; margin:1% 1% 5% 0;">
    					<div class="col-md-12">
    						<img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
    					</div>
    					<div class="col-md-12">
    						<h4><?= $body['peliculas']->titulo ?></h4>
    					</div>
    				</div>
				</div>
				<div class="col-md-9" style="padding-top:20px;">
    				<div class="row-md-12" style="height: 100%;margin: 1% 1% 5% 0;">
    					<?= $body['peliculas']->sinopsis ?>
    				</div>
				</div>
			</div>
			
			<div id="reparto">
				<div class="col-md-3" style="padding-top:20px;">
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
    					<h4>Director:</h4>
    					<?php foreach($body['repartos'] as $reparto): ?>
    						<?php foreach ($reparto->sharedProfesionesList as $prof): ?>
								<?php if($prof->nombre == 'Director'):?>
									<div class="col-md-6" id="<?= $reparto->id ?>" onclick="mostrarFicha(this.id);">
    									<div class="row-md-3" style="display:inline">
	    									<img src="<?= $reparto->ruta_foto ?>" style="width:100px; height:150px;" />
	    								</div>
		    							<div class="row-md-8" style="display:inline">
				    						<?= $reparto->nombre ?> 
				    						<?= $reparto->apellido1 ?>
		    							</div>
    								</div>
								<?php endif; ?>
							<?php endforeach; ?>
    					<?php endforeach; ?>
    					<h4>Actores:</h4>
    					<?php foreach($body['repartos'] as $reparto): ?>
    						<?php foreach ($reparto->sharedProfesionesList as $prof): ?>
								<?php if($prof->nombre == 'Actor'):?>
									<div class="col-md-6" id="<?= $reparto->id ?>" onclick="mostrarFicha(this.id);">
    									<div class="row-md-3" style="display:inline">
	    									<img src="<?= $reparto->ruta_foto ?>" style="width:100px; height:150px;" />
	    								</div>
		    							<div class="row-md-8" style="display:inline">
				    						<?= $reparto->nombre ?>
				    						<?= $reparto->apellido1 ?>
		    							</div>
    								</div>
								<?php endif; ?>
							<?php endforeach; ?>
    					<?php endforeach; ?>
    				</div>
				</div>
			</div>
			
			<div id="galeria">
				<div class="col-md-3" style="padding-top:20px;">
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
    			<div class="col-md-9" style="padding-top:20px;">
    				<form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
    					<div class="rowd" id="galeriaFotografica"></div>
    				</form>
				</div>
			</div>
		</div>
	</section>
</div>

<!--


                VISTA DEL ADMINISTRADOR DESDE AQUI HACIA ABAJO


 -->
<?php else: ?>
<div class="content-wrapper">
    <section class="content">
        <div id="tabs" class="divPestanas">
            <ul>
                <li><a href="#principal"><i class="far fa-id-card"></i></a></li>
                <li><a href="#sinopsis"> <i class="fas fa-book"></i> Sinopsis </a></li>
                <li><a href="#reparto"> <i class="fas fa-film"></i> Reparto </a></li>
                <li><a href="#galeria"> <i class="far fa-images"></i> Galería </a></li>
            </ul>
            <div id="principal">
                <div class="estilo-img posicion-div-info">
                    <img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
                    <h4><?= $body['peliculas']->titulo ?></h4>
                    <?php if(isset($_SESSION['idUser'])):?>
                    <div class="info-gen aviso-user" title="Has calificado con <?=isset($body['votos']['voto'])?$body['votos']['voto']:'0'?>/5 esta película">
                        <input type="hidden" id="userId" value="<?=$_SESSION['idUser']?>" name="user"/>
                        <input name="rating" value="<?=isset($body['votos']['voto'])?$body['votos']['voto']:' '?>" id="rating_star" type="hidden" postID="<?=$body['peliculas']['id']?>" />
                    </div>
                    <?php else: ?>
                        <a class="info-gen" href="<?=base_url()?>Login/loginGet" title="Debes estar logueado para poder votar esta película">
                        <input type="hidden" id="userId" value="0" name="user"/>
                        <input name="rating" value="<?=$body['peliculas']['media_votos_totales']?>" id="rating_star" type="hidden" postID="<?=$body['peliculas']['id']?>" />
                        </a>
                    <?php endif; ?>
                    <div class="overall-rating">
                        <h6>(Calificación media <span id="avgrat"><?php echo $body['peliculas']['media_votos_totales']; ?>
                        </span>
                        <br/>basada en <span id="totalrat"><?php echo $body['peliculas']['votos_totales']; ?></span> votos totales)</h6>
                    </div>
                </div>
                <div class="posicion-div-info">
                    <h5>Título original: <?=$body['peliculas']->titulo_original ?></h5>
                    <h5>Fecha de estreno: <?=$body['peliculas']->fecha_lanzamiento ?></h5>
                    Géneros: 
                    <?php foreach ($body['peliculas']->sharedGenerosList as $gen): ?>
                         <?= $gen->nombre ?>
                    <?php endforeach; ?>
                    <h5>¿Todos los públicos? <?= $body['peliculas']->adulto ?></h5>
                    <h5>Idioma original: <?= $body['peliculas']->original_language ?></h5>
                </div>
            </div>
            
            <div id="sinopsis">
                <div class="estilo-img posicion-div-info">
                    <img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
                    <br/>
                    <h4><?= $body['peliculas']->titulo ?></h4>
                </div>
                <div class="posicion-div-info" style="width: 70%;margin-top: 2%;">
                    <!-- <hr/> -->
    
                    <?= $body['peliculas']->sinopsis ?>
                </div>
            </div>
            
            <div id="reparto">
                <div class="estilo-img posicion-div-info">
                    <img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
                <br/>
                     <h4><?= $body['peliculas']->titulo ?></h4>
                </div>
                <div class="posicion-div-info">
                    <div>
                        <h4>Director:</h4>
                        <?php foreach($body['repartos'] as $reparto): ?>
                            <?php foreach ($reparto->sharedProfesionesList as $prof): ?>
                                <?php if($prof->nombre == 'Director'):?>
                                    <div id="<?= $reparto->id ?>" onclick="mostrarFicha(this.id);">
                                        <div>
                                            <img src="<?= $reparto->ruta_foto ?>" />
                                        </div>
                                        <div>
                                            <?= $reparto->nombre ?> 
                                            <?= $reparto->apellido1 ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <h4>Actores:</h4>
                        <?php foreach($body['repartos'] as $reparto): ?>
                            <?php foreach ($reparto->sharedProfesionesList as $prof): ?>
                                <?php if($prof->nombre == 'Actor'):?>
                                    <div id="<?= $reparto->id ?>" onclick="mostrarFicha(this.id);">
                                        <div >
                                            <img src="<?= $reparto->ruta_foto ?>" />
                                        </div>
                                        <div>
                                            <?= $reparto->nombre ?>
                                            <?= $reparto->apellido1 ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div id="galeria">
                <div class="estilo-img posicion-div-info">
                    <div>
                        <img src="<?= $body['peliculas']->ruta_cartel ?>" class="imgPerfilFichaIndividual" />
                    <br/>
                        <h4><?= $body['peliculas']->titulo ?></h4>
                    </div>
                    <div>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#avisoCambio">Añadir fotos</button>
                    </div>
                </div>

                <div class="posicion-div-info">
                    <form action="<?= base_url()?>reparto/insertarImagenes" method="post" enctype="multipart/form-data">
                        <div class="row" id="galeriaFotografica"></div>
                    </form>
                </div>
            </div>
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
		window.location="<?= base_url() ?>reparto/abrirFicha?id_reparto="+id;
	}
	
</script>
<script>
    $( document ).ready(function() {
    $("#rating_star").codexworld_rating_widget({
        starLength: '5',
        initialValue: '<?php echo isset($body['votos']['voto'])?$body['votos']['voto']:$body['peliculas']['media_votos_totales']?>',
        callbackFunctionName: 'processRating',
        imageDirectory: '<?=base_url()?>assets/img/images/',
        inputAttr: 'postID'
    });
});
    function processRating(val, attrVal){
    user = $("#userId").val();
    $.ajax({
        type: 'POST',
        url: '<?=base_url()?>Usuario/guardar_voto',
        data: 'postID='+attrVal+'&ratingPoints='+val+'&user='+user,
        dataType: 'json',
        success : function(data) {
            if (data.status == 'ok') {
                alert('Has calificado con '+val+'/5 esta película');
                $( ".aviso-user" ).attr( "title",'Has calificado con '+val+'/5 esta película');
                $('#avgrat').text(data.actualizacion.media_votos_totales);
                $('#totalrat').text(data.actualizacion.votos_totales);
            }else{
                <?php if(isset($_SESSION['idUser'])): ?>
                alert('Some problem occured, please try again.');
                <?php endif;?>
            }
        }
    });
};
</script>
