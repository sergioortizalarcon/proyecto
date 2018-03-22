<script type="text/javascript">
	var xhr;
	window.onload = function(){
		xhr = new XMLHttpRequest();
		console.log(xhr);
	}
	function accionAJAX() {
		if (xhr.readyState==4 && xhr.status==200) {	
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}

	function peticionAJAX(nombre, id_pais) {
	//xhr = new XMLHttpRequest();
	xhr.open("POST", "<?=base_url()?>pais/editarPost", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	console.log(nombre);
	xhr.send("nombre="+nombre+"&id_pais="+id_pais);
	console.log(xhr);

	
	xhr.onreadystatechange = function(){
		console.log(xhr.readyState+"  "+xhr.status);
		if (xhr.readyState==4 && xhr.status==200) {	
			console.log(xhr.readyState+"   "+xhr.status);
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}
}

function validarNombre() {
	var nombre = document.getElementById("idNombre").value;
	var nombreAnterior = document.getElementById("idNombreAnterior").value;

	var distintos = true;

	if (nombre.toLowerCase()==nombreAnterior.toLowerCase()) {
		distintos=false;
	}
	
	if(nombre!="" && distintos ) {
		expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
		if (expresion.test(nombre)) {
			var m = nombre.charAt(0);
			nombre= m.toUpperCase()+nombre.substring(1,nombre.length);
			idFormulario.idNombre.style.borderColor="blue";
			document.getElementById("aNombre").style.display="none";
			return true;
		} else {
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			return false;
		}
	} else {
		document.getElementById("aNombre").style.display="initial";
		idFormulario.idNombre.style.borderColor="red";
		return false;
	}
	
	
}
function validar(){
	if (validarNombre()) {
		document.getElementById('editar').disabled=false;
	}else{
		document.getElementById('editar').disabled=true;
	}
}
function enviarDatos(){
	idFormulario.submit();
}

</script>


<div class="container ">
	<form id="idFormulario" method="post">
		<fieldset>
			<legend>Editar país</legend>

			<div class="form-group">
				<label for="idNombreAnterior">Nombre anterior</label> <input
				class="form-control" type="text" id="idNombreAnterior"
				name="nombreAnterior" disabled="disabled"
				<?= ($body["paises"]->nombre)?"value=".$body["paises"]->nombre:"" ?>>

			</div>
			<div class="form-group">
				<label for="idNombre">Nuevo nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validar();">
				<input class="form-control" type="hidden" id="idID" name="id_pais"
				<?= "value=".$body["paises"]->id?>> <span class="avisos"
				id="aNombre"> Debes escribir un nombre válido(de 3 a 20 caracteres
			no númericos o símbolos). </span>

		</div>

		<div class="form-group">
			<input type="button"  id="editar" class="btn btn-default"
			value="Editar" disabled="disabled" onclick="enviarDatos();" />
		</div>
	</fieldset>
</form>

<div id="result"></div>

</div>