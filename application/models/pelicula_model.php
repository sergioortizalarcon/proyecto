<?php
class Pelicula_model extends CI_Model {
    //Se guarda en la tabla los datos de la película, comprueba que ya exista uno creado con los mismos datos
    public function createFilm ( $titulo, $anioEstreno, $duracion, $id_pais, $cadRepartos, $productora, $cadGeneros, $sinopsis, $foto, $estado) {
        $pelicula = R::find('peliculas', 'titulo like ? and anioEstreno like ? and duracion like ? and productora like ?', [$titulo,$anioEstreno,$duracion,$productora]);
        if ($pelicula == null) {
            $pelicula = R::dispense ( 'peliculas' );
            $pelicula -> titulo = $titulo;
            $pelicula -> anioEstreno = $anioEstreno;
            $pelicula -> duracion = $duracion;
            $pelicula -> productora = $productora;
            $pelicula -> sinopsis = $sinopsis;
            $pelicula -> rutaFoto = $foto;
            $pelicula -> estado = $estado;
            $generos = explode(",",$cadGeneros);
            for ($i=0;$i<count($generos);$i++) {
                $genero = R::load("generos",$generos[$i]);
                $genero -> sharedPeliculasList[] = $pelicula;
                R::store($genero);
            }
            $repartos = explode(",",$cadRepartos);
            for ($i=0;$i<count($repartos);$i++) {
                $reparto = R::load("repartos",$repartos[$i]);
                $reparto -> sharedPeliculasList[] = $pelicula;
                R::store($reparto);
            }
            $pais = R::load("paises", $id_pais);
            $pais -> xownPeliculasList[] = $pelicula;
            R::store($pais);
        } else {
            throw new Exception("Película duplicada");
        }
        R::close();
    }

	public function getPeliculaPorNombre($nombre){
		$idioma = R::findOne("peliculas","nombre=?",[$nombre]);
		if ($idioma == null) {
			return true;
		} else {
			return false;
		}
	}
	
	//Devuelve todos los datos de todas las películas
	public function getAll() {
	    $mostrar = R::find("peliculas","order by anio_estreno,titulo,productora");
	    return $mostrar;
	}
	
	public function getPeliculaPorId ( $id_pelicula ) {
	    return R::load("peliculas",$id_pelicula);
	}
	
	public function editar($id_pelicula, $titulo, $anioEstreno, $duracion, $id_pais, $reparto, $productora, $generos, $sinopsis, $foto) {
	    $pelicula = R::load ( 'peliculas', $id_pelicula );
	    $peliculasTodas = R::find("peliculas",'titulo like ? and anioEstreno like ? and duracion like ? and productora like ?', [$titulo,$anioEstreno,$duracion,$productora]);
	    $pais = R::load("paises", $id_pais);
	    //Editar generos y reparto segun los ids que vengan de la vista
	    $cambio=false;
	    
	    if ($peliculasTodas == null) {
	        if($titulo != $pelicula->titulo && $titulo != "") {
	            $pelicula->titulo = $titulo;
	            $cambio=true;
	        }
	        if($anioEstreno != $pelicula->anioEstreno && $anioEstreno != "") {
	            $pelicula->anioEstreno = $anioEstreno;
	            $cambio=true;
	        }
	        if($duracion != $pelicula->duracion && $duracion != ""){
	            $pelicula->duracion = $duracion;
	            $cambio=true;
	        }
	        if($productora != $pelicula->productora && $productora != "") {
	            $pelicula->productora = $productora;
	            $cambio=true;
	        }
	        if($sinopsis != $pelicula->sinopsis && $sinopsis != "") {
	            $pelicula->sinopsis = $sinopsis;
	            $cambio=true;
	        }
	        if($foto != "") {
	            $pelicula->rutaFoto = $foto;
	            $cambio=true;
	        }
	        if($pais != $pais->id) {
	            $pais -> xownPeliculaList[] = $pelicula;
	            R::store($pais);
	            $cambio=true;
	        }
	        //Me faltan generos y reparto(Tengo que ver como cambiar si vienen varios ids)
	        
	        if ($cambio) {
	            R::store ( $pelicula );
	        }
	    }
	}
	
	public function borrar($id_pelicula) {
	    $pelicula = R::load ( 'peliculas', $id_pelicula );
	    $pelicula->estado = 'Inactivo';
	    R::store ( $pelicula );
	}
	
	public function activar($id_pelicula) {
	    $pelicula = R::load ( 'peliculas', $id_pelicula );
	    $pelicula->estado = 'Activo';
	    R::store ( $pelicula );
	}
}
?>