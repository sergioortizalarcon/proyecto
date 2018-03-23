<footer class="container">

<?php
	$espacio = "  ---   ";
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'];
	$refer = $_SERVER['HTTP_REFERER'];
	$resto = $_SERVER['REQUEST_URI'];
	echo $enlace_actual.$espacio.$refer.$espacio.$resto;
?>
	<hr/>
revisar footer <!-- sin collapse pierde el fondo y la lista solo va en pc -->
			<div id="footer" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Contactanos</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a class="icono-face" href="https://www.facebook.com/"></a></li>
					<li><a class="icono-tw" href="https://twitter.com/"></a></li>
				</ul>
			</div>

</footer>