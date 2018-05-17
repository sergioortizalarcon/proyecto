<?php
class Pelicula extends CI_Controller {

	//Vista de admin
	public function menuFilms() {
		enmarcar($this,'pelicula/listar');
	}

	public function crear() {
	    $this -> load -> model("pais_model");
	    $this -> load -> model("genero_model");
	    $datos["paises"] = $this -> pais_model -> getTodos();
	    $datos["generos"] = $this -> genero_model -> getTodos();
		enmarcar($this, "pelicula/crear",$datos);
	}

	public function listar() {
    	$this->listarPost();
    }
    
    public function listarPost($f='') {
    	$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
    	$this->load->model('pelicula_model');
    	$datos['body']['directores'] = $this->pelicula_model->getAll($filtro);
    	$datos['filtro'] = $filtro;
    	enmarcar($this, 'pelicula/listar',$datos);
    }


	//mover a otro controller info si se crea

	public function infoAct(){
		enmarcar($this,'peliculas/vista_info_actor');
	}
}
?>