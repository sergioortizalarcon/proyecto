<script type="text/javascript">

function validarAlias(alias) {
		if(alias!="") {
			expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{0,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ]{1,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{1,6}$/;
			if (expresion.test(alias)) {
				return true;
			} else {
			    return false;
			}
		} else 	{
			return false;
		}
}

function validarCorreo(correo) {
		if (correo!="") {
		expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/i;
		    if (expresion.test(correo)) {
		    	return true;
		    } else {
		        return false;
		    }
		} else {
		    return false;
		}
	}

function validarPass() {
	var pwd = document.getElementById("idPwd").value;
		if (pwd!="") {
		expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
			if (expresion.test(pwd)) {
			    return true;
			} else {
			    return false;
			}
		} else {
		    return false;
		}
}

	function logearse(){
		alias = document.getElementById("nUsuario").value;
		pwd = document.getElementById("pwd").value;
		c1 = validarAlias(alias);
		c2 = validarCorreo(alias);
		if (!c2) {
			if (!c1) {
				document.getElementById("loginFailed").style.display="initial";
			} else {
				enviar();
			}
		} else {
			enviar();
		}
	}

		function enviar(){
			pwd = document.getElementById("pwd").value;
			pcripto = sha256(pwd);
			idFormulario.hash_passwrd.value=pcripto;
			idFormulario.submit();
		}
	</script>
	
<div class="container">
		<div class="col-md-5" id="login">
			<h2>Iniciar sesión:</h2>
			<span class="avisos" id="loginFailed">
				Usuario o contraseña incorrecto 
			</span>

<!-- 			<div class="input-group input-group-sm mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
				  </div>
				  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div> 
-->
				<form id="idFormulario" name="idFormulario" class="form-horizontal" action="<?=base_url()?>login/loginPost" method="post">
				    <div class="form-group">
				    <label for="nUsuario">Nombre:</label><br>
				   		<input type="text" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
				    </div>
					<div class="form-group">
						<label for="pwd">contraseña:</label><br>
					    <input type="password" class="form-control" id="pwd" placeholder="contraseña" data-toogle="tooltip" data-placement="left" title="contraseña"/>
					    <input type="hidden" class="form-control" name="hash_passwrd"/>
					</div>
					<a href="<?=base_url()?>usuario/recuperarPwd" id="edit-forgotten">¿Has olvidado tu contraseña?</a>
					<div class="form-check">
						<label class="form-check-label" for="idR">Recordar:</label>
						<input class="form-check-input" type="checkbox" id="idR" name="recordar" value="recordar" <?=$recordar?> />
					</div>
					    <br/>
					<div class="nav navbar-form navbar-right">
					   	<input type="button" class="btn btn-default" value="Iniciar sesión" onclick="logearse()"/>
					</div>
		  		</form>
		</div>
<script>
	document.getElementById("pwd").value="23aA$@$!%*?&";
	</script>
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
