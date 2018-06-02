<?php

class Administrador extends CI_Controller {

	public function comprobarRol(){
		if (session_status () == PHP_SESSION_NONE) {session_start ();}
		if (isset ( $_SESSION ['rol'] ) && ($_SESSION['rol'] == 'administrador')) {
			return true;
		} else {
			return false;
		}
	}

	public function acceso_denegado(){
		$this->load -> view('templates_admin/access');
	}

	public function editarGet(){
		$this->load->model('administrador_model');
		$this->load->model('usuario_model');
		$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
		if ($idUser) {
			$datos['roles'] = $this->usuario_model->listar_roles();
			$datos['estados_usuarios'] = $this ->usuario_model->listar_estados();
			$datos['usuario'] = $this->administrador_model->getByID($idUser);
			enmarcar($this,"administrador/acciones_usuarios",$datos);
		}
	}

	//Por ID para visita perfil
	public function datos_user(){
		$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
		$this->load->model('administrador_model');
		session_start();
		if (strcmp($idUser,$_SESSION['idUser']) === 0) {
			$info = $this->administrador_model->getByID($idUser);
			$envio['info']['alias']=$info->alias;
			$envio['info']['nombre']=$info->nombre;
			$envio['info']['apellido_uno']=$info->apellido_uno;
			$envio['info']['apellido_dos']=$info->apellido_uno;
			$envio['info']['email']=$info->email;
			$envio['info']['fecha_nacimiento']=$info->fecha_nacimiento;
			$envio['info']['nombre']=$info->nombre;
			$this -> load -> model('pais_model');
			$pais = $this -> pais_model -> getPaisPorId($info->paises_id);
			$envio['info']['pais']= $pais -> nombre;
			print_r(json_encode($envio));
		} else {
			$datos['info']['texto'] = "Se ha producido algún error. Vuelve a intentarlo.";
			$datos['info']['nivel'] = 'error';
			print_r(json_encode($datos));
		}
	}


	// public function aviso_mensaje($texto,$nivel,$link=[]){
	// 	$datos['mensaje']['texto'] = $texto;
	// 	$datos['mensaje']['nivel'] = $nivel;
	// foreach($link as $key => $value){
	// $datos ['mensaje'] ['link'] [$key] = $value;
		
	// }
	// 	$this ->load ->view('templates_admin/mensaje', $datos);
	// }


		/*			ACCIONES CONTRA CUENTA DE USUARIO 			*/

	public function update_estado($idUser,$idEstado,$fechaBan,$messagetext) {
		if ($this -> comprobarRol()) {
			$this->load->model('administrador_model');
			if ($idUser!='' && $idEstado != '') {
				try {
					$accion = $this -> administrador_model -> editar_estado($idUser,$idEstado,$fechaBan,$messagetext);
					if ($accion > 0 ) {
						header('location: '.base_url().'administrador/editarEstOk');
					} else {
						header('location: '.base_url().'administrador/editarEstError');
					}
				} catch (Exception $e) {
					header('location: '.base_url().'administrador/editarEstError?error='.$e);
				}
			} else {
				header('location: '.base_url().'administrador/editarEstError?error=exist'.$accion);
			}
		} else {
			$this->acceso_denegado();
		}
		
	}

