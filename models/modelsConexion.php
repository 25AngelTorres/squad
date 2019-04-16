<?php
	/*modelsConexion*/
	
	/*
	Esta clase realiza la conexion con la base de datos, utilizando la libreria ADO para realizar conexiones con diversas bases de datos
	*/
	class modelConexion {

		function conexion(){
			$this->db = ADONewConnection('mysqli');
			$this->db->debug = false;
					   //ip     user      pass    bd
			$this->db->Connect('localhost','root','','i_qms');
			$this->db->setCharset('utf8');
		}
	}

?>