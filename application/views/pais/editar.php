<script type="text/javascript">
	var xhr;
	window.onload = function(){
		xhr = new XMLHttpRequest();
	}

	function accionAJAX() {
		if (xhr.readyState==4 && xhr.status==200) {	
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}

	function peticionAJAX(nombre, id_pais) {
	xhr.open("POST", "<?=base_url()?>pais/editarPost", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("nombre="+nombre+"&id_pais="+id_pais);

	
	xhr.onreadystatechange = function(){
		if (xhr.readyState==4 && xhr.status==200) {	
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}
}

function validarNombre() {
	var n = document.getElementById("idNombre").value;
	var nombre = n.trim();
	var nombreAnterior = document.getElementById("idNombreAnterior").value;

	var distintos = true;

	if (nombre.toLowerCase()==nombreAnterior.toLowerCase()) {
		distintos=false;
	}
	
	if(nombre!="" && distintos ) {
		expresion = /^([a-z]|[A-Z]|[á-ú]|[Á-Ú]|[à-ù]|[À-Ù]|[ñÑ]|\s){1,20}$/;
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
        <i class="fas fa-globe"></i>&nbsp;&nbsp;Editar país
      </h1>
    </section>
	<section class="content">
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
				id="aNombre"> Debes escribir un nombre válido(caracteres
				no númericos o símbolos) mayor de dos caracteres.</span>
			</div>

			<div class="form-group">
				<div class="nav navbar-form navbar-right">
					<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar cambio" onclick="cancelarRegistro();"/>
					<input type="submit"  id="editar" name="editar" class="btn btn-default"
					value="Editar" disabled="disabled" />
				</div>
			</div>
		</fieldset>
</form>
<div id="result"></div>
</section>
</div>