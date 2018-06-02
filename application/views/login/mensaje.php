<?php if (isset($mensaje['token'])): ?>
<div class="content-wrapper">
	<section class="content-header">
	  <span class="alert alert-info" style="font-size: x-large;">Info!</span>
	</section>
	<section class="content">
		<div class="well">
<?php else:?>
	<div class="container">
<?php endif ?>

<?php if ($mensaje['nivel']=='ok'):?>
	<div class="alert alert-success">
<?php else: ?>
	<div class="alert alert-danger">
<?php endif;?>
	<?= $mensaje['texto'] ?>
	</div>
		
<?php if ( isset($mensaje['link']) ) :?>
	<?php if ($mensaje['link']=="actor/listar") :?>
		<button onclick="location.href = '<?=base_url().$mensaje['link']?>';" id="myButton" class="float-left submit-button" >
			Listar
		</button>
		<button onclick="location.href = '<?=base_url()?>actor/crear';" id="myButton" class="float-left submit-button" >Volver</button>
		<?php else: ?>
		<button onclick="location.href = '<?=base_url()?>actor/listar';" id="myButton" class="float-left submit-button" >
			Listar
		</button>
		<button onclick="location.href = '<?=base_url().$mensaje['link']?>';" id="myButton" class="float-left submit-button" >
			Volver
		</button>
	<?php endif;?>
<?php endif;?>
	</div>
<?php if (isset($mensaje['token'])): ?>
</div>
	</div>
</section>
<?php endif;?>
</div>