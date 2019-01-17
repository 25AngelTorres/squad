<?php
	include ('../librs/adodb5/adodb-pager.inc.php');
	include ('../librs/adodb5/adodb.inc.php');
	
	include	('../Models/modelsConexion.php');
	include	('../Models/modelsModelo.php');
	
	include	('../Models/modelsMail.php');
	
	include	('../Models/modelsUsuario.php');
	include	('controlConfig-user.php');
	//include	('../../controllers/controlConfig-user-AX.php');
	
	$configUser = new controllerConfigUser();

	$id = $_POST['id'];
	
	$resultado = array(
	0 => array(
		'id_usuario' 	=>'',
		'user'			=>'',
		'name'			=>'',
		'mail'			=>'',
		'reset_password'=>'',
		'tipo'			=>'0',
		),
	);
	
	if($id!=0){
		$resultado = $configUser->pull_registros($id);
	}
	
	echo ($resultado[0]['user'].'-#-'.$resultado[0]['name'].'-#-'.$resultado[0]['mail'].'-#-'.$resultado[0]['reset_password'].'-#-'.$resultado[0]['tipo']);
?>