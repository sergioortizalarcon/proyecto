<<<<<<< HEAD
<!-- <header id="cabecera" class="container">
</header>

<div style="background-color:#F44336;color:#fff;padding: 0px">
  <h1>Scrollspy & Affix Example</h1>
  <p>The navbar is attached to the top of the page after you have scrolled a specified amount of pixels, and the links in the navbar are automatically updated based on scroll position.</p>
</div>
 -->

<header id="cabecera" class="container">
	<!--
	<a href="< base_url()?>"><img class="center-block" alt="logo" height="200px" width="100%" src="< base_url()?>assets/img/crud.png"></a>
-->
   <?= isset($header ['usuario'] ['nombre'])?$header ['usuario'] ['nombre']:'anonimo' ?>
   <div align="right">
			<form id="guest_form" action="#" method="post">
				<div class="info">Logueate si ya estas registrado :)</div>
				<input type="text" name="user" size="10">
				<input type="password" name="passwrd" size="10" style="display:block;margin-bottom: 5px; margin-top: 5px;">
				<input type="submit" value="Ingresar"><br>
				<div class="info">
					<a href="#">Clave olvidada?</a> | <a href="http://redlinesp.org/newrlsp/index.php?action=register">Registrate</a>
				</div>
			</form>
	</div>

</header>
<div class="container" style="border:1px solid black;padding: 0px">
	<form class="navbar-form" style="float:right;margin: auto; padding: initial;"">
		     		<div class="input-group">
		       			<input type="text" class="form-control" placeholder="Buscar">
		       			<div class="input-group-btn">
		       				<button class="btn btn-default" type="subtmit">
		       					<span class="glyphicon glyphicon-search"></span>
		       				</button>
		       			</div>
		    		</div>
	    		</form>
=======
<header id="cabecera" class="container">
	<!--
	<a href="< base_url()?>"><img class="center-block" alt="logo" height="200px" width="100%" src="< base_url()?>assets/img/crud.png"></a>
-->
   <?= isset($header ['usuario'] ['nombre'])?$header ['usuario'] ['nombre']:'anonimo' ?>
   <div align="right">
			<form id="guest_form" action="#" method="post">
				<div class="info">Logueate si ya estas registrado :)</div>
				<input type="text" name="user" size="10">
				<input type="password" name="passwrd" size="10" style="display:block;margin-bottom: 5px; margin-top: 5px;">
				<input type="submit" value="Ingresar"><br>
				<div class="info">
					<a href="#">Clave olvidada?</a> | <a href="http://redlinesp.org/newrlsp/index.php?action=register">Registrate</a>
				</div>
			</form>
	</div>

</header>
<div class="container" style="border:1px solid black;padding: 0px">
	<form class="navbar-form" style="float:right;margin: auto; padding: initial;"">
		     		<div class="input-group">
		       			<input type="text" class="form-control" placeholder="Buscar">
		       			<div class="input-group-btn">
		       				<button class="btn btn-default" type="subtmit">
		       					<span class="glyphicon glyphicon-search"></span>
		       				</button>
		       			</div>
		    		</div>
	    		</form>
>>>>>>> 84fd4d63e75988b27de32147f8f50cddad2785c1
</div>