<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
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
			$envio['info']['id']=$info->id;
			$envio['info']['alias']=$info->alias;
			$envio['info']['nombre']=$info->nombre;
			$envio['info']['apellido_uno']=$info->apellido_uno;
			$envio['info']['apellido_dos']=$info->apellido_dos;
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

	public function generar_nuevo_password(){
		$longitud = 14;
		$psswd = substr( md5(microtime()), 1, $longitud);
		return $psswd;
	}
	
	public function resetPasswordUser() {
		$this-> load -> model("administrador_model");
		$correo = isset($_POST['correo'])?$_POST['correo']:null;
		$existe = false;
		$correo = filter_var($correo,FILTER_SANITIZE_EMAIL);

		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
		      header('Location:'.base_url().'usuario/recuperacionErronea?aviso=1');
		} else {
		    if (strlen($correo) < 10) {
		       header('Location:'.base_url().'usuario/recuperacionErronea?aviso=2');
		    } else {
		    	$existe = $this -> administrador_model ->getUsuario($correo);
				if ($existe != null) {
					$id_user = $existe['id'];
					$alias_user = $existe['alias'];
					$token = $this->generar_nuevo_password();
					$this-> administrador_model -> recuperar_pwd($token,$id_user);
					$envio = $this -> enviarCorreoAUsuario($correo,$alias_user,$token,$id_user);
					if($envio){
						header('Location:'.base_url().'usuario/recuperacionOk');
						// $datos['mensaje']['texto'] = "Se envió correctamente el correo electrónico.";
						// $datos['mensaje']['nivel'] = 'ok';
						// $this->load->view('usuario/mensaje', $datos);
					} else {
						header('Location:'.base_url().'usuario/recuperacionErronea');
					}
				} else {
					header('Location:'.base_url().'usuario/recuperacionErronea');
				}
			}
		}
	}


	public function perfilUsuario(){
		enmarcar($this,"administrador/perfilAdmin");
	}


