<?php

	$id = $_POST['id_usuario'];
	
	$resultado = array(
		'id_usuario' 	=>'',
		'user'			=>'',
		'name'			=>'ninguno',
		'mail'			=>'',
		'reset_password'=>'',
		'tipo'			=>'',
		);
	/*
	if($id!=0){
		$resultado = $this->pull_registros($_POST['id_usuario']);
	}

	return json_encode($resultado['name']);
	*/
	
	echo json_encode($resultado);
?>