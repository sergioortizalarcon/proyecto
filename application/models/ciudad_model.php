<?php
class Ciudad_model extends CI_Model {
	public function create_ciudad($nombre_ciudad) {
		$ciudad = R::findOne('ciudad','nombre=?',[$nombre_ciudad]);
		if ($ciudad == null)  {
			$c = R::dispense ( 'ciudad' );
			$c -> nombre = $nombre_ciudad;
			R::store($c);
		}
		else {
			throw new Exception("ciudad duplicada");
		}
		R::close();
	}

	public function getAll($filtro='') {
		$mostrar = R::find("ciudad","nombre like ?", ["%".$filtro."%"]);
		return $mostrar;
	}
}
?>