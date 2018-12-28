<?php
/*
Este nos permite realizar inserciones, consultas, etc. en las bases de datos
Esta clase hereda de Conexion para realizar la conexion a las bases de datos    
*/
class modelModelo extends modelConexion {

	//Varianble
    public $db;

	//Constructor de clase
	function __construct(){
		 parent::conexion();
	}

	//Ejecuta una funcion personalizada en sql
    public function consulta_sql($sql) {
        $rs = $this->db->Execute($sql);
        $this->get_error($rs, 'Error en consulta datos');
        return $rs;
    }

	/**
	FUNCIÓN PARA INSERTAR EN LA BD
	
	@tabla	-	Record Set que se obtine al realizar una consulta a ls BD
	@fields	arreglo con nombre de las columnas y valores a insertar en ellas
	*/
    public function insertar($rs, $fields) {
        $sql_insert = $this->db->GetInsertSQL($rs, $fields);
        return $this->get_error($this->db->Execute($sql_insert), 'Error en Modelo.inserta');
    }

	//Funcion para leer el error al momento de realizar alguna operación en BD
    public function get_error($result, $tipo_error) {
        if ($result === false) {
            die('Redireccionar a la pagina de error: '. $this->db->ErrorMsg() .' '. $tipo_error);
            return false;
        } else {
            return true;
        }
    }

	//Consulta con Where
    public function show_grid($select = '*', $where = '') {
        $sql = "SELECT " . $select . " 
                FROM " . $this->nombre_tabla . " 
                " . $where;
        $grid = new ADODB_Pager($this->db, $sql);
        $grid->Render($rows_per_page = $num);
    }
	
	/**
	**/
    public function actualiza($sql_update) {
            return $this->get_error($this->db->Execute($sql_update), 'Error al actualizar');
    }

	//Elimina registro de la BD.
    public function elimina($where = 'null') {

        if ($where == 'null')
            $sql = "DELETE FROM " . $this->nombre_tabla;
        else
            $sql = "DELETE FROM " . $this->nombre_tabla . "
                    WHERE " . $where;

        return $this->get_error($this->db->Execute($sql), "Error al eliminar");
    }

//Generar select
    public function getDropDown($id_tabla,$nombre_columna,$tabla,$name,$id,$where = ' '){
         $rs = $this->consulta_sql(" select * from $tabla ".$where);
         $rows = $rs->GetArray();
         $dropDown = '<select class="form-control" id="'.$id.'" name="'.$name.'">
                        <option value="">Selecciona de la lista </option>';
         foreach ($rows as $key => $value) {
            $dropDown.= '<option value="'.$value[$id_tabla].'">'.utf8_encode($value[$nombre_columna]).'</option>';
         }
         $dropDown.= '</select>'; 
         return $dropDown;
    }
	
	/*
	Funcion para actualizar registros en la BD
	*/
	public function updateRegistro($record,$id,$atributos) {
		if (is_integer($id)) {
            $sql = "SELECT * FROM  " . $tabla . " 
                WHERE id_usuario = " . $id;

            $record = $this->db->Execute($sql);
            /*$rs = array();
            $rs['nombre'] = 'PEDROOOOOOO';
            $rs['email'] = 'pedroo@nnnnn.mmm';
            $rs['password'] = '0000000';*/

			echo('<pre>');
			print_r($record);
			print_r($this->atributos);
			echo('</pre>');
			
            $sql_update = $this->db->GetUpdateSQL($record, $this->atributos);
			
			echo('<pre>');
			print_r($sql_update);
			echo('</pre>');
			
            $this->get_error($this->db->Execute($sql_update), 'Error al actualizar');
        } else {
            die('OJO id no es entero (int() @variable) ');
        }
			
	}
	
}
?>


