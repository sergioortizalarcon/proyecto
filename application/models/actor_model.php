<?php
class Actor_model extends CI_Model {
	public function create_actor($nombre_actor, $apellido1_actor, $apellido2_actor, $fechaNac_actor, $nacionalidad_actor) {
		$actor = R::findOne('actor','nombre=?',[$nombre_actor]);
		if ($actor == null)  {
			$a = R::dispense ( 'actor' );
			$a -> nombre = $nombre_actor;
			$a -> apellido1 = $apellido1_actor;
			$a -> apellido2 = $apellido2_actor;
			$a -> fechaNac = $fechaNac_actor;
			$a -> nacionalidad = $nacionalidad_actor;
			R::store($a);
		}
		else {
			throw new Exception("Actor duplicado");
		}
		R::close();
	}

	public function getAll($filtro='') {
		$mostrar = R::find("actor","nombre like ?", ["%".$filtro."%"]);
		return $mostrar;
	}
}
?>