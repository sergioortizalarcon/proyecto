<?php
class Pelicula extends CI_Controller {

	//Vista de admin
	public function menuFilms() {
		enmarcar($this,'pelicula/listar');
	}

	public function crear() {
	    $this -> load -> model("pais_model");
	    $this -> load -> model("genero_model");
	    $this -> load -> model("reparto_model");
	    $datos["paises"] = $this -> pais_model -> getTodos();
	    $datos["generos"] = $this -> genero_model -> getTodos();
	    $datos["repartos"] = $this -> reparto_model ->getAll();
		enmarcar($this, "pelicula/crear",$datos);
	}
	
	public function crearPost() {
		$this->load->model("pelicula_model");
		
		$titulo = isset($_POST['titulo'])?$_POST['titulo']:null;
		$anioEstreno = isset($_POST['anioEstreno'])?$_POST['anioEstreno']:null;
		$duracion = isset($_POST['duracion'])?$_POST['duracion']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		//Reparto(Array con nombres)
		//$reparto = isset($_POST['reparto'])?$_POST['reparto']:null;
		$productora = isset($_POST['productora'])?$_POST['productora']:null;
		$generos = isset($_POST['genero'])?$_POST['genero']:null;
		$sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:null;
		
		$titulo = str_replace(" ","",$titulo);
		
		$cadGeneros ="";
		for ($i=0;$i<count($generos);$i++) {
			$cadGeneros = $generos[$i].",".$cadGeneros;
		}
		$cadGeneros = substr($cadGeneros, 0, -1);
		
		if (is_uploaded_file($_FILES['fotoPoster']['tmp_name'])) {
			# verificamos el formato de la imagen
			if ($_FILES["fotoPoster"]["type"]=="image/jpeg" || $_FILES["fotoPoster"]["type"]=="image/pjpeg" || $_FILES["fotoPoster"]["type"]=="image/png"){
				
				# Cogemos la anchura y altura de la imagen
				$info=getimagesize($_FILES["fotoPoster"]["tmp_name"]);
				
				$extension = 0;
				if ($info[2] == 2) {
					$extension = "jpg";
				} else if ($info[2] == 3) {
					$extension = "png";
				}
				
				$tituloSinEspacios = str_replace(" ","",$titulo);
				
				if ($_FILES["fotoPoster"]["size"] < 25000000) {
					//Tamaño y extensión correctos, guardar imagen en carpeta
					//echo "<br />assets/img/fotoReparto/Reparto_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
					copy($_FILES["fotoPoster"]['tmp_name'], "assets/img/poster/".$titulo."_".$productora."_".$anioEstreno."_".$duracion.".".$extension);
					$foto = "assets/img/poster/".$titulo."_".$productora."_".$anioEstreno."_".$duracion.".".$extension;
				}
			}
		}else {
			$foto = $_POST['fotoFija'];
		}
		
		echo $titulo;
		
		echo $foto;
		
		try {
			$this->pelicula_model->createFilm ( $titulo, $anioEstreno, $duracion, $id_pais, $reparto, $productora, $generos, $sinopsis);
			header ("location:".base_url ()."reparto/editarOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Persona ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link']['listar'] = "reparto";
			$datos['mensaje']['link']['crear'] = "reparto";
			enmarcar($this,"reparto/mensaje",$datos);
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


	//mover a otro controller info si se crea

	public function infoAct(){
		enmarcar($this,'peliculas/vista_info_actor');
	}
}
?>