<?php

	include ('../librs/adodb5/adodb-pager.inc.php');
	include ('../librs/adodb5/adodb.inc.php');
	
	include	('../Models/modelsConexion.php');
	include	('../Models/modelsModelo.php');
	
	include	('../Models/modelsSubproceso.php');

	include	('../Models/modelsNorma.php');

	include	('controlDocumentationManagement.php');
	//include	('../../controllers/controlConfig-user-AX.php');
	
	$controller = new controllerDocumentationManagement();

	$id = ($_POST['id']);
	
	
	$resultado = array(
	0 => array(
			'name' 			=>'',
			'description'	=>'',
		),
	);
	$ducOption = '<option value="0">New Document</option>';
	$normaOption = '<option value="0">New Norma</option>';

	
	if($id!=0){
		$resultado 	= $controller->pull_data_subproceso($id);
		//Obtener valores de documento relacionado a este subproceso
		/*
		$temp = $controller->pull_data_documento_where('id_subproceso = '.$id);
		foreach($documento as $value){
			$ducOption.= '<option value="'.$value['value'].'">'.$value['option'].'</option>';
		}
		*/
		//Obtener registro de normas
		$temp = $controller->pull_data_Select_norma();
		foreach($temp as $value){
			$normaOption.= '<option value="'.$value['value'].'">'.$value['option'].'</option>';
		}
	}
	echo $resultado[0]['name'].'-#-'.$resultado[0]['description'].'-/-'.$ducOption.'-/-'.$normaOption;

	//echo ($resultado[0]['user'].'-#-'.$resultado[0]['name'].'-#-'.$resultado[0]['mail'].'-#-'.$resultado[0]['reset_password'].'-#-'.$resultado[0]['tipo']);
?>