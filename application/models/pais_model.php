<?php

class Pais_model extends CI_Model {

	public function create_pais($nombre) {
		$pais = R::find("paises", "nombre like ?",[$nombre]);

		if ($pais != null) {
			$pais = R:: dispense("paises");
			$pais -> nombre = $nombre;
			
			R::store($pais);
			R::close();
		} else {
			throw new Exception("Error Processing Request", 1);
		}
		R::close();
	}
}


?>