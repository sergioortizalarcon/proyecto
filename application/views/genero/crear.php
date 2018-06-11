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
	} else if(id == "idApellido1") {
		idFormulario.idApellido1.value=palabraNueva;
	}else { 
		idFormulario.idApellido2.value=palabraNueva;
	}
}

function validarNombre() {
	nombre = idFormulario.idNombre.value.trim();
	if (nombre != "") {
		var expReg = /^[a-zA-Zá-úÁ-ÚñÑ ]{3,20}$/;
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
	} else {
		if (correcto == true) {
			document.getElementById('idNombre').focus();
			correcto=false;
		}
		document.getElementById("aNombre").style.display="initial";
        idFormulario.idNombre.style.borderColor="red";
        nombreCorrecto = false;
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
		window.location.href = "<?=base_url()?>genero/listar";
	}
}
</script>

<div class="container content-wrapper">
<section class="content-header">
      <h1>
        <i class="fas fa-folder-open"></i>&nbsp;&nbsp;Registro de géneros
      </h1>
    </section>
	<section class="content">
<div id="creator">
	<form id="idFormulario" onchange="permitirEnvio();" name="idFormulario" action="<?= base_url()?>genero/crearPost" method="post" >
		<fieldset>
			<small style="float:right;"> (<span class="obligatorio">*</span> Campo obligatorio)</small>
			
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();" onchange="mayuscula(this.value, this.id);"
				placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
				<span class="avisos" id="aNombre">
					Debes escribir un nombre válido(3 a 20 caracteres no numéricos ni símbolos).
				</span>
			</div>

			<input type="hidden" value="Activo" name="activo"/>
			
			
			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name="cancelar" value="Cancelar registro" onclick="cancelarRegistro();" />
				<input type="button" class="btn btn-default" id="idRegistro" name="registrarse" value="Registrar género" onclick="validar();" />
			</div>
			
		</fieldset>
	</form>
	<br/>
</div>
<div id="result"></div>
</section>
</div>

