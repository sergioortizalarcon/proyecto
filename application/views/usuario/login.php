<div class="container">
		<div class="col-md-5" id="login">
			<h2>Iniciar sesión:</h2>
				<form class="form-horizontal" action="#">
				    <div class="form-group">
				    	<label for="email">Nombre:</label><br>
				   		<input type="email" class="form-control" id="email" placeholder="nombre" name="email" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
				    </div>
					<div class="form-group">
						<label for="pwd">contraseña:</label><br>
					    <input type="password" class="form-control" id="pwd" placeholder="contraseña" name="pwd" data-toogle="tooltip" data-placement="left" title="contraseña">
					</div>
					<a href="<?=base_url()?>usuario/recuperarPwd" id="edit-forgotten">¿Has olvidado tu contraseña?</a>
					<div class="checkbox">
						<label><input type="checkbox" name="remember"> Recordar</label>
					</div>
					    <br/>
					<div class="nav navbar-form navbar-right">
					   	<button type="submit" class="btn btn-default">Iniciar sesión</button>
					</div>
		  		</form>
		</div>

	<div class="col-md-5" id="crear">
		<div class="form-group">
			<h2>Unete a WatchFilms!</h2>
			<p>WatchFilms es un espacio creado para todo amante del cine.</p>
			<p>Como usuario de WatchFilms podrás consultar toda la información añadida a la página</p>
			<p>¡Añadir información de películas o tus impresiones acerca de estas!</p><br/><br/>
			<form class="form" action="<?=base_url()?>usuario/registrar" style="float:right;">
				<p>¿Aún no tienes cuenta?</p>
				<div class="nav navbar-form navbar-right">
					<button type="submit" class="btn btn-default">Registrate ya!</button>
				</div>
		  	</form>
		  </div>
	</div>
</div>
