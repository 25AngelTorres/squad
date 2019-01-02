/*
	(function($){
		"use strict"; // Start of use strict
		$("#login-forgot").on( "click", function(e) {
			e.preventDefault();
			$('#forgot-div-form').show(); //muestro mediante id
			$('#login-div-form').hide(); //muestro mediante id
			//$('.target').show(); //muestro mediante clase
		 });
		 
		$("#login-singin").on( "click", function(e) {
			e.preventDefault();
			$('#forgot-div-form').hide(); //muestro mediante id
			$('#login-div-form').show(); //muestro mediante id
		});
	})(jQuery); // End of use strict
	
	*
	(function($){
	$('#sidebarToggle-leftbar').on('click', function () {
            // open sidebar
            $('#sidebar-left').toggleClass('span');
			$('#content').toggleClass('span');
            // fade in the overlay
            //$('.overlay').addClass('span');
            //$('.collapse.in').toggleClass('in');
            //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
	})(jQuery); // End of use strict
	
	
	//Amostrar procedimientos
	(function($){
	$('#sidebarToggle-leftbar').on('click', function () {
            // open sidebar
            $('#sidebar-left').toggleClass('span');
			$('#content').toggleClass('span');
            // fade in the overlay
            //$('.overlay').addClass('span');
            //$('.collapse.in').toggleClass('in');
            //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
		*/
		
	// toggle the dropdown-toggle
	$(".dropdown-toggle").on('clic',function(e) {
		e.preventDefault();
		$('.dropdown-menu').toggleClass('show');
	}// toggle the dropdown-toggle
		
	})(jQuery); // End of use strict