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

	public function crearPost(){
		$this->load->model ( "pelicula_model" );
		$id = isset ( $_POST ["id"] ) ? $_POST ["id"] : null;
		$title = isset ( $_POST ["title"] ) ? $_POST ["title"] : null;
		$original_title = isset ( $_POST ["original_title"] ) ? $_POST ["original_title"] : null;
		$poster_path = isset ( $_POST ["poster_path"] ) ? $_POST ["poster_path"] : null;
		$popularity = isset ( $_POST ["popularity"] ) ? $_POST ["popularity"] : null;
		$release_date = isset ( $_POST ["release_date"] ) ? $_POST ["release_date"] : null;
		$adult = isset ( $_POST ["adult"] ) ? $_POST ["adult"] : null;
		$overview = isset ( $_POST ["overview"] ) ? $_POST ["overview"] : null;
		$genre_ids = isset ( $_POST ["genre"] ) ? $_POST ["genre"] : [];

		try {
			if ($adult == 'false') {
				$adult = "No";
			} else {
				$adult = "Sí";
			}
			$ver = $this-> pelicula_model -> insertPelicula($id,$title,$original_title,$poster_path,$popularity,$release_date,$adult,$overview,$genre_ids);
			if ($ver) {
			header('Location:'.base_url().'pelicula/crearOk?pelicula='.$title);
			} else {
				header('Location:'.base_url().'pelicula/crearError');
			}
		} catch(Exception $e){
			print_r($e);
		}
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

    public function crearOk() {
		$datos['mensaje']['texto'] = "La película ".$_GET['pelicula'].". Redirigiendo a la lista de películas...";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this, 'usuario/mensaje', $datos);
		header("Refresh:3;url=".base_url().'pelicula/listar');
	}
	
	public function crearError() {
		$datos['mensaje']['texto'] = "Se ha producido un error, intentalo de nuevo.";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this, 'pelicula/listar', $datos);
	}


	//mover a otro controller info si se crea

	public function infoAct(){
		enmarcar($this,'peliculas/vista_info_actor');
	}
}
?>