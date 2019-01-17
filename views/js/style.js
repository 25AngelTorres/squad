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
		
		
		
		/**DOCUMENTATION MANAGEMENT**/
		//Mostrar div con formularios
		$('#managementFormProceso').on( "click", function(e) {
			e.preventDefault();
			$('#managementFormProceso').toggleClass('active');
			$('#procesoForm').toggleClass('atention');
			$('#elementsProcesoForm').toggle('slow');
		});
		
		
		
	})(jQuery); // End of use strict
	
	/*
	
	function updateFormConfigUserAdmin(val) {
		//Variables ..
		var id_usuario = val;
		alert("The input value has changed. The new value is: " + id_usuario);
		$.ajax({
			data:	id_usuario,
			url:	'../../controllers/controlConfig-user-AX.php',
			type:	'post',
			/*
			beeforeSend: function(){
					
			},
			*//*
		})
		.done(function(registro){
			alert("The input value has changed. The new value is: " + registro['mail']);
		});	
	}
	
	
	
	/*
	
	$(document).ready(funtion(){
	
	function updateFormConfigUserAdmin(val) {
		//Variables ..
		var id_usuario = val;
		alert("The input value has changed. The new value is: " + id_usuario);
		$.ajax({
			data:	id_usuario,
			url:	'../../controllers/controlConfig-user-AX.php',
			type:	'post',
			/*
			beeforeSend: function(){
					
			},
			*
		})
		.done(function(registro){
			alert("The input value has changed. The new value is: " + registro['mail']);
		});
		
		
	}
	}); */