	public function editarEstOk() {
		$datos['mensaje']['texto'] = "El estado de la cuenta se ha actualizado correctamente.";
		$datos['mensaje']['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "administrador";
		enmarcar($this,'templates_admin/mensaje', $datos);
		header("Refresh:3;url=".base_url()."administrador/listar");
	}
	
	public function editarEstError() {
		if ( (isset($_GET['error'])) && ($_GET['error']=="exist") ) {
			$datos['mensaje']['texto'] = "Se ha producido un error al ejecutar la acción. Inténtalo de nuevo.";
			$datos['mensaje']['nivel'] = 'error';
			enmarcar($this,'templates_admin/mensaje', $datos);
			// header("Refresh:3;url=".base_url()."administrador/listar");
		} else {
			$datos['mensaje']['texto'] = "No existe el usuario al intentar actualizar el estado. Inténtalo de nuevo.";
			$datos['mensaje']['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "administrador";
			enmarcar($this,'templates_admin/mensaje', $datos);
			header("Refresh:3;url=".base_url()."administrador/listar");
		}
	}

	public function aplicarAccion() {
		if ($this -> comprobarRol()) {
			$this ->load -> model('administrador_model');
			$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
			$idRol = isset($_POST['idRol'])?$_POST['idRol']:null;
			$idEstado = isset($_POST['idEstado'])?$_POST['idEstado']:null;
			$estado_cuenta = $this-> administrador_model -> getByID($idUser);//obtengo los datos del usuario
			$fechaBan = isset($_POST['cntrl'])?$_POST['cntrl']:null;
			$messagetext = isset($_POST['messagetext'])?$_POST['messagetext']:null;

			if ($estado_cuenta['id'] != '0') {//Devolvería cero en caso de no existir el usuario
				echo ('<pre><code>'.$estado_cuenta['estados']['id'].', '.$idEstado.'</pre></code>');
				if ($estado_cuenta['estados']['id'] != $idEstado) {
					$this->update_estado($idUser,$idEstado,$fechaBan,$messagetext);
				} else if ($idRol != $estado_cuenta['roles']['id']) {
					$this->editarRolPost($idUser,$idRol);
				} else {
					$datos['mensaje']['texto'] = "No has hecho ningún cambio. Inténtalo de nuevo.";
					$datos['mensaje']['nivel'] = 'error';
					$datos ['mensaje'] ['link'] ['listar'] = "administrador";
					enmarcar($this,'templates_admin/mensaje', $datos);
				}
			} else {
				$datos['mensaje']['texto'] = "Se ha producido un error al cargar el usuario. Inténtalo de nuevo.";
				$datos['mensaje']['nivel'] = 'error';
				$datos ['mensaje'] ['link'] ['listar'] = "administrador";
				enmarcar($this,'templates_admin/mensaje', $datos);
			}
		} else {
			$this->acceso_denegado();
		}
	}


	public function editarRolPost($idUser,$idRol) {
		if ($this->comprobarRol()) {
			$this->load->model('administrador_model');
			$id_user = $idUser;
			$id_rol = $idRol;
			if ($id_user!='' && $id_rol != '') {
				try {
					$accion = $this -> administrador_model -> editar_rol_usuario($id_user,$id_rol);

					if ($accion>= 0 ) {
						header('location: '.base_url().'administrador/editarRolOk');
					} else {
						header('location: '.base_url().'administrador/editarRolError');
					}
				} catch (Exception $e) {
					header('location: '.base_url().'administrador/editarRolError');
				}
			} else {
				header('location: '.base_url().'administrador/editarRolError?error=exist');
			}
		} else {
			$this->acceso_denegado();
		}
	}

	public function editarRolOk() {
			$datos['mensaje']['texto'] = "El rol se ha actualizado correctamente.";
			$datos['mensaje']['nivel'] = 'ok';
			$datos ['mensaje'] ['link'] ['listar'] = "administrador";
			enmarcar($this,'templates_admin/mensaje', $datos);
			header("Refresh:3;url=".base_url()."administrador/listar");
	}
	
	public function editarRolError() {
		if ( (isset($_GET['error'])) && ($_GET['error']=="exist") ) {
			$datos['mensaje']['texto'] = "Se ha producido un error al ejecutar la acción. Inténtalo de nuevo.";
			$datos['mensaje']['nivel'] = 'error';
			enmarcar($this,'templates_admin/mensaje', $datos);
			header("Refresh:3;url=".base_url()."administrador/listar");
		} else {
			$datos['mensaje']['texto'] = "No existe el usuario o el rol. Inténtalo de nuevo.";
			$datos['mensaje']['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "administrador";
			enmarcar($this,'templates_admin/mensaje', $datos);
			header("Refresh:3;url=".base_url()."administrador/listar");
		}
	}

	/*			ACCIONES CONTRA CUENTA DE USUARIO 			*/



	public function listar($f='') {
		if ($this->comprobarRol()) {
			$this->load->model('administrador_model');
			$this->load->model('usuario_model');
			$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;

			$datos['roles'] = $this->usuario_model->listar_roles();
			$datos['usuarios'] = $this->administrador_model->getAll($filtro);
			$datos['filtro'] = $filtro;
			enmarcar($this,'administrador/listar',$datos);
		} else {
			$this->acceso_denegado();
		}
	}

	public function forgetPwdAd(){
		$this -> load ->view("templates_admin/forgotPassword");
	}


	/*	RECUPERACION DE PASSWORD */
	
	public function recuperarPwd() {
		enmarcar($this, "usuario/recuperarPwd");
	}
	
	public function resetPasswordUser() {
		if ($this->comprobarRol()) {
			$this-> load -> model("administrador_model");
			$correo = isset($_POST['correo'])?$_POST['correo']:null;
			$tokenAdm = isset($_POST["tken"])?1:null;
			$existe = false;
			if ($tokenAdm != null) {
				$existe = $this -> administrador_model ->comprobar_emailAdm($correo);
			}

			if (!$existe) {
				$this -> enviarCorreoAUsuario($correo);
			} else {
				$datos['mensaje']['texto'] = "El correo no es correcto o no existe en nuestros registros. Inténtalo de nuevo.";
				$datos['mensaje']['nivel'] = 'error';
				enmarcar($this,'templates_admin/forgotPassword', $datos);
			}
		} else {
			$this->acceso_denegado();
		}
	}


	public function perfilUsuario(){
		enmarcar($this,"administrador/perfilAdmin");
	}


//Para usar esto hay q instalar phpmailer ( con composer en la raiz del proyecto)
	public function enviarCorreoAUsuario ($correo) {
		$the_subject = "Primera prueba mailer";
		$email_user = "usuariodosfilms@gmail.com";
		$email_word = "usuarioDosFilm";
		$cuerpoMensaje = 'Probando etiquetas';
		$cuerpoMensaje .="<h1>Hola Mundo</h1>";
		$cuerpoMensaje .="<p>Acepta es pero entre etiquetas, no tildes</p>";
		$cuerpoMensaje .="Fecha y Hora: ".date("d-m-Y h:i:s");

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
		    $mail->Body = $cuerpoMensaje;
		    $mail->AltBody = 'Prueba xxx add-25';
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
		enmarcar($this,'templates_admin/forgotPassword', $datos);
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
		$this ->load ->view ('templates_admin/forgotPassword', $datos);
	}
	
	public function recuperacionErronea() {
		$datos['mensaje']['texto'] = "El email ingresado no existe en nuestros registros. ";
		$datos['mensaje']['nivel'] = 'error';
		$this ->load ->view ('templates_admin/forgotPassword', $datos);
	}
}