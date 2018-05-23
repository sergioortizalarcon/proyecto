<?php

class Director extends CI_Controller {
	public function crear(){
		$this->load->model('pais_model');
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar($this, "director/crear", $datos);
    }

    public function crearPost() {
    	$this->load->model('director_model');
    	$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
    	$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
    	$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
    	$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
    	$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
    	$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
    	
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
    	            //echo "<br />assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
    	            copy($_FILES["foto"]['tmp_name'], "assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
    	            $foto = "assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
    	        }
    	    }
    	} else {
    	    $foto = "assets/img/fotoDirector/prueba.png";
    	}
        
        try {
            $debug = $this -> director_model -> createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto);
        	header ("location:".base_url ()."director/crearOk");
        }
        catch (Exception $e) {
        	$datos['mensaje']['texto'] = "Director ya existente";
        	$datos['mensaje']['nivel'] = 'error';
        	$datos['mensaje']['link'] = "director/crear";
        	enmarcar($this,"director/mensaje",$datos);
        }
    }

	public function crearOK() {
		$datos['mensaje']['texto'] = "Director creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje'] ['link'] = "director/listar";
		enmarcar($this, "director/mensaje",$datos);
	}

    public function listar() {
    	$this->listarPost();
    }
    
    public function listarPost() {
    	$this->load->model('director_model');
    	$datos['body']['directores'] = $this->director_model->getAll();
    	enmarcar($this, 'director/listar',$datos);
    }
    
    public function editar() {
    	$this->load->model ( 'director_model' );
    	$this->load->model('pais_model');
    	$id_director = $_POST ['id_director'];
    	$datos ['body'] ['directores'] = $this->director_model->getDirectorPorId ( $id_director );
    	$datos['body']['paises'] = $this->pais_model->getTodos();
    	enmarcar ( $this, 'director/editar', $datos );
    }
    
    public function editarPost() {
    	$this->load->model ( 'director_model' );
    	
    	$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
    	$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
    	$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
    	$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
    	$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
    	$biografia = isset($_POST['biografia'])?$_POST['biografia']:null;
    	$id_director = $_POST ['id_director'];
    	
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
    	            //echo "<br />assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
    	            copy($_FILES["foto"]['tmp_name'], "assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
    	            $foto = "assets/img/fotoDirector/Director_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
    	        }
    	    }
    	}
    
    	try {
    		$this->director_model->editar ( $id_director, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto);
    		header ("location:".base_url ()."director/editarOk");
    	}
    	catch (Exception $e) {
    		$datos['mensaje']['texto'] = "Dirctor ya existente";
    		$datos['mensaje']['nivel'] = 'error';
    		$datos['mensaje']['link'] = "director/crear";
    		enmarcar($this,"director/mensaje",$datos);
    	}
    }
    
    public function editarOK() {
    	$datos['mensaje']['texto'] = "Director creado correctamente";
    	$datos['mensaje']['nivel'] = 'ok';
    	$datos['mensaje'] ['link'] = "director/listar";
    	enmarcar($this, "director/mensaje",$datos);
    }
    
    public function borrar() {
    	$datos ['body'] ['accion'] = 'borrar';
    	$datos ['body'] ['filtro'] = '';
    	$this->filtrar ( $datos );
    }
    public function borrarPost() {
    	$this->load->model ( 'director_model' );
    	$id_director = $_POST ['id_director'];
    	$this->director_model->borrar ( $id_director );
    	
    	$this->listarPost();
    }
    
    public function abrirFicha() {
        $this->load->model ( 'director_model' );
        $id_director = $_GET ['id_director'];
        $datos ['body']['directores'] = $this->director_model->getdirectorPorId ( $id_director );
        enmarcar($this, "director/ficha",$datos);
    }
}
?>