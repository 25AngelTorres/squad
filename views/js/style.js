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
	})(jQuery); // End of use strict
	
	