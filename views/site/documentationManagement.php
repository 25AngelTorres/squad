<?php
	//Header
	include ('header-navbar.php');
	
	include ('../../librs/adodb5/adodb-pager.inc.php');
	include ('../../librs/adodb5/adodb.inc.php');
	
	include	('../../Models/modelsConexion.php');
	include	('../../Models/modelsModelo.php');

	include	('../../Models/modelsMail.php');
	include	('../../Models/modelsER.php');
	
	include	('../../Models/modelsProceso.php');
	include	('../../Models/modelsSubproceso.php');
	include	('../../Models/modelsNorma.php');

	
	include	('../../controllers/controlDocumentationManagement.php');
	
	$controller = new controllerDocumentationManagement();
	
	/****PROCESO****/
	if(isset($_POST['updateProceso'])){
		if((int)$_POST['idProceso']==0){
			//Insertar Proceso
			if(isset($_POST['nameProceso'])  ){
				//Insertar
				$data = array(
				'name' 			=> trim($_POST['nameProceso']),
				'description'	=> trim($_POST['descriptionProceso']),
				);
				$controller->push_registro_proceso($data);
			}else{
				//Mensaje de error
				$controller->mensaje_procesos = true;
				$controller->mensajeProceso['danger']='Empty NAME field';
			}
		}else{
			//Modificar Proceso
			if(isset($_POST['nameProceso'])  ){
				//Modificar
				$data = array(
				'id_proceso'	=> (int)$_POST['idProceso'],
				'name' 			=> trim($_POST['nameProceso']),
				'description'	=> trim($_POST['descriptionProceso']),
				);
				$controller->push_registro_proceso($data);
			}else{
				//Mensaje de error
				$controller->mensaje_procesos = true;
				$controller->mensajeProceso['danger']='Empty NAME field';
			}
		}
	}
	if(isset($_POST['deleteProceso'])){
		if(!(int)$_POST['idProceso']==0){
			$controller->delete_registro_proceso($_POST['idProceso']);
		}
	}
	/****SUBPROCESO****/
	if(isset($_POST['updateSubproceso'])){
		if((int)$_POST['idSubproceso']==0){
			//Insertar Subproceso
			if(isset($_POST['nameSubproceso'])){
				//Acomodo de información
				$data = array(
				'name'			=> trim($_POST['nameSubproceso']),
				'description'	=> trim($_POST['descriptionSubproceso']),
				'id_proceso'	=> (int)$_POST['id_procesoSubproceso'],
				);
				//Insertar subproceso
				//die(print_r($data));
				$controller->push_registro_subproceso($data);
			}else{
				//Mensaje de error
				$controller->mensaje_subprocesos = true;
				$controller->mensajeSubproceso['danger']='Empty NAME field';
			}
		}else{
			//Modificar Subproceso
			if(isset($_POST['nameSubproceso'])){
				//Acomodo de información
				$data = array(
				'id_subproceso'	=> (int)$_POST['idSubproceso'],
				'name'			=> trim($_POST['nameSubproceso']),
				'description'	=> trim($_POST['descriptionSubproceso']),
				'id_proceso'	=> (int)$_POST['id_procesoSubproceso'],
				);
				//Modificar subproceso
				//die(print_r($data));
				$controller->push_registro_subproceso($data);
			}else{
				//Mensaje de error
				$controller->mensaje_subprocesos = true;
				$controller->mensajeSubproceso['danger']='Empty NAME field';
			}
		}
	}
	if(isset($_POST['deleteSubproceso'])){
		if(!(int)$_POST['idSubproceso']==0){
			$controller->delete_registro_subproceso($_POST['idSubproceso']);
		}
	}

	/****NORMA****/
	
	/****REVISIÓN****/
	
	/****DOCUMENTO****/
	
?>

