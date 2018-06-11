<?php
class Pais_model extends CI_Model {
	// Se guardan en la tabla los datos del país, comprueba que no exista uno creado con los mismos datos
	public function crearPais($nombre, $activo) {
		$pais = R::find ( 'paises', 'nombre like ?', [ 
				$nombre 
		] );
		if ($pais == null) {
			$pais = R::dispense ( 'paises' );
			$pais->nombre = $nombre;
			$pais->activo = $activo;
			R::store ( $pais );
		} else {
			throw new Exception ( "país duplicado" );
		}
		R::close ();
	}
	
	// Devuelve todos los datos de todos las países
	public function getTodos() {
		$mostrar = R::find ( "paises", "order by nombre" );
		return $mostrar;
	}
	
	// Devuelve un país mediante su id
	public function getPaisPorId($id_pais) {
		return R::load ( 'paises', $id_pais );
	}
	
	// Permite editar los datos del país, no puede repetir datos ni meterlos vacios
	public function editar($id_pais, $nombre) {
		$pais = R::load ( 'paises', $id_pais );
		$paisessTodos = R::find ( "paises", 'nombre like ?', [ 
				$nombre 
		] );
		$cambio = false;
		
		if ($paisesTodos == null) {
			if ($nombre != $pais->nombre && $nombre != "") {
				$pais->nombre = $nombre;
				$cambio = true;
			}
			if ($cambio) {
				R::store ( $pais );
			}
		}
	}
	
	// Permite desactivar un país mediante su id
	public function borrar($id_pais) {
		$pais = R::load ( 'paises', $id_pais );
		$pais->activo = 'Inactivo';
		R::store ( $pais );
	}
	public function activar($id_pais) {
		$pais = R::load ( 'paises', $id_pais );
		$pais->activo = 'Inactivo';
		R::store ( $pais );
	}
}

?>