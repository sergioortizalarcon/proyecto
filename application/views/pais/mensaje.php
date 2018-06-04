<div class="container content-wrapper">
<section class="content-header">
  <span class="alert alert-info" style="font-size: x-large;">Info!</span>
</section>
<section class="content">
	<div class="well">
		<?php if ($mensaje['nivel']=='ok'):?>
		<div class="alert alert-success" style="font-weight: 700;">
		<?php else: ?>
		<div class="alert alert-danger">
		<?php endif;?>
		<?= $mensaje['texto'] ?>
		</div>
		
		<?php if ( isset($mensaje['link']) ) :?>
			<?php foreach ($mensaje['link'] as $key => $value): ?>
				<button type="button" onclick="location.href = '<?=base_url().$value.'/'.$key?>';" id="myButton" class="btn btn-default" ><?=$key?></button>
			<?php endforeach; ?>
		<?php endif;?>
		</div>
	</div>
</section>
</div>