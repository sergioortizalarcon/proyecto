<?php
class actor extends CI_Controller {
	public function crear() {
		$this->load->model('pais_model');
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar($this, "actor/crearGET", $datos);
	}

	public function crearPost() {
		$this->load->model('actor_model');
		$this->load->model('director_model');

		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
		$ambos = isset($_POST['ambos'])?$_POST['ambos']:'off';

		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			# verificamos el formato de la imagen
			if ($_FILES["foto"]["type"]=="image/jpeg" || $_FILES["foto"]["type"]=="image/pjpeg" || $_FILES["foto"]["type"]=="image/png"){

				# Cogemos la anchura y altura de la imagen
				$info=getimagesize($_FILES["foto"]["tmp_name"]);

				$extension = 0;
				if ($info[2] == 2) {
					$extension = "jpg";
				} else if ($info[2] == 3) {
					$extension = "png";
				}

				if ($_FILES["foto"]["size"] < 25000000) {
					//Tamaño y extensión correctos, guardar imagen en carpeta
					copy($_FILES["foto"]['tmp_name'], "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
					$foto = "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
				}
			}
		} else {
			$foto = "assets/img/foto/default.png";
		}

		try {
			//Si la persona es a la vez actor y director se guarda en las dos tablas, si no, solo en la de actor
			if ($ambos == 'on') {
				$debug = $this -> actor_model -> createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
				$debug = $this -> director_model -> createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
			} else {
				$debug = $this -> actor_model -> createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
			}
			header ("location:".base_url ()."actor/crearOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Actor ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link'] = "actor/crear";
			enmarcar($this,"actor/mensaje",$datos);
		}
	}

	public function crearOK() {
		$datos['mensaje']['texto'] = "Actor creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje'] ['link'] = "actor/listar";
		enmarcar($this, "actor/mensaje",$datos);
	}

	public function listar() {
		$this->listarPost();
	}

	public function listarPost() {
		$this->load->model('actor_model');
		$datos['body']['actores'] = $this->actor_model->getAll();
		enmarcar($this, 'actor/listar',$datos);
	}

	public function editar() {
		//TODO
		//Hay que conseguir el id del director para pasarselo al modelo y que se modifique en las dos tablas

		$this->load->model ( 'actor_model' );
		$this->load->model('pais_model');
		$id_actor = $_POST ['id_actor'];
		$datos ['body']['actores'] = $this->actor_model->getActorPorId ( $id_actor );
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar ( $this, 'actor/editar', $datos);
	}

	public function editarPost() {
		$this->load->model ( 'actor_model' );
		$this->load->model ( 'director_model' );
		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		//$nombre = $_POST['nombre'];
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
		$ambos = isset($_POST['ambos'])?$_POST['ambos']:'off';
		$id_actor = $_POST ['id_actor'];

		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			# verificamos el formato de la imagen
			if ($_FILES["foto"]["type"]=="image/jpeg" || $_FILES["foto"]["type"]=="image/pjpeg" || $_FILES["foto"]["type"]=="image/png"){

				# Cogemos la anchura y altura de la imagen
				$info=getimagesize($_FILES["foto"]["tmp_name"]);

				$extension = 0;
				if ($info[2] == 2) {
					$extension = "jpg";
				} else if ($info[2] == 3) {
					$extension = "png";
				}

				if ($_FILES["foto"]["size"] < 25000000) {
					//Tamaño y extensión correctos, guardar imagen en carpeta
					//echo "<br />assets/img/fotoActor/Actor_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
					copy($_FILES["foto"]['tmp_name'], "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
					$foto = "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
				}
			}
		}else {
		    $foto = $_POST['fotoFija'];
		}

		try {
		    echo $ambos;
		    if ($ambos == 'on') {
		        //$this->actor_model->editar ( $id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
		        //TODO
		        //Comprueba que ya exista un director mediante la id, si es así lo modifica, si no, lo crea nuevo
		        
		        
		        $director = $this->director_model->getDirectorPorDatos($nombre, $apellido1, $apellido2, $fechaNacimiento);
		        //echo $director[];
		        //echo $director->nombre;
		        echo "ID DIRECTOR $director->nombre";
		        //if (id_director != null) {
		        //$this->director_model->editar ( $id_director, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
		        //}
		    } else {
				$this->actor_model->editar ( $id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto);
			}
			//header ("location:".base_url ()."actor/editarOk");
		}
		catch (Exception $e) {
			/*$datos['mensaje']['texto'] = "Actor ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link'] = "actor/crear";
			enmarcar($this,"actor/mensaje",$datos);*/
		}
	}

	public function editarOK() {
		$datos['mensaje']['texto'] = "Actor creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje'] ['link'] = "actor/listar";
		enmarcar($this, "actor/mensaje",$datos);
	}

	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}

	public function borrarPost() {
		$this->load->model ( 'actor_model' );
		$id_actor = $_POST ['id_actor'];
		$this->actor_model->borrar ( $id_actor );

		$this->listarPost();
	}

	public function abrirFicha() {
		$this->load->model ( 'actor_model' );
		$id_actor = $_GET ['id_actor'];
		$datos ['body']['actores'] = $this->actor_model->getActorPorId ( $id_actor );
		enmarcar($this, "actor/ficha",$datos);
	}
	
	//Crea un director copiando los mismos datos del actor
	public function crearDirector() {
	    $this->load->model('actor_model');
	    $this->load->model('director_model');
	    $id_actor = $_POST ['id_actor'];
	    
	    try {
	        $datos = $this->actor_model->getActorPorId($id_actor);
	        $datos->ambos = 'on';
	        $this->director_model->createDirector($datos->nombre, $datos->apellido1, $datos->apellido2, $datos->fechaNacimiento, $datos->paisesId, $datos->biografia, $datos->ambos, $datos->rutaFoto);
	        header ("location:".base_url ()."director/editarOk");
	    } catch (Exception $e) {
	        $datos['mensaje']['texto'] = "Director ya existente";
	        $datos['mensaje']['nivel'] = 'error';
	        $datos['mensaje']['link'] = "director/crear";
	        enmarcar($this,"actor/mensaje",$datos);
	    }
	}
}
?>