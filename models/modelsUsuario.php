<?php

class modelUsuario extends modelModelo{
	//Nombre de tabla
    public $nombre_tabla = 'USUARIO';
	//LLave primaria
    public $pk = 'id_usuario';
    
    //Columnas
    public $atributos 		= array(
        'user'				=>array(),
        'name'				=>array(),
		'mail'				=>array(),
        'password'			=>array(),
		'reset_password'	=>array(),
		'tipo'				=>array(),
    );
    
	//Variable que almacena errores o éxito
    public $errores = array();
	public $success	= array();
    
	//Variables locales para manejo de columnas
    private $user;
    private $name;
	private $mail;
    private $password;
	private	$reset_password;
	private	$tipo;
	
    
    function usuario(){
        parent::modelo();
    }
    
	/**
		Obtener atributos
	*/
    public function get_atributos(){
        $rs = array();
        foreach ($this->atributos as $key => $value) {
            $rs[$key]=$this->$key;
        }
        return $rs;
    }
    
    /**
		Obetener Valores de cada atributo
	**/
    public function get_user(){
        return $this->user;
    } 
	public function get_name(){
        return $this->name;
    }
	public function get_mail(){
        return $this->mail;
    }
	public function get_password(){
        return $this->password;
    }
	public function get_reset_password(){
        return $this->reset_password;
    }
	public function get_tipo(){
        return $this->tipo;
    }

	/**
		Asignar valores a cada atributo
	**/
	//Asignar valor a atributo user, único
    public function set_user($valor){
		///Expresión regular para validad estructura nombre
        $er = new RegularExpression();
        if ( !$er->valida_nombre($valor) ){
            $this->errores[] = 'User not valid, special characters and numbers are not allowed, length 3-25 characters.';
        }else{
			//Validar que no exista un registro identico
			$rs = $this->consulta_sql('select user from USUARIO where user = "'.$valor.'"');
			$rows = $rs->GetArray();
			if(count($rows) > 0){
				$this->errores[] = 'User name not available.'; 
			}else{
				$this->user = trim($valor);
			}
		}        
    }
	//Asignar valor a atributo nombre
    public function set_name($valor){

		///Expresión regular para validad estructura nombre
        $er = new Er();
        if ( !$er->valida_nombre($valor) ){
            $this->errores[] = "Nombre ".$valor." NO valido ";
        }

        $rs = $this->consulta_sql("select * from USUARIO where name = '$valor'");
        $rows = $rs->GetArray();
        
        if(count($rows) > 0){
            $this->errores[] = "Este nombre (".$valor.") ya esta registrado"; 
        }else{
            $this->nombre = trim($valor);
        }
    }
	public function set_mail($valor){
        $this->mail = $valor;
    }
    //Asignar contraseña a atributo contraseña
    public function set_password($valor){
        $this->password = trim( md5($valor) );
    }
	/*
	*/
	public function set_reset_password($valor){
		$this->reset_password= $valor;
	}
	
	/**
	FUNCINO PARA ACTUALIZAR EN BD
	
	@id		Id del atributo a modificar
	@atrib	Arreglo coon estrustura @atrib['nombre de la columna'] => Valor nuevo
	*/
	public function set_bd($id,$atrib){
		if (is_integer($id)) {		
			$sql = "SELECT * FROM  " . $this->nombre_tabla . " 
                WHERE ".$this->pk." = " . $id;
			$record = $this->db->Execute($sql);
			
			$sql_update = $this->db->GetUpdateSQL($record, $atrib);
			$this->actualiza($sql_update);
		}else{
			die('OJO id no es entero (int() @variable) ');
		}
	}
	
	
	/***
		FUNCIÓN PARA INSERTAR REGISTRO EN BD
		
		@data	Arreglo con estructura @data['nombre de la columna'] => valor insertado
	*/
	public function insert_bd($data){
	  //Verificar integridad de atributos
	    $er 		= new RegularExpression();
		$resultado 	= false;
		// 'user' sin caracteres especiales y longitud de 3-25 vcaracteres
		if ( !$er->valida_nombre($data['user']) ){
          $this->errores[] = 'User not valid, special characters and numbers are not allowed, length 3-25 characters.';
        }else{
		  // 'user' no existe en base de datos
		  $rs = $this->consulta_sql('select * from USUARIO where user = "'.$data['user'].'"');
		  $rows = $rs->GetArray();
		  if(count($rows) > 0){
			$this->errores[] = 'User name not available.'; 
		  }else{
			// 'name' sin caracteres especiales
			if( !$er->valida_texto($data['name'],5,100)){
			  $this->errores[] = 'NAME not valid, special characters and numbers are not allowed. length 5-100 characters.';
			}else{
			  // 'Mail' sin caracteres permitidos y extención de infinish
			  if( !$er->valida_mail_local($data['mail'],'infinishai.com.mx')){
				$this->errores[] = 'MAIL not valid, special characters and numbers are not allowed. only internal emails are allowed';
			  }else{
				// 'mail' no existe en base de datos
				$rs = $this->consulta_sql('select * from USUARIO where mail = "'.$data['mail'].'"');
				$rows = $rs->GetArray();
				if(count($rows) > 0){
				  $this->errores[] = 'User MAIL not available.'; 
				}else{
				  // validación 'reset_password' respuesta binaria 0 1
				  if($data['reset_password']<0 || $data['reset_password']>1){
					$this->errores[] = 'RESET PASSWORD not allowed.';
				  }else{
					//validación 'tipo' caracteres permitidos, sólo numeros enteros
					if(!$er->valida_numero_entero($data['tipo'])){
					  $this->errores[] = 'TIPO not allowed.';
					}else{
							//Insertar en BD
							$resultado = $this->inserta($rs, $data);
					}// validación 'tipo' expresión regular
				  }// validación 'reset_password' 
				}// validación 'mail' duplicidad
			  }// validación 'mail' expresión regular
			}// validación 'name' expresión regular
		  }// validación 'user' duplicidad
		}// validación 'user' expresión regular
		return $resultado;
	}
	
	/**
		FUNCIÓN PARA ELIMINAR UN REGISTRO EN LA BASE DE DATOS
	**/
	public function delete_db($id){
		$resul = false;
		//Validar id
		if(isset($id)&& $id>0){
			$resul = $this->elimina($id);
		}else{
			$this->errores[] = 'Could not delete record.';
		}
		return $resul;
	}
	
}

?>
