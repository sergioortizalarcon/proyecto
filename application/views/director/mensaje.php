<div class="container">

<?php if ($mensaje['nivel']=='ok'):?>
<div class="alert alert-success">
<?php else: ?>
<div class="alert alert-danger">
<?php endif;?>
<?= $mensaje['texto'] ?>
</div>
	
<?php if ( isset($mensaje['link']) ) :?>
<?php if ($mensaje['link']=="actor/listar") :?>
<button onclick="location.href = '<?=base_url().$mensaje['link']?>';" id="myButton" class="float-left submit-button" >Listar</button>
<button onclick="location.href = '<?=base_url()?>director/crear';" id="myButton" class="float-left submit-button" >Volver</button>
<?php else: ?>
<button onclick="location.href = '<?=base_url()?>director/listar';" id="myButton" class="float-left submit-button" >Listar</button>
<button onclick="location.href = '<?=base_url().$mensaje['link']?>';" id="myButton" class="float-left submit-button" >Volver</button>
<?php endif;?>
<?php endif;?>
</div>
</div>