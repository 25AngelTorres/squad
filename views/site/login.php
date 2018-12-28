<?php
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');
	
	//Enviar email
	include	('../../Models/modelsMail.php');
	
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
		$login->login($_POST);
	}
	
	
?>
	<body id='login'>
		<div class='login-div'>
			<div class='login-div-logo'>
				<img src='../images/logo_png.png' class='login-user-icon'>
			</div>
			<div class='login-div-form'>
				formulario
			</div>
			
			<img src='../images/login-user-icon.jpg' class='login-user-icon'>
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
					<p>
					<a id='login-forgot' href='' class='login-forgot' data-toggle='modal' data-target='#reqPasModal'>Request new password</a>
					</p>
					
				</form>
			</div>
		</div>
		<!-- request password modal -->
		<div class="modal fade" id="reqPasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Request new password</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p>
							A temporary password will be sent to registered mail, please enter with the new password</br></br></br>
						</p>
						<form class='form' method = 'POST' role='form'>
													  
							<?php 
								if ($login->muestra_errores_reset) {
								  foreach ($login->errores as $key => $value) {
									  echo '<div class="alert alert-danger centro_50">';
									echo $value."</div>";
								  }
								}
							?>
						  
							<p>
								<label for="inputUserRecover" class="sr-only">User</label>
								<input type="" id="inputUserRecover" class="form-control centro_50" placeholder="User" name="userRecover" required autofocus>
								<label for="inputMailRecover" class="sr-only">Email</label>
								<input type="mail" id="inputMailRecover" class="form-control centro_50" placeholder="Mail" name="mailRecover" required>
							</p>
						  
							<button class="btn btn-lg btn-success btn-block" type="submit">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	
<?php
	//Footer
	include ('footer.php');
?>