<header class="container">
	<a href="<?= base_url()?>"><img class="center-block" alt="logo" height="50%" width="50%" src="<?= base_url()?>assets/img/crud.jpg"></a>
	<br/>
   <?= isset($header ['usuario'] ['nombre'])?$header ['usuario'] ['nombre']:'anonimo' ?>
</header>
