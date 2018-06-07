<?php
class genero_model extends CI_Model {
	public function crear_genero($nombre) {
		$genero = R::findOne ( "generos", "nombre=?", [
				$nombre
		] );

		if ($genero == null) {
			$genero = R::dispense ( "generos" );
			$genero->nombre = $nombre;
				
			R::store ( $genero );
		} else {
			throw new Exception ( "Error al crear el género" );
		}

		R::close ();
	}
	public function getTodos($filtro='') {
		$todos = R::find ( "generos", "nombre like ? order by nombre ASC", [
				"%" . $filtro . "%"
		] );
		return $todos;
	}
	public function filtrar($filtro = '') {
		return R::find ( 'generos', 'nombre like ?', [
				'%' . $filtro . '%'
		] );
	}
	public function getgeneroPorId($id_genero) {
		return R::load ( 'generos', $id_genero );
	}
	public function getgeneroPorNombre($nombre) {
		$genero = R::findOne ( "generos", "nombre=?", [
				$nombre
		] );
		if ($genero == null) {
			return true;
		} else {
			return false;
		}
	}
	public function editar($id_genero, $nuevo_nombre) {
		$genero = R::load ( 'generos', $id_genero );
		if ($genero->id != 0) {
			$genero->nombre = $nuevo_nombre;
			R::store ( $genero );
		} else {
			throw new Exception ( "El género no existe" );
		}
		R::close ();
	}
	public function borrar($id_genero) {
		$genero = R::load ( 'generos', $id_genero );
		if ($genero->id != 0) {
			R::trash ( $genero );
		}
		R::close ();
	}
}

?>