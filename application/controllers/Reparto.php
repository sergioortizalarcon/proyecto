<?php
class Reparto extends CI_Controller {
	public function comprobarRol(){
		if (session_status () == PHP_SESSION_NONE) {session_start ();}
		if (isset ( $_SESSION ['rol'] ) && ($_SESSION['rol'] == 'administrador')) {
			return true;
		} else {
			return false;
		}
	}
	
	public function acceso_denegado(){
		header ("location:".base_url());
	}
	
	public function crear() {
		if ($this -> comprobarRol()) {
		    $this->load->model('pais_model');
		    $this->load->model('profesion_model');
			$datos['body']['paises'] = $this->pais_model->getTodos();
			$datos['body']['profesiones'] = $this->profesion_model->getAllActive();
			enmarcar($this, "reparto/crear", $datos);
		} else {
			$this->acceso_denegado();
		}
	}

	public function crearPost() {
		$this->load->model('reparto_model');

		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
		$ambos = isset($_POST['ambos'])?$_POST['ambos']:'off';
		$profesiones = isset($_POST['profesion'])?$_POST['profesion']:[];
		$estado = isset($_POST['estado'])?$_POST['estado']:'Inactivo';
		$fechaNacimiento = str_replace("/", "-", $fechaNacimiento);

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
		    $debug = $this -> reparto_model -> createReparto($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $profesiones, $foto, $estado);
			header ("location:".base_url ()."reparto/crearOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Persona ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link']['listar'] = "reparto";
			$datos['mensaje']['link']['crear'] = "reparto";
			enmarcar($this,"reparto/mensaje",$datos);
		}
	}

	public function crearOK() {
		$datos['mensaje']['texto'] = "Persona creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje']['link']['listar'] = "reparto";
		$datos['mensaje']['link']['crear'] = "reparto";
		enmarcar($this, "reparto/mensaje",$datos);
	}

	public function listar() {
		$this->listarPost();
	}

	public function listarPost() {
		$this->load->model('reparto_model');
		$datos['body']['repartos'] = $this->reparto_model->getAll();
		enmarcar($this, 'reparto/listar',$datos);
	}

	public function editar() {
		if ($this -> comprobarRol()) {
			$this->load->model ( 'reparto_model' );
			$this->load->model('pais_model');
			$this->load->model('profesion_model');
			$id_reparto = $_POST ['id_reparto'];
			$datos ['body']['repartos'] = $this->reparto_model->getRepartoPorId ( $id_reparto );
			$datos['body']['paises'] = $this->pais_model->getTodos();
			$datos['body']['profesiones'] = $this->profesion_model->getAllActive();
			enmarcar ( $this, 'reparto/editar', $datos);
		} else {
			$this->acceso_denegado();
		}
	}

	public function editarPost() {
		$this->load->model ( 'reparto_model' );
		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		//$nombre = $_POST['nombre'];
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
		$id_reparto = $_POST ['id_reparto'];
		$profesiones = isset($_POST['profesion'])?$_POST['profesion']:null;
		$estado = $_POST['estado'];
		//$fechaNacimiento = str_replace("/","-",$fechaNacimiento);
		
		if ($profesiones!="") {
			$cadProfesiones ="";
			for ($i=0;$i<count($profesiones);$i++) {
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
					copy($_FILES["foto"]['tmp_name'], "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
					$foto = "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
					echo $foto;
				}
			}
		}else {
			$foto = $_POST['fotoFija'];
			$foto = str_replace("http://localhost/proyecto/","",$foto);
		}

		try {
		    $this->reparto_model->editar ( $id_reparto, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto, $estado);
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

	public function editarOK() {
		$datos['mensaje']['texto'] = "Persona creada correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje']['link']['listar'] = "reparto";
		$datos['mensaje']['link']['crear'] = "reparto";
		enmarcar($this, "reparto/mensaje",$datos);
	}

	public function borrarPost() {
		if ($this->comprobarRol()) {
			$this->load->model ( 'reparto_model' );
			$id_reparto = $_POST ['id_reparto'];
			$this->reparto_model->borrar ( $id_reparto );
			$this->listar();
		} else {
			$this->acceso_denegado();
		}
	}
	
	public function activarPost() {
		if ($this->comprobarRol()) {
		    $this->load->model ( 'reparto_model' );
		    $id_reparto = $_POST ['id_reparto'];
		    $this->reparto_model->activar ( $id_reparto );
		    $this->listar();
		} else {
			$this->acceso_denegado();
		}
	} 

	public function abrirFicha() {
	    $this->load->model ( 'reparto_model' );
		$this->load->model('profesion_model');
		$this->load->model('pelicula_model');
		$id_reparto = $_REQUEST ['id_reparto'];
		$datos ['body']['repartos'] = $this->reparto_model->getRepartoPorId ( $id_reparto );
		$datos['body']['profesiones'] = $this->profesion_model->getAllActive();
		$datos['body']['peliculas'] = $this->pelicula_model->getAllActive();
		enmarcar($this, "reparto/ficha",$datos);
	}
}
?>