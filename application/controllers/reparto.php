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
		$profesiones = isset($_POST['profesion'])?$_POST['profesion']:null;
		
		$fechaCambio = str_replace("/", "-", $fechaNacimiento);
		
		if ($profesiones != null) {
			$cadProfesiones ="";
			for ($i=0;$i<count($profesiones);$i++) {
			    echo "$profesiones[$i] <br/>";
			    $cadProfesiones = $profesiones[$i].",".$cadProfesiones;
			}
			$cadProfesiones = substr($cadProfesiones, 0, -1);
		}

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
					copy($_FILES["foto"]['tmp_name'], "assets/img/foto/".$nombre."_".$apellido1."_".$fechaCambio.".".$extension);
					$foto = "assets/img/foto/".$nombre."_".$apellido1."_".$fechaCambio.".".$extension;
				}
			}
		} else {
			$foto = "assets/img/foto/default.png";
		}

		try {
			$debug = $this -> actor_model -> createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto);
			
			header ("location:".base_url ()."actor/crearOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Actor ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link']['listar'] = "actor";
			$datos['mensaje']['link']['crear'] = "actor";
			enmarcar($this,"actor/mensaje",$datos);
		}
	}

	public function crearOK() {
		$datos['mensaje']['texto'] = "Actor creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje']['link']['listar'] = "actor";
		$datos['mensaje']['link']['crear'] = "actor";
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
		$id_actor = $_POST ['id_actor'];
		$profesiones = isset($_POST['profesion'])?$_POST['profesion']:null;
		
		//TEMPORAL (coge todas las profesiones y las junta en un string separado por comas)
		$cadProfesiones ="";
		for ($i=0;$i<count($profesiones);$i++) {
		    echo "$profesiones[$i] <br/>";
		    $cadProfesiones = $profesiones[$i].",".$cadProfesiones;
		}
		$cadProfesiones = substr($cadProfesiones, 0, -1);
		echo $cadProfesiones;
		//Hasta aqui crea la cadena con todas las profesiones que se elijan separadas por una coma
		//Si se quita, quitar el parámetro de la llamada al modelo

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
		    $this->actor_model->editar ( $id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto);
			header ("location:".base_url ()."actor/editarOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Actor ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link']['listar'] = "actor";
			$datos['mensaje']['link']['crear'] = "actor";
			enmarcar($this,"actor/mensaje",$datos);
		}
	}

	public function editarOK() {
		$datos['mensaje']['texto'] = "Actor creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje']['link']['listar'] = "actor";
		$datos['mensaje']['link']['crear'] = "actor";
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
}
?>