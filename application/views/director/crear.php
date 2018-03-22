<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
var correcto = false;

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
	console.log(nombre);
	if (nombre != "") {
		nombreMayus = mayuscula(nombre);
		idFormulario.nombre.value = nombreMayus.trim();
	
		//var correcto=false;
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(nombreMayus)){
			console.log("nombre Correcto");
			correcto = true;
			idFormulario.idNombre.style.borderColor="blue";
			document.getElementById("aNombre").style.display="none";
		} else {
			console.log("nombre Incorrecto");
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			if (correcto == true) {
				document.getElementById('idNombre').focus();
			}
			correcto = false;
		}
	} else {
		document.getElementById("aNombre").style.display="initial";
        idFormulario.idNombre.style.borderColor="red";
        correcto = false;
	}
	return correcto;
}

function validarApellido1() {
	var apellido = idFormulario.idApellido1.value.trim();
	if (apellido != "") {
		apellidoMayus = mayuscula(apellido);
		idFormulario.apellido1.value = apellidoMayus.trim();
	
		//var correcto=false;
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(apellido)){
			correcto = true;
			idFormulario.idApellido1.style.borderColor="blue";
			document.getElementById("aApellido1").style.display="none";
		} else {
			idFormulario.idApellido1.style.borderColor="red";
			document.getElementById("aApellido1").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido1').focus();
			}
			correcto = false;
		}
	} else {
		document.getElementById("aApellido1").style.display="initial";
        idFormulario.idApellido1.style.borderColor="red";
        correcto = false;
	}
	return correcto;
}

function validarApellido2() {
	var correcto=true;
	var apellido = idFormulario.apellido2.value.trim();
	if (apellido != "") {
		apellidoMayus = mayuscula(apellido);
		idFormulario.apellido2.value = apellidoMayus.trim();
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
		if (expReg.test(apellido)){
			correcto = true;
			idFormulario.idApellido2.style.borderColor="blue";
			document.getElementById("aApellido2").style.display="none";
		} else {
			idFormulario.idApellido2.style.borderColor="red";
			document.getElementById("aApellido2").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido2').focus();
			}
			correcto = false;
		}
	} else {
		document.getElementById("aApellido2").style.display="initial";
        idFormulario.idApellido2.style.borderColor="red";
        correcto = true;
	}
	return correcto;
}

function validarFecha() {
	var fecha = idFormulario.idFecha.value;
	var correcto = false;
	
	if (fecha == "") {
		idFormulario.idFecha.style.borderColor="red";
		if (correcto) {
			document.getElementById('idFecha').focus();
			document.getElementById("aFecha").style.display="initial";
		}
		correcto = false;
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
			correcto = false;
		} else {
			correcto = true;
			document.getElementById("aFecha").style.display="none";
			idFormulario.idFecha.style.borderColor="black";
		}
	}
	return correcto;
}

function accionAJAX() {
    document.getElementById("result").innerHTML = conexion.responseText;
}



function limpiar() {
	idFormulario.nombre.value = "";
	idFormulario.apellido1.value = "";
	idFormulario.apellido2.value = "";
	idFormulario.fechaNacimiento.value="";
	idFormulario.pais.value = "españa";
}

function validar() {
	if (validarNombre() && validarApellido1() && validarApellido2() && validarFecha()) {
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
	<form id="idFormulario" name="idFormulario" action="<?= base_url()?>director/crearPost" method="post" onChange="validar();">
		<fieldset>
			<legend>Crear nuevo actor</legend>
			<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>
			
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onfocusout="validarNombre();"
				placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
				<span class="avisos" id="aNombre">
					Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido1">Primer apellido</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idApellido1" name="apellido1" onfocusout="validarApellido1();" 
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido1">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido2">Segundo apellido</label>
				<input class="form-control" type="text" id="idApellido2" name="apellido2" onfocusout="validarApellido2();" 
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido2">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
				<input class="form-control" type="date" id="idFecha" name="fechaNacimiento" onfocusout="validarFecha();" />
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