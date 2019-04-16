<?php

class modelSubproceso extends modelModelo{
	//Nombre de tabla
    private $nombre_tabla = 'SUBPROCESO';
	//LLave primaria
    private $pk = 'id_subproceso';
    
    //Columnas
    public $atributosSubproceso 	= array(
        'name'			=>array(),
		'description'	=>array(),
		'id_proceso'	=>array(),
    );
	
	//Valiable para mensajes
	public $mensaje = array();
    
    function subproceso(){
        parent::modelo();
    }
    
	/**
		Obtener atributos
	*/
    public function get_atributos_Subproceso(){
        $rs = array();
        foreach ($this->atributosSubproceso as $key => $value) {
            $rs[$key]=$this->$key;
        }
        return $rs;
    }
    
	/**
		FUNCION PARA OPTENER Y ORDENAR REGISTRO
		
		@atrib	Atributos a obtener de la BD
		@orden	nuevo ordenamiento 
	**/
	public function get_atrib_toSelect_Subproceso(){
		//Define las columnas a obtener de la BD
		$query = 'select '.$this->pk.' as value, name as option from '.$this->nombre_tabla.' Order by name';
		$rs = $this->consulta_sql($query);
		return $rs->GetArray();
	}
	
	/**
		FUNCION PARA OBTENER LOS VALORES DE UN REGISTRO POR ID
		@id		Valor de llave primaria para identificar el registro
	**/
	public function get_atrib_byID_subproceso($id){
		if(!isset($id)){
			echo("error no hay id para get_atrib_byID_subproceso");
		}else{
			$query = 'select name, description from '.$this->nombre_tabla.' where '.$this->pk.' = "'.(int)$id.'"';
			$rs = $this->consulta_sql($query);
			return $rs->GetArray();
		}
	}
	
	/**
		FUNCIÓN PARA OBTENER REGISTROS CON UN WHERE
	**/
	public function get_atrib_byWhere_subproceso($where){
		//Define las columnas a obtener de la BD
		$query = 'select '.$this->pk.' as value, name as option from '.$this->nombre_tabla.' where '.$where.' Order by name';
		$rs = $this->consulta_sql($query);
		return $rs->GetArray();
	}
	/**
		FUNCIÓN PARA ACTUALIZAR UN REGISTRO EN LA BD
		
		@ID 	identificador a actualizar
		@data	arreglo ordenado con las columnas y valores a actualizar
	**/
	public function update_subproceso($id, $data){
		$er 		= new RegularExpression();
		$resultado 	= false;
		//Verificar integridad de atributos
		if(!isset($id)){
			$this->mensaje['danger']='Error en id_subproceso. No declarada';
		}else{
		if((int)$id==0){
			$this->mensaje['danger']='Error en id_subproceso. Valor 0';
		}else{
		if($id==''){
			$this->mensaje['danger']='Error en id_subproceso. Valor ""';
		}else{
			// 'name' sin caracteres especiales y longitud de 3-50 caracteres
			if ( !$er->valida_texto2($data['name'],3,50 )){
				$this->mensajeProceso['danger']='NAME not valid, special characters are no allowed. length 3-50 characters.';
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
		FUNCIÓN PARA INSERTAR UN REGISTRO NUEVO EN LA BD
		
		@$data		Arreglo con valores
	**/
	public function insert_subproceso($data){
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
			$this->mensaje['danger'] = 'Subprocess NAME not available.'; 
		}else{
			// 'description' sin caracteres especiales y longitud de 0-300 caracteres
			if(!$er->valida_texto2($data['description'],0,300 )){
				$this->mensaje['danger']='DESCRIPTION not valid, special characters are no allowed. length 0-300 characters.';
			}else{
				//id_proceso número entero mayor a cero
				if(!(int)$data['id_proceso']>0){
					$this->mensaje['danger']='ID_PROCESO not valid.';
				}else{
					/**INSERTA**/
					$resultado = $this->inserta($rs, $data);
				}// 'id_proceso
			}// 'discription' expresion regular
		}// 'name' no repetido en BD
		}// 'name' expresión regular
		return $resultado;
	}
	
	/**
		FUNCIÓN PARA ELIMINAR UN REGSITRO EN LA BD DE ACUERDO AL ID
		
		@id		Identificador del registro a eliminar
	**/
	public function delete_subproceso($id){
		$resultado 	= false;
		if(!isset($id)){
			$this->mensaje['danger']='Error en id_subproceso. No declarada';
		}else{
		if((int)$id==0){
			$this->mensaje['danger']='Error en id_subproceso. Valor 0';
		}else{
		if($id==''){
			$this->mensaje['danger']='Error en id_subproceso. Valor ""';
		}else{
				/**DELETE**/
				$sql = 'delete from '.$this->nombre_tabla.' where '.$this->pk.' = '.$id;
				$resultado = $this->elimina($sql);
		}}}// 'id'
		
		return $resultado;
	}
	
	/**
		FUNCIÓN PARA CONOCER SI EXISTE RELACIÓN CON ID
	**/
	public function existe_where($id_proceso){
		$rs = $this->consulta_sql('select * from '.$this->nombre_tabla.' where id_proceso = "'.$id_proceso.'"');
		$rows = $rs->GetArray();
		if(count($rows) > 0){
			return true;
		}else{
			return false;
		}
	}
	
}

?>
