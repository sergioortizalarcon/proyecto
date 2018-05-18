<style>
	#ayuda{		
		position:fixed;
		visibility:hidden;
		text-align:center;
		font-weight: bold;
		line-height:30px;
		}
</style>
<script>
	$(document).ready(function(){
		$("button").hover(function(){
				$("#ayuda").css("visibility", "visible");								
				$("#ayuda").text('hola');
			},
			function(){			
				$("#ayuda").css("visibility", "hidden");
				$("#ayuda").removeClass(this.className);
			});
		$("div").not("#total, #posicion, #ayuda, #clickeado").on("mousemove", function(evento){
				$('#ayuda').css("top", evento.pageY+15);
				$('#ayuda').css("left", evento.pageX+10);
			});
	});
</script>
<div class="content-wrapper">
<section class="content-header">
	 <h1>
        <i class="far fa-folder-open"></i>&nbsp;&nbsp;Listado de Géneros
        <small>Add, Edit, Delete</small>
      </h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12 text-right">
			<div class="form-group">
				<a class="btn btn-primary" href="<?= base_url()?>genero/crear">
					<i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar más...</a>
			</div>
		</div>
	</div>
<div class="table-responsive">
	<table id="efectoTabla" class="display table table-bordered ">
	<thead>
			<tr>
				<th>Id del país</th>
				<th>Nombre del país</th>
				<th>Acciones</th>
			</tr>
	</thead>
	<tbody>
			<?php foreach ($body['generos'] as $genero): ?>
				<tr>
				<td><?= $genero->id ?></td>
				<td><?= $genero->nombre ?></td>
				<td>
					<form class="listado" id="idFormedit" action="<?=base_url()?>genero/editar" method="post">
						<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
						<button class="botones" onclick="function f() {document.getElementById('idFormEdit').submit();}"><span class="glyphicon glyphicon-pencil"></span></button>
					</form>
					<form class="listado" id="idFormRemove" action="<?=base_url()?>genero/borrarPost" method="post">
						<input type="hidden" name="id_genero" value="<?= $genero -> id?>">
						<input type="hidden" name="v" value="listarTodos">
						<button class="botones" onclick="function f() {document.getElementById('idFormRemove').submit();}"><span class="glyphicon glyphicon-remove"></span></button>
					</form>
					
				</td>
			</tr>
			<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<th>Id del país</th>
			<th>Nombre del país</th>
			<th>Acciones</th>
		</tr>
	</tfoot>
	</table>
	</div>
	<div id="ayuda" style="border:1px solid black;height: 5%;width: 4%;"></div>
</section>
</div>