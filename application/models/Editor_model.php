<?php

class Editor_model extends CI_Model {

	public function publicar_articulo($titulo,$contenido,$alias_autor,$fecha,$ids_categorias) {
		
			$articulo = R::dispense("articulos");
			$articulo -> titulo = $titulo;
			$articulo -> contenido = $contenido;
			$articulo -> fecha = $articulo;
			foreach ($ids_categorias as $id_categoria) {
				$categoria = R::load('categorias',$id_categoria);
				$articulo -> sharedCategoriaList []= $id_categoria;
			}
			$autor -> xownArticuloList [] = $articulo;
			R::store($autor);
	}

}