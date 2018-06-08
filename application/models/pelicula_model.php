<?php
class Pelicula_model extends CI_Model {
	
	public function crear_pelicula($nombre) {
		$pelicula = R::findOne ( "peliculas", "nombre=?", [$nombre]);
		
		if ($pelicula == null) {
			$a='db';
		} else {
			throw new Exception ( "Error al crear la ficha de la película");
		}
		R::close ();
	}

	public function getPeliculaPorNombre($nombre){
		$idioma = R::findOne("peliculas","nombre=?",[$nombre]);
		if ($idioma == null) {
			return true;
		} else {
			return false;
		}
	}

	public function getPeliculaPorId ( $id_idioma ) {
		return R::load("peliculas",$id_idioma);
	}
	
	public function getAll($filtro='') {
		$mostrar = R::find("peliculas","nombre like ?", ["%".$filtro."%"]);
		return $mostrar;
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

}
?>