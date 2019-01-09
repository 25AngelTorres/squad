<?php
	//Header
	include ('header-navbar.php');
	
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');
	
	include	('../../Models/modelsMail.php');
	
	include	('../../Models/modelsUsuario.php');
	include	('../../controllers/controlConfig-user.php');
	
	$configUser = new controllerConfigUser();
	
	if(isset($_POST['inputPassword1']) && 
	isset($_POST['inputPassword2'])	){
		$configUser->push_registros($_POST);
	}
	
	$registros = $configUser -> pull_registros($_SESSION['id_usuario']);
?>

<div id='content'>
	<div class='header'>
		<span>USER CONFIGURATION</span>
	</div>
	<div class='body'>
		<h4>
			<?php echo $registros[0]['user']; ?>
		</h4>
		<form class='form' method = 'POST' role='form'>
			<div class="form-group row">
				<label for="inputName" class="col-sm-2 col-form-label">Name</label>
				<div class="col-sm-10">
				  <input type='text' class='form-control' id='inputName' value ='<?php echo $registros[0]['name'];?>' name='inputName' required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputMail" class="col-sm-2 col-form-label">Mail</label>
				<div class="col-sm-10">
				  <input type='mail' class='form-control' id='inputMail' value ='<?php echo $registros[0]['mail'];?>' name='inputMail' required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword1" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-5">
				  <input type='password' class='form-control' id='inputPassword1' placeholder='password' name='inputPassword1' required autofocus>
				</div>
				<div class="col-sm-5">
					<label for='inputPassword2' class='sr-only'>Repet Password</label>
					<input type='password' class='form-control' id='inputPassword2' placeholder='repet password' name='inputPassword2' required>
				</div>
			</div>
			<div class="form-group row">
				<?php
					//Montrar errorer
					if ($configUser->muestra_errores) {
						foreach ($configUser->errores as $key => $value) {
							echo '<div class="alert alert-danger col-sm-12">';
							echo $value."</div>";
						}
					}else{
						if($configUser->muestra_exitos) {
							foreach ($configUser->success as $key => $value) {
								echo '<div class="alert alert-success col-sm-12">';
								echo $value."</div>";
							}
						}
					}
				?>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		</form>	
	</div>
</div>

<?php
	//Footer
	include('footer.php');
?>