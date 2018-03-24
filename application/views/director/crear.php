<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
var correcto = true;
var nombreCorrecto = false;
var apellido1Correcto = false;
var apellido2Correcto = false;
var fechaCorrecto = false;

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
	var nombre = idFormulario.idNombre.value.trim();
	if (nombre != "") {

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

function validarApellido1() {
	var apellido = idFormulario.idApellido1.value.trim();
	if (apellido != "") {
		
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
				correcto=false;
			}
			apellido1Correcto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('idNombre').focus();
			correcto=false;
		}
		document.getElementById("aApellido1").style.display="initial";
        idFormulario.idApellido1.style.borderColor="red";
        apellido1Correcto = false;
	}
}

function validarApellido2() {
	var apellido = idFormulario.idApellido2.value.trim();
	if (apellido != "") {
		
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
				correcto=false;
			}
			apellido2Correcto = false;
		}
	} else {
		document.getElementById("aApellido2").style.display="none";
        apellido2Correcto = true;
	}
}

function validarFecha() {
	var fecha = idFormulario.idFecha.value;
	idFormulario.idFecha.style.borderColor="red";
	
	if (fecha == "") {
		document.getElementById("aFecha").style.display="initial";
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
		idFormulario.submit();
	} else {
		validarNombre();
		validarApellido1();
		validarApellido2();
		validarFecha();
		//alert("Debes rellenar todos los campos obligatorios");
	}
}

function cancelarRegistro(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registo?");

	if (cancelarRegistro) {
		window.location.href = "<?=base_url()?>";
	}
}
</script>


<div class="container ">
<div id="creator">
	<form id="idFormulario" name="idFormulario" action="<?= base_url()?>director/crearPost" method="post">
		<fieldset>
			<legend>Crear nuevo director</legend>
			<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>
			
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();" onchange="mayuscula(this.value, this.id);"
				placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
				<span class="avisos" id="aNombre">
					Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido1">Primer apellido</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idApellido1" name="apellido1" onkeyup="validarApellido1();" onchange="mayuscula(this.value, this.id);"
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido1">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido2">Segundo apellido</label>
				<input class="form-control" type="text" id="idApellido2" name="apellido2" onkeyup="validarApellido2();" onchange="mayuscula(this.value, this.id);"
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
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
			
			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar registro" onclick="cancelarRegistro();"/>
				<input type="button" class="btn btn-default" id="registrarse" name ="registrarse" value="Registrarse" onclick="validar();"
				 />
			</div>
			
		</fieldset>
	</form>
	<br/>
</div>
<div id="result"></div>
</div>