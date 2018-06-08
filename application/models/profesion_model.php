<?php
class profesion_model extends CI_Model {
    public function crear_profesion($nombre, $activo) {
		$profesion = R::findOne ( "profesion", "nombre=?", [$nombre]);

		if ($profesion == null) {
			$profesion = R::dispense ( "profesion" );
			$profesion->nombre = $nombre;
			$profesion->activo = $activo;
				
			R::store ( $profesion );
		} else {
			throw new Exception ( "Error al crear la profesión" );
		}

		R::close ();
	}
	
	public function getAll() {
		$todos = R::find ( "profesion", "order by nombre");
		return $todos;
	}
	
	public function getAllActive() {
	    $todos = R::find ( "profesion", "activo like ? order by nombre",['Activo']);
	    return $todos;
	}
	
	public function getprofesionPorId($id_profesion) {
		return R::load ( 'profesion', $id_profesion );
	}
	
	public function getprofesionPorNombre($nombre) {
		$profesion = R::findOne ( "profesion", "nombre=?", [
				$nombre
		] );
		if ($profesion == null) {
			return true;
		} else {
			return false;
		}
	}
	
	public function editar($id_profesion, $nuevo_nombre) {
		$profesion = R::load ( 'profesion', $id_profesion );
		if ($profesion->id != 0) {
			$profesion->nombre = $nuevo_nombre;
			R::store ( $profesion );
		} else {
			throw new Exception ( "La profesión no existe" );
		}
		R::close ();
	}
	
	public function borrar($id_profesion) {
	    $profesion = R::load ( 'profesion', $id_profesion );
	    $profesion->activo = 'Inactivo';
	    R::store ( $profesion );
	}
	
	public function activar($id_profesion) {
	    $profesion = R::load ( 'profesion', $id_profesion );
	    $profesion->activo = 'Activo';
	    R::store ( $profesion );
	}
}

?>