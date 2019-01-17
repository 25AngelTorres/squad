<?php
/*
Contine las clases 
*/
	class controllerConfigUser extends modelUsuario{
		
		public $muestra_errores = false;
		public $muestra_exitos 	= false;
		public $dataUser		;
		
		//Constructor de clase
		function __construct(){
			 parent::conexion();
		}
		
		/**
			Función para obtener registros de BD y registrarlos en forma de arreglo
		**/
		public function pull_registros($id){
			$rs = $this->consulta_sql(' select * from USUARIO where id_usuario = "'.$id.'"');
        	$rows = $rs->GetArray();
			return $rows;
		}
		
		/**
			Función para modificar los valores de usuario
		**/
		public function push_registros($datos){
			//Verificar coincidencia de contraseñas
			if($datos['password1']===$datos['password2']){					
				//Actualizar registros
					if( isset($datos['user']) &&
						isset($datos['reset_password']) &&
						isset($datos['tipo'])){
						//Crear arreglo con valores
						$rowsAct =	array(
						'user'				=> $datos['user']				,
						'name' 				=> $datos['name']				,
						'mail'				=> $datos['mail']				,
						'password'			=> md5($datos['password1'])		,
						'reset_password'	=> (int)$datos['reset_password'],
						'tipo'				=> (int)$datos['tipo']			,
						);
					}else{
						//Crear arreglo con valores
						$rowsAct =	array(
						'name' 				=> $datos['name']			,
						'mail'				=> $datos['mail']			,
						'password'			=> md5($datos['password1'])	,
						'reset_password'	=> 0,
						);
					}
					
					//Verificar si se actualizará un registro o es un nuevo registro
					if(isset($datos['id_usuario'])	&& (int)$datos['id_usuario']>0){
						//Realiza la actualización en la BD
						if(!$this->set_bd((int)$datos['id_usuario'],$rowsAct)){
							$this->muestra_exitos	= true;
							$this->success[]		= 'successful update';
							
							//Enviar correo de confirmación
							//instancia de modelMail
							$mail = new modelMail();
							//Cuerpo del mensaje
							$menssage 	= 'The user information was modified in iQMS.
							Thanks';
							//Ausnto del mensaje
							$subject 	= 'iQMS user information ';
							$recipient	= $datos['mail'];
							
							//Funcion que envía el mail
							$mail->sendMail($recipient,$subject,$menssage);
						}else{
							$this->muestra_errores = true;
						}
					}else{
						//Realiza inserción en la BD
						if($this->insert_bd($datos)){
							$this->muestra_exitos	= true;
							$this->success[]		= 'Success adding user';
							//Enviar correo de confirmación
							//instancia de modelMail
							$mail = new modelMail();
							//Cuerpo del mensaje
							$menssage 	= 'Successfully registered user in iQMS.
							Thanks';
							//Ausnto del mensaje
							$subject 	= 'iQMS User Registration';
							$recipient	= $datos['mail'];
							
							//Funcion que envía el mail
							$mail->sendMail($recipient,$subject,$menssage);
						}else{
							$this->muestra_errores = true;
						}
					}
			}else{
				$this->muestra_errores = true;
				$this->errores[] = 'Passwords do not match';
			}
		}
		
		
		/**
			FUNCIÓN PARA ELIMINAR Registros
		**/
		public function delete_registros($data){
			if($this->delete_db((int)$data['id_usuario'])){
				$this->muestra_exitos	= true;
				$this->success[]		= 'Success deleting user';
				//Enviar correo de confirmación
				//instancia de modelMail
				$mail = new modelMail();
				//Cuerpo del mensaje
				$menssage 	= 'Successfully deleted user information in IQMS.
				Thanks';
				//Ausnto del mensaje
				$subject 	= 'iQMS User Deleted';
				$recipient	= $data['mail'];
				
				//Funcion que envía el mail
				$mail->sendMail($recipient,$subject,$menssage);
			}else{
				$this->muestra_errores = true;
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
		
		
		public function do_select_option($id,$class,$name,$valor,$texto){
			//Generar consulta BD
			$rs = $this->consulta_sql(' select id_usuario,user from USUARIO');
        	$rows = $rs->GetArray();

			return $this->do_select($id,$class,$name,$rows,$valor,$texto);
		}
		
		/**
		Función para general select con usuarios y primer registro diferentes
		@id			- Id para <SELECT>
		@class		- Clase para >SELECT>
		@option		- Arreglo que contiene las opciones
		@valor		- valor para el primer registro (Diferente)
		@texto		- Información dentro del opcion diferente
		**/
		private function do_select($id,$class,$name,$option,$valor,$texto){
			$element = 
				'<select id="'.$id.'" class="'.$class.'" name="'.$name.'">	
			';
			if(isset($valor) && isset($texto)){
				$element.=	'<option value="'.$valor.'" selected>'.$texto.'</option>';
			}		
			foreach ($option as $key => $value) {
				$element.='<option value="'.$value['id_usuario'].'">'.$value['user'].'</option>';
			}	
			$element.= '
				</select>
			';
			return $element;
		}
	}
?>