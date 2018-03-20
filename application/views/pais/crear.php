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

function peticionAJAX(nombre) {
	//xhr = new XMLHttpRequest();
	xhr.open("POST", "<?=base_url()?>pais/crearPost", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	console.log(nombre);
	xhr.send("nombre="+nombre);
	console.log(xhr);
	
	xhr.onreadystatechange = function(){
		console.log(xhr.readyState+"  "+xhr.status);
		if (xhr.readyState==4 && xhr.status==200) {	
			console.log(xhr.readyState+"   "+xhr.status);
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}
}

 function validar(){
    var nombre = document.getElementById("idNombre").value;
    var code="";

    function validarNombre() {
        if(nombre!="") {
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

    
	validarNombre();
	
	if ( validarNombre()) {
		peticionAJAX(nombre);
	} else {
	}
}

</script>


<div class="container ">
<form id="idFormulario" method="post">
<fieldset>
<legend>Añadir nuevo país</legend>

<div class="form-group">
<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idNombre" name="nombre" />
<span class="avisos" id="aNombre">
	Debes escribir un nombre válido(caracteres no númericos o símbolos).
</span>
</div>

<div class="form-group">
<input type="button" class="btn btn-default" onclick="validar();" value="Añadir"/>
</div>
</fieldset>
	</form>

<div id="result"></div>

<script>
	document.getElementById("idNombre").value="España";
</script>
</div>