/**/


	(function($){
		"use strict"; // Start of use strict
		
		/** Botones para login **/
		$("#login-forgot").on( "click", function(e) {
			e.preventDefault();
			$('#forgot-div-form').show(); //muestro mediante id
			$('#login-div-form').hide(); //muestro mediante id
			//$('.target').show(); //muestro mediante clase
		 });
		 
		$("#dropdown-toggle1").on( "click", function(e) {
			e.preventDefault();
			$('#menu-dropdown-toggle').toggleClass('show');
		});
		
		
		/**SIDEBAR-LEFT**/
		$('#sidebarToggle-leftbar').on('click', function(e){
			$('#sidebar-left').toggleClass('span');
			$('#content').toggleClass('span');
		});
		
		/** Botones en config-user-admin **/
		//Boton actualizar para mostrar información necesaria para actualizar
		$('#btn-delete').on( "click", function(e) {
			e.preventDefault();
			$('#btn-delete').addClass('active');
			$('#btn-update').removeClass('active');
			
			$('.form-delete').addClass('show');
			$('.form-update').removeClass('show');
			
			$('#inputPassword1Update').val('1');
			$('#inputPassword2Update').val('1');
		});
		//Botón borrar para mostrar información necesaria para elimianr
		$('#btn-update').on( "click", function(e) {
			e.preventDefault();
			$('#btn-update').addClass('active');
			$('#btn-delete').removeClass('active');
			
			$('.form-update').addClass('show');
			$('.form-delete').removeClass('show');
			
			$('#inputPassword1Update').val('');
			$('#inputPassword2Update').val('');
		});
		
		
		
		//Cambio en select de usuarios
		$('#inputId').change(function() {
			var id_usuario	= this.value;
			var resul 		= new Array();
			$.ajax({
				// En data puedes utilizar un objeto JSON, un array o un query string
				data: 		{ id : id_usuario },
				//Cambiar a type: POST si necesario
				type: 		"POST",
				// Formato de datos que se espera en la respuesta
				dataType: 	"text",
				// URL a la que se enviará la solicitud Ajax
				url: 		"../../Controllers/controlConfig-user-AX.php",
			})
			 .done(function( res) {
				 resul = res.split("-#-");
				$('#inputUserUpdate').val(resul[0]);
				$('#inputUserDelete').val(resul[0]);
				$('#inputNameUpdate').val(resul[1]);
				$('#inputNameDelete').val(resul[1]);
				$('#inputMailUpdate').val(resul[2]);
				$('#inputMailDelete').val(resul[2]);
				$('#inputTipoUpdate').val(resul[4]);
				$('#inputTipoDelete').val(resul[4]);
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
				 alert("ERROR " + textStatus + " - " + errorThrown + " --- ");
			});
		});
		
		
		/**ANIMACION PARA ALERTAS**/
		$(".alertFade").fadeTo(5000, 500).slideUp(500, function(){ 
			$(".alertFade").slideUp(500); 
		}); 
		
		
		/**DOCUMENTATION MANAGEMENT**/
		//Mostrar div con formularios
		$('#managementFormProceso').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormProceso').toggleClass('active');
			$('#procesoForm').toggleClass('atention');
			$('#elementsProcesoForm').toggle('slow');
			
			//Ocultar otros formularios
			$('#elementsSubprocesoForm').hide(500);
			$('#subprocesoForm').removeClass('atention');
			$('#elementsDocumentoForm').hide(500);
			$('#documentoForm').removeClass('atention');
			$('#elementsNormaForm').hide(500);
			$('#normaForm').removeClass('atention');
			$('#elementsRevisionForm').hide(500);
			$('#revisionForm').removeClass('atention');
			
			//Mover focus al elemento del formulario
			$('input[name=nameProceso]').focus();
			
			//Desactivar boton de management
			$('#managementFormSubproceso').removeClass('active');
			$('#managementFormDocumento').removeClass('active');
			$('#managementFormNorma').removeClass('active');
			$('#managementFormRevision').removeClass('active');
		});
		$('#managementFormSubproceso').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormSubproceso').toggleClass('active');
			$('#subprocesoForm').toggleClass('atention');
			$('#elementsSubprocesoForm').toggle('slow');
			
			//ocultar otros formularios
			$('#elementsProcesoForm').hide(500);
			$('#procesoForm').removeClass('atention');
			$('#elementsDocumentoForm').hide(500);
			$('#documentoForm').removeClass('atention');
			$('#elementsNormaForm').hide(500);
			$('#normaForm').removeClass('atention');
			$('#elementsRevisionForm').hide(500);
			$('#revisionForm').removeClass('atention');
			
			//Mover el focus al elemento del formulario
			$('input[name=nameSubproceso]').focus();
			//Desactivar boton de management
			$('#managementFormProceso').removeClass('active');
			$('#managementFormDocumento').removeClass('active');
			$('#managementFormNorma').removeClass('active');
			$('#managementFormRevision').removeClass('active');
		});
		$('#managementFormDocumento').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormDocumento').toggleClass('active');
			$('#documentoForm').toggleClass('atention');
			$('#elementsDocumentoForm').toggle('slow');
			
			//ocultar otros formularios
			$('#elementsProcesoForm').hide(500);
			$('#procesoForm').removeClass('atention');
			$('#elementsSubprocesoForm').hide(500);
			$('#subprocesoForm').removeClass('atention');
			$('#elementsNormaForm').hide(500);
			$('#normaForm').removeClass('atention');
			$('#elementsRevisionForm').hide(500);
			$('#revisionForm').removeClass('atention');
			
			//Mover el focus al elemento del formulario
			$('input[name=nameDocumento]').focus();
			//Desactivar boton de management
			$('#managementFormProceso').removeClass('active');
			$('#managementFormSubproceso').removeClass('active');
			$('#managementFormNorma').removeClass('active');
			$('#managementFormRevision').removeClass('active');
		});
		$('#managementFormNorma').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormNorma').toggleClass('active');
			$('#normaForm').toggleClass('atention');
			$('#elementsNormaForm').toggle('slow');
			
			//ocultar otros formularios
			$('#elementsProcesoForm').hide(500);
			$('#procesoForm').removeClass('atention');
			$('#elementsSubrocesoForm').hide(500);
			$('#subprocesoForm').removeClass('atention');
			$('#elementsRevisionForm').hide(500);
			$('#revisionForm').removeClass('atention');
			$('#documentoForm').toggleClass('atention');
			
			//Mover el focus al elemento del formulario
			$('input[name=nameNorma]').focus();
			//Desactivar boton de management
			$('#managementFormProceso').removeClass('active');
			$('#managementFormDocumento').removeClass('active');
			$('#managementFormSubproceso').removeClass('active');
			$('#managementFormRevision').removeClass('active');
		});
		$('#managementFormRevision').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormRevision').toggleClass('active');
			$('#revisionForm').toggleClass('atention');
			$('#elementsRevisionForm').toggle('slow');
			
			//ocultar otros formularios
			$('#elementsProcesoForm').hide(500);
			$('#procesoForm').removeClass('atention');
			$('#elementsSubprocesoForm').hide(500);
			$('#subprocesoForm').removeClass('atention');
			$('#elementsNormaForm').hide(500);
			$('#normaForm').removeClass('atention');
			$('#documentoForm').toggleClass('atention');
			
			//Mover el focus al elemento del formulario
			$('input[name=revRevision]').focus();
			//Desactivar boton de management
			$('#managementFormProceso').removeClass('active');
			$('#managementFormDocumento').removeClass('active');
			$('#managementFormNorma').removeClass('active');
			$('#managementFormSubproceso').removeClass('active');
		});
		
		
		//Cambio en select
		$('#idProceso').change(function() {
			var id_proceso = this.value;		
			proceso(id_proceso);
		});
		$('#idSubproceso').change(function() {
			var id_subproceso = this.value;
			//alert("resultado " + id_subproceso );
			subproceso(id_subproceso);
		});
		$('#preidDocumento').change(function() {
			var id_documento = this.value;
			//alert("resultado " + id_subproceso );
			$('#idDocumento').val(id_documento);
			//documento(id_documento);
		});
		$('#preidNorma').change(function() {
			var id_norma = this.value;
			//alert("resultado " + id_subproceso );
			$('#id_normaDocumento').val(id_norma);
			//norma(id_norma);
		});
		$('#preidRevision').change(function() {
			var id_revision = this.value;
			//alert("resultado " + id_subproceso );
			$('#id_revisionDocumento').val(id_revision);
			//revision(id_revision);
		});
		
		
		function proceso(id_proceso){
			$.ajax({
				data:		{ id: id_proceso },
				type:		'POST',
				url:		'../../Controllers/controlDocumentationManagement-Proceso-ax.php',
			})
				.done(function (res){					
					//alert("resultado " + res );
					
					/***Preparar información obtenida***/
					var option = res.split("-/-");
					//Option[0] 	- 	Valores Proceso
					//Option[1]		-	Valores Subproceso
					
					var proceso = option[0].split("-#-");
					//proceso[0]	-	Name
					//proceso[1]	-	Description				
					
					$('#nameProceso').val(proceso[0]);
					$('#descriptionProceso').val(proceso[1]);
					//Habilitar elementos
					if (id_proceso > 0) {
						//Habilitar boton para eliminar registro proceso
						$('#btnDeleteProceso').removeClass('disabled');
						//Habilitar seccion de subproceso
						$('#subprocesoForm').removeClass('hide');
					}else{
						//Deshabilitar botón para eliminar registro proceso
						$('#btnDeleteProceso').addClass('disabled');
					}
					/***Actualización en subproceso***/
					//Actualizar id_proceso en Subproceso
					$('#id_procesoSubproceso').val(id_proceso);
					//Actualizar select subproceso
					$('#idSubproceso').children().remove();
					$("#idSubproceso").append(option[1]);
					
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
					alert("ERROR en ajax --" + textStatus + " --- " + errorThrown );
				})
				.always(function() {
					//alert( "complete" );
				})
			;// Fin ajax
		}
				
		function subproceso(id_subproceso){
			$.ajax({
				data:		{ id: id_subproceso },
				type:		'POST',
				url:		'../../Controllers/controlDocumentationManagement-Subproceso-ax.php',
			})
				.done(function (res){
					//alert("resultado " + res );
					
					/***Preparar información obtenida***/
					var option = res.split("-/-");
					//Option[0] 	- 	Valores subproceso
					//Option[1]		-	Valores documento
					//Option[2]		-	Valores norma
					//Option[3]		-	Valores revisar
					
					var subproceso = option[0].split("-#-");
					//proceso[0]	-	Name
					//proceso[1]	-	Description				
					
					$('#nameSubproceso').val(subproceso[0]);
					$('#descriptionSubproceso').val(subproceso[1]);
					//Habilitar elementos
					if (id_subproceso > 0) {
						//Habilitar botón para eliminar registro subproceso
						$('#btnDeleteSubproceso').removeClass('disabled');
						//Habilitar sección de documento
						$('#documentoForm').removeClass('hide');
					}else{
						//Deshabilitar botón para eliminar registro proceso
						$('#btnDeleteSubproceso').addClass('disabled');
					}
					/***Actualización en documento***/
					//Actualizar id_subproceso en Documento
					$('#id_subprocesoDocumento').val(id_subproceso);
					//Actualizar select documento
					$('#preidDocumento').children().remove();
					$('#preidDocumento').append(option[1]);
					//Actualizar select modelo
					$('#preidNorma').children().remove();
					$('#preidNorma').append(option[2]);
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
					alert("ERROR en ajax --" + textStatus + " --- " + errorThrown );
				})
				.always(function() {
					//alert( "complete" );
				})
			;// Fin ajax
		}
		
		
	})(jQuery); // End of use strict