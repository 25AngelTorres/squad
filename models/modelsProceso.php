<?php

class modelProceso extends modelModelo{
	//Nombre de tabla
    private $nombre_tabla = 'PROCESO';
	//LLave primaria
    private $pk = 'id_proceso';
    
    //Columnas
    public $atributosProceso 	= array(
        'name'			=>array(),
		'description'	=>array(),
    );
    
	//Variable que almacena errores o éxito
    public $erroresProceso = array();
	public $successProceso = array();
    
	//Variables locales para manejo de columnas
    private $name;
	private $description;
    
    function proceso(){
        parent::modelo();
    }
    
	/**
		Obtener atributos
	*/
    public function get_atributos_Proceso(){
        $rs = array();
        foreach ($this->atributosProceso as $key => $value) {
            $rs[$key]=$this->$key;
        }
        return $rs;
    }
    
	/**
		FUNCION PARA OPTENER Y ORDENAR REGISTRO
		
		@atrib	Atributos a obtener de la BD
		@orden	nuevo ordenamiento 
	**/
	public function get_atrib_toSelect_Proceso(){
		//Define las columnas a obtener de la BD
		$query = 'select id_proceso as value, name as option from '.$this->nombre_tabla.' Order by name';
		$rs = $this->consulta_sql($query);
		return $rs->GetArray();
	}
}

?>
