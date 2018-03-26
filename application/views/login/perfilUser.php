<div class="container">
<h1>Mi Perfil</h1>

<div class="column">

	<ul class="profile-navi-desk">

		<li>

			<a href="/comunidad/usuarios/#/personal" data-drupal-link-system-path="user/32742/personal" class="is-active">
				Datos personales
			</a>
		</li>

		<li>
			<a href="/comunidad/usuarios/#/edit" data-drupal-link-system-path="user/32742/edit">
		Cuenta
			</a>

		</li>

		<li>
			<a href="/comunidad/usuarios/#/profile" data-drupal-link-system-path="user/32742/profile">
		Mis perfiles
			</a>

		</li>

		<li>
			<a href="/comunidad/usuarios/#/reviews" data-drupal-link-system-path="user/32742/reviews">
		Mis análisis
			</a>

		</li>

	
	</ul>

	<div class="js-form-item form-item js-form-type-select form-item- js-form-item- form-no-label">

	    <select class="profile-navi-mov form-select">
	        <option value="/comunidad/usuarios/#/personal" selected="selected">
	        Datos personales
	    	</option>
	        <option value="/comunidad/usuarios/#/edit">
	        	Cuenta
	    	</option>
	        <option value="/comunidad/usuarios/#/profile">
				Mis perfiles
	    	</option>
	        <option value="/comunidad/usuarios/#/reviews">
	        	Mis análisis
	    	</option>
	    </select>
    </div>
</div>

	<ul id="menuUser">
		<li href="login/editarCampos">
		Datos
		</li>

		<li href="#">
		a
		</li>

		<li href="#">
		b
		</li>
	</ul>


	<h3>Añadir foto de perfil.</h3>

	<form action="login/fotoPerfil" enctype="multipart/form-data" method="post">

    <label for="imagen">
    Imagen:
		</label>

    <input id="imagen" name="imagen" size="30" type="file" />


    <input name="submit" type="submit" value="Guardar" />


	</form>


</div>

