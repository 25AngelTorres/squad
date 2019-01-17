<?php
/*
Contine las clases 
*/
	class controllerDocumentationManagement extends modelProceso {
		
		public $muestra_errores = false;
		public $muestra_exitos 	= false;

		//Constructor de clase
		function __construct(){
			 parent::conexion();
		}
		
		/**
			FUNCION PARA CREAR SELECT CON VALORES DE TABLA
		**/
		public function do_select($table, $idSelect, $nameSelect , $classSelect, $otroSelect, $option, $valueOption){
			//seleccion de acuerdo a la tabla
			switch ($table) {
				case "proceso":
					$opt = $this->get_atrib_toSelect_Proceso();
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
	}
?>