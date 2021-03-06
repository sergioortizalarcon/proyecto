<?php

// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\src\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';

class Usuario extends CI_Controller {
	
	public function registrar(){
		$this -> load -> model("pais_model");
		$datos["paises"] = $this -> pais_model -> getTodos();
		enmarcar($this, "usuario/registrar",$datos);
	}
	
	/*1.- COMPROBACIONES PARA REGISTRARSE  */
	
	public function comprobarDispAlias() {
		$this -> load -> model("usuario_model");
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$comprobacion = $this -> usuario_model -> comprobar_alias($alias);
		if ($comprobacion) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	public function comprobarDispCorreo() {
		$this -> load -> model("usuario_model");
		$correo = isset($_POST["correo"])?$_POST["correo"]:null;
		$comprobacion = $this -> usuario_model -> comprobar_email($correo);
		if ($comprobacion) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	/* 2.- REGISTRO Y REDIRECCION */
	public function crearPost() {
		$this -> load -> model("usuario_model");
		$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;
		$ape1 = isset($_POST["apellido1"])?$_POST["apellido1"]:null;
		$ape2 = isset($_POST["apellido2"])?$_POST["apellido2"]:"";
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$email = isset($_POST["correo"])?$_POST["correo"]:null;
		$pwd = isset($_POST["hash_passwrd"])?$_POST["hash_passwrd"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;
		$idPais = isset($_POST["pais"])?$_POST["pais"]:null;

		try {
			$comprobacion = $this -> usuario_model -> comprobar_usuario($alias, $email);
			if ($comprobacion) {
				$ver = $this -> usuario_model -> create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha,$idPais);
				header('Location:'.base_url().'usuario/crearOk');
			} else {
				header('Location:'.base_url().'usuario/crearError');
			}
		} catch (Exception $e) {
			$datos['mensaje']['texto'] = "Error al crear nuevo usuario.<pre><code>".$e.'</code></pre>';
			$datos['mensaje']['nivel'] = 'error';
			$this->load->view("usuario/mensaje",$datos);
		}
	}

	public function crearOk() {
		$datos['mensaje']['texto'] = "Usuario creado correctamente.Rediriendo al login...";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this, 'usuario/mensaje', $datos);
		header("Refresh:3;url=".base_url().'login/loginGet');
	}
	
	public function crearError() {
		$datos['mensaje']['texto'] = "El correo o alias ya existe, intentalo de nuevo.";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this, 'usuario/mensaje', $datos);
	}


	/* RECUPERAR Password*/
	public function recuperarPwd() {
		enmarcar($this, "usuario/recuperarPwd");
	}
	
	public function recuperarPost() {
		$this-> load -> model("usuario_model");
		$correo = isset($_POST['correo'])?$_POST['correo']:null;
		$existe = $this -> usuario_model ->comprobar_email($correo);
		if (!$existe) {
			$this -> enviarCorreoAUsuario($correo);
		} else {
			$datos['mensaje']['texto'] = "El correo no existe en la base.";
			$datos['mensaje']['nivel'] = 'error';
			enmarcar($this, 'usuario/mensaje', $datos);
		}
	}
	





//Para usar esto hay q instalar phpmailer ( con composer en la raiz del proyecto)
	public function enviarCorreoAUsuario ($correo) {
	
		$mail = new PHPMailer(true); 
		try {
			$mail->CharSet = 'UTF-8';
				//Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $email_user;                 // SMTP username
		    $mail->Password = $email_word;                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to
		    //Recipients
		    $mail->setFrom($email_user, 'Admin Films');
		    $mail->addAddress($correo, 'Joe User');     // Add a recipient
		    //$mail->setLanguage('es','includes/phpmailer/language');   no funciona
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $the_subject;
		    $mail-> Body = $cuerpoMensaje;
		    $mail->AltBody = 'Prueba xxx add-25';
			$the_subject = "Primera prueba mailer";
			$email_user = "usuariodosfilms@gmail.com";
			$email_word = "usuarioDosFilm";
			$cuerpoMensaje = 'Probando etiquetas';
			$cuerpoMensaje .="<h1>Hola Mundo</h1>";
			$cuerpoMensaje .="<p>Acepta es pero entre etiquetas, no tildes</p>";
			$cuerpoMensaje .="Fecha y Hora: ".date("d-m-Y h:i:s");
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
		    $exito =  $mail->send();

			if($exito){
				header('Location:'.base_url().'usuario/recuperacionOk?enviado');
			} else {
				header('Location:'.base_url().'usuario/recuperacionErronea');
			}
			/*
			Los mensajes enviados por smtp no se guardan así q si se quieren guardar se debe usar IMAP

			Los comandos IMAP requieren la extensión PHP IMAP, que se encuentra en: https://php.net/manual/en/imap.setup.php
			Función para llamar que usa las funciones PHP imap _ * () para guardar mensajes: https://php.net/manual/en/book.imap.php
 			Puedes usar imap_getmailboxes ($ imapStream, '/ imap / ssl') para obtener una lista de carpetas o etiquetas disponibles, esto puede
			ser útil si intentas hacer que esto funcione en un servidor IMAP que no sea de Gmail.
			 if ($this->save_mail($mail)) {
			 echo "Message saved!";
			 } 
	*/
		} catch (Exception $e) {
		$datos['mensaje']['texto'] = "Ocurrió un error inesperado con él envió del correo electrónico, inténtelo de nuevo más tarde, disculpa las molestias. $e";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this, 'usuario/mensaje', $datos);
		}
	
	}
