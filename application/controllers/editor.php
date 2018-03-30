<?php

class Editor extends CI_Controller {

	public function crear() {
		enmarcar($this,"articulo/publicarGet");
	}

	public function publicarPost(){
//En desarrollo, ver si coger mejor alias o id

		$this -> load -> model("editor_model");
		$this -> load -> model("usuario_model");
		$titulo= isset($_POST["titulo"])?$_POST["titulo"]:null;
		$contenido = isset($_POST["contenido"])?$_POST["contenido"]:null;
		$alias_autor = isset($_POST["alias_autor"])?$_POST["alias_autor"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;
		$ids_categorias = isset($_POST["ids_categorias"])?$_POST["ids_categorias"]:null;

		if ($alias_autor!=null) {
			$existe = $this -> usuario_model ->comprobar_alias($alias_autor);
			if (!$extiste) {
				try {
					$this -> editor_model -> publicar_articulo($titulo,$contenido,$alias_autor,$fecha,$ids_categorias);
				} catch (Exception $e ) {

				}
			}
		}
		 
	}

}