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
		<ul class="nav navbar-nav" style="padding:7px;">
		
			<li>
				<ul class="btn">
					<li><a href="<?=base_url()?>pelicula/listar" style="color:#9d9d9d;">Películas</a></li>
				</ul>
			</li>
			
			<li>
				<ul class="btn">
					<li><a href="<?=base_url()?>reparto/listar" style="color:#9d9d9d;">Reparto</a></li>
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
                        <li><a href="<?=base_url()?>usuario/perfilUsuario"><i class="fas fa-user"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <?php if(isset($_SESSION['rol']) && ($_SESSION['rol'] == 'administrador')): ?>
	                        <li>
			              		<a href="<?=base_url()?>administrador/vista_admin" >
			              			<i class="fas fa-door-open"></i>
			                		<span>Panel admin</span>
			              		</a>
				            </li>
				        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>login/loginOut">
                        	<i class="fas fa-sign-out-alt"></i> Logout <?=$_COOKIE["usuario"]?></a>
                        </li>
                    </ul>
               </li>
			<?php endif;?>

			
		</ul>	
	</div>
</nav>

