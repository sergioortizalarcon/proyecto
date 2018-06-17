<div class="content-wrapper container">
	<section class="content-header">
		
		<div class="w3-content w3-section slidePeliculas">
		  <img class="mySlides" src="<?= base_url() ?>assets/img/banner/bannerBatman.jpg">
		  <img class="mySlides" src="<?= base_url() ?>assets/img/banner/bannerReadyPlayerOne.jpg">
		  <img class="mySlides" src="<?= base_url() ?>assets/img/banner/bannerSherlock.jpg">
		</div>
	</section>
	<section class="content">
		<div id="body">
			<div class="col-md-12 divPeliculas">
				<?php foreach($body['peliculas'] as $pel): ?>
					<div class="col-md-4 imgPrincipal">
						<img src="<?= $pel->ruta_cartel ?>" id="<?= $pel->id ?>" onclick="mostrarFicha(this.id);">
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
			<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
		</p>
	</section>
</div>

<style>
	.mySlides {display:none;width:100%;height:300px;}
	.slidePeliculas {padding-bottom:20px;}
	.imgPrincipal{width:300px;weight:200px;margin:20px;}
	.divPeliculas{ padding:50px;margin-left:100px;}
	.divPeliculas img {border-radius:20px;}
</style>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}

function mostrarFicha(id) {
	window.location="<?= base_url() ?>pelicula/abrirFicha?id_pelicula="+id;
}
</script>