<div id='content'>
	<div class='header'>
		<span>DOCUMENTATION MANAGEMENT</span>
	</div>
	<div class='body'>
		<div id='' class='managementForm'>
		<h4>
			Processes
		</h4>
		<div class='form-group col-md-12'>
			<?php
				//Mostrar mensajes
				if($controller->mensaje_procesos) {
					
					foreach( $controller->msjProceso as $key => $value){
						echo $controller->mensaje($key,'alertFade',$value);
					}
				}
			?>
		</div>
		<div id='procesoForm' class='managementForm'>
			<form id='formDocumentoProceso' class='form' method = 'POST' role='form'>
				<div class='form-group row'>
					<label for='idProceso' class='col-md-3 col-form-label'>Select Process</label>
					<div id='' class='col-md-4'>
						<?php // 
						echo $controller -> do_select('proceso','idProceso', 'idProceso', 'form-control', null,'New Process', 0);
						?>
					</div>
					<div class='col-md-5 ' >
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
							<textarea id='descriptionProceso' class='form-control' rows='1' name='descriptionProceso'></textarea>
						</div>
					</diV>
					<div class='form-group row '>
						<button type="submit" class="btn btn-sm btn-primary col-md-3 offset-md-3" name='updateProceso'> Insert / Update </button>
						<a id='btnDeleteProceso' class='btn btn-sm btn-danger col-md-2 offset-md-1 disabled' href="#" data-toggle="modal" data-target="#deleteModalProceso" onclick='ajaxProceso()' >Delete</a>
					</diV>
				</div>
				<!-- Logout Modal-->
				<div class='modal fade' id="deleteModalProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Delete Process?</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Do you want to permanently delete the Process ?</div>
							<div class="modal-footer">
								<button class="btn btn-secondary col-md-4" type="button" data-dismiss="modal">Cancel</button>
								<button id='deleteProceso' type="submit" class="btn btn-danger col-md-2 offset-md-1" name='deleteProceso'>Delete</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div><!--procesoForm-->
		
		<div id='' class='managementForm'>
		<h4>
			Subprocesses
		</h4>
		<div class='form-group col-md-12'>
			<?php
				//Mostrar mensajes
				if($controller->mensaje_subprocesos) {
					
					foreach( $controller->msjSubproceso as $key => $value){
						echo $controller->mensaje($key,'alertFade',$value);
					}
				}
			?>
		</diV>
		<div id='subprocesoForm' class='managementForm hide'>
			<form id='formDocumentoSubproceso' class='form' method='POST' role='form'>
				<div class='form-group row'>
					<label for='idSubproceso' class='col-md-3 col-form-label'>Select Subprocess</label>
					<div id='' class='col-md-4'>
						<select id='idSubproceso' name='idSubproceso' class='form-control'>
							
							
						</select>
					</div>
					<div class='col-md-5 ' >
						<a id='managementFormSubproceso' href='#' class='btn btn-outline-secondary col-md-6 offset-md-3'>Manage</a>
					</div>
				</div>
				<div id='elementsSubprocesoForm' class='managementFormElements'>
					<div class='form-group row '>
						<label for='nameSubproceso' class='col-md-2 col-form-label'>Name</label>
						<div class='col-md-10'>
							<input type='text' class='form-control' id='nameSubproceso' name='nameSubproceso' required>
						</div>
					</diV>
					<div class='form-group row '>
						<label for='descriptionSubproceso' class='col-md-2 col-form-label'>Description</label>
						<div class='col-md-10'>
							<textarea id='descriptionSubproceso' class='form-control' rows='1' name='descriptionSubproceso'></textarea>
						</div>
					</diV>
					<div class='form-group row '>
						
						<div class='col-md-10'>
							<input type='hidden' class='form-control' id='id_procesoSubproceso' name='id_procesoSubproceso' >
						</div>
					</diV>
					<div class='form-group row '>
						<button type="submit" class="btn btn-sm btn-primary col-md-3 offset-md-3" name='updateSubproceso'> Insert / Update </button>
						<a id='btnDeleteSubproceso' class='btn btn-sm btn-danger col-md-2 offset-md-1 disabled' href="#" data-toggle="modal" data-target="#deleteModalSubproceso" >Delete</a>
					</diV>
				</div>
				<!-- Logout Modal-->
				<div class='modal fade' id="deleteModalSubproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Delete Subprocess?</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Do you want to permanently delete the Subprocess ?</div>
							<div class="modal-footer">
								<button class="btn btn-secondary col-md-4" type="button" data-dismiss="modal">Cancel</button>
								<button id='deleteSubproceso' type="submit" class="btn btn-danger col-md-2 offset-md-1" name='deleteSubproceso'>Delete</button>
							</div>
						</div>
					</div>
				</div>
				
			</form><!--Formulario subproceso-->
		</div>
		</div><!--subprocesoForm-->
		
		<div id='' class='managementForm'>
		<h4>
			Documents
		</h4>
		<div class='form-group col-md-12'>
			<?php
				//Mostrar mensajes
				if($controller->mensaje_documento) {
					foreach( $controller->msjDocumento as $key => $value){
						echo $controller->mensaje($key,'alertFade',$value);
					}
				}
				if($controller->mensaje_norma) {
					foreach( $controller->msjNorma as $key => $value){
						echo $controller->mensaje($key,'alertFade',$value);
					}
				}
				if($controller->mensaje_revision) {
					foreach( $controller->msjRevision as $key => $value){
						echo $controller->mensaje($key,'alertFade',$value);
					}
				}
			?>
		</div>
		<div id='documentoForm' class='managementForm hide'>
			<div class='form-group row'>
				<label for='preidDocumento' class='col-md-3 col-form-label'>Select Document</label>
				<div id='' class='col-md-4'>
					<select id='preidDocumento' name='preidDocumento' class='form-control'>
					</select>
				</div>
				<div class='col-md-5 ' >
					<a id='managementFormDocumento' href='#' class='btn btn-outline-secondary col-md-6 offset-md-3'>Manage</a>
				</div>
			</div>
			<div id='elementsDocumentoForm' class='managementFormElements'>
				<div id='normaForm' class='managementForm'>
					<form id='formNormaSubproceso' class='form' method='POST' role='form'>
						<div class='form-group row'>
							<label for='preidNorma' class='col-md-3 col-form-label'>Select Norma</label>
							<div id='' class='col-md-4'>
								<select id='preidNorma' name='preidNorma' class='form-control'>
								</select>
							</div>
							<div class='col-md-5 ' >
								<a id='managementFormNorma' href='#' class='btn btn-outline-secondary col-md-6 offset-md-3'>Manage</a>
							</div>
						</div>
						<div id='elementsNormaForm' class='managementFormElements'>
							<div class='form-group row '>
								<label for='nameNorma' class='col-md-2 col-form-label'>Name</label>
								<div class='col-md-10'>
									<input type='text' class='form-control' id='nameNorma' name='nameNorma' required>
								</div>
							</div>
							<div class='form-group row '>
								<label for='descriptionNorma' class='col-md-2 col-form-label'>Description</label>
								<div class='col-md-10'>
									<textarea id='descriptionNorma' class='form-control' rows='1' name='descriptionNorma'></textarea>
								</div>
							</div>
							<div class='form-group row'>
								<label for='validityNorma' class='col-md-2 col-form-label'>validity</label>
								<div class='col-md-10'>
									<div class="input-group date" data-provide="datepicker">
										<input id='validityNorma' name='validityNorma' type='text' class='form-control'>
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<div class='form-group row '>
								<button type="submit" class="btn btn-sm btn-primary col-md-3 offset-md-3" name='updateNorma'> Insert / Update </button>
								<a id='btnDeleteNorma' class='btn btn-sm btn-danger col-md-2 offset-md-1 disabled' href="#" data-toggle="modal" data-target="#deleteModalNorma" >Delete</a>
							</div>
						</div>
						
						
						
						
						
					</form><!--formulario Norma -->
				</div><!--normaForm-->
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
		</div>
		</div><!--documentoForm-->
		
		
		
	</div><!-- body -->
</div>

<?php
	//Footer
	include('footer.php');
?>