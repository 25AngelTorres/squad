<?php
	/**	Agregar nuevos usuarios y modificar información **/
	
	//Header
	include ('header-navbar.php');
	//Seguridad 
	include ('../../Controllers/controlSecurity-Admin.php');
	
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');
	
	include	('../../Models/modelsMail.php');
	include	('../../Models/modelsER.php');
	
	include	('../../Models/modelsUsuario.php');
	include	('../../controllers/controlConfig-user.php');
	//include	('../../controllers/controlConfig-user-AX.php');
	
	$configUser = new controllerConfigUser();
	
	if(isset($_POST['update'])){
		if($_POST['inputId']==0){
			if(	isset($_POST['inputUserUpdate']) 		&&
				isset($_POST['inputNameUpdate']) 		&&
				isset($_POST['inputMailUpdate']) 		&&
				isset($_POST['inputPassword1Update']) 	&&
				isset($_POST['inputPassword2Update']) 	&&
				isset($_POST['inputTipoUpdate'])
				){
					//Insertar
				if(isset($_POST['inputResetUpdate']))
					$reset=1;
				else
					$reset=0;
				$datos = array(
				'user'			=>$_POST['inputUserUpdate'],
				'name'			=>$_POST['inputNameUpdate'],
				'mail'			=>$_POST['inputMailUpdate'],
				'password1'		=>$_POST['inputPassword1Update'],
				'password2'		=>$_POST['inputPassword2Update'],
				'reset_password'=>$reset,
				'tipo'			=>$_POST['inputTipoUpdate'],
				);
				$configUser->push_registros($datos);
			}
		}else{
			if(	isset($_POST['inputUserUpdate']) 		&&
				isset($_POST['inputNameUpdate']) 		&&
				isset($_POST['inputMailUpdate']) 		&&
				isset($_POST['inputPassword1Update']) 	&&
				isset($_POST['inputPassword2Update']) 	&&
				isset($_POST['inputTipoUpdate'])
				){
				//Modificar
				if(isset($_POST['inputResetUpdate']))
					$reset=1;
				else
					$reset=0;
				$datos = array(
				'id_usuario'	=>$_POST['inputId'],
				'user'			=>$_POST['inputUserUpdate'],
				'name'			=>$_POST['inputNameUpdate'],
				'mail'			=>$_POST['inputMailUpdate'],
				'password1'		=>$_POST['inputPassword1Update'],
				'password2'		=>$_POST['inputPassword2Update'],
				'reset_password'=>$reset,
				'tipo'			=>$_POST['inputTipoUpdate'],
				);
				$configUser->push_registros($datos);
			}
		}
	}
	if(isset($_POST['delete'])){
		if($_POST['inputId']==0){
		}else{
			$datos= array(
			'id_usuario'	=>$_POST['inputId'],
			'mail'			=>$_POST['inputMailUpdate'],
			);
			$configUser->delete_registros($datos);
		}
	}
	
?>


