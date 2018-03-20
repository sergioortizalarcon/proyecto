<?php
class Actor_model extends CI_Model {
	public function createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad) {
		if ($apellido2 == "") {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ?', [$nombre,$apellido1]);
			if ($actor == null) {
				$a = R::dispense ( 'actor' );
				$a -> nombre = $nombre;
				$a -> apellido1 = $apellido1;
				$a -> apellido2 = $apellido2;
				$a -> fechaNac = $fechaNacimiento;
				$a -> nacionalidad = $nacionalidad;
				R::store($a);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		} else {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ? and apellido2 like ?', [$nombre,$apellido1,$apellido2]);
			if ($actor == null) {
				$a = R::dispense ( 'actor' );
				$a -> nombre = $nombre;
				$a -> apellido1 = $apellido1;
				$a -> apellido2 = $apellido2;
				$a -> fechaNac = $fechaNacimiento;
				$a -> nacionalidad = $nacionalidad;
				R::store($a);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		}
	}

	public function getAll($filtro='') {
		$mostrar = R::find("actor","nombre like ? or apellido1 like ? or apellido2 like? order by apellido1,apellido2,nombre", ["%".$filtro."%","%".$filtro."%","%".$filtro."%"]);
		return $mostrar;
	}
}
?>