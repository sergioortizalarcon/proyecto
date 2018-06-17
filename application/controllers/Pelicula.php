<?php
class Pelicula extends CI_Controller {
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
		    $this -> load -> model("pais_model");
		    $this -> load -> model("genero_model");
		    $this -> load -> model("reparto_model");
		    $datos["paises"] = $this -> pais_model -> getTodos();
		    $datos["generos"] = $this -> genero_model -> getAllActive();
		    $datos["repartos"] = $this -> reparto_model ->getAllActive();
			enmarcar($this, "pelicula/crear",$datos);
		} else {
			$this->acceso_denegado();
		}
	}
	
	public function crearPost() {
		$this->load->model("pelicula_model");
		
		$titulo = isset($_POST['titulo'])?$_POST['titulo']:null;
		$tituloOriginal = isset($_POST['tituloOriginal'])?$_POST['tituloOriginal']:null;
		$fechaLanzamiento = isset($_POST['fechaLanzamiento'])?$_POST['fechaLanzamiento']:null;
		$lenguage = isset($_POST['lenguage'])?$_POST['lenguage']:null;
		$popularity = isset($_POST['popularity'])?$_POST['popularity']:null;
		$adulto = isset($_POST['adulto'])?$_POST['adulto']:"No";
		//Reparto(Array con nombres)
		$repartosDirector = isset($_POST['repartoDirector'])?$_POST['repartoDirector']:[];
		$repartosActor = isset($_POST['repartoActor'])?$_POST['repartoActor']:[];
		$generos = isset($_POST['genero'])?$_POST['genero']:[];
		$sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:null;
		$estado = isset($_POST['estado'])?$_POST['estado']:'Inactivo';
		
		$fechaLanzamiento = str_replace("/","-",$fechaLanzamiento);
		
		$tituloSinEspacios = str_replace(" ","",$titulo);
		$tituloOriginalSinEspacios = str_replace(" ","",$tituloOriginal);
		
		
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
				$urlBase = base_url();
				if ($_FILES["fotoPoster"]["size"] < 25000000) {
					copy($_FILES["fotoPoster"]['tmp_name'], "assets/img/poster/".$tituloSinEspacios."_".$fechaLanzamiento."_".$lenguage.".".$extension);
					$foto = "assets/img/poster/".$tituloSinEspacios."_".$fechaLanzamiento."_".$lenguage.".".$extension;
				}
			}
		}else {
		    $foto = "assets/img/poster/default.png";
		}
		try {
		    $this->pelicula_model->createPelicula ( $titulo, $tituloOriginal, $adulto, $fechaLanzamiento, $popularity, $lenguage, $repartosDirector, $repartosActor, $generos, $sinopsis, $foto, $estado);
			header ("location:".base_url()."pelicula/crearOk");
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

	public function crearPostdb(){
		$this->load->model ( "pelicula_model" );
		$datos = $_POST;
		$sol = [ ];
		foreach ( $datos as $k => $v ) {
			if (! is_array ( $v )) {
				$sol[$k]=$v;
			}
		}
		$id = isset ( $sol ["id"] ) ? $sol ["id"] : null;
		$title = isset ( $sol ["title"] ) ? $sol ["title"] : null;
		$original_title = isset ( $sol ["original_title"] ) ? $sol ["original_title"] : null;
		$poster_path = isset ( $sol ["poster_path"] ) ? $sol ["poster_path"] : null;
		$popularity = isset ( $sol ["popularity"] ) ? $sol ["popularity"] : null;
		$release_date = isset ( $sol ["release_date"] ) ? $sol ["release_date"] : null;
		$adult = isset ( $sol ["adult"] ) ? $sol ["adult"] : null;
		$original_language = isset ( $sol ["original_language"] ) ? $sol ["original_language"] : null;
		$overview = isset ( $sol ["overview"] ) ? $sol ["overview"] : null;
		$genre_ids = isset ($_POST["genre"] ) ?$_POST["genre"] : [];
		$titulo = $this->pelicula_model->getPeliculaPorTitulo($title,$id);
		$estado = 'Activo';
		
		$rutaPoster = "http://image.tmdb.org/t/p/w185";
		$poster_path = $rutaPoster.$poster_path;
		
		if($titulo){
			$this-> pelicula_model -> insertPelicula($id,$title,$original_title,$poster_path,$popularity,$release_date,$adult,$original_language,$overview,$genre_ids,$estado);
		}
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
    	if ($this->comprobarRol()) {
	        $this->load->model ( 'pelicula_model' );
	        $this->load->model('pais_model');
	        $this->load->model('reparto_model');
	        $this->load->model('Genero_model');
	        $id_pelicula = $_POST ['id_pelicula'];
	        $datos['body']['peliculas'] = $this->pelicula_model->getPeliculaPorId ( $id_pelicula );
	        $datos['body']['paises'] = $this->pais_model->getTodos();
	        $datos['body']['repartos'] = $this->reparto_model->getAllActive();
	        $datos['body']['generos'] = $this->Genero_model->getAllActive();
	        enmarcar ( $this, 'pelicula/editar', $datos);
    	} else {
    		$this->acceso_denegado();
    	}
    }
    
    public function editarPost() {
        $this->load->model ( 'pelicula_model' );
        $this->load->model('pais_model');
        $this->load->model('reparto_model');
        $this->load->model('genero_model');
        $titulo = isset($_POST['titulo'])?$_POST['titulo']:null;
        $tituloOriginal = isset($_POST['tituloOriginal'])?$_POST['tituloOriginal']:null;
        $fechaLanzamiento = isset($_POST['fechaLanzamiento'])?$_POST['fechaLanzamiento']:null;
        $lenguage = isset($_POST['lenguage'])?$_POST['lenguage']:null;
        $popularity = isset($_POST['popularity'])?$_POST['popularity']:null;
        $adulto = isset($_POST['adulto'])?$_POST['adulto']:"No";
        $repartos = isset($_POST['reparto'])?$_POST['reparto']:null;
        $generos = isset($_POST['genero'])?$_POST['genero']:null;
        $sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:null;
        $id_pelicula = $_POST ['id_pelicula'];
        $estado = $_POST['estado'];
        $fechaLanzamiento = str_replace("/","-",$fechaLanzamiento);
        $tituloSinEspacios = str_replace(" ","",$titulo);
        $tituloOriginalSinEspacios = str_replace(" ","",$tituloOriginal);
        
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
        			copy($_FILES["fotoPoster"]['tmp_name'], "assets/img/poster/".$tituloSinEspacios."_".$fechaLanzamiento."_".$lenguage.".".$extension);
        			$foto = "assets/img/poster/".$tituloSinEspacios."_".$fechaLanzamiento."_".$lenguage.".".$extension;
        		}
        	}
        }else {
            $foto = $_POST['fotoFija'];
            // $foto = str_replace("http://localhost/proyecto/","",$foto);
        }
        
        try {
        	$this->pelicula_model->editarPelicula ( $titulo, $tituloOriginal, $adulto, $fechaLanzamiento, $popularity, $lenguage, $cadRepartos, $cadGeneros, $sinopsis, $foto, $id_pelicula, $estado);
            header ("location:".base_url()."pelicula/editarOk");
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

    public function creadaOk() {
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
	
	public function borrarPost() {
		if ($this->comprobarRol()) {
		    $this->load->model ( 'pelicula_model' );
		    $id_pelicula = $_POST ['id_pelicula'];
		    $this->pelicula_model->borrar ( $id_pelicula );
		    $this->listar();
		} else {
			$this->acceso_denegado();
		}
	}
	
	public function activarPost() {
		if ($this->comprobarRol()) {
		    $this->load->model ( 'pelicula_model' );
		    $id_pelicula = $_POST ['id_pelicula'];
		    $this->pelicula_model->activar ( $id_pelicula );
		    
		    $this->listar(); 
		} else {
			$this->acceso_denegado();
		} 
	}
	
	public function abrirFicha() {
	    $this->load->model ( 'pelicula_model' );
	    $this->load->model('reparto_model');
		$this->load->model('genero_model');
		$this->load->model('usuario_model');
		if (session_status () == PHP_SESSION_NONE) {session_start ();}
		$id_user = isset($_SESSION['idUser'])?$_SESSION['idUser']:0;
	    $id_pelicula = $_GET ['id_pelicula'];
		$votos_usuario = $this->usuario_model->listar_votos_peli($id_pelicula,$id_user);
		if ($votos_usuario!=null) {
			$datos['body']['votos'] = $votos_usuario;
		}
	    $datos ['body']['peliculas'] = $this->pelicula_model->getPeliculaPorId ( $id_pelicula );
		$datos['body']['repartos'] = $this->reparto_model->getAllActive();
		$datos['body']['generos'] = $this->genero_model->getAllActive();
	    enmarcar($this, "pelicula/ficha",$datos);
	}
}
?>