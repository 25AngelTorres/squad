<?php
/*
Contine las clases 
*/
	class controllerDocumentationManagement extends modelModelo {
		
		public $mensaje_procesos 	= false;
		public $mensaje_subprocesos	= false;
		public $mensaje_documento	= false;
		public $mensaje_norma		= false;
		public $mensaje_revision	= false;
		public $msjProceso 		= array();
		public $msjSubproceso	= array();
		public $msjDocumento	= array();
		public $msjNorma 		= array();
		public $msjRevision		= array();
		
		public $alert = Array();

		//Constructor de clase
		function __construct(){
			 parent::conexion();
		}
		
		/**
			FUNCION PARA LA GESTION DE MENSAJES
		**/
		public function mensaje($tipo, $otherClass, $mensaje){
			$alert = '<div class= "alert alert-'.$tipo.' '.$otherClass.' "><button class="close" data-dismiss="alert"><span>&times;</span></button>'.$mensaje.'</div>';
			
			return $alert;
		}
		
		/**
			FUNCION PARA CREAR SELECT CON VALORES DE TABLA
		**/
		public function do_select($table, $idSelect, $nameSelect , $classSelect, $otroSelect, $option, $valueOption){
			//seleccion de acuerdo a la tabla
			switch ($table) {
				case "proceso":
					$db = new modelProceso();
					$opt = $db->get_atrib_toSelect_Proceso();
					break;
			}
			$element = 
				'<select id="'.$idSelect.'" class="'.$classSelect.'" name="'.$nameSelect.'" '.$otroSelect.'>';
			if(isset($option) && isset($valueOption)){
				$element.=	'<option value="'.$valueOption.'" selected>'.$option.'</option>';
			}
			foreach ($opt as $value) {
				$element.='<option value="'.$value['value'].'">'.$value['option'].'</option>';
			}	
			$element.= '
				</select>
			';
			echo($element);
		}
		
		/**
			FUNCION PARA OBTENER TODOS LOS VALORES DE UN REGISTRO DE LA TABLA
			 
			@id		llave primaria para obtener valores
		**/
		public function pull_data_proceso($id){
			$db = new modelProceso();
			return $db->get_atrib_byID_proceso($id);
		}
		/**
			FUNCION PARA OBTENER TODOS LOS VALORES DE UN REGISTRO DE LA TABLA
			 
			@id		llave primaria para obtener valores
		**/
		public function pull_data_subproceso($id){
			$db = new modelSubproceso();
			return $db->get_atrib_byID_subproceso($id);
		}
		
		/**
			FUNCIÓN PARA INSERTAR O MODIFICAR UN PROCESO
			
			@data	Información a insertar o modificar
		**/
		public function push_registro_proceso($data){
			$db = new modelProceso();
			if(isset($data['id_proceso'])){
				//Modificar
				$upd = array(
					'name'			=> $data['name'],
					'description'	=> $data['description'],
					);
				if($db->update_proceso($data['id_proceso'], $upd)){
					//Éxito al modificar
					$this->mensaje_procesos= true;
					$this->msjProceso['success']='Success updating PROCCESS';
				}else{
					//Fracaso al modificar
					$this->msjProceso = $db->mensaje;
					$this->mensaje_procesos= true;
				}
			}else{
				//Insertar
				if($db->insert_proceso($data)){
					//Éxito al insertar
					$this->mensaje_procesos= true;
					$this->msjProceso['success']='Success adding PROCCESS';
				}else{
					//Fracaso al insertar
					$this->msjProceso = $db->mensaje;
					$this->mensaje_procesos= true;
				}
			}
		}
		
		/**
			FUNCIÓN PARA ELIMINAR UN REGISTRO EN LA TABLA PROCESOS
		**/
		public function delete_registro_proceso($id){
			if(isset($id)){
				//Verificar que no se encuentre relación sobproceso
				$db = new modelSubproceso();
				if($db->existe_where($id)){
					//Fracaso al eliminar
					$this->mensaje_procesos= true;
					$this->msjProceso['danger']='Impossible to eliminate Process, there are created relationships.';
				}else{
					$db = new modelProceso();
					if($db->delete_proceso($id)){
						//Éxito al insertar
						$this->mensaje_procesos= true;
						$this->msjProceso['success']='Success deleting PROCCESS';
					}else{
						//Fracaso al eliminar
						$this->mensaje_procesos= true;
						$this->msjProceso['danger']='Impossible to eliminate PROCSESS.';
					}
				}
			}else{
				//Fracaso al eliminar
				$this->mensaje_procesos= true;
				$this->msjProceso['warning']='Impossible to eliminate, PROCCESS not selected.';
			}
		}
		
		
		/**
			FUNCIÓN PARA OPTENER REGISTROS CON UN WHERE
		**/
		public function pull_data_subproceso_where($where){
			$db = new modelSubproceso();
			return $db->get_atrib_byWhere_subproceso($where);
		}
		/**
			FUNCIÓN PARA INSERTAR O MODIFICAR UN SUBPROCESO
			
			@data	Información a insertar o modificar
		**/
		public function push_registro_subproceso($data){
			$db = new modelSubproceso();
			if(isset($data['id_subproceso'])){
				//Modificar
				$upd = array(
				'name'			=> $data['name'],
				'description'	=> $data['description'],
				);
				if($db->update_subproceso($data['id_subproceso'], $upd)){
					//Éxito al modificar
					$this->mensaje_subprocesos= true;
					$this->msjSubproceso['success']='Success updating PROCCESS';
				}else{
					//Fracaso al modificar
					$this->msjSubproceso = $db->mensaje;
					$this->mensaje_subprocesos= true;
				}
			}else{
				//Insertar
				if($db->insert_subproceso($data)){
					//Éxito al insertar
					$this->mensaje_subprocesos= true;
					$this->msjSubproceso['success']='Success adding PROCCESS';
				}else{
					//Fracaso al insertar
					$this->msjSubproceso = $db->mensaje;
					$this->mensaje_subprocesos= true;
				}
			}
		}
	
		/**
			FUNCIÓN PARA ELIMINAR UN REGISTRO EN LA TABLA SUBPROCESOS
		**/
		public function delete_registro_subproceso($id){
			if(isset($id)){
				$db = new modelSubproceso();
				if($db->delete_subproceso($id)){
					//Éxito al insertar
					$this->mensaje_subprocesos= true;
					$this->msjSubproceso['success']='Success deleting SUBPROCCESS';
				}else{
					//Fracaso al eliminar
					$this->mensaje_subprocesos= true;
					$this->msjSubproceso['danger']='Impossible to eliminate SUBPROCSESS.';
				}
			}else{
				//Fracaso al eliminar
				$this->mensaje_subprocesos= true;
				$this->msjSubproceso['warning']='Impossible to eliminate, SUBPROCCESS not selected.';
			}
		}
		
		/**
			FUNCIÓN PARA OBTENER REGISTRO DE NORMA, EN FORMATO DE SELECT
		**/
		public function pull_data_Select_norma(){
			$db = new modelNorma();
			return $db->get_atrib_toSelect();
		}
	
	}
?>