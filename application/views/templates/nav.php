<nav class="container navbar navbar-inverse">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed"
			data-toggle="collapse" data-target="#navegacionPagina">
			<span class="sr-only">desplegar/ocultar</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=base_url()?>">Template_Preparado</a>
	</div>
	<div class="collapse navbar-collapse" id="navegacionPagina">
		<ul class="nav navbar-nav">

			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Peliculas<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Peliculas</li>
					<li><a href="<?=base_url()?>pelicula/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>pelicula/listar">Listar</a></li>
				</ul></li>


			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Actores<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Actores</li>
					<li><a href="<?=base_url()?>actor/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>actor/listar">Listar</a></li>
				</ul></li>

			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Directores<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Directores</li>
					<li><a href="<?=base_url()?>director/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>director/listar">Listar</a></li>
				</ul></li>

			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Noticias<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Noticias</li>
					<li><a href="<?=base_url()?>articulo/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>articulo/listar">Listar</a></li>
				</ul></li>
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Países<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Países</li>
					<li><a href="<?=base_url()?>pais/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>pais/listar">Listar</a></li>
				</ul></li>
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Idiomas<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Idiomas</li>
					<li><a href="<?=base_url()?>idioma/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>idioma/listar">Listar</a></li>
				</ul></li>

		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?=base_url()?>usuario/registrar"><span
					class="glyphicon glyphicon-user"></span> Registrarse</a></li>
			<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span>
					Iniciar sesión</a></li>
			<li class="nope">
				<!--Agrupa el input de buscar con el boton-->
				<form class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar">
						<div class="input-group-btn">
							<button class="btn btn-default" type="subtmit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</div>
					</div>
				</form>
			</li>
		</ul>
	</div>
</nav>

