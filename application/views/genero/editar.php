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

	function peticionAJAX(nombre, id_genero) {
	//xhr = new XMLHttpRequest();
	xhr.open("POST", "<?=base_url()?>genero/editarPost", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	console.log(nombre);
	xhr.send("nombre="+nombre+"&id_genero="+id_genero);
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
	var n = document.getElementById("idNombre").value;
	var nombre = n.trim();
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
        <i class="far fa-folder-open"></i>&nbsp;&nbsp;Editar género
      </h1>
    </section>
	<section class="content">
	<form id="idFormulario" method="post" action="<?=base_url()?>genero/editarPost">
		<fieldset>
			<legend>Editar genero</legend>

			<div class="form-group">
				<label for="idNombreAnterior">Nombre anterior</label> <input
				class="form-control" type="text" id="idNombreAnterior"
				name="nombreAnterior" disabled="disabled"
				<?= ($body["generos"]->nombre)?"value=".$body["generos"]->nombre:"" ?>>

			</div>
			<div class="form-group">
				<label for="idNombre">Nuevo nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validar();">
				<input class="form-control" type="hidden" id="idID" name="id_genero"
				<?= "value=".$body["generos"]->id?>>
				<span class="avisos" id="aNombre"> Debes escribir un nombre válido(caracteres no númericos o símbolos). </span>

		</div>

		<div class="form-group">
			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar cambio" onclick="cancelarRegistro();"/>
			<input type="submit"  id="editar" name="editar" class="btn btn-default" value="Editar" disabled="disabled" />
			</div>
		</div>
	</fieldset>
	</form>
	<div id="result"></div>
</section>
</div>