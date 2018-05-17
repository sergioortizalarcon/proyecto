<script type="text/javascript">
	function banearUsuario() {

		var accion = confirm("¿Estas seguro de que quieres banear a este usuario?");
		if (accion) {
			alert("terminar accion");
			//realizarAccion();
		} else {
			return false;
		}
	}
	
	function realizarAccion() {
		formulario.submit();
	}
</script>
<div class="content-wrapper">
	<section class="content-header">
	<h1><i class="fa fa-users"></i>&nbsp;&nbsp;Permisos usuarios</h1>
	</section>
<section class="content">
<!-- 	<div style="width: 100%; padding-left: -10px; border: 1px solid red;"> -->
<div class="table-responsive">
<table id="efectoTabla" class="display table table-bordered ">
	<thead>
	<tr>
		<th>Id usuario</th>
		<th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>País</th>
		<th>Rol</th>
		<th>Estado</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>

	</tr>
	</thead>
    <tbody>
		<tr>
			<td> <?=$usuario->id?> </td>
			<td> <?=$usuario->nombre?> </td>
			<td> <?=$usuario->apellido_uno?> </td>
			<td> <?=$usuario->apellido_dos?> </td>
			<td> <?=$usuario->alias?> </td>
			<td> <?=$usuario->email?> </td>
			<td> <?=$usuario->paises["nombre"]?> </td>
			<form action="<?=base_url()?>administrador/editarRolPost" method="post">
				<td>
					<select name="idRol" class="form-control">
						<?php foreach ($roles as $rol_existentes): ?>
							<?php if($rol_existentes!=null): ?>
								<option value="<?=$rol_existentes->id?>"
									<?php echo ($usuario->roles["id"]==$rol_existentes->id)?'selected="selected"':"g";?> >
									<?=$rol_existentes['rol']?>
								</option>
							<?php else: ?>
								<td>solo debug--> <?=$usuario->rol_existentes?> </td>
							<?php endif;?>
						<?php endforeach; ?>
					</select>
				</td>
				<td>
					<select name="idEstado"  class="form-control">
						<?php foreach ($roles as $rol_existentes): ?>
							<?php if($rol_existentes!=null): ?>
								<option value="<?=$rol_existentes->id?>"
									<?php echo ($usuario->roles["id"]==$rol_existentes->id)?'selected="selected"':"g";?> >
									<?=$rol_existentes['rol']?>
								</option>
							<?php else: ?>
								<td>solo debug--> <?=$usuario->rol_existentes?> </td>
							<?php endif;?>
						<?php endforeach; ?>
					</select>
				</td>
				<td> <?=$usuario->fecha_nacimiento?></td>
				<td>
					<input type="hidden" name="idUser" value="<?=$usuario->id?>" />
					<button  class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i>  Cambiar rol</button>
				</td>
				</form>
		</tr>
	</tbody>
	<tfoot>
         <tr>
         	<th>Id usuario</th>
        <th>Nombre usuario</th>
		<th>1º Apellido usuario</th>
		<th>2º Apellido usuario</th>
		<th>Alias usuario</th>
		<th>Email usuario</th>
		<th>País</th>
		<th>Rol</th>
		<th>Estado</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>
            </tr>
        </tfoot>
</table>
</div>
<br/><hr/>
</section>
</div>