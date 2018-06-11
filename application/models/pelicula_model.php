<?php
class Pelicula_model extends CI_Model {
	//Se guarda en la tabla los datos de la película, comprueba que ya exista uno creado con los mismos datos
	public function createFilm ( $titulo, $anioEstreno, $duracion, $id_pais, $reparto, $productora, $generos, $sinopsis, $foto, $activo) {
		$pelicula = R::find('pelicula', 'titulo like ? and anioEstreno like ? and duracion like ? and productora like ?', [$titulo,$anioEstreno,$duracion,$productora]);
		if ($pelicula == null) {
			$pelicula = R::dispense ( 'pelicula' );
			$pelicula -> titulo = $titulo;
			$pelicula -> anioEstreno = $anioEstreno;
			$pelicula -> duracion = $duracion;
			$pelicula -> productora = $productora;
			$pelicula -> sinopsis = $cadProfesiones;
			$pelicula -> rutaFoto = $foto;
			$pelicula -> activo = $activo;
			/*$reparto = R::load("repartos", $id_reparto[]);
			 $reparto -> xownPeliculaList[] = $pelicula;
			 $genero = R::load("generos", $id_genero[]);
			 $genero -> xownPeliculaList[] = $pelicula;*/
			$pais = R::load("paises", $id_pais);
			$pais -> xownPeliculaList[] = $pelicula;
			R::store($pais);
		} else {
			throw new Exception("Película duplicada");
		}
		R::close();
	}

	public function getPeliculaPorTitulo($nombre,$tmdb){
		$pelicula = R::findOne("peliculas","titulo=? and id_tmdb=?",[$nombre,$tmdb]);
		if ($pelicula == null) {
			return true;
		} else {
			return false;
		}
	}

	public function getAll() {
		return R::findAll("peliculas");
	}

	public function getPeliculaPorId ( $id_pelicula ) {
		return R::load("pelicula",$id_pelicula);
	}
	
	 public function insertPelicula($id,$title,$original_title,$poster_path,$popularity,$release_date,$adult,$overview,$genre_ids) {
		$pelicula = R::findOne('peliculas','id like ? and titulo_original like ?',[$id,$original_title]);

		if ($pelicula == null) {
		$nueva_pelicula = R::dispense('peliculas');
		$nueva_pelicula -> titulo = $title;
		$nueva_pelicula -> titulo_original = $original_title;
		$nueva_pelicula ->ruta_cartel = $poster_path;
		$nueva_pelicula ->popularidad = $popularity;
		$nueva_pelicula -> fecha_lanzamiento= $release_date;
		$nueva_pelicula -> adulto= $adult;
		$nueva_pelicula -> sinopsis= $overview;
		foreach ($genre_ids as $id_g) {
		$nueva_pelicula->sharedGenerosList[] = R::load('generos',$id_g);
		}
		$nueva_pelicula -> id_tmdb = $id;
		R::store($nueva_pelicula);
		R::close();
		return true;
		} else {
		R::close();
		throw new Exception("Error Processing Request", 1);
		return false;
		}
		}

		
	public function editar($id_pelicula, $titulo, $anioEstreno, $duracion, $id_pais, $reparto, $productora, $generos, $sinopsis, $foto) {
		$pelicula = R::load ( 'pelicula', $id_pelicula );
		$peliculasTodas = R::find("pelicula",'titulo like ? and anioEstreno like ? and duracion like ? and productora like ?', [$titulo,$anioEstreno,$duracion,$productora]);
		$pais = R::load("paises", $id_pais);
		//Editar generos y reparto segun los ids que vengan de la vista
		$cambio=false;
	  
		if ($peliculasTodas == null) {
			if($titulo != $pelicula->titulo && $titulo != "") {
				$pelicula->titulo = $titulo;
				$cambio=true;
			}
			if($anioEstreno != $pelicula->anioEstreno && $anioEstreno != "") {
				$pelicula->anioEstreno = $anioEstreno;
				$cambio=true;
			}
			if($duracion != $pelicula->duracion && $duracion != ""){
				$pelicula->duracion = $duracion;
				$cambio=true;
			}
			if($productora != $pelicula->productora && $productora != "") {
				$pelicula->productora = $productora;
				$cambio=true;
			}
			if($sinopsis != $pelicula->sinopsis && $sinopsis != "") {
				$pelicula->sinopsis = $sinopsis;
				$cambio=true;
			}
			if($foto != "") {
				$pelicula->rutaFoto = $foto;
				$cambio=true;
			}
			if($pais != $pais->id) {
				$pais -> xownPeliculaList[] = $pelicula;
				R::store($pais);
				$cambio=true;
			}
			//Me faltan generos y reparto(Tengo que ver como cambiar si vienen varios ids)
			 
			if ($cambio) {
				R::store ( $pelicula );
			}
		}
	}

	public function borrar($id_pelicula) {
		$pelicula = R::load ( 'pelicula', $id_pelicula );
		$pelicula->activo = 'false';
		R::store ( $pelicula );
	}

	public function activar($id_pelicula) {
		$pelicula = R::load ( 'pelicula', $id_pelicula );
		$pelicula->activo = 'true';
		R::store ( $pelicula );
	}
}
?>