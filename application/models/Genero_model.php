<?php
class Genero_model extends CI_Model {
	// Se guardan en la tabla los datos del género, comprueba que no exista uno creado con los mismos datos
	public function crearGenero($nombre, $estado) {
		$genero = R::find ( 'generos', 'nombre like ?', [ 
				$nombre 
		] );
		if ($genero == null) {
			$genero = R::dispense ( 'generos' );
			$genero->nombre = $nombre;
			$genero->estado = $estado;
			R::store ( $genero );
		} else {
			throw new Exception ( "genero duplicado" );
		}
		R::close ();
	}
	
	// Devuelve todos los datos de todos las géneros
	public function getTodos() {
		$mostrar = R::find ( "generos", "order by nombre" );
		return $mostrar;
	}
	
	// Devuelve todos los datos de todos las géneros
	public function getAllActive() {
	    $mostrar = R::find ( "generos", "estado like ?", ['Activo']);
	    return $mostrar;
	}
	
	// Devuelve un género mediante su id
	public function getGeneroPorId($id_genero) {
		return R::load ( 'generos', $id_genero );
	}
	
	// Permite editar los datos del género, no puede repetir datos ni meterlos vacios
	public function editar($id_genero, $nombre) {
		$genero = R::load ( 'generos', $id_genero );
		$generosTodos = R::find ( "generos", 'nombre like ?', [ 
				$nombre 
		] );
		$cambio = false;
		
		if ($generosTodos == null) {
			if ($nombre != $genero->nombre && $nombre != "") {
				$genero->nombre = $nombre;
				$cambio = true;
			}
			if ($cambio) {
				R::store ( $genero );
			}
		}
	}
	// Permite desactivar un género mediante su id
	public function borrar($id_genero) {
		$genero = R::load ( 'generos', $id_genero );
		$genero->estado = 'Inactivo';
		R::store ( $genero );
	}
	public function activar($id_genero) {
		$genero = R::load ( 'generos', $id_genero );
		$genero->estado = 'Activo';
		R::store ( $genero );
	}


	public function buscarGen($valor) {
		return $v = R::findAll("peliculas");
	}
}

?>
