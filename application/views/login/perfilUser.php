<script>
	var xhr;
	function cargaAjax(id){
		xhr = new XMLHttpRequest();
		xhr.open("POST","Empleado/listarPost",true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("id="+id);
		xhr.onreadystatechange = function(){
			if (xhr.readyState==4 && xhr.status ==200) {
				cargarDatos();
			}
		}
	}

	function cargarDatos(id){
		console.log(id);
	}
</script>

<div class="container">
	<h1>Mi Perfil</h1>
	<div class="iUser">
	<ul class="profile-navi-desk">
		<li>
			<a href="/login/usuarios/<?=$_SESSION['_activo']?>/personal">Datos personales</a>
		</li>
		<li>
			<a onclick="cargarDatos(<?=$_SESSION['_activo']?>);">Cuenta</a></li>
		<li>
			<a href="/comunidad/usuarios/<?="user"?>/profile">lalala</a></li>
	</ul>
	</div>

	<div id="cargaInfo" class="iUser">
		<ul id="menuUser">
		<li href="login/editarCampos">Datos</li>
		<li href="#">a</li>
		<li href="#">b</li>
	</ul>

	<h3>Añadir foto de perfil.</h3>
	<form action="login/fotoPerfil" enctype="multipart/form-data" method="post">
	    <label for="imagen">Imagen:</label>
	    <input id="imagen" name="imagen" size="30" type="file" />
	    <input name="submit" type="submit" value="Guardar" />
	</form> 

	</div>
	
</div>