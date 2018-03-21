<div class="container">

<script type="text/javascript">
function validarCorreo() {
	var correo = document.getElementById("idEmail").value;
		expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/i;
		    if (expresion.test(correo)) {
			//Realiza la accion del sgte if pero muestra la consola de su correspondiente else.
		    	if (comprobarCorreo(correo)) {
		        	idFormulario.idEmail.style.borderColor="blue";
		        	return true;
		        } else {
					idFormulario.idEmail.style.borderColor="red";
				    return false;
				}
		    } else {
		        idFormulario.idEmail.style.borderColor="red";
		        return false;
		    }
	}

</script>

<form id="idFormulario" name="idFormulario" action="<?= base_url()?>usuario/recuperarPost"
 method="post" onchange="validar();">
<fieldset>
<legend>Restablecer contraseña.</legend>
	<div class="form-group">
<label for="idEmail">Usuario o correo electrónico</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idEmail" name="correo"
placeholder="email@email.com" data-toogle="tooltip" data-placement="left" title="introduce un correo electrónico válido">
<br/>
<span>
	Enviaremos a tu correo electrónico las instrucciones para cambiar la contraseña.
</span>
</div>
<div class="nav navbar-form navbar-right">
<input type="button" class="btn btn-default" id="idRecuperar" name ="idRecuperar" value="Recuperar mi cuenta"" />
</div>
</fieldset>
</form>
</div>