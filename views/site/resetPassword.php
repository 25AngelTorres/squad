<?php
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');
	
	include	('../../Models/modelsUsuario.php');
	include	('../../Controllers/controlLogin.php');

	include ('header.php');
	
	$login = new controllerLogin();
	
	
	
	if(isset($_POST['userRecover']) && 
	isset($_POST['mailRecover'])){	
		//die();
		$login->recoverPassword($_POST);
	}
	if(isset($_POST['user']) && 
	isset($_POST['password'])){
		echo '<pre>';
		echo 'Login';
		echo '</pre>';
		die();
		//$login->login($_POST);
	}
	
	
?>
	<body id='login'>
		<div class='login-div'>
			
			<div id='login-div-form' class="login-div-form">
			
				<form class='form' method = 'POST' role='form'>
				
					<div class='form-group row'>
						<label for='inputUser' class='sr-only'>User</label>
						<input type='' id='inputUser' class='form-control' placeholder='User' name='user' required autofocus>
					</div>
					<div class='form-group row'>
						<label for='inputPassword' class='sr-only'>Password</label>
						<input type='password' id='inputPassword' class='form-control' placeholder='Password' name='password' required>
					</div>

						<?php
							//Montrar errorer
							if ($login->muestra_errores) {
								foreach ($login->errores as $key => $value) {
									echo '<div class="alert alert-danger centro_50">';
									echo $value."</div>";
								}
							}
							if ($login->muestra_errores_reset){
								foreach ($login->errores as $key => $value) {
									echo '<script language="javascript">alert("'.$value.'");</script>';
								}
							}
						?>
					
					<p class=''> 
					<button class='btn btn-lg btn-primary btn-block' type="submit">Sign in</button>
					</p>
				</form>
			</div>
		</div>
<?php
	//Footer
	include ('footer.php');
?>