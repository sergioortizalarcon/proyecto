<?php
class Idioma_model extends CI_Model {
	public function crear_pais($nombre) {
		$idioma = R::findOne ( "idiomas", "nombre=?", [ 
				$nombre 
		] );
		
		if ($idioma == null) {
			$idioma = R::dispense ( "idiomas" );
			$idioma->nombre = $nombre;
			
			R::store ( $idioma );
		} else {
			throw new Exception ( "Error Processing Request", 1 );
		}
		R::close ();
	}
}

?>