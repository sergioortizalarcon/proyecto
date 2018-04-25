<?php

class Pelicula extends CI_Controller {

	public function crearGet() {
	    $this -> load -> model("pais_model");
	    $this -> load -> model("genero_model");
	    $datos["paises"] = $this -> pais_model -> getTodos();
	    $datos["generos"] = $this -> genero_model -> getTodos();
		enmarcar($this, "pelicula/crear",$datos);
	}
}

?>