<div id='content'>
	<div class='header'>
		<span>USER ADMINISTRATION</span>
	</div>
	<div class='body'>
		<h4>
			
		</h4>
		<form class='form' method = 'POST' role='form' id='form-admin-user'>
			<div class='form-group row'>
				<label for='inputId' class='col-md-2 col-form-label'>Select user</label>
				<div class='col-md-3'>
					<?php echo $configUser -> do_select_option("inputId","form-control","inputId","0","New User");?>
				</div>
				<div class='col-md-5 offset-md-2'>
					<a id='btn-update' href='#' class='btn btn-outline-info col-md-7 active'>Update</a>
					<a id='btn-delete' href='#' class='btn btn-outline-danger col-md-4'>Delete</a>
				</div>
			</div>
			<div class='form-update show'>
				<div class='form-group row'>
					<label for='inputUserUpdate' class='col-md-2 col-form-label'>User</label>
					<div class='col-md-3'>
						<input type='text' class='form-control' id='inputUserUpdate' name='inputUserUpdate' required>
					</div>
					<label for='inputNameUpdate' class='col-md-2 col-form-label'>Name</label>
					<div class='col-md-5'>
						<input type='text' class='form-control' id='inputNameUpdate' name='inputNameUpdate' required>
					</div>
				</div>
				<div class='form-group row'>
					<label for='inputMailUpdate' class='col-sm-2 col-form-label'>Mail</label>
					<div class='col-sm-10'>
						<input type='mail' class='form-control' id='inputMailUpdate' name='inputMailUpdate' required>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword1Update" class="col-sm-2 col-form-label">Password</label>
					
					<div class="col-sm-5">
					  <input type='password' class='form-control' id='inputPassword1Update' name='inputPassword1Update' required>
					</div>
					<div class="col-sm-5">
						<label for='inputPassword2Update' class='sr-only'>Repet Password</label>
						<input type='password' class='form-control' id='inputPassword2Update' placeholder='repet password' name='inputPassword2Update' required>
					</div>
				</div>
				<div class="form-group row">
					<div class='col-md-10 offset-md-2'>
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" value="1" id="inputResetUpdate" name='inputResetUpdate'checked>
						  <label class="form-check-label" for="inputResetUpdate">
							Request new password
						  </label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for='inputTipoUpdate' class='col-sm-2 col-form-label'>Role</label>
					<div class='col-sm-3'>
						<select id='inputTipoUpdate' class='form-control' name='inputTipoUpdate' required>
						  <option value="2" selected>General</option>
						  <option value="1">Administrator</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<?php
						//Montrar errorer
						if ($configUser->muestra_errores) {
							foreach ($configUser->errores as $key => $value) {
								echo '<div class="alert alert-danger col-md-12">';
								echo $value."</div>";
							}
						}else{
							if($configUser->muestra_exitos) {
								foreach ($configUser->success as $key => $value) {
									echo '<div class="alert alert-success col-md-12">';
									echo $value."</div>";
								}
							}
						}
					?>
				</div>
				<div class="form-group row">
					<button type="submit" class="btn btn-primary col-md-3 offset-md-2" name='update'>Insert/Update</button>
				</div>
			</div><!-- form-update -->
			<div class='form-delete'>
				<div class='form-group row'>
					<label for='inputUserDelete' class='col-md-2 col-form-label'>User</label>
					<div class='col-md-3'>
						<input type='text' class='form-control' id='inputUserDelete' name='inputUserDelete' disabled>
					</div>
					<label for='inputNameDelete' class='col-md-2 col-form-label'>Name</label>
					<div class='col-md-5'>
						<input type='text' class='form-control' id='inputNameDelete' name='inputNameDelete' disabled>
					</div>
				</div>
				<div class='form-group row'>
					<label for='inputMailDelete' class='col-sm-2 col-form-label'>Mail</label>
					<div class='col-sm-10'>
						<input type='mail' class='form-control' id='inputMailDelete' name='inputMailDelete' disabled>
					</div>
				</div>
				<div class="form-group row">
					<label for='inputTipoDelete' class='col-sm-2 col-form-label'>Role</label>
					<div class='col-sm-10'>
						<select id='inputTipoDelete' class='form-control' name='inputTipoDelete' disabled>
						  <option value="2" selected>General</option>
						  <option value="1">Administrator</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<?php
						//Montrar errorer
						if ($configUser->muestra_errores) {
							foreach ($configUser->errores as $key => $value) {
								echo '<div class="alert alert-danger col-md-12">';
								echo $value."</div>";
							}
						}else{
							if($configUser->muestra_exitos) {
								foreach ($configUser->success as $key => $value) {
									echo '<div class="alert alert-success col-md-12">';
									echo $value."</div>";
								}
							}
						}
					?>
				</div>
				<div class="form-group row">
					<a class='btn btn-danger col-md-3 offset-md-2' href="#" data-toggle="modal" data-target="#deleteModal" >Delete</a>
				</div>
			</div>
						<!-- Logout Modal-->
			<div class='modal fade' id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Delete user?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">Do you want to permanently delete the user?</div>
						<div class="modal-footer">
							<button class="btn btn-secondary col-md-4" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-danger col-md-2 offset-md-1" name='delete'>Delete</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>	
</div>



<?php
	//Footer
	include('footer.php');
?>