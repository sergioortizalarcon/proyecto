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
			throw new Exception ( "Error al crear el idioma");
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
		if ($idioma->id!=0){
			$idioma -> nombre = $nuevo_nombre;
			R::store($idioma);
		} else {
			 throw new Exception("Idioma inexistente.");
		}
		R::close();
	}

	public function borrar_idioma($id_idioma) {
		$idioma = R::load ( 'idiomas', $id_idioma );
		if ($idioma->id != 0) {
			R::trash ( $idioma );
		}
		R::close ();
	}


}

?>