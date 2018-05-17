<?php
class Pais_model extends CI_Model {
	public function crear_pais($nombre) {
		$pais = R::findOne ( "paises", "nombre=?", [ 
				$nombre 
		] );
		
		if ($pais == null) {
			$pais = R::dispense ( "paises" );
			$pais->nombre = $nombre;
			
			R::store ( $pais );
		} else {
			throw new Exception ( "Error al crear el país" );
		}
		
		R::close ();
	}
	public function getTodos($filtro = '') {
		$todos = R::find ( "paises", "nombre like ?", [ 
				"%" . $filtro . "%" 
		] );
		return $todos;
	}
	public function getPaisPorId($id_pais) {
		return R::load ( 'paises', $id_pais );
	}
	public function getPaisPorNombre($nombre) {
		$pais = R::findOne ( "paises", "nombre=?", [ 
				$nombre 
		] );
		if ($pais == null) {
			return true;
		} else {
			return false;
		}
	}
	public function editar($id_pais, $nuevo_nombre) {
		$pais = R::load ( 'paises', $id_pais );
		if ($pais->id != 0) {
			$pais->nombre = $nuevo_nombre;
			R::store ( $pais );
		} else {
			throw new Exception ( "El país no existe" );
		}
		R::close ();
	}
	public function borrar($id_pais) {
		$pais = R::load ( 'paises', $id_pais );
		if ($pais->id != 0) {
			R::trash ( $pais );
		}
		R::close ();
	}
}

?>