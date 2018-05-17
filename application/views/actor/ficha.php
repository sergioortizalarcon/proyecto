<script>
	$(document).ready(function(){
		$("#tabs").tabs();
	});
</script>
<div class="content-wrapper">
	<section class="content">
		<div id="tabs">
			<ul>
				<li><a href="#perfil"><i class="far fa-id-card"></i></a></li>
				<li><a href="#bio"> <i class="fas fa-book"></i> Biografía </a></li>
				<li><a href="#filmog"> <i class="fas fa-film"></i> Filmografía </a></li>
				<li><a href="#noticias"> <i class="far fa-newspaper"></i> Noticia </a></li>
			</ul>
		
			<div id="perfil">
			<div class="row" style="float: left;display: inline-grid;height: 100%;margin: 1% 1% 5% 0;">
				<div class="col-md-12" style="border:1px solid black; float: ">
					<img src="<?= base_url() ?><?= $body['actores']->rutaFoto ?>">
				</div>
				<div class="col-md-12" style="border:1px solid blue;">
					<h4><?= $body['actores']->nombre ?> <?= $body['actores']->apellido1 ?> <?= $body['actores']->apellido2 ?></h4>
				</div>
			</div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non recusandae suscipit quod nulla harum, repellendus ea repellat iste eaque maxime nostrum saepe? Laboriosam distinctio, ipsum officiis vitae harum voluptatum. <br>
			</div>
			<div id="bio">Lorem ipsum dolor sit amet.</div>
			<div id="filmog">Lorem ipsum dolor sit amet.Lorem ipsum dolor. </div>
			<div id="noticias">Lorem ipsum. </div>

		</div>
	</section>
</div>