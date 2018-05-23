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
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<img src="<?= base_url() ?><?= $body['actores']->rutaFoto ?>">
		</div>
		<div class="col-md-9">
			<h2 style="margin-top:-6px;"><?= $body['actores']->nombre ?> <?= $body['actores']->apellido1 ?> <?= $body['actores']->apellido2 ?></h2>
			<u><strong>Biografía:</strong></u><br/>
			<textarea cols="100" rows="12" readonly style="border:0; background-color:transparent; resize:none;"><?= $body['actores']->biografia ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>PELÍCULAS EN LAS QUE ACTÚA / DIRIGE</h2>
			<!-- TODO -->
		</div>
	</div>
</div>