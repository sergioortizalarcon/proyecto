<div class="container">
<h3>Introduce el nuevo nombre</h3>
<form class="form" action="<?= base_url() ?>pais/editarPost" method="post">
<label>Nombre</label>
<input type="text" name="nombre" value="<?=$body['paises']->nombre ?>">
		<input type="hidden" name="id_pais" value="<?=$body['paises']->id ?> ">
								<input type="submit">
								</form>
								</div>