/*

	 function save_mail($mail)
	 {
	 //You can change 'Sent Mail' to any other folder or tag
	 $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
	 //Indique a su servidor que abra una conexión IMAP con el mismo nombre de usuario y contraseña que usó para SMTP
	 $imapStream = imap_open($path, $mail->Username, $mail->Password);
	 $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
	 imap_close($imapStream);
	 return $result;
	 }
	 */
	
	public function recuperacionOk() {
		$datos['mensaje']['texto'] = "Se envió correctamente el correo electrónico.";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this, 'usuario/mensaje', $datos);
	}
	
	public function recuperacionErronea() {
		$datos['mensaje']['texto'] = "El email ingresado no existe en nuestros registros. ";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this, 'usuario/mensaje', $datos);
	}


	/* VISTA USUARIO */
	public function perfilUsuario(){
		$this -> load -> model("pais_model");
		$datos["paises"] = $this -> pais_model -> getTodos();
		enmarcar($this,"login/perfilUser",$datos);
	}


	/* EDICION DE USUARIO */

	public function editarPost(){
		$this -> load -> model("administrador_model");
		$user_id =  isset($_POST["idUsuario"])?$_POST["idUsuario"]:null;
		$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;
		$ape1 = isset($_POST["apellido1"])?$_POST["apellido1"]:null;
		$ape2 = isset($_POST["apellido2"])?$_POST["apellido2"]:"";
		$email = isset($_POST["correo"])?$_POST["correo"]:null;
		$pwd = isset($_POST["hash_passwrd"])?$_POST["hash_passwrd"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;
		$idPais = isset($_POST["pais"])?$_POST["pais"]:null;
		$pwd_anterior = isset($_POST["ant_hash_passwrd"])?$_POST["ant_hash_passwrd"]:null;

		echo($user_id." - ".$nombre." - ".$ape1." - ".$ape2." - ".$email." - ".$pwd." - ".$fecha." - ".$idPais." - ".$pwd_anterior."<br/><br/>");
		$comprobarUser = $this->administrador_model->getByID($user_id);
		if ($comprobarUser) {
			$idPais =($idPais=='0')?$comprobarUser->paises_id:$idPais;
			// echo $comprobarUser->paises_id."<br>";echo $idPais;
			if ($nombre&&$ape1&&$email&&$fecha&&$idPais&&$pwd_anterior&&$pwd) {
				if ($comprobarUser['password'] == $pwd_anterior) {
					try{
						$this->administrador_model-> actualizar_datos_uno($comprobarUser['id'],$nombre,$ape1,$ape2,$email,$fecha,$idPais,$pwd);
						if ($comprobarUser['roles_id']=="3") {
							header('Location:'.base_url().'usuario/updateOk?cambio=1');
						} else {							
							header('Location:'.base_url().'usuario/updateOk');
						}
					}catch(Exception $e){
						if ($comprobarUser['roles_id']=="3") {
							header('Location:'.base_url().'usuario/updateError?cambio=1');
						} else {
							header('Location:'.base_url().'usuario/updateError');
						}
					}
				} else {
					if ($comprobarUser['roles_id']=="3") {
						header('Location:'.base_url().'usuario/updateError?cambio=1');
					} else {
						header('Location:'.base_url().'usuario/updateError');
					}
				}
			} elseif ($nombre&&$ape1&&$email&&$fecha&&$idPais&&$pwd_anterior) {
				if ($comprobarUser['password'] == $pwd_anterior) {
					try {
						$this->administrador_model-> actualizar_datos_dos($comprobarUser['id'],$nombre,$ape1,$ape2,$email,$fecha,$idPais);
						if ($comprobarUser['roles_id']=="3") {
							header('Location:'.base_url().'usuario/updateOk?cambio=1');
						} else {
							header('Location:'.base_url().'usuario/updateOk');
						}
					} catch(Exception $e) {
						if ($comprobarUser['roles_id']=="3") {
							header('Location:'.base_url().'usuario/updateError?cambio=1');
						} else {
							header('Location:'.base_url().'usuario/updateError');
						}
					}
				} else {
					if ($comprobarUser['roles_id']=="3") {
						header('Location:'.base_url().'usuario/updateError?cambio=1');
					} else {
						header('Location:'.base_url().'usuario/updateError');
					}
				}
			} else {
				if ($comprobarUser['roles_id']=="3") {
					header('Location:'.base_url().'usuario/updateError?cambio=1');
				} else {
					header('Location:'.base_url().'usuario/updateError');
				}
			}
		} else {
			if ($comprobarUser['roles_id']=="3") {
				header('Location:'.base_url().'usuario/updateError?cambio=1');
			} else {
				header('Location:'.base_url().'usuario/updateError');
			}
		}
	}

	public function updateOk() {
		$datos['mensaje']['texto'] = "Los cambios se han realizado correctamente. Redirigiendo...";
		$datos['mensaje']['nivel'] = 'ok';
		if ((isset($_GET['cambio'])) && ($_GET['cambio'] == "1")) {
			enmarcar($this, 'administrador/mensaje', $datos);
			header("Refresh:3;url=".base_url().'usuario/perfilUsuario');
		} else {
			enmarcar($this, 'usuario/mensaje', $datos);
			header("Refresh:3;url=".base_url().'usuario/perfilUsuario');
		}
	}

	public function updateError() {
		$datos['mensaje']['texto'] = "Se ha producido un error inesperado. Por favor, intentelo de nuevo.";
		$datos['mensaje']['nivel'] = 'error';
		if ((isset($_GET['cambio'])) && ($_GET['cambio'] == "1")) {
			enmarcar($this, 'administrador/mensaje', $datos);
			header("Refresh:3;url=".base_url().'usuario/perfilUsuario');
		} else {
			enmarcar($this, 'usuario/mensaje', $datos);
			header("Refresh:3;url=".base_url().'usuario/perfilUsuario');
		}
	}


	public function guardar_voto(){
		$this->load->model("Pelicula_model");
		$this->load->model("Administrador_model");
		$this->load->model("usuario_model");

		$id_peli = isset($_POST['postID'])?$_POST['postID']:null;
		$voto = isset($_POST['ratingPoints'])?$_POST['ratingPoints']:null;
		$id_user = isset($_POST['user'])?$_POST['user']:null;

		$ratingRow['status'] = 'err';
		if ($id_user != 0) {
			$usuario = $this->Administrador_model->getByID($id_user);
			$peli = $this->Pelicula_model->getPeliculaPorId($id_peli);
			if ($usuario->id!=0 && $peli->id!=0) {
				$p = $this->usuario_model->guardar_votacion_peli($id_peli,$voto,$id_user);
        		$ratingRow['status'] = 'ok';
        	}
    	}
    	if ($ratingRow['status'] == 'ok') {
    		$ratingRow['actualizacion'] =  $this->Pelicula_model->getPeliculaPorId($id_peli);
    	}

		
    //Return json formatted rating data
    echo json_encode($ratingRow);
	}


	public function buscador(){
		$this->load->model("pelicula_model");
		$this->load->model("reparto_model");
		$this->load->model("genero_model");
		$valor = isset($_POST["valor"])?$_POST["valor"]:null;//busqueda
		$indice= isset($_POST["indice"])?$_POST["indice"]:null;//bean
		$res="uno";
		if ($indice =="peliculas") {
			$res = $this->pelicula_model->buscarTitulo($valor);
			$datos["peliculas"]=$res;
		} else if ($indice =="reparto") {
			$res = $this->reparto_model->buscarRep($valor);
			$datos["repartos"]=$res;
		} else if($indice =="genero"){
			$res = $this->genero_model->buscarGen($valor);
				
			// 	foreach ($search->sharedGenerosList as $gen){
			// 		if ($gen == $valor) {
			// 			array_push($res,$search);
			// 		}
			// 	}
			// 	print_r($res);
			// }

		}
		
		enmarcar($this,"usuario/busqueda",$datos);
	}
	
}


?>