<div class="container">
<div class="row">
	<div class="col-md-9">
		<?php if ($mensaje['nivel']=='ok'):?>
<div class="alert alert-success">
<?php else: ?>
<div class="alert alert-danger">
<?php endif;?>
<?= $mensaje['texto'] ?>
	</div>
</div>
	<div class="col-md-1"></div>
</div>