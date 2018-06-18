<?php
class Pelicula_model extends CI_Model {

    public function createPelicula ( $titulo, $tituloOriginal, $adulto, $fechaLanzamiento, $popularity, $lenguage, $cadRepartosDirector, $cadRepartosActor, $cadGeneros, $sinopsis, $foto, $estado) {
        $pelicula = R::find('peliculas', 'titulo = ? and tituloOriginal = ? and fechaLanzamiento = ?', [$titulo,$tituloOriginal,$fechaLanzamiento]);
        if ($pelicula == null) {
            $pelicula = R::dispense ( 'peliculas' );
            $pelicula -> titulo = $titulo;
            $pelicula -> titulo_original = $tituloOriginal;
            $pelicula -> adulto = $adulto;
            $pelicula -> fecha_lanzamiento = $fechaLanzamiento;
            $pelicula -> popularidad = $popularity;
            $pelicula -> votos_totales = 0;
            $pelicula -> suma_total_votos = 0;
            $pelicula -> media_votos_totales = 0;
            $pelicula -> sinopsis = $sinopsis;
            $pelicula -> ruta_cartel = base_url().$foto;
            $pelicula -> estado = $estado;
            $pelicula -> original_language = $lenguage;
            $pelicula -> id_tmdb = 0;

            foreach ($cadGeneros as $genero) {
                $pelicula->sharedGenerosList[] = R::load('generos',$genero);
            }

            foreach ($cadRepartosDirector as $director) {
                $pelicula->sharedRepartosList[] = R::load('repartos',$director);
            }
            // foreach ($cadRepartosActor as $actor) {
            //     $pelicula->sharedRepartosList[] = R::load('repartos',$actor);
            // }

            R::store($pelicula);

        } else {
            throw new Exception("Película duplicada");
        }
        R::close();
    }
	public function getPeliculaPorTitulo($nombre,$tmdb){
		$pelicula = R::findOne("peliculas","titulo like ? and id_tmdb like ?",[$nombre,$tmdb]);
		if ($pelicula == null) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getUltimas() {
		return R::findAll("peliculas", "estado like ? order by id desc limit 12",['Activo']);
	}

	public function getAll() {
		return R::findAll("peliculas");
	}
	
	public function getAllActive() {
		return R::findAll("peliculas","estado like ?", ['Activo']);
	}

	public function getPeliculaPorId ( $id_pelicula ) {
	    return R::load("peliculas",$id_pelicula);
	}
	
    //De tmdb
    public function insertPelicula($id,$title,$original_title,$poster_path,$popularity,$release_date,$adult,$original_language,$overview,$genre_ids,$estado) {
        $pelicula = R::findOne('peliculas','id_tmdb = ? and titulo_original = ? and titulo = ?',[$id,$original_title,$title]);
        if ($pelicula == null) {
            $nueva_pelicula = R::dispense('peliculas');
            $nueva_pelicula -> titulo = $title;
            $nueva_pelicula -> titulo_original = $original_title;
            $nueva_pelicula -> ruta_cartel = $poster_path;
            $nueva_pelicula -> popularidad = $popularity;
            $nueva_pelicula -> votos_totales = 0;
            $nueva_pelicula -> media_votos_totales = 0;
            $nueva_pelicula -> suma_total_votos = 0;
            $nueva_pelicula -> fecha_lanzamiento= $release_date;
            $nueva_pelicula -> adulto= $adult;
            $nueva_pelicula -> original_language= $original_language;
            $nueva_pelicula -> sinopsis= $overview;
            $nueva_pelicula -> id_tmdb = $id;
            $nueva_pelicula -> estado = $estado; 
            foreach ($genre_ids as $id_g) {
                $nueva_pelicula->sharedGenerosList[] = R::load('generos',$id_g);
            }
            R::store($nueva_pelicula);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
        R::close();
    }
		
    public function editarPelicula( $titulo, $tituloOriginal, $adulto, $fechaLanzamiento, $popularity, $lenguage, $cadRepartos, $cadGeneros, $sinopsis, $foto, $id_pelicula, $estado) {
		$pelicula = R::load ( 'peliculas', $id_pelicula );
		$pelicula -> titulo = $titulo;
		$pelicula -> titulo_original = $tituloOriginal;
		$pelicula -> adulto = $adulto;
		$pelicula -> fecha_lanzamiento = $fechaLanzamiento;
		$pelicula -> popularidad = $popularity;
		$pelicula -> sinopsis = $sinopsis;
		$pelicula -> ruta_cartel = $foto;
		$pelicula -> estado = $estado;
		$pelicula -> original_language = $lenguage;

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
		
	    R::close();
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


    public function buscarTitulo($valor){
        $v = R::find("peliculas","titulo LIKE ?",["%".$valor."%"]);
        return $v;
    }
}
?>