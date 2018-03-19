<nav class="container navbar navbar-inverse">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacionPagina">
			<span class="sr-only">desplegar/ocultar</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=base_url()?>">Template_Preparado</a>
	</div>
	<div class="collapse navbar-collapse" id="navegacionPagina">
		<ul class="nav navbar-nav navbar-left">
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Acciones<span class="caret"></span>
			</a>
				<ul class="dropdown-menu">

					<li class="dropdown-header">Ciudad</li>
					<li><a href="<?=base_url()?>ciudad/crear">Crear</a></li>
					<li><a href="<?=base_url()?>ciudad/listar">Listar</a></li>
					<li role="separator" class="divider"></li>
					
					<li class="dropdown-header">Lenguajes</li>
					<li><a href="<?=base_url()?>lp/crear">Crear</a></li>
					<li><a href="<?=base_url()?>lp/listar">Listar</a></li>
					<!-- Más beans y más acciones -->
					<li class="dropdown-header">Empleados</li>
					<li><a href="<?=base_url()?>empleado/crear">Crear</a></li>
					<li><a href="<?=base_url()?>empleado/listar">Listar</a></li>

				</ul>
			</li>
			
			<!-- Más menús -->

		</ul>
		<ul class="nav navbar-nav navbar-right">
				<li><a href="<?=base_url()?>lp/registro"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
				<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
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

