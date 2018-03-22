<?php
class Idioma_model extends CI_Model {
	
	public function crear_idioma($nombre) {
		$idioma = R::findOne ( "idiomas", "nombre=?", [ 
				$nombre 
		] );
		
		if ($idioma == null) {
			$idioma = R::dispense ( "idiomas" );
			$idioma -> nombre = $nombre;
			
			R::store ( $idioma );
		} else {
			throw new Exception ( "Error Processing Request", 1 );
		}
		R::close ();
	}

	public function getIdiomaPorNombre($nombre){
		$idioma = R::findOne("idiomas","nombre=?",[$nombre]);
		if ($idioma == null) {
			return true;
		} else {
			return false;
		}
	}

	public function getIdiomaPorId ( $id_idioma ) {
		return R::load("idiomas",$id_idioma);
	}
	
	public function getTodos($filtro='') {
		$mostrar = R::find("idiomas","nombre like ?", ["%".$filtro."%"]);
		return $mostrar;
	}


	/*			EDITADO Y BORRADO		*/

	public function editar_idioma($idId,$nuevo_nombre) {
		$idioma = R::load("idiomas",$idId);
		$idioma -> nombre = $nuevo_nombre;
		R::store($idioma);
		R::close();
	}

	public function borrar($id) {
		$lp = R::load ( 'lp', $id );
		if ($lp->id != 0) {
			R::trash ( $lp );
		}
		R::close ();
	}


}

?>