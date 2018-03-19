<nav class="container navbar navbar-inverse">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacionPagina">
			        <span class="sr-only">desplegar/ocultar</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			</button>
		<a class="navbar-brand" href="<?=base_url()?>">CRUD emple</a>
	</div>
	<div class="collapse navbar-collapse" id="navegacionPagina">
		<ul class="nav navbar-nav">
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Acciones<span class="caret"></span></a>

				<ul class="dropdown-menu">
					<li class="dropdown-header">CIUDAD</li>
					<li><a href="<?=base_url()?>ciudad/crear">Nueva</a></li>
					<li><a href="<?=base_url()?>ciudad/listar">Listar</a></li>

					<li role="separator" class="divider"></li>

					<li class="dropdown-header">Leng.prog.</li>
					<li><a href="<?=base_url()?>lp/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>lp/listar">Listar</a></li>

					<li role="separator" class="divider"></li>

					<li class="dropdown-header">Empleado</li>
					<li><a href="<?=base_url()?>empleado/crear">Nuevo</a></li>
					<li><a href="<?=base_url()?>empleado/listar">Listar</a></li>

				</ul>
				
			</li>

		</ul>
		<ul class="nav navbar-right"> 
			<?php if ( !isset($_COOKIE["usuario"]) ): ?>
			<li><a class="boton-login" href="<?=base_url()?>login/logginGet">login</a></li>
			<?php else: ?>

			<!--
			<li><a href="base_url()login/logginOut">Logout $_COOKIE["usuario"]?> </a></li>
			-->
			<li class="dropdown" style="background: none">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url()?>login/perfilUsuarioGet"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>login/logginOut"><i class="fa fa-sign-out fa-fw"></i> Logout <?=$_COOKIE["usuario"]?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
               </li>

			<?php endif;?>
		</ul>
	</div>
</nav>
