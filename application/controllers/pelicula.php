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
		$repartos = isset($_POST['reparto'])?$_POST['reparto']:null;
		$productora = isset($_POST['productora'])?$_POST['productora']:null;
		$generos = isset($_POST['genero'])?$_POST['genero']:null;
		$sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:null;
		$activo = isset($_POST['activo'])?$_POST['activo']:false;
		
		$titulo = str_replace(" ","",$titulo);
		
		if ($generos!="") {
    		$cadGeneros ="";
    		for ($i=0;$i<count($generos);$i++) {
    			$cadGeneros = $generos[$i].",".$cadGeneros;
    		}
    		$cadGeneros = substr($cadGeneros, 0, -1);
		}
		
		if ($repartos!="") {
    		$cadRepartos = "";
    		for ($i=0; $i<count($repartos);$i++) {
    		    $cadRepartos = $repartos[$i].",".$cadRepartos;
    		}
    		$cadRepartos = substr($cadRepartos, 0, -1);
		}
		
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
		
		try {
		    $this->pelicula_model->createFilm ( $titulo, $anioEstreno, $duracion, $id_pais, $cadRepartos, $productora, $cadGeneros, $sinopsis, $foto, $activo);
			header ("location:".base_url ()."pelicula/crearOk");
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "película ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$datos['mensaje']['link']['listar'] = "pelicula";
			$datos['mensaje']['link']['crear'] = "pelicula";
			enmarcar($this,"pelicula/mensaje",$datos);
		}
	}
	
	public function crearOK() {
	    $datos['mensaje']['texto'] = "Película creada correctamente";
	    $datos['mensaje']['nivel'] = 'ok';
	    $datos['mensaje']['link']['listar'] = "pelicula";
	    $datos['mensaje']['link']['crear'] = "pelicula";
	    enmarcar($this, "pelicula/mensaje",$datos);
	}

	public function listar() {
    	$this->listarPost();
    }
    
    public function listarPost() {
    	$this->load->model('pelicula_model');
    	$datos['body']['peliculas'] = $this->pelicula_model->getAll();
    	enmarcar($this, 'pelicula/listar',$datos);
    }
    
    public function editar() {
        $this->load->model ( 'pelicula_model' );
        $this->load->model('pais_model');
        $this->load->model('reparto_model');
        $this->load->model('genero_model');
        $id_pelicula = $_POST ['id_pelicula'];
        $datos ['body']['peliculas'] = $this->pelicula_model->getPeliculaPorId ( $id_pelicula );
        $datos['body']['paises'] = $this->pais_model->getTodos();
        //Coger Reparto y Generos que vienen por su id de la vista
        enmarcar ( $this, 'pelicula/editar', $datos);
    }
    
    public function editarPost() {
        $this->load->model ( 'pelicula_model' );
        $this->load->model('pais_model');
        $this->load->model('reparto_model');
        $this->load->model('genero_model');
        $titulo = isset($_POST['titulo'])?$_POST['titulo']:null;
        $anioEstreno = isset($_POST['anioEstreno'])?$_POST['anioEstreno']:null;
        $duracion = isset($_POST['duracion'])?$_POST['duracion']:null;
        $id_pais = isset($_POST['pais'])?$_POST['pais']:null;
        //Reparto(Array con nombres)
        $repartos = isset($_POST['reparto'])?$_POST['reparto']:null;
        $productora = isset($_POST['productora'])?$_POST['productora']:null;
        $generos = isset($_POST['genero'])?$_POST['genero']:null;
        $sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:null;
        $activo = isset($_POST['activo'])?$_POST['activo']:false;
        
        $titulo = str_replace(" ","",$titulo);
        
        $cadGeneros ="";
        for ($i=0;$i<count($generos);$i++) {
            $cadGeneros = $generos[$i].",".$cadGeneros;
        }
        $cadGeneros = substr($cadGeneros, 0, -1);
        
        $cadReparto = "";
        for ($i=0; $i<count($repartos);$i++) {
            $cadReparto = $repartos[$i].",".$cadReparto;
        }
        $cadReparto = substr($cadReparto, 0, -1);
        
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
                    //echo "<br />assets/img/fotoReparto/Reparto_".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
                    copy($_FILES["foto"]['tmp_name'], "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension);
                    $foto = "assets/img/foto/".$nombre."_".$apellido1."_".$fechaNacimiento.".".$extension;
                }
            }
        }else {
            $foto = $_POST['fotoFija'];
        }
        
        try {
            $this->pelicula_model->editar ($titulo, $anioEstreno, $duracion, $id_pais, $cadIdsReparto, $productora, $generos, $sinopsis, $foto, $activo);
            header ("location:".base_url ()."pelicula/editarOk");
        }
        catch (Exception $e) {
            $datos['mensaje']['texto'] = "Película ya existente";
            $datos['mensaje']['nivel'] = 'error';
            $datos['mensaje']['link']['listar'] = "pelicula";
            $datos['mensaje']['link']['crear'] = "pelicula";
            enmarcar($this,"pelicula/mensaje",$datos);
        }
    }
    
    public function editarOK() {
        $datos['mensaje']['texto'] = "Película creada correctamente";
        $datos['mensaje']['nivel'] = 'ok';
        $datos['mensaje']['link']['listar'] = "pelicula";
        $datos['mensaje']['link']['crear'] = "pelicula";
        enmarcar($this, "pelicula/mensaje",$datos);
    }


	//mover a otro controller info si se crea

	public function infoAct(){
		enmarcar($this,'peliculas/vista_info_actor');
	}
}
?>