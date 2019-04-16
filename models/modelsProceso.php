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
	
	//Valiable para mensajes
	public $mensaje = array();
    
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
	
	/**
		FUNCION PARA OBTENER LOS VALORES DE UN REGISTRO POR ID
		@id		Valor de llave primaria para identificar el registro
	**/
	public function get_atrib_byID_proceso($id){
		if(!isset($id)){
			echo("error no hay id para get_atrib_byID_proceso");
		}else{
			$query = 'select name, description from '.$this->nombre_tabla.' where '.$this->pk.' = "'.(int)$id.'"';
			$rs = $this->consulta_sql($query);
			return $rs->GetArray();
		}
	}
	
	/**
		FUNCIÓN PARA INSERTAR UN REGISTRO NUEVO EN LA BD
		
		@$data		Arreglo con valores
	**/
	public function insert_proceso($data){
		//Verificar integridad de atributos
	    $er 		= new RegularExpression();
		$resultado 	= false;
		// 'name' sin caracteres especiales y longitud de 3-50 caracteres
		if ( !$er->valida_texto2($data['name'],3,50 )){
			$this->mensaje['danger']='NAME not valid, special characters are no allowed. length 3-50 characters.';
		}else{
		// 'name' no existe en bd
		$rs = $this->consulta_sql('select * from '.$this->nombre_tabla.' where name = "'.$data['name'].'"');
		$rows = $rs->GetArray();
		if(count($rows) > 0){
			$this->mensaje['danger'] = 'Process NAME not available.'; 
		}else{
			// 'description' sin caracteres especiales y longitud de 0-300 caracteres
			if(!$er->valida_texto2($data['description'],0,300 )){
				$this->mensaje['danger']='DESCRIPTION not valid, special characters are no allowed. length 0-300 characters.';
			}else{
					/**INSERTA**/
					$resultado = $this->inserta($rs, $data);
			}// 'discription' expresion regular
		}// 'name' no repetido en BD
		}// 'name' expresión regular
		return $resultado;
	}
	
	/**
		FUNCIÓN PARA ACTUALIZAR UN REGISTRO EN LA BD
		
		@ID 	identificador a actualizar
		@data	arreglo ordenado con las columnas y valores a actualizar
	**/
	public function update_proceso($id, $data){
		$er 		= new RegularExpression();
		$resultado 	= false;
		//Verificar integridad de atributos
		if(!isset($id)){
			$this->mensaje['danger']='Error en id_proceso. No declarada';
		}else{
		if((int)$id==0){
			$this->mensaje['danger']='Error en id_proceso. Valor 0';
		}else{
		if($id==''){
			$this->mensaje['danger']='Error en id_proceso. Valor ""';
		}else{
			// 'name' sin caracteres especiales y longitud de 3-50 caracteres
			if ( !$er->valida_texto2($data['name'],3,50 )){
				$this->mensaje['danger']='NAME not valid, special characters are no allowed. length 3-50 characters.';
			}else{
				// 'name' no se encuentra un registro identico en la tabla
				$rs = $this->consulta_sql('select * from '.$this->nombre_tabla.' where name = "'.$data['name'].'" and '.$this->pk.' != '.$id);
				$rows = $rs->GetArray();
				if(count($rows) > 0){
					$this->mensaje['danger'] = 'Process NAME not available.'; 
				}else{
					// 'description' sin caracteres especiales y longitud de 0-300 caracteres
					if(!$er->valida_texto2($data['description'],0,300 )){
						$this->mensaje['danger']='DESCRIPTION not valid, special characters are no allowed. length 0-300 characters.';
					}else{
							/**ACTUALIZA**/
							$sql = 'select * from '.$this->nombre_tabla.' where '.$this->pk.' = '.$id;
							$record = $this->db->Execute($sql);
							
							$sql_update = $this->db->GetUpdateSQL($record, $data);		
							if(empty($sql_update)){
								$this->mensaje['warning']='Without changes.';
							}else{
								$resultado = $this->actualiza($sql_update);
							}
					}// 'description'
			}}// 'name'
		}}}// 'id'
		return $resultado;
	}
	
	/**
		FUNCIÓN PARA ELIMINAR UN REGSITRO EN LA BD DE ACUERDO AL ID
		
		@id		Identificador del registro a eliminar
	**/
	public function delete_proceso($id){
		$resultado 	= false;
		if(!isset($id)){
			$this->mensaje['danger']='Error en id_proceso. No declarada';
		}else{
		if((int)$id==0){
			$this->mensaje['danger']='Error en id_proceso. Valor 0';
		}else{
		if($id==''){
			$this->mensaje['danger']='Error en id_proceso. Valor ""';
		}else{
				/**DELETE**/
				$sql = 'delete from '.$this->nombre_tabla.' where '.$this->pk.' = '.$id;
				$resultado = $this->elimina($sql);
		}}}// 'id'
		
		return $resultado;
	}
}

?>
