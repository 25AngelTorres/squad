<?php 
/** Valida que se haya iniciado sesion
	Sesion iniciada 	- Continua y optiene la informacion de la variable $_session
	Sesión no iniciada	- Redirige a sitio de login
*/


	//Valida que exista la información de sesion, en caso de no existir, redirigir a login
	if($_SESSION['id_usuario']!=1){
		echo ('
		<div class="alert alert-warning" role="alert">
		  <h4 class="alert-heading">Without privileges to access</h4>
		  <p>Contact the administrator to modify your user profile.</p>
		</div>
		');
		
		//Footer
		include('footer.php');
		die();
	}
?>