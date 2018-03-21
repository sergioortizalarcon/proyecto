<script type="text/javascript">
	var xhr;
	var correcto = true;
	
	window.onload = function(){
		xhr = new XMLHttpRequest();
		console.log(xhr);
	}

	function comprobar() {
		var nombreCorrecto=true;
		var ape1Correcto=true;
		var ape2Correcto=true;
		var fechaCorrecto=true;
		
		var nombre = idFormulario.nombre.value.trim();
		if (nombre != "") {
			nombreMayus = mayuscula(nombre);
			idFormulario.nombre.value = nombreMayus;
			nombreCorrecto = comprobarNombre(nombre);
		}
		
		var apellido1 = idFormulario.apellido1.value.trim();
		if (apellido1 != "") {
			nombreMayus = mayuscula(apellido1);
			idFormulario.apellido1.value = nombreMayus;
			ape1Correcto = comprobarApellido1(apellido1);
		}

		var apellido2 = idFormulario.apellido2.value.trim();
		if (apellido2 != "") {
			nombreMayus = mayuscula(apellido2);
			idFormulario.apellido2.value = nombreMayus;
			ape2Correcto = comprobarApellido2(apellido2);
		}

		var fechaNacimiento = idFormulario.idFecha.value;
		console.log(fechaNacimiento);
		if (fechaNacimiento != "") {
			fechaCorrecto = comprobarFechaNac(fechaNacimiento);
		}

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

	function peticionAJAX() {
	    conexion = new XMLHttpRequest();
	    
	    var datosSerializados = serialize(document.getElementById("idFormulario"));
	    conexion.open('POST', '<?=base_url()?>director/editarPost', true);
	    conexion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    conexion.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		console.log(datosSerializados);
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
	}

</script>


<div class="container ">
	<form id="idFormulario">
		<fieldset>
			<legend>Editar director: <?= $body['directores']->nombre ?> <?= $body['directores']->apellido1 ?> <?= $body['directores']->apellido2 ?></legend>
			
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="nombre" />
			
			<label for="idApellido1">Apellido1</label>
			<input class="form-control" type="text" id="idApellido1" name="apellido1" />
			
			<label for="idApellido2">Apellido2</label>
			<input class="form-control" type="text" id="idApellido2" name="apellido2" />
			
			<label for="idFecha">Fecha de nacimiento</label>
			<input class="form-control" type="date" id="idFecha" name="fechaNacimiento" />
			
			<input type="hidden" name="id_director" value="<?= $body['directores']->id ?>" />
			
			<label for="idPais">Pais de nacimiento</label>
			<select class="form-control" id="idPais" name="pais">
				<?php foreach($body['paises'] as $pais):?>
					<option value="<?= $pais-> id ?>"><?= $pais->nombre?></option>
				<?php endforeach; ?>
			</select>
			
			<br/>
			<input type="button" class="btn btn-default col-md-12" onclick="comprobar();" value="Enviar" />
			
		</fieldset>
	</form>
	<br/>
</div>