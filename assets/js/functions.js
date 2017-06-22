$(document).ready(function(){

	$('.button-collapse').sideNav({
	      menuWidth: 200
	    }
	);

	$('.collapsible').collapsible();


	//REMOVE SET TIME OUT
	setTimeout(function(){
		$(window).ready(function(){
			$('#main-loader').hide();
			$('body').removeClass('not-scroll');
		});
	}, 3000);





});