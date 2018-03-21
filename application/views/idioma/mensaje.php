<div class="container">

<?php if ($mensaje['nivel']=='ok'):?>
<div class="alert alert-success">
<?php else: ?>
<div class="alert alert-danger">
<?php endif;?>
<?= $mensaje['texto'] ?>
</div>
	
<?php if ( isset($mensaje['link']) ) :?>
<button onclick="location.href = '<?=base_url().$mensaje['link']?>';" id="myButton" class="float-left submit-button" >Listar</button>

<?php endif;?>
</div>
</div>