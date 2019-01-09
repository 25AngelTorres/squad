<?php 
/** Valida que se haya iniciado sesion
	Sesion iniciada 	- Continua y optiene la informacion de la variable $_session
	Sesión no iniciada	- Redirige a sitio de login
*/
	//Iniciar session
	session_start();
	//Valida que exista la información de sesion, en caso de no existir, redirigir a login
	if( !isset($_SESSION['user']))
		header('Location: login.php');
?>