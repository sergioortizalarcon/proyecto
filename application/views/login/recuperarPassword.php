<script>

function validarCorreo() {
	var correo = document.getElementById("idEmail").value.trim();
	if (correo!="") {
	expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/i;
	    if (expresion.test(correo)) {
        	idFormulario.idEmail.style.borderColor="blue";
        	document.getElementById("aEmail").style.display="none";
        	val=false;
        	return true;
	    } else {
			idFormulario.idEmail.style.borderColor="red";
			document.getElementById("aEmail").style.display="initial";
		    return false;
			}
	    } else {
	    document.getElementById("aEmail").style.display="initial";
	    idFormulario.idEmail.style.borderColor="red";
	    return false;
	}
}

	function validarPass() {
	var pwd = document.getElementById("idPwd").value;
		if (pwd!="") {
		expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{5,15}$/;
			if (expresion.test(pwd)) {
			    idFormulario.idPwd.style.borderColor="blue";
			    document.getElementById("aPwd").style.display="none";
			    	return true;
			} else {
			    document.getElementById("aPwd").style.display="initial";
			    idFormulario.idPwd.style.borderColor="red";
			    return false;
			}
		} else {
		    document.getElementById("aPwd").style.display="initial";
		    idFormulario.idPwd.style.borderColor="green";
		    return false;
		}
	}

	function confirmarPass() {
		var pwd = document.getElementById("idPwd").value;
		var pwdDos = document.getElementById("idPwdD").value;
    	if (pwd == pwdDos) {

        	document.getElementById("aPwdD").style.display="none";
        	idFormulario.idPwdD.style.borderColor="blue";
        	return true;
    	} else {
    		document.getElementById("aPwdD").style.display="initial";
        	idFormulario.idPwdD.style.borderColor="red";
        	return false;
    	}
	}

	function validar() {
		validarCorreo();
		validarPass();
	if (validarCorreo() && validarPass() && confirmarPass()) {
		enviarRegistro();
		function enviarRegistro(){
			pwd = document.getElementById("idPwd").value;
			pcripto = sha256(pwd);
			idFormulario.hash_passwrd.value=pcripto;
	        idFormulario.submit();
		}
	} else {
		var error =  document.getElementsByTagName("input");
		for (var i = 1; i < error.length; i++) {
            if (error[i].style.borderColor!="blue") {
                error[i].focus();
                break;
            }
        }
    }
	}
</script>
<div class="container">      
	<form id="idFormulario" name="idFormulario" role="form" action="<?=base_url()?>administrador/cambiarPwd" method="POST" autocomplete="off">
		<legend>Formulario de recuperación de contrase&ntilde;a</legend>
		<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>
		<fieldset>
			<div class="form-group">
				<label for="idEmail">Introduce tu correo electrónico</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idEmail" name="email" 
				placeholder="email@email.com" data-toogle="tooltip" data-placement="left" title="introduce un correo electrónico válido"/>
				<span class="avisos" id="aEmail">
					Debes escribir un correo válido.
				</span>
			</div>
			<div class="avisos" id="mailAviso"></div>
			<div class="form-group">
				<label for="idPwd">Contraseña</label><span class="obligatorio">*</span>
				<input class="form-control" type="password" id="idPwd"
				data-toogle="tooltip" data-placement="left" title="contraseña"/>
				<input class="form-control" type="hidden" id="hash_passwrd" name="hash_passwrd" />
				<input class="form-control" type="hidden" id="token_confirmacion" name="token_confirmacion"
				 value="<?=isset($token)?$token:' '?>" />
				 <input class="form-control" type="hidden" id="user_id" name="user_id"
				 value="<?=isset($user_id)?$user_id:' '?>" />
				<span class="avisos" id="aPwd">
					Entre 5 y 15 caracteres. La contraseña ha de incluir al menos tres de los siguientes elementos: números, mayúsculas, minúsculas o alguno de estos símbolos ($, @, !, %,*, &amp;).
				</span>
			</div>
			<div class="form-group">
				<label for="idPwdD">Confirmar Contraseña</label><span class="obligatorio">*</span>
				<input class="form-control" type="password" id="idPwdD" 
				data-toogle="tooltip" data-placement="left" title="repite la contraseña"/>
				<span class="avisos" id="aPwdD">
					Debe coincidir con la contraseña introducida en el recuadro anterior.
				</span>
			</div>
			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="registrarse" name ="registrarse" value="Registrarse" onclick="validar();"/>
			</div>
		</fieldset>
	</form>
</div>