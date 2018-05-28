<style>
	.content-header > h1 {
    margin: 0;
    font-size: 24px;
    font-size: xx-large;
    text-decoration: underline;
    font-weight: bold;
    color: slateblue;
   }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<br/>
		<h1>¡AVISO!</h1>
		<br/>
	</section>
	<section class="content">
		<?php if ($mensaje['nivel']=='ok'):?>
		<div class="alert alert-success">
		<?php else: ?>
		<div class="alert alert-danger">
		<?php endif;?>
		<?= $mensaje['texto'] ?>
		</div>

		<br/>
		<?php if ( isset($mensaje['link']) ) :?>
		<!-- si existe el array link entra a un foreach q crea un boton para ir a listar o crear, la clave es la accion y el valor el control -->
			<?php foreach ($mensaje['link'] as $key => $value): ?>
				<button type="button" onclick="location.href = '<?=base_url().$value.'/'.$key?>';" id="myButton" class="btn btn-default" ><?=$key?></button>
			<?php endforeach; ?>
		<?php endif;?>
		</div>
	</section>
</div>