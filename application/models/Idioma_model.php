<?php
class Idioma_model extends CI_Model {
	// Se guardan en la tabla los datos del idioma, comprueba que no exista uno creado con los mismos datos
	public function crearIdioma($nombre, $estado) {
		$idioma = R::find ( 'idiomas', 'nombre like ?', [ 
				$nombre 
		] );
		if ($idioma == null) {
			$idioma = R::dispense ( 'idiomas' );
			$idioma->nombre = $nombre;
			$idioma->estado = $estado;
			R::store ( $idioma );
		} else {
			throw new Exception ( "idioma duplicado" );
		}
		R::close ();
	}
	
	// Devuelve todos los datos de todos las idiomas
	public function getTodos() {
		$mostrar = R::find ( "idiomas", "order by nombre" );
		return $mostrar;
	}
	
	// Devuelve un idioma mediante su id
	public function getIdiomaPorId($id_idioma) {
		return R::load ( 'idiomas', $id_idioma );
	}
	
	// Permite editar los datos del idioma, no puede repetir datos ni meterlos vacios
	public function editar($id_idioma, $nombre) {
		$idioma = R::load ( 'idiomas', $id_idioma );
		$idiomasTodos = R::find ( "idiomas", 'nombre like ?', [ 
				$nombre 
		] );
		$cambio = false;
		
		if ($idiomasTodos == null) {
			if ($nombre != $idioma->nombre && $nombre != "") {
				$idioma->nombre = $nombre;
				$cambio = true;
			}
			if ($cambio) {
				R::store ( $idioma );
			}
		}
	}
	// Permite desactivar un idioma mediante su id
	public function borrar($id_idioma) {
		$idioma = R::load ( 'idiomas', $id_idioma );
		$idioma->estado = 'Inactivo';
		R::store ( $idioma );
	}
	public function activar($id_idioma) {
		$idioma = R::load ( 'idiomas', $id_idioma );
		$idioma->estado = 'Activo';
		R::store ( $idioma );
	}
}

?>
