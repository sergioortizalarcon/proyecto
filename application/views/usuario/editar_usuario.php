<!-- <form id="idFormulario" name="idFormulario" action="<?= base_url()?>usuario/editar_usuarioPost" method="post">
<fieldset>
<legend>Datos de usuario<legend>
<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>

<div class="form-group">
<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idNombre" name="nombre" placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />

</div>

<div class="form-group">
<label for="idApe1">Primer apellido</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idApe1" name="apellido1" 
placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
</div>

<div class="form-group">	
<label for="idApe2">Segundo apellido</label>
<input class="form-control" type="text" id="idApe2" name="apellido2" placeholder="apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido(opcional)" />
</div>

<div class="form-group">
<label for="idEmail">Email</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idEmail" name="correo" placeholder="email@email.com" data-toogle="tooltip" data-placement="left" title="introduce un correo electrónico válido">
</div>

<div class="form-group">
<label for="idPais">Selecciona país</label><span class="obligatorio">*</span>
<select class="form-control" name="pais" id="idPais"
data-toogle="tooltip" data-placement="left" title="Selecciona tu país">
<?php foreach ($paises as $pais): ?>
	<option value="<?=$pais->id?>" <?=($pais->nombre == "España") ? "selected='selected'" : " "?> >
		<?=$pais->nombre?></option>
<?php endforeach;?>
</select>
</div>


<div class="form-group">
<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
<input class="form-control" type="date" id="idFecha" name="fecha" />
<div id="result"></div>
</div>

<div class="nav navbar-form navbar-right">

<input type="button" class="btn btn-default" id="editar" name ="editar" value="Editar campos" onclick="enviar();"
 />
</div>
</fieldset>
</form>
</div> -->