//Para usar esto hay q instalar phpmailer ( con composer en la raiz del proyecto)
	public function enviarCorreoAUsuario($correo,$alias_user,$token,$user_id) {
		$url = base_url().'login/cambiar_pass?user_id='.$user_id.'&token='.$token;
		$the_subject = "Petición de recuperación de  contrase&ntilde;a.";
		$email_user = "usuariodosfilms@gmail.com";
		$email_word = "usuarioDosFilm";
		$cuerpoMensaje = "<strong>Hola ". $alias_user.",</strong><br/><br/>";
		$cuerpoMensaje .= 'Recientemente se solicitó la recuperación de la  contrase&ntilde;a asociada a la cuenta de correo: '.$correo;
		$cuerpoMensaje .="<br/>Fecha y Hora: ".date("d-m-Y h:i:s")."<br/>";
		$cuerpoMensaje .="Para cambian tu contrase&ntilde;a debes visitar la siguiente direcci&oacute;n: ".$url."<br/><br/>";
		$cuerpoMensaje .="Le recomendamos encarecidamente que actualice la  contrase&ntilde; después de iniciar sesión correctamente. <br/>Gracias, <br/><br/>";
		$cuerpoMensaje .="Att. Staff de blablabla<br/><br/>";
		$cuerpoMensaje .='<a href="#">WhatviewNow</a>';

		$mail = new PHPMailer(true); 
		try {
			$mail->CharSet = 'UTF-8';
			$mail->setLanguage('es');
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
			header('Location:'.base_url().'usuario/recuperacionOk');
		    $exito =  $mail->send();
			if($exito){
				return true;
			} else {
				return false;
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
		enmarcar($this,'usuario/mensaje', $datos);
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
		$datos['mensaje']['texto'] = "Hemos enviado un mensaje a tu correo electronico para restablecer tu password.<br />";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this,'usuario/mensaje', $datos);
	}
	
	public function recuperacionErronea() {
		if ((isset($_GET['aviso'])) && ($GET['aviso']=="1")) {
			$datos['mensaje']['texto'] = "Correo electrónico no válido";
		} else if((isset($_GET['aviso'])) && ($GET['aviso']=="2")) {
			$datos['mensaje']['texto'] = "El correo electrónico es demasiado corto";
		} else{
			$datos['mensaje']['texto'] = "El email ingresado no existe en nuestros registros. ";
		}
			$datos['mensaje']['nivel'] = 'error';
			enmarcar($this,'usuario/mensaje', $datos);
			header("Refresh:3;url=".base_url()."usuario/recuperarPwd");
	}

	public function vista_usuario(){
		if ($this->comprobarRol()) {
			if (session_status () == PHP_SESSION_NONE) {session_start ();}
			$_SESSION['vista_user']="permiso";
			header("Refresh:1;url=".base_url()."welcome/index");
		} else {
			$this->acceso_denegado();
		}
	}

	public function vista_admin(){
		if ($this->comprobarRol()) {
			if (session_status () == PHP_SESSION_NONE) {session_start ();}
			unset($_SESSION['vista_user']);
			header("Refresh:1;url=".base_url()."welcome/index");
		} else {
			$this->acceso_denegado();
		}
	}

	public function cambiarPwd(){
		$this->load->model("administrador_model");
		$email = isset($_POST['email'])?$_POST['email']:null;
		$hash_passwrd = isset($_POST['hash_passwrd'])?$_POST['hash_passwrd']:null;
		$token_confirmacion = isset($_POST['token_confirmacion'])?$_POST['token_confirmacion']:null;
		$user_id = isset($_POST['user_id'])?$_POST['user_id']:null;

		// echo ($email." - ".$hash_passwrd." - ".$token_confirmacion." - ".$user_id);
		if ($email && $hash_passwrd && $token_confirmacion && $user_id) {
			//si los valores no son nulos carga el usuario con los datos pasados
			$user = $this->administrador_model->confirmacion_reset_password($email,$token_confirmacion,$user_id);
			// print_r($user);
			if ($user != null) {
				$id_user = $user['id'];
				//en la linea anterior obtiene el id del usuario cargado y lo usa para actualizar la password
				$cambio = $this->administrador_model->update_pwd($hash_passwrd,$id_user);
				if ($cambio) {
					header("location:".base_url()."administrador/confirmarCambio");
				} else {
					header("location:".base_url()."administrador/CambioErroneo");
				}
			}
		}
	}

	public function confirmarCambio(){
		$datos['mensaje']['texto'] = "Se ha cambiado la contrase&ntilde;a correctamente. Redirigiendo al login...";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this,'usuario/mensaje', $datos);
		header("Refresh:3;url=".base_url()."login/loginGet");
	}

	public function CambioErroneo(){
		$datos['mensaje']['texto'] = "Error, no se ha podido cambiar la contrase&ntilde;a. Redirigiendo a la pagina principal...";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this,'usuario/mensaje', $datos);
		header("Refresh:3;url=".base_url());
	}

		/*		BLOQUEO DE CUENTA			*/	

	public function cancelarCuenta(){
		$this->load->model("administrador_model");
		$user_id= isset($_POST["idUsu"])?$_POST["idUsu"]:null;
		$pwd = isset($_POST["hash_pwd"])?$_POST["hash_pwd"]:null;
		$existe = $this->administrador_model->getByID($user_id);
		if ($existe['id']!=0) {
			try{
				$this->administrador_model->borrar($existe['id'],$pwd);
				header("location:".base_url()."login/loginOut");
			} catch (Exception $e) {
				header("location:".base_url()."administrador/borradoError");
			}
		} else {
			header("location:".base_url()."administrador/borradoError");
		}
	}

	public function borradoError() {
		$datos['mensaje']['texto'] = "Se ha producido un error. Inténtelo de nuevo. Si sigue teniendo problemas pongase en conctato con un administrador.";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this,"usuario/mensaje",$datos);
	}


}