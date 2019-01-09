/**/
	(function($){
		"use strict"; // Start of use strict
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
		});
		//Botón borrar para mostrar información necesaria para elimianr
		$('#btn-update').on( "click", function(e) {
			e.preventDefault();
			$('#btn-update').addClass('active');
			$('#btn-delete').removeClass('active');
			
			$('.form-update').addClass('show');
			$('.form-delete').removeClass('show');
		});
		
	})(jQuery); // End of use strict
	
	