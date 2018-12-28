<?php
/*
Contine las clases 
*/
	class controllerLogin extends modelUsuario{
		
		public $muestra_errores = false;
		public $muestra_errores_reset = false;
		
		//Constructor de clase
		function __construct(){
			 parent::conexion();
		}
		
		/**
			Funcion para validad usuario
		**/
		public function login($datos){
				
			
			$rs = $this->consulta_sql(' select * from USUARIO where user = "'.$datos['user'].'"  ');
        	$rows = $rs->GetArray();
			
			/*
			echo "<pre>";
			print_r($rows);
			echo"\n Valida usuario";
			print_r($datos);
			echo md5($datos['password']);
			echo "</pre>";
			die();
			*/
			
        	if(count($rows) > 0){
        		if ($rows['0']['password']== md5($datos['password'])) {
        			$this->iniciarSesion($rows);
        		}else{
		     		$this->muestra_errores = true;
		     		$this->errores[] = 'Incorrect password';
		     	}
	     	}else{
	     		$this->muestra_errores = true;
	     		$this->errores[] = 'User not located';
	     	}

		}
		
		
		/**
		FUNCION QUE INICIA LA VARIABLE GLOBAR _SESSION
		
		@data	-	arreglo con información de usuario obtenida de la BD
		**/
		public function iniciarSesion($data){
			session_start();
			$_SESSION['usuario'] = $data['0']['user'];
			$_SESSION['id_usuario'] = $data['0']['id_usuario'];
			
			//Si la contraseña es temporal dirigir al formulario para actualizar contraseña
			if($data['0']["reset_password"]){
				//die("resetPassword");
				//header("Location: newPassword.php");
				header("Location: home.php");
				//Agregar notificación de cambio de contraseña, y crear nueva contraseña
			}else{
				header("Location: home.php");
			}
		}
	
		/**
		FUNCIÓN PARA CERRAR Y DESTRUIR LA SESION INICIADA
		**/
		public function cerrarSesion(){
			session_destroy();
		}
		
		
		/**
		Funcion que envia correo para recuperar contraseña
		
		-$post	-	Arreglo que contiene la informacion enviada del form
		**/
		public function recoverPassword($post){
			$rs = $this->consulta_sql(" select * from USUARIO where user = '".$post['userRecover']."'  ");
        	$rows = $rs->GetArray();
			
			if(count($rows) > 0){
				//Verificar que el correo es el mismo registrado
        		if (strcasecmp($rows['0']['mail'],$post['mailRecover'])==0) {
					//Función que crea la contraseña 
					$this->tempPassword($rows);
        		}else{
		     		$this->muestra_errores_reset = true;
		     		$this->errores[] = 'Recover password. Mail not located. contact the system administrator';
					
		     	}
	     	}else{
	     		$this->muestra_errores_reset = true;
	     		$this->errores[] = 'Recover password. User not located';
	     	}
		}
		
		/**
		Función que crea una contraseña temporal , actualiza la información en la BD y envia un correo de aviso
		
		@ROWS	-	Arreglo que contiene la informacion obtenida de la tabla de la BD
		**/
		private function tempPassword($rows){
			//instancia de modelMail
			$mail = new modelMail();
			
			//****Generar Random como contraseña
			$caracteres 	='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$numCaracteres	= 10;
			$tempPassword	= substr(str_shuffle($caracteres), 0, $numCaracteres);
			
			$this->set_password($tempPassword);
			
			//***Enviar nueva contraseña por correo
			//Cuerpo del mensaje
			$menssage 	= 'Se ha generado un nuevo password temporal para poder acceder a INFINISH QMS
			
			Password: '.$tempPassword;
			//Ausnto del mensaje
			$subject 	= 'INFINISH QMS Password ';
			$recipient	= $rows['0']['mail'];
			
			//Funcion que envía el mail
			$mail->sendMail($recipient,$subject,$menssage);
			
			//crear arreglo con nombre de columnas para actualizar en BD
			$rowsAct = array(
				'password' 			=>	array(),
				'reset_password'	=>	array(),
			);
			//Asignar valores a las columnas para actualizar BD
			$rowsAct['password']		= $this->get_password();
			$rowsAct['reset_password']	= 1;
			
			//Realiza la actualización en la BD
			if(!$this->set_bd((int)$rows['0']['id_usuario'],$rowsAct)){
				header("Location: login.php");
			}
		}
		
		
		function ActualizarPassword($id_usuario,$post){
			if (strcmp ($post['newPassword'] , $post['newPassword2']) == 0){
				$this->set_password($post['newPassword']);
				/****Actualizar valores en BD****/
				$rowsAct = array(
					'password' 		=>	array(),
					'rest_password'	=>	array(),
				);
				$rowsAct['password']		= $this->get_password();
				$rowsAct['reset_password']	= 0;
				
				//Realiza la actualización en la BD
				if(!$this->set_bd((int)$id_usuario,$rowsAct)){
					
					header("Location: home.php");
				}
			}else{
				$this->muestra_errores = true;
	     		$this->errores[] = 'Passwords not match';
			}
		}
		
	}
?>