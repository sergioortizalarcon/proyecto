<?php
class profesion_model extends CI_Model {
	public function crear_profesion($nombre) {
		$profesion = R::findOne ( "profesiones", "nombre=?", [
				$nombre
		] );

		if ($profesion == null) {
			$profesion = R::dispense ( "profesiones" );
			$profesion->nombre = $nombre;
				
			R::store ( $profesion );
		} else {
			throw new Exception ( "Error al crear el género" );
		}

		R::close ();
	}
	public function getTodos($filtro='') {
		$todos = R::find ( "profesiones", "nombre like ? order by nombre ASC", [
				"%" . $filtro . "%"
		] );
		return $todos;
	}
	public function filtrar($filtro = '') {
		return R::find ( 'profesiones', 'nombre like ?', [
				'%' . $filtro . '%'
		] );
	}
	public function getprofesionPorId($id_profesion) {
		return R::load ( 'profesiones', $id_profesion );
	}
	public function getprofesionPorNombre($nombre) {
		$profesion = R::findOne ( "profesiones", "nombre=?", [
				$nombre
		] );
		if ($profesion == null) {
			return true;
		} else {
			return false;
		}
	}
	public function editar($id_profesion, $nuevo_nombre) {
		$profesion = R::load ( 'profesiones', $id_profesion );
		if ($profesion->id != 0) {
			$profesion->nombre = $nuevo_nombre;
			R::store ( $profesion );
		} else {
			throw new Exception ( "El género no existe" );
		}
		R::close ();
	}
	public function borrar($id_profesion) {
		$profesion = R::load ( 'profesiones', $id_profesion );
		if ($profesion->id != 0) {
			R::trash ( $profesion );
		}
		R::close ();
	}
}

?>