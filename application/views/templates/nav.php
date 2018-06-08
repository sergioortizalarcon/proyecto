<nav class="container navbar navbar-inverse">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacionPagina">
			<span class="sr-only">desplegar/ocultar</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=base_url()?>">CRUD</a>
	</div>
	<div class="collapse navbar-collapse" id="navegacionPagina">
		<ul class="nav navbar-nav">
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Peliculas<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Peliculas</li>
					<li><a href="<?=base_url()?>pelicula/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>pelicula/listar">Listar</a></li>
				</ul>
			</li>
			

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reparto<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Reparto</li>
					<li><a href="<?=base_url()?>reparto/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>reparto/listar">Listar</a></li>
				</ul>
			</li>
			
			<!--
			Por si se quiere diferenciar en el futuro
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Directores<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Directores</li>
					<li><a href="<?=base_url()?>director/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>director/listar">Listar</a></li>
				</ul>
			</li>
			-->
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Noticias<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Noticias</li>
					<li><a href="<?=base_url()?>editor/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>editor/listar">Ver noticias</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Países<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Países</li>
					<li><a href="<?=base_url()?>pais/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>pais/listar">Listar</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Idiomas<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Idiomas</li>
					<li><a href="<?=base_url()?>idioma/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>idioma/listar">Listar</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Usuarios</li>
					<li><a href="<?=base_url()?>administrador/listar">Listar</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Profesiones<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Profesiones</li>
					<li><a href="<?=base_url()?>profesion/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>profesion/listar">Listar</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reparto<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Reparto</li>
					<li><a href="<?=base_url()?>reparto/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>reparto/listar">Listar</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if ( !isset($_COOKIE["usuario"]) ): ?>
				<li>
					<a href="<?=base_url()?>login/loginGet" class="boton-login">
						<span class="glyphicon glyphicon-log-in"></span> Login
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>usuario/registrar" class="boton-login"><span class="glyphicon glyphicon-user"></span> Registrarse</a>
				</li>
			<?php else: ?>
			<li class="dropdown" style="background: none">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url()?>login/perfilUsuario"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>login/loginOut"><i class="fa fa-sign-out fa-fw"></i> Logout <?=$_COOKIE["usuario"]?></a>
                        </li>
                    </ul>
               </li>
			<?php endif;?>

			
		</ul>	
	</div>
</nav>

