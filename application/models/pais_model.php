<?php
class Pais_model extends CI_Model {
	public function crear_pais($nombre) {
		$pais = R::findOne ( "paises", "nombre=?", [ 
				$nombre 
		] );
		
		if ($pais == null) {
			$p = R::dispense ( "paises" );
			$p->nombre = $nombre;
			
			R::store ( $p );
		} else {
			throw new Exception ( "Error" );
		}
	
		R::close ();
	}
	public function getTodos() {
		return R::findAll ( 'paises', 'order by nombre' );
	}
	public function filtrar($filtro = '') {
		return R::find ( 'paises', 'nombre like ?', [ 
				'%' . $filtro . '%' 
		] );
	}
	public function getPaisPorId($id_pais) {
		return R::load ( 'paises', $id_pais );
	}
	public function editar($id_pais, $nombre) {
		$pais = R::load ( 'paises', $id_pais );
		$pais->nombre = $nombre;
		R::store ( $pais );
	}
	public function borrar($id_pais) {
		$pais = R::load ( 'paises', $id_pais );
		R::trash ( $pais );
	}
}

?>