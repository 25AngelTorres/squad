<?php

class modelUsuario extends modelModelo{
	//Nombre de tabla
    public $nombre_tabla = 'USUARIO';
	//LLave primaria
    public $pk = 'id_usuario';
    
    //Columnas
    public $atributos = array(
        'user'			=>array(),
        'name'			=>array(),
		'mail'				=>array(),
        'password'		=>array(),
		'reset_password'	=>array(),
    );
    
	//Variable que almacena errores
    public $errores = array( );
    
	//Variables locales para manejo de columnas
    private $user;
    private $name;
	private $mail;
    private $password;
	private	$reset_password;
	
    
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

	/**
		Asignar valores a cada atributo
	**/
	//Asignar valor a atributo usuario

    public function set_user($valor){

		///Expresión regular para validad estructura nombre
        $er = new Er();
        if ( !$er->valida_nombre($valor) ){
            $this->errores[] = "Usuario ".$valor." NO valido ";
        }

        $rs = $this->consulta_sql("select * from USUARIO where user = '$valor'");
        $rows = $rs->GetArray();
        
        if(count($rows) > 0){
            $this->errores[] = "Este usuario (".$valor.") ya esta registrado"; 
        }else{
            $this->usuario = trim($valor);
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
	
	
}

?>
