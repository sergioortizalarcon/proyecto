<script type="text/javascript">
var correcto = true;
var nombreCorrecto = false;
var nombre="";

function mayuscula(palabra, id) {
	var palabrasSeparadas = palabra.split(" ");
	var palabraNueva="";
	if (palabrasSeparadas.length>1) {
		for (i=0;i<palabrasSeparadas.length; i++) {
			var primeraLetra = palabrasSeparadas[i].substr(0,1);
			palabra = palabrasSeparadas[i].slice(1);
			palabraNueva += primeraLetra.toUpperCase() + palabra + " ";
		}
	} else {
		var primeraLetra = palabrasSeparadas[0].substr(0,1);
		palabra = palabrasSeparadas[0].slice(1);
		palabraNueva = primeraLetra.toUpperCase() + palabra + " ";
	}
	if (id == "idNombre") {
		idFormulario.idNombre.value=palabraNueva;
	}else { 
		idFormulario.idApellido2.value=palabraNueva;
	}
}

function validarNombre() {
	nombre = idFormulario.idNombre.value.trim();
	if (nombre == "") {
		idFormulario.nombre.style.borderColor="red";
		document.getElementById("aNombre").style.display="initial";
		if (correcto == true) {
			document.getElementById('aNombre').focus();
			correcto=false;
		}
	}

	if (nombre != "") {
		var expReg = /^[a-zA-Zá-úÁ-ÚñÑ ]{2,20}$/;
		if (expReg.test(nombre)){
			nombreCorrecto = true;
			correcto=true;
			idFormulario.idNombre.style.borderColor="blue";
			document.getElementById("aNombre").style.display="none";
		} else {
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			if (correcto == true) {
				document.getElementById('idNombre').focus();
				correcto=false;
			}
			nombreCorrecto = false;
		}
	}
}


function permitirEnvio() {
	if (nombreCorrecto) {
		idFormulario.idRegistro.disabled=false;
	}
}

function validar() {
	if (nombreCorrecto) {
		nombre = idFormulario.idNombre.value.trim();
		idFormulario.idNombre.value = nombre;
		idFormulario.submit();
	} else {
		validarNombre();
	}
}

function cancelarRegistro(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registro?");

	if (cancelarRegistro) {
		window.location.href = "<?=base_url()?>";
	}
}
</script>

<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-language"></i>&nbsp;&nbsp;Editar país
      </h1>
    </section>
	<section class="content">
		<div id="creator">
			<form id="idFormulario" onchange="permitirEnvio();" name="idFormulario" action="<?= base_url()?>idioma/editarPost" method="post">
				<fieldset>
					<legend><?= $body['idiomas']->nombre ?></legend>
					
					<div class="form-group">
						<label for="idNombre">Nombre</label>
						<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();" onchange="mayuscula(this.value, this.id);"
						value="<?= $body['idiomas']->nombre ?>" data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
						<span class="avisos" id="aNombre">
							Debes escribir un nombre válido(3 a 20 caracteres no numéricos ni símbolos).
						</span>
					</div>
					
					
					
					<input type="hidden" name="id_idioma" value="<?= $body['idiomas']->id ?>" />
					
					<div class="nav navbar-form navbar-right">
						<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar cambio" onclick="cancelarCambio();"/>
						<input type="button" class="btn btn-default" id="registrarse" name ="registrarse" value="Editar" onclick="validar();"/>
					</div>
					
				</fieldset>
			</form>
			<br/>
		</div>
		<div id="result"></div>
	</section>
</div>
