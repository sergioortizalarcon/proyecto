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
<script>
  $(document).ready(function(){
    $("#idEstado").change(function(){
        $sel = $("#idEstado").val();
        console.log($sel);
        if ($sel =='0') {
          $("#avisoCambio").modal('show');
        } else{
          $("#avisoCambio").modal('hide');
        }
      });
  });
</script>
<div class="content-wrapper">
	<section class="content-header">
	<h1><i class="fa fa-users"></i>&nbsp;&nbsp;Permisos usuarios</h1>
	</section>
<section class="content">
	<div class="modal fade" id="avisoCambio" tabindex="-1" role="dialog" aria-labelledby="avisoCambioModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="modal-title" id="avisoCambioModalLabel">¡Desactivación de cuenta!</h2>
	        <h6>¿Estas seguro de querer ejecutar esta acción?</h6>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="idForm" action="<?=base_url()?>admin/estadoCuentas" method="post">
	          <div class="form-group">
	            <label for="motivoB" class="col-form-label">Tiempo de Baneo:</label>
	            <input type="text" class="form-control" id="motivoB" name="motivoB">
	          </div>
	          <div class="form-group">
	            <label for="message-text " class="col-form-label">Motivo la suspensión:</label>
	            <textarea class="form-control" id="message-text" name="message-text"></textarea>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" id="open" onclick="infoban();">Confirmar</button>
	      </div>
	    </div>
	  </div>
	</div>
<!-- 	<div style="width: 100%; padding-left: -10px; border: 1px solid red;"> -->
<div class="table-responsive">
<!-- 	<code><pre>?=$usuario?></pre></code>
	<code><pre>?=$usuario['estado']?></pre></code>
	<code><pre>?=$usuario->estados?></pre></code>
	<code><pre>?=$usuario->estados['estado']?></pre></code> -->
	<?=$usuario->estados['id']?>
<table id="efectoTabla">
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
		<th>Estado cuenta</th>
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
			<form action="<?=base_url()?>administrador/aplicarAccion" method="post">
				<td>
					<select name="idRol" id="idRol" class="form-control" 
					 <?=($usuario->estados['id']=='2')?'disabled="disabled"':' '?> >
						<?php foreach ($roles as $rol_existentes): ?>
							<option value="<?=$rol_existentes->id?>" <?=($usuario->roles["id"]==$rol_existentes->id)?'selected="selected"':" "?>>
									<?=$rol_existentes['rol']?>
							</option>
						<?php endforeach; ?>
					</select>
				</td>
				<td  >
					<select name="idEstado" id="idEstado"  class="form-control">
						<option value="1" <?=($usuario['estado']=='1')?'selected="selected"':" ";?> >
								Activa
						</option>
						<option value="2" <?=($usuario->estado=='2')?'selected="selected"':" ";?> >
								Baneado
						</option>
					</select>
				</td>
				<td> <?=$usuario->fecha_nacimiento?></td>
				<td>
					<input type="hidden" name="idUser" value="<?=$usuario->id?>" />
					<button  class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i>  Aplicar cambios</button>
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
		<th>Estado cuenta</th>
		<th>Fecha de nacimiento del usuario</th>
		<th>Acciones</th>
            </tr>
        </tfoot>
</table>
</div>
<br/><hr/>
</section>
</div>