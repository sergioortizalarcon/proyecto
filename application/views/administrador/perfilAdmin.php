<style>
	#cargando {
		display: none;
	}
</style>
<script>
  $(document).ready(function(){
      var request = $.ajax({
        type: "POST",
        url: '<?=base_url()?>administrador/datos_user',
        beforeSend:$('#cargando').css('display:initial'),
        data: {idUser:'<?=$_SESSION["idUser"]?>'},
        dataType: 'text',
        success: function( data ) {
         var content = JSON.parse(data);
         $('#tabs-1 p.alias').text(content.info['alias']);//'info'-> nombre del array enviado desde PHP
         $('#tabs-1 p.nombre').text(content.info['nombre']),
         $('#tabs-1 p.ap1').text(content.info['apellido_uno']);
         $('#tabs-1 p.ap2').text(content.info['apellido_dos']);
         $('#tabs-1 p.email').text(content.info['email']);
         $('#tabs-1 p.fecha').text(content.info['fecha_nacimiento']);
         $('#tabs-1 p.pais').text(content.info['pais']);
        },
        error:function(jqXHR,estado,error){
          alert(error)
          console.log(estado)
        },
        complete:function (jqXHR,estado) {
          console.log(estado)
        }
    });
      });
  </script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Mi Perfil</h1>
	</section>
<section class="content">
<div id="tabsV">
  <ul>
    <li><a href="#tabs-1">Resumen</a></li>
    <li><a href="#tabs-2">Cuenta</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
    <h2 class="datos_user">Datos personales</h2>
      <h4 class="datos_user">Alias</h4>
      <p class="alias"></p>
      <h4 class="datos_user">Nombre </h4>
      <p class="nombre"></p>
      <h4 class="datos_user">Primer Apellido</h4>
      <p class="ap1"></p>
      <h4 class="datos_user">Segundo Apellido</h4>
      <p class="ap2"></p>
      <h4 class="datos_user">Correo electrnónico</h4>
      <p class="email"></p>
      <h4 class="datos_user">Fecha de nacimiento</h4>
      <p class="fecha"></p>
      <h4 class="datos_user">País</h4>
      <p class="pais"></p>
	<div id="cargando"><img src="<?=base_url()?>assets/img/ajax-loader.gif" alt="cargando..."/></div>
  </div>
  <div id="tabs-2">
    <h2>Content heading 2</h2>
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    <div class="column">
    <h3>Añadir foto de perfil.</h3>
    <form action="login/fotoPerfil" enctype="multipart/form-data" method="post">
      <label for="imagen">Imagen:</label>
      <input id="imagen" name="imagen" size="30" type="file" />
      <input name="submit" type="submit" value="Guardar" />
    </form>
  </div>
  </div>
  
  <div id="tabs-3">
    <h2>Content heading 3</h2>
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
  </div>
</div>
</section>
</div>

