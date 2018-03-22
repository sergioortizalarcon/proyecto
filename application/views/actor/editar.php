<script type="text/javascript">
var correcto = false;
var nombreCorrecto = false;
var apellido1Correcto = false;
var apellido2Correcto = false;
var fechaCorrecto = false;

function mayuscula(palabra) {
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
	return palabraNueva;
}

function validarNombre() {
	var nombre = idFormulario.idNombre.value.trim();
	if (nombre != "") {
		nombreMayus = mayuscula(nombre);
		idFormulario.nombre.value = nombreMayus.trim();

		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(nombre)){
			nombreCorrecto = true;
			idFormulario.idNombre.style.borderColor="blue";
			document.getElementById("aNombre").style.display="none";
		} else {
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			if (correcto == true) {
				document.getElementById('idNombre').focus();
			}
			nombreCorrecto = false;
		}
	} else {
		document.getElementById("aNombre").style.display="initial";
        idFormulario.idNombre.style.borderColor="red";
        nombreCorrecto = false;
	}
}

function validarApellido1() {
	var apellido = idFormulario.idApellido1.value.trim();
	if (apellido != "") {
		apellidoMayus = mayuscula(apellido);
		idFormulario.idApellido1.value = apellidoMayus.trim();
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(apellido)){
			apellido1Correcto = true;
			idFormulario.idApellido1.style.borderColor="blue";
			document.getElementById("aApellido1").style.display="none";
		} else {
			idFormulario.idApellido1.style.borderColor="red";
			document.getElementById("aApellido1").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido1').focus();
			}
			apellido1Correcto = false;
		}
	} else {
		document.getElementById("aApellido1").style.display="initial";
        idFormulario.idApellido1.style.borderColor="red";
        apellido1Correcto = false;
	}
}

function validarApellido2() {
	var apellido = idFormulario.idApellido2.value.trim();
	if (apellido != "") {
		apellidoMayus = mayuscula(apellido);
		idFormulario.idApellido2.value = apellidoMayus.trim();
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(apellido)){
			apellido2Correcto = true;
			idFormulario.idApellido2.style.borderColor="blue";
			document.getElementById("aApellido2").style.display="none";
		} else {
			idFormulario.idApellido2.style.borderColor="red";
			document.getElementById("aApellido2").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido2').focus();
			}
			apellido2Correcto = false;
		}
	} else {
		document.getElementById("aApellido2").style.display="none";
        idFormulario.idApellido2.style.borderColor="blue";
        apellido2Correcto = true;
	}
}

function validarFecha() {
	var fecha = idFormulario.idFecha.value;
	
	if (fecha == "") {
		idFormulario.idFecha.style.borderColor="red";
		if (correcto==true) {
			document.getElementById('idFecha').focus();
			document.getElementById("aFecha").style.display="initial";
		}
		fechaCorrecto = false;
	} else {
		var fechaSis = new Date();
		var anio = fechaSis.getFullYear();
		var mes = fechaSis.getMonth()+1;
		var dia = fechaSis.getDate();
		mes = "0"+mes;
		fechaSistema = anio + "-" + mes + "-" + dia

		if (fechaSistema <= fecha) {
			idFormulario.idFecha.style.borderColor="red";
			document.getElementById("aFecha").style.display="initial";
			if (correcto) {
				idFormulario.idFecha.focus();
			}
			fechaCorrecto = false;
		} else {
			fechaCorrecto = true;
	        idFormulario.idFecha.style.borderColor="blue";
			document.getElementById("aFecha").style.display="none";
		}
	}
}

function validar() {
	if (nombreCorrecto && apellido1Correcto && apellido2Correcto && fechaCorrecto) {
		document.getElementById("crearActor").disabled=false;
	}else {
		document.getElementById("crearActor").disabled=true;
	}
}

function enviarActor() {
	idFormulario.submit();
}
</script>


<div class="container ">
<div id="creator">
	<form id="idFormulario" name="idFormulario" action="<?= base_url()?>actor/crearPost" method="post" onchange="validar();">
		<fieldset>
			<legend>Editar actor: <?= $body['actores']->nombre ?> <?= $body['actores']->apellido1 ?> <?= $body['actores']->apellido2 ?></legend>
			
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();"
				placeholder="<?= $body['actores']->nombre ?>" data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
				<span class="avisos" id="aNombre">
					Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido1">Primer apellido</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idApellido1" name="apellido1" onkeyup="validarApellido1();" 
				placeholder="<?= $body['actores']->apellido1 ?>" data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido1">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido2">Segundo apellido</label>
				<input class="form-control" type="text" id="idApellido2" name="apellido2" onkeyup="validarApellido2();" 
				placeholder="<?= $body['actores']->apellido2 ?>" data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido2">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
				<input class="form-control" type="date" id="idFecha" name="fechaNacimiento" onchange="validarFecha();" />
				<span class="avisos" id="aFecha">
					Debes introducir una fecha válida(Anterior al día actual).
				</span>
			</div>
			
			<label for="idPais">Pais de nacimiento</label><span class="obligatorio">*</span>
				<select class="form-control" id="idPais" name="pais">
					<?php foreach($body['paises'] as $pais):?>
						<option value="<?=$pais -> id?>" <?=($pais -> nombre == "España")?"selected='selected'":" "?>"><?= $pais->nombre?></option>
					<?php endforeach; ?>
				</select>
			<br/>
			<input type="button" disabled="disabled" class="btn btn-default col-md-12" id="crearActor" onclick="enviarActor();" value="Enviar" />
			
		</fieldset>
	</form>
	<br/>
</div>
<div id="result"></div>
</div>