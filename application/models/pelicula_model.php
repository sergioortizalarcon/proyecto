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

}
?>