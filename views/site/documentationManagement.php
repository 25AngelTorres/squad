<?php
	//Header
	include ('header-navbar.php');
	
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');

	include	('../../Models/modelsMail.php');
	
	include	('../../Models/modelsProceso.php');
	include	('../../controllers/controlDocumentationManagement.php');
	
	$controller = new controllerDocumentationManagement();
	


?>

<div id='content'>
	<div class='header'>
		<span>DOCUMENTATION MANAGEMENT</span>
	</div>
	<div class='body'>
		<h4>
			Processes
		</h4>
		<div id='procesoForm' class='managementForm'>
			<form id='formDocumentoProceso' class='form' method = 'POST' role='form'>
				<div class='form-group row'>
					<label for='idProceso' class='col-md-2 col-form-label'>Select Process</label>
					<div class='col-md-4'>
						<?php // 
						echo $controller -> do_select('proceso','idProceso', 'idProceso', 'form-control', null,'New Processes', 0);
						?>
					</div>
					<div class='col-md-6 ' >
						<a id='managementFormProceso' href='#' class='btn  btn-outline-secondary col-md-6 offset-md-3'>Manage</a>
					</div>
				</div>
				<div id='elementsProcesoForm' class='managementFormElements'>
					<div class='form-group row '>
						<label for='nameProceso' class='col-md-2 col-form-label'>Name</label>
						<div class='col-md-10'>
							<input type='text' class='form-control' id='nameProceso' name='nameProceso' required>
						</div>
					</diV>
					<div class='form-group row '>
						<label for='descriptionProceso' class='col-md-2 col-form-label'>Description</label>
						<div class='col-md-10'>
							<textarea id='descriptionProceso' class='form-control' rows='1'></textarea>
						</div>
					</diV>
					<div class='form-group row '>
						<?php
						//Mostrar errores
						?>
					</diV>
					<div class='form-group row '>
						<button type="submit" class="btn btn-sm btn-primary col-md-3 offset-md-3" name='updateProceso'> Insert / Update </button>
						<a class='btn btn-sm btn-danger col-md-2 offset-md-1 disabled' href="#" data-toggle="modal" data-target="#deleteModalProceso" >Delete</a>
					</diV>
				</div>
				<!-- Logout Modal-->
				<div class='modal fade' id="deleteModalProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>

<?php
	//Footer
	include('footer.php');
?>