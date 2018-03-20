<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
var conexion;
var correcto = true;

function comprobar() {
	var nombre = idFormulario.nombre.value.trim();
	if (nombre != "") {
		nombreMayus = mayuscula(nombre);
		idFormulario.nombre.value = nombreMayus;
	}
	nombreCorrecto = comprobarNombre(nombre);
	
	var apellido1 = idFormulario.apellido1.value.trim();
	if (apellido1 != "") {
		nombreMayus = mayuscula(apellido1);
		idFormulario.apellido1.value = nombreMayus;
	}
	ape1Correcto = comprobarApellido1(apellido1);

	var apellido2 = idFormulario.apellido2.value.trim();
	if (apellido2 != "") {
		nombreMayus = mayuscula(apellido2);
		idFormulario.apellido2.value = nombreMayus;
		ape2Correcto = comprobarApellido2(apellido2);
	}
	
	var fechaNacimiento = idFormulario.idFecha.value;
	fechaCorrecto = comprobarFechaNac(fechaNacimiento);

	var nacionalidad = idFormulario.idPais.value;
	
	if(nombreCorrecto && ape1Correcto && ape2Correcto && fechaCorrecto) {
		peticionAJAX();
		limpiar();
	}
}

function mayuscula(palabra) {
	var primeraLetra = palabra.substr(0,1);
	palabra = palabra.slice(1);
	palabra = primeraLetra.toUpperCase() + palabra;
	return palabra;
}

function comprobarNombre(nombre) {
	var expReg = /^[a-zA-Z áéíóúÁÉÍÓÚ]{2,30}$/;
	if (expReg.test(nombre)){
		correcto = true;
		document.getElementById('idNombre').style="color:black";
	} else {
		document.getElementById('idNombre').style="color:red";
		if (correcto == true) {
			document.getElementById('idNombre').focus();
		}
		correcto = false;
	}
	return correcto;
}

function comprobarApellido1(apellido1) {
	var expReg = /^[a-zA-Z áéíóúÁÉÍÓÚ]{2,30}$/;
	if (expReg.test(apellido1)){
		correcto = true;
		document.getElementById('idApellido1').style="color:black";
	} else {
		document.getElementById('idApellido1').style="color:red";
		if (correcto == true) {
			document.getElementById('idApellido1').focus();
		}
		correcto = false;
	}
	return correcto;
}

function comprobarApellido2(apellido2) {
	var expReg = /^[a-zA-Z áéíóúÁÉÍÓÚ]{2,30}$/;
	if (expReg.test(apellido2)){
		correcto = true;
		document.getElementById('idApellido2').style="color:black";
	} else {
		document.getElementById('idApellido2').style="color:red";
		if (correcto) {
			document.getElementById('idApellido2').focus();
		}
		correcto = false;
	}
	return correcto;
}

function comprobarFechaNac(fecha) {
	if (fecha == "") {
		document.getElementById('idFecha').style="color:red";
		if (correcto) {
			document.getElementById('idFecha').focus();
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
			document.getElementById('idFecha').style="color:red";
			if (correcto) {
				document.getElementById('idFecha').focus();
			}
			correcto = false;
		} else {
			correcto = true;
			document.getElementById('idFecha').style="color:black";
		}
	}
	return correcto;
}

function accionAJAX() {
    document.getElementById("result").innerHTML = conexion.responseText;
}

function peticionAJAX() {
    conexion = new XMLHttpRequest();
    
    var datosSerializados = serialize(document.getElementById("idFormulario"));
    conexion.open('POST', '<?=base_url()?>director/crearPost', true);
    conexion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    conexion.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    conexion.send(datosSerializados);
    
    conexion.onreadystatechange = function() {
        if (conexion.readyState==4 && conexion.status==200) {
            accionAJAX();
        }
    }
}

function limpiar() {
	idFormulario.nombre.value = "";
	idFormulario.apellido1.value = "";
	idFormulario.apellido2.value = "";
	idFormulario.fechaNacimiento.value="";
	idFormulario.nacionalidad.value = "es";
}
</script>


<div class="container ">
	<form id="idFormulario">
		<fieldset>
			<legend>Crear nuevo director</legend>
			
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="nombre" />
					
			<label for="idApellido1">Apellido1</label>
			<input class="form-control" type="text" id="idApellido1" name="apellido1" />
					
			<label for="idApellido2">Apellido2</label>
			<input class="form-control" type="text" id="idApellido2" name="apellido2" />
					
			<label for="idFecha">Fecha de nacimiento</label>
			<input class="form-control" type="date" id="idFecha" name="fechaNacimiento" />
		
		
			<!-- TODO
				Falta el model de los lenguajes para pasarlos
				
				<laber for="idPais">Nacionalidad</label>
				<select class="form-control" id="idPais" name="nacionalidad">
					<-?php foreach($body['nacionalidades'] as $nacionalidad):?>
						<option value="<-?php $nacionalidad->codigo ?>"><-?php $nacionalidad->nombre ?></option>
					<-?php endforeach; ?>
				</select>
			 -->
			
			<!-- TEMPORAL -->
			<label for="idPais">Nacionalidad</label>
			<select class="form-control" id="idPais" name="nacionalidad">
				<option value="es">Española</option>
				<option value="fr">Francesa</option>
				<option value="pt">Portuguesa</option>
				<option value="de">Alemana</option>
			</select>
			<br/>
			<input type="button" class="btn btn-default" onclick="comprobar()" value="Enviar"/>
			
		</fieldset>
	</form>
	<br/>
	<div id="result"></div>
</div>