<footer>
<div class="container">

<?php 
	echo "sesion -> ";
	echo isset($_SESSION["recordar"])?$_SESSION["recordar"]:'hola';
	echo "   |||   ";
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo $enlace_actual;
?>
	
</div>
</footer>