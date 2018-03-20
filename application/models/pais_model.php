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
			throw new Exception ( "Error Processing Request", 1 );
		}
		R::close ();
	}
	public function getTodos() {
		return R::findAll ( 'pais', 'order by nombre' );
	}
}

?>