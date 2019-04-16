<?php

	include ('../librs/adodb5/adodb-pager.inc.php');
	include ('../librs/adodb5/adodb.inc.php');
	
	include	('../Models/modelsConexion.php');
	include	('../Models/modelsModelo.php');
	
	include	('../Models/modelsProceso.php');
	include	('../Models/modelsSubproceso.php');
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
	$subOption = '<option value="0">New Subprocess</option>';
	
	if($id!=0){
		$resultado 	= $controller->pull_data_proceso($id);
		//Obtener valores de subproceso
		$subproceso = $controller->pull_data_subproceso_where('id_proceso = '.$id);
		foreach($subproceso as $value){
			$subOption.= '<option value="'.$value['value'].'">'.$value['option'].'</option>';
		}
	}
	echo $resultado[0]['name'].'-#-'.$resultado[0]['description'].'-/-'.$subOption;

	//echo ($resultado[0]['user'].'-#-'.$resultado[0]['name'].'-#-'.$resultado[0]['mail'].'-#-'.$resultado[0]['reset_password'].'-#-'.$resultado[0]['tipo']);
?>