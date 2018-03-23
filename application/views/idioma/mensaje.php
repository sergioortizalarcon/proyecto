<div class="container">

<?php if ($mensaje['nivel']=='ok'):?>
<div class="alert alert-success">
<?php else: ?>
<div class="alert alert-danger">
<?php endif;?>
<?= $mensaje['texto'] ?>
</div>


<?php if ( isset($mensaje['link']) ) :?>
<!-- si existe el array link entra a un foreach q crea un boton para ir a listar o crear, la clave es la accion y el valor el bean -->
	<?php foreach ($mensaje['link'] as $key => $value): ?>
		<button type="button" onclick="location.href = '<?=base_url().$value.'/'.$key?>';" id="myButton" class="btn btn-default" ><?=$key?></button>
	<?php endforeach; ?>
<?php endif;?>
</div>